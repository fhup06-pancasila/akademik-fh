<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }

    public function test_login_page_returns_a_successful_response(): void
    {
        $this->get('/login')
            ->assertOk()
            ->assertSee('Login dengan HRIS FHUP');
    }

    public function test_oidc_redirect_uses_state_nonce_and_pkce(): void
    {
        $response = $this->get('/auth/redirect');

        $response->assertRedirectContains('/oauth/authorize?');
        $response->assertRedirectContains('code_challenge_method=S256');
        $response->assertRedirectContains('scope=openid+profile+email');
        $response->assertSessionHas('oidc', fn (array $oidc) =>
            strlen($oidc['state']) === 64
            && strlen($oidc['nonce']) === 64
            && strlen($oidc['verifier']) === 96
        );
    }
}
