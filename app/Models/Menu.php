<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category',
        'description',
        'price',
        'image',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'price' => 'integer',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, string $category)
    {
        return $query->where('category', $category);
    }

    public function getRupiahAttribute(): string
    {
        return 'Rp' . number_format($this->price, 0, ',', '.');
    }

    protected static function booted(): void
    {
        static::saving(function (Menu $menu) {
            if (empty($menu->slug)) {
                $menu->slug = Str::slug($menu->name);
            }
        });
    }
}