<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiMasuk extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'jumlah', 'tanggal_masuk', 'keterangan'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}
