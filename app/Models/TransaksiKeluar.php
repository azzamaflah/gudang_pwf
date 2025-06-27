<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKeluar extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'jumlah', 'tanggal_keluar'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
