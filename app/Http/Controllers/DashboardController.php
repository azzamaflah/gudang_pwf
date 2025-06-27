<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\TransaksiMasuk;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = Barang::count();

        $masukBulanIni = TransaksiMasuk::whereMonth('tanggal_masuk', now()->month)->count();
        $keluarBulanIni = TransaksiKeluar::whereMonth('tanggal_keluar', now()->month)->count();

        $stokKritis = Barang::where('stok', '<', 5)->get();

        // Ambil data 12 bulan terakhir
        $bulanLabels = [];
        $dataMasuk = [];
        $dataKeluar = [];

        for ($i = 11; $i >= 0; $i--) {
            $bulan = now()->subMonths($i);
            $bulanLabels[] = $bulan->format('M Y');

            $jumlahMasuk = TransaksiMasuk::whereMonth('tanggal_masuk', $bulan->month)
                ->whereYear('tanggal_masuk', $bulan->year)
                ->count();

            $jumlahKeluar = TransaksiKeluar::whereMonth('tanggal_keluar', $bulan->month)
                ->whereYear('tanggal_keluar', $bulan->year)
                ->count();

            $dataMasuk[] = $jumlahMasuk;
            $dataKeluar[] = $jumlahKeluar;
        }

        return view('dashboard', compact(
            'totalBarang',
            'masukBulanIni',
            'keluarBulanIni',
            'stokKritis',
            'bulanLabels',
            'dataMasuk',
            'dataKeluar'
        ));
    }
}
