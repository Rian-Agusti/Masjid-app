<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aset extends Model
{
    protected $fillable = [
        'nama',
        'kategori',
        'status',
        'deskripsi',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
