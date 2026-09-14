<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalMenu' => Menu::count(),
            'totalGallery' => Gallery::count(),
            'totalTestimonial' => Testimonial::count(),
            'activeTestimonial' => Testimonial::active()->count(),
            'featuredMenu' => Menu::active()->featured()->count(),
            'recentTestimonials' => Testimonial::latest()->take(5)->get(),
        ]);
    }
}