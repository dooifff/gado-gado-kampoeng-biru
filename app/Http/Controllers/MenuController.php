<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $categories = Menu::active()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $query = Menu::active();

        if (in_array($category, $categories->all(), true)) {
            $query->where('category', $category);
        } else {
            $category = null;
        }

        $menus = $query->orderBy('category')->orderBy('name')->paginate(9);

        return view('menu', [
            'menus' => $menus,
            'categories' => $categories,
            'activeCategory' => $category,
        ]);
    }
}