<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact', [
            'testimonials' => Testimonial::active()
                ->orderBy('rating', 'desc')
                ->take(3)
                ->get(),
        ]);
    }
}