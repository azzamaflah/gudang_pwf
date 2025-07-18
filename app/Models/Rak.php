<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;
    protected $fillable = ['kode_rak', 'lokasi'];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
