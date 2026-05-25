<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumumanMasjid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'thumbnail',
        'is_published',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
