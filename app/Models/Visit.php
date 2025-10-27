<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'ip',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];
}