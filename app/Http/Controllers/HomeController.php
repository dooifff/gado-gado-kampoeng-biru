<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('home', [
            'featuredMenus' => Menu::active()
                ->featured()
                ->orderBy('name')
                ->take(6)
                ->get(),
            'galleryPreview' => Gallery::orderBy('id')->take(4)->get(),
            'testimonials' => Testimonial::active()
                ->orderBy('rating', 'desc')
                ->take(5)
                ->get(),
        ]);
    }
}