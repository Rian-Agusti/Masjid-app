<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AgendaKajian extends Model
{
    protected $fillable = [
        'judul',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'ustadz_id',
        'status',
        'deskripsi',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu_mulai' => 'datetime:H:i',
        'waktu_selesai' => 'datetime:H:i',
    ];

    public function ustadz()
    {
        return $this->belongsTo(Ustadz::class);
    }
}
