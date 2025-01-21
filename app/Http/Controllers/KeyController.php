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
            'key' => 'required|string',
        ]);

        $keyInput = $request->input('key');

  
        $keyData = Key::where('key', $keyInput)->first();

        if ($keyData) {
        
            session(['login_kepala' => true]);
            Log::info('Session login_kepala disimpan.');
            return redirect()->route('index.kepala'); 
        }
        Log::info('Key salah.');
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

        return view('index-kepala', compact('keys'));
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