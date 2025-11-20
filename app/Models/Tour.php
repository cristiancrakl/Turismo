<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'tags',
        'tipo',
        'location',
        'duration_minutes',
        'active',
    ];

    protected $casts = [
        'tags' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
