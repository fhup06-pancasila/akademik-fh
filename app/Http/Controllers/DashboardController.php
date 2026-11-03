<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        try {
            $activeTerm = DB::table('tahunakademik')
                ->where('is_active', 1)
                ->first() ?? DB::table('tahunakademik')->orderByDesc('id')->first();

            $termId = $activeTerm?->id;

            $stats = [
                'mahasiswa' => DB::table('mahasiswa')->count(),
                'dosen' => DB::table('dosen')->where('keterangan', 'AKTIF')->count(),
                'mata_kuliah' => DB::table('mata_kuliah')->where('aktif', 'Ya')->count(),
                'kelas' => $termId ? DB::table('jadwal_kuliah')->where('thakad_id', $termId)->count() : 0,
            ];

            $studentsByProgram = DB::table('program_studi as p')
                ->leftJoin('mahasiswa as m', 'm.prodi_id', '=', 'p.id')
                ->select('p.nmprodi', 'p.jenjang', DB::raw('COUNT(m.id) as total'))
                ->groupBy('p.id', 'p.nmprodi', 'p.jenjang')
                ->orderByDesc('total')
                ->get();

            $scheduleByDay = $termId
                ? DB::table('jadwal_kuliah')
                    ->where('thakad_id', $termId)
                    ->select('hari', DB::raw('COUNT(*) as total'))
                    ->groupBy('hari')
                    ->get()
                    ->keyBy('hari')
                : collect();

            $recentStudents = DB::table('mahasiswa as m')
                ->leftJoin('program_studi as p', 'm.prodi_id', '=', 'p.id')
                ->select('m.nim', 'm.nama_mhs', 'm.tamasuk', 'm.jnskel', 'p.nmprodi', 'p.jenjang')
                ->orderByDesc('m.id')
                ->limit(8)
                ->get();

            $recentSchedules = $termId
                ? DB::table('jadwal_kuliah')
                    ->where('thakad_id', $termId)
                    ->select('hari', 'jam', 'nama_mk', 'kelas', 'ruang', 'sks')
                    ->orderByRaw("FIELD(hari, 'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu')")
                    ->limit(6)
                    ->get()
                : collect();

            return view('dashboard', compact(
                'activeTerm', 'stats', 'studentsByProgram', 'scheduleByDay',
                'recentStudents', 'recentSchedules'
            ));
        } catch (QueryException $exception) {
            report($exception);

            return view('dashboard', [
                'activeTerm' => null,
                'stats' => ['mahasiswa' => 0, 'dosen' => 0, 'mata_kuliah' => 0, 'kelas' => 0],
                'studentsByProgram' => collect(),
                'scheduleByDay' => collect(),
                'recentStudents' => collect(),
                'recentSchedules' => collect(),
                'databaseError' => 'Database akademikfh belum dapat diakses. Periksa konfigurasi MySQL pada file .env.',
            ]);
        }
    }
}
