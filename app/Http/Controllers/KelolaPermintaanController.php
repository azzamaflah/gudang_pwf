<?php

namespace App\Http\Controllers;

use App\Models\PermintaanBarang;
use App\Models\Barang;
use App\Models\TransaksiKeluar;
use Illuminate\Support\Carbon;
class KelolaPermintaanController extends Controller
{
    public function acc($id)
    {
        $permintaan = PermintaanBarang::with('barang')->findOrFail($id);

        $barang = $permintaan->barang;

        // Cek stok cukup atau tidak
        if ($barang->stok < $permintaan->jumlah) {
            return redirect()->back()->with('error', 'Stok tidak mencukupi.');
        }

        // Kurangi stok barang
        $barang->stok -= $permintaan->jumlah;
        $barang->save();

        // Tambahkan entri ke tabel transaksi_keluars
        TransaksiKeluar::create([
            'barang_id' => $permintaan->barang_id,
            'jumlah' => $permintaan->jumlah,
            'tanggal_keluar' => Carbon::now()->toDateString(),
        ]);

        // Update status permintaan
        $permintaan->status = 'disetujui';
        $permintaan->save();

        return redirect()->back()->with('success', 'Permintaan disetujui dan stok barang dikurangi.');
    }
}
