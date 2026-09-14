<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class AboutController extends Controller
{
    public function index()
    {
        return view('about', [
            'galleryPhotos' => Gallery::query()->orderBy('id')->take(8)->get(),
        ]);
    }
}