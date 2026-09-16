<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'message',
        'rating',
        'image',
        'image_data',
        'image_mime',
        'is_active',
    ];

    public function getImageUrlAttribute(): string
    {
        return route('media.show', ['model' => 'testimonial', 'ref' => $this->id]);
    }

    protected $casts = [
        'rating' => 'integer',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}