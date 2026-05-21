<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    public function generateCaptcha()
    {
        $code = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789'), 0, 5);
        session(['captcha_code' => $code]);

        $image = imagecreatetruecolor(120, 40);
        $bgColor = imagecolorallocate($image, 255, 255, 255);
        imagefill($image, 0, 0, $bgColor);

        // High contrast colors
        $colors = [
            imagecolorallocate($image, 220, 20, 60), // Crimson
            imagecolorallocate($image, 0, 100, 0),  // Dark Green
            imagecolorallocate($image, 0, 0, 139),  // Dark Blue
            imagecolorallocate($image, 139, 0, 139), // Dark Magenta
        ];

        for ($i = 0; $i < 5; $i++) {
            $color = $colors[array_rand($colors)];
            imagestring($image, 5, 10 + ($i * 20), 12, $code[$i], $color);
        }

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
        exit;
    }

    public function index()
    {
        $appName = Setting::where('key', 'app_name')->first()->value ?? config('app.name');
        return view('welcome', compact('appName'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'skor' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
            'captcha' => 'required'
        ]);

        // Simple Case-Insensitive Captcha Check (Dummy for now, will implement session-based later)
        if (strtolower($request->captcha) !== strtolower(session('captcha_code'))) {
            return back()->with('error', 'Captcha salah!')->withInput();
        }

        DB::beginTransaction();
        try {
            Survey::create([
                'nama' => $request->nama,
                'skor' => $request->skor,
                'komentar' => $request->komentar,
            ]);
            DB::commit();
            return redirect('/')->with('success', 'Terima kasih atas penilaian Anda!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan sistem.')->withInput();
        }
    }
}
