<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Key; // Import model Key
use Illuminate\Support\Facades\Log;

class KeyController extends Controller
{
    public function verifyKepala(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);

        $keyInput = $request->input('key');
        $defaultKey = '123';

        $keyData = Key::where('key', $keyInput)->first();

        if ($keyInput === $defaultKey || $keyData) {
            session(['login_kepala' => true, 'show_generate_key_menu' => true]);
            Log::info("Login berhasil dengan key: {$keyInput}.");
            return redirect()->route('index.kepala', ['menu' => 'generate-key']);
        }

        Log::warning("Key tidak valid. Key yang dimasukkan: {$keyInput}");
        return redirect()->route('login.kepala')->with('error', 'Key salah.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|string',
            'key' => 'required|string|unique:keys,key', 
        ]);

        Key::create([
            'role' => $request->input('role'),
            'key' => $request->input('key'),
        ]);

        return redirect()->back()->with('success', 'Key berhasil disimpan.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login.kepala')->with('success', 'Logout berhasil.');
    }

    public function indexKepala()
    {
        $keys = Key::all();
        // Tidak menghapus session 'show_generate_key_menu' agar tetap tampil setelah refresh
        $showGenerateKeyMenu = session('show_generate_key_menu', false);

        return view('index-kepala', compact('keys', 'showGenerateKeyMenu'));
    }

    public function destroy($id)
    {
        $key = Key::find($id);

        if ($key) {
            $key->delete();
            return redirect()->back()->with('success', 'Key berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Key tidak ditemukan.');
    }
}
