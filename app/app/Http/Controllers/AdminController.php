<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Survey;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success', 'Selamat datang kembali, Admin!');
        }

        return back()->with('error', 'Email atau password salah!')->onlyInput('email');
    }

    public function dashboard()
    {
        $stats = [
            'total' => Survey::count(),
            'rata_rata' => Survey::avg('rata_rata') ?? 0,
            'terbaru' => Survey::latest()->take(5)->get(),
            'indikator' => [
                'q1' => Survey::avg('q1') ?? 0,
                'q2' => Survey::avg('q2') ?? 0,
                'q3' => Survey::avg('q3') ?? 0,
                'q4' => Survey::avg('q4') ?? 0,
                'q5' => Survey::avg('q5') ?? 0,
                'q6' => Survey::avg('q6') ?? 0,
                'q7' => Survey::avg('q7') ?? 0,
                'q8' => Survey::avg('q8') ?? 0,
                'q9' => Survey::avg('q9') ?? 0,
            ]
        ];
        return view('dashboard', compact('stats'));
    }

    public function settings()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    public function export()
    {
        $surveys = Survey::all();
        $filename = "Survey_Export_" . date('Y-m-d_H-i-s') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Nama', 'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Rata-rata', 'Komentar', 'Waktu'];

        $callback = function() use($surveys, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($surveys as $survey) {
                fputcsv($file, [
                    $survey->id,
                    $survey->nama,
                    $survey->q1,
                    $survey->q2,
                    $survey->q3,
                    $survey->q4,
                    $survey->q5,
                    $survey->q6,
                    $survey->q7,
                    $survey->q8,
                    $survey->q9,
                    $survey->rata_rata,
                    $survey->komentar,
                    $survey->created_at
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function users()
    {
        $users = User::all();
        return view('users', compact('users'));
    }

    public function listSurveys()
    {
        $surveys = Survey::latest()->paginate(10);
        return view('admin-surveys', compact('surveys'));
    }

    public function deleteSurvey($id)
    {
        Survey::destroy($id);
        return back()->with('success', 'Data survey berhasil dihapus.');
    }

    public function storeUser(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        $data['password'] = bcrypt($data['password']);
        User::create($data);
        return back()->with('success', 'User berhasil ditambahkan.');
    }

    public function deleteUser($id)
    {
        if (Auth::id() == $id) {
            return back()->with('error', 'Tidak dapat menghapus diri sendiri!');
        }
        User::destroy($id);
        return back()->with('success', 'User berhasil dihapus.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Berhasil logout.');
    }
}
