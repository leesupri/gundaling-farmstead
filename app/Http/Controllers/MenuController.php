<?php

namespace App\Http\Controllers;

use App\Models\MenuCategory;

class MenuController extends Controller
{
    public function index()
    {
        $categories = MenuCategory::with(['items' => function ($query) {
            $query->where('is_available', true)->orderBy('sort_order');
        }])
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('menu.index', ['categories' => $categories]);
    }
}
