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

        $colors = [
            imagecolorallocate($image, 30, 27, 75), // Midnight Plum
            imagecolorallocate($image, 0, 100, 0),
            imagecolorallocate($image, 0, 0, 139),
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
        $questions = [
            'q1' => 'Kesesuaian persyaratan pelayanan',
            'q2' => 'Kemudahan prosedur',
            'q3' => 'Kecepatan waktu pelayanan',
            'q4' => 'Kewajaran biaya/tarif',
            'q5' => 'Kesesuaian hasil layanan',
            'q6' => 'Kompetensi petugas',
            'q7' => 'Perilaku petugas',
            'q8' => 'Penanganan pengaduan',
            'q9' => 'Sarana dan prasarana',
        ];
        return view('welcome', compact('appName', 'questions'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'komentar' => 'nullable|string',
            'captcha' => 'required'
        ];
        for($i=1; $i<=9; $i++) $rules["q$i"] = 'required|integer|min:1|max:5';

        $request->validate($rules);

        if (strtolower($request->captcha) !== strtolower(session('captcha_code'))) {
            return back()->with('error', 'Captcha salah!')->withInput();
        }

        DB::beginTransaction();
        try {
            $data = $request->only(['nama', 'komentar', 'q1', 'q2', 'q3', 'q4', 'q5', 'q6', 'q7', 'q8', 'q9']);
            $avg = ($data['q1'] + $data['q2'] + $data['q3'] + $data['q4'] + $data['q5'] + $data['q6'] + $data['q7'] + $data['q8'] + $data['q9']) / 9;
            $data['rata_rata'] = round($avg, 2);
            
            Survey::create($data);
            DB::commit();
            return redirect('/')->with('success', 'Terima kasih atas penilaian Anda!');
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan sistem.')->withInput();
        }
    }
}
