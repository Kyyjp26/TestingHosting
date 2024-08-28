<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory;

    protected $fillable = [
        'IDproduk',
        'tanggal',
        'qty',
        'hargajual',
        'total',
        'dibayar',
        'kembali'
    ];

    protected $primaryKey = 'IDtrans';

    public function stok()
    {
        return $this->belongsTo(Stok::class, 'IDproduk');
    }
}
