<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendapatanTenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'IDtenant',
        'totalPendapatan',
        'setoranTenant'
    ];

    protected $primaryKey = 'IDpendapatan';
}
