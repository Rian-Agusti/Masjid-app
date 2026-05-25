<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalJumat extends Model
{
    protected $table = 'jadwal_jumat';

    protected $fillable = [
        'tanggal_jumat',
        'khatib',
        'imam',
        'bilal',
        'muadzin',
        'tema_khutbah',
    ];
}
