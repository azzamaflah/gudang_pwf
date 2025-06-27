<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();
        $masukBulanIni = TransaksiMasuk::whereMonth('tanggal_masuk', now()->month)->count();
        $keluarBulanIni = TransaksiKeluar::whereMonth('tanggal_keluar', now()->month)->count();

        return view('user.dashboard', compact('totalBarang', 'masukBulanIni', 'keluarBulanIni'));
    }
}
