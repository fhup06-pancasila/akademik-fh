<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Firebase\JWT\JWK;
use Firebase\JWT\JWT;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class OpenIdConnectController extends Controller
{
    public function redirect(Request $request): RedirectResponse
    {
        $state = Str::random(64);
        $nonce = Str::random(64);
        $verifier = Str::random(96);
        $challenge = rtrim(strtr(base64_encode(hash('sha256', $verifier, true)), '+/', '-_'), '=');

        $request->session()->put('oidc', compact('state', 'nonce', 'verifier'));

        return redirect()->away(config('services.oidc.issuer').'/oauth/authorize?'.http_build_query([
            'client_id' => config('services.oidc.client_id'),
            'redirect_uri' => config('services.oidc.redirect_uri'),
            'response_type' => 'code',
            'scope' => 'openid profile email',
            'state' => $state,
            'nonce' => $nonce,
            'code_challenge' => $challenge,
            'code_challenge_method' => 'S256',
            'prompt' => 'consent',
        ]));
    }

    public function callback(Request $request): RedirectResponse
    {
        if ($request->filled('error')) {
            return redirect()->route('login')->withErrors([
                'sso' => $request->input('error_description', 'Permintaan login dibatalkan.'),
            ]);
        }

        $oidc = $request->session()->pull('oidc');

        if (! $oidc || ! hash_equals($oidc['state'], $request->string('state')->toString())) {
            throw ValidationException::withMessages(['sso' => 'State login tidak valid atau telah kedaluwarsa.']);
        }

        $request->validate(['code' => ['required', 'string']]);

        $tokenResponse = Http::asForm()->acceptJson()->timeout(15)
            ->post(config('services.oidc.issuer').'/oauth/oidc/token', [
                'grant_type' => 'authorization_code',
                'client_id' => config('services.oidc.client_id'),
                'client_secret' => config('services.oidc.client_secret'),
                'redirect_uri' => config('services.oidc.redirect_uri'),
                'code' => $request->string('code')->toString(),
                'code_verifier' => $oidc['verifier'],
                'nonce' => $oidc['nonce'],
            ]);

        if (! $tokenResponse->successful() || ! $tokenResponse->json('id_token')) {
            return redirect()->route('login')->withErrors([
                'sso' => $tokenResponse->json('error_description', 'HRIS tidak dapat menyelesaikan proses login.'),
            ]);
        }

        $jwks = Http::acceptJson()->timeout(10)
            ->get(config('services.oidc.issuer').'/oauth/jwks')
            ->throw()
            ->json();

        $claims = (array) JWT::decode($tokenResponse->json('id_token'), JWK::parseKeySet($jwks));
        $audiences = (array) ($claims['aud'] ?? []);

        abort_unless(($claims['iss'] ?? null) === config('services.oidc.issuer'), 401, 'Issuer ID token tidak valid.');
        abort_unless(in_array(config('services.oidc.client_id'), $audiences, true), 401, 'Audience ID token tidak valid.');
        abort_unless(isset($claims['nonce']) && hash_equals($oidc['nonce'], (string) $claims['nonce']), 401, 'Nonce ID token tidak valid.');

        $userInfo = Http::withToken($tokenResponse->json('access_token'))->acceptJson()->timeout(10)
            ->get(config('services.oidc.issuer').'/oauth/userinfo')
            ->throw()
            ->json();

        abort_unless((string) ($userInfo['sub'] ?? '') === (string) ($claims['sub'] ?? ''), 401, 'Subjek UserInfo tidak valid.');

        $user = User::find($claims['sub'] ?? null);
        abort_unless(
            $user
            && $user->status_aktif === 'aktif'
            && $user->can_access_akademik
            && in_array($user->akademik_role, ['kabag', 'kasubag', 'staff'], true)
            && ($userInfo['akademik_role'] ?? null) === $user->akademik_role,
            403,
            'Akun atau role Akademik FH belum dikonfigurasi.'
        );

        Auth::login($user, true);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}
