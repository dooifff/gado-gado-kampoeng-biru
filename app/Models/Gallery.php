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
        'image_data',
        'image_mime',
    ];

    public function getImageUrlAttribute(): string
    {
        return route('media.show', ['model' => 'gallery', 'ref' => $this->id]);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }
}