<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function home()
    {
        $featuredItems = MenuItem::with('category')
            ->where('is_featured', true)
            ->where('is_available', true)
            ->orderBy('sort_order')
            ->take(4)
            ->get();

        $activePromos = Promo::where('is_active', true)
            ->orderBy('sort_order')
            ->take(3)
            ->get();

        return view('home', [
            'featuredItems' => $featuredItems,
            'activePromos' => $activePromos,
        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string'],
        ]);

        Mail::raw(
            "From: {$data['name']} <{$data['email']}>\n\n{$data['message']}",
            function ($mail) use ($data) {
                $mail->to(config('mail.from.address'))
                    ->subject('Contact form: ' . $data['subject']);
            }
        );

        return response()->json(['success' => true]);
    }
}
