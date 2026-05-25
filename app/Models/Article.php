<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'thumbnail',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
