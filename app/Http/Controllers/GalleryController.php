<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $categories = Gallery::distinct()->orderBy('category')->pluck('category');

        $query = Gallery::query();

        if (in_array($category, $categories->all(), true)) {
            $query->where('category', $category);
        } else {
            $category = null;
        }

        $galleries = $query->orderBy('id')->paginate(12);

        return view('gallery', [
            'galleries' => $galleries,
            'categories' => $categories,
            'activeCategory' => $category,
        ]);
    }
}