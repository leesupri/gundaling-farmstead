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
            'reviews' => $this->sampleReviews(),
        ]);
    }

    /**
     * Curated sample reviews for the dual-brand review wall.
     * Swap this for the Google Business Profile API (or a reviews table)
     * once access is granted — each entry needs: brand, name, role, origin, text.
     */
    private function sampleReviews(): \Illuminate\Support\Collection
    {
        return collect([
            ['brand' => 'farmstead', 'name' => 'Budi & Rina Santoso', 'role' => 'Tamu reservasi', 'origin' => 'Medan', 'text' => 'Pemandangan Gunung Sibayak dari meja makan sungguh tak terlupakan. Pizza wood-fire-nya juara.'],
            ['brand' => 'farmstead', 'name' => 'Sarah Tan', 'role' => 'Weekend traveller', 'origin' => 'Singapore', 'text' => 'Fresh cheese made on site, cool mountain air, and the friendliest staff. Worth the drive from Medan.'],
            ['brand' => 'farmstead', 'name' => 'Keluarga Ginting', 'role' => 'Makan siang keluarga', 'origin' => 'Kabanjahe', 'text' => 'Nasi goreng sapi panggangnya luar biasa. Anak-anak senang melihat dapur terbuka.'],
            ['brand' => 'farmstead', 'name' => 'Daniel Hutagalung', 'role' => 'Business dinner', 'origin' => 'Jakarta', 'text' => 'Keju Gundaling-nya wajib dicoba. Suasana malam dengan lampu hangat sangat cozy.'],
            ['brand' => 'farmstead', 'name' => 'Ayu Lestari', 'role' => 'Anniversary dinner', 'origin' => 'Medan', 'text' => 'Panna cotta susu farm-nya lembut sekali. Tempat paling romantis di Berastagi.'],
            ['brand' => 'farm', 'name' => 'Keluarga Harahap', 'role' => 'Wisata keluarga', 'origin' => 'Pematang Siantar', 'text' => 'Anak-anak bisa menyentuh sapi langsung dan minum susu segar. Pengalaman edukatif yang seru.'],
            ['brand' => 'farm', 'name' => 'Michael Wong', 'role' => 'Family trip', 'origin' => 'Kuala Lumpur', 'text' => 'The kids loved feeding the calves. Fresh yogurt and gelato straight from the farm.'],
            ['brand' => 'farm', 'name' => 'Sri Rahayu', 'role' => 'Study tour', 'origin' => 'Berastagi', 'text' => 'Belajar proses susu dari pemerahan sampai menjadi keju. Pemandu ramah dan informatif.'],
            ['brand' => 'farm', 'name' => 'Andre Situmorang', 'role' => 'Weekend getaway', 'origin' => 'Medan', 'text' => 'Udara sejuk, pemandangan luas, dan susu murni terbaik di tanah Karo.'],
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
