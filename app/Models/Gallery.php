<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image',
    ];

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}