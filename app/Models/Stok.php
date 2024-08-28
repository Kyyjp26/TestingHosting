<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'hargabeli',
        'hargajual',
        'stok',
        'kategori'
    ];

    protected $primaryKey = 'IDproduk';

    public function penjualans()
    {
        return $this->hasMany(Penjualan::class, 'IDproduk');
    }
}
