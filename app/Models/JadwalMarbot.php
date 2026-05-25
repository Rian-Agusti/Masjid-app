<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalMarbot extends Model
{
    protected $table = 'jadwal_marbot';

    protected $fillable = [
        'nama_petugas',
        'tanggal_piket',
        'shift',
        'tugas',
        'keterangan',
    ];
}
