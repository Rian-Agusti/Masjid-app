<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\PengumumanMasjid;
use App\Models\Keuangan;
use App\Models\JadwalJumat;
use App\Models\JadwalMarbot;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        // ==================== STATISTIK UTAMA ====================
        $totalUsers       = User::count();
        $totalArticles    = Article::count();
        $totalPengumuman  = PengumumanMasjid::count();
        $totalKeuangan    = Keuangan::sum('amount');
        $totalJadwal      = JadwalJumat::count() + JadwalMarbot::count();

        // ==================== GRAFIK KEUANGAN ====================
        $keuanganBulanan = Keuangan::selectRaw(
            'MONTH(date) as bulan,
            SUM(CASE WHEN type = "income" THEN amount ELSE 0 END) as pemasukan,
            SUM(CASE WHEN type = "expense" THEN amount ELSE 0 END) as pengeluaran'
        )
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        $chartLabels = $keuanganBulanan->pluck('bulan')
            ->map(fn($b) => date('M', mktime(0, 0, 0, $b, 1)))
            ->toArray();
        $chartDataPemasukan = $keuanganBulanan->pluck('pemasukan')->toArray();
        $chartDataPengeluaran = $keuanganBulanan->pluck('pengeluaran')->toArray();

        // ==================== AKTIVITAS TERBARU (dengan pagination) ====================
        $activitiesCollection = collect();

        // User baru
        User::latest()->get()->each(function ($user) use (&$activitiesCollection) {
            $activitiesCollection->push((object) [
                'description' => "User baru: {$user->name}",
                'created_at'  => $user->created_at,
            ]);
        });

        // Artikel baru
        Article::latest()->get()->each(function ($article) use (&$activitiesCollection) {
            $activitiesCollection->push((object) [
                'description' => "Artikel baru: \"{$article->title}\"",
                'created_at'  => $article->created_at,
            ]);
        });

        // Jadwal Jumat terbaru
        JadwalJumat::latest()->get()->each(function ($jadwal) use (&$activitiesCollection) {
            $activitiesCollection->push((object) [
                'description' => "Jadwal Jumat: {$jadwal->khatib} - {$jadwal->tanggal_jumat}",
                'created_at'  => $jadwal->created_at,
            ]);
        });

        // Jadwal Marbot terbaru
        JadwalMarbot::latest()->get()->each(function ($marbot) use (&$activitiesCollection) {
            $activitiesCollection->push((object) [
                'description' => "Jadwal Marbot: {$marbot->nama_petugas} - Tugas: {$marbot->tugas}",
                'created_at'  => $marbot->created_at,
            ]);
        });

        // Urutkan berdasarkan created_at DESC
        $activitiesCollection = $activitiesCollection->sortByDesc('created_at')->values();

        // Pagination manual
        $perPage = 5;
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $activitiesCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $activities = new LengthAwarePaginator(
            $currentItems,
            $activitiesCollection->count(),
            $perPage,
            $currentPage,
            ['path' => LengthAwarePaginator::resolveCurrentPath(), 'query' => $request->query()]
        );

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalArticles',
            'totalPengumuman',
            'totalKeuangan',
            'totalJadwal',
            'chartLabels',
            'chartDataPemasukan',
            'chartDataPengeluaran',
            'activities'
        ));
    }
}
