<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Charts\BeritaChart;
use App\Charts\JadwalChart;
use App\Charts\TimChart;
use App\Charts\MonthlyUsersChart;
use App\Models\Galeri;
use App\Models\logs;
use App\Models\Tim;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Berita;
use App\Models\Pelatih;
use App\Models\Pemain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        return view('Beranda.index');
    }

    // public function indexDashboard()
    // {
    //     return view('Beranda.dashboard');
    // }

    public function indexDashboard(BeritaChart $beritaChart, JadwalChart $jadwalChart, MonthlyUsersChart $userBulananChart, TimChart $timChart)
    {
        $data = [
            'user' => User::query()->count(),
            'galeri' => Galeri::query()->count(),
            'berita' => Berita::query()->count(),
            'log' => logs::query()->count(),
            'tim' => Tim::query()->count(),
            'jadwal' => Jadwal::query()->count(),
            'beritaChart' => $beritaChart->build(),
            'jadwalChart' => $jadwalChart->build(),
            'timChart' => $timChart->build(),
            'userBulananChart' => $userBulananChart->build(),
            // 'suratChart' => $suratChart->build()
        ];

        return view('Beranda.dashboard', $data);
    }
}
