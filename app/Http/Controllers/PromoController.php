<?php

namespace App\Http\Controllers;

use App\Models\Promo;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('promo.index', ['promos' => $promos]);
    }
}
