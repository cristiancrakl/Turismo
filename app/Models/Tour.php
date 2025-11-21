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
        'tipos',
        'tipo',
        'location',
        'duration_minutes',
        'active',
        'profile_link',
    ];

    protected $casts = [
        'tags' => 'array',
        'tipos' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
