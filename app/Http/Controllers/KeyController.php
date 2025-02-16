<?php

namespace App\Http\Controllers;

use App\Models\Key; 
use App\Models\Pengujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KeyController extends Controller
{
    public function verifyKepala(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);

        $keyInput = $request->input('key');


        $keyData =  Key::where('key', $keyInput)->where('role', 'Kepala Lab')->first();

        if ($keyData) {
            session(['login_kepala'=>true]);
            return redirect()->route('dashboard.kepala' );
        }

      
        return redirect()->route('login.kepala')->with('error', 'Key salah.');
    }
    public function verifyAdmin(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);
    
        $keyInput = $request->input('key');
    
    
        $keyData = Key::where('key', $keyInput)->where('role', 'Admin')->first();
    
        if ($keyData) {
         
            session(['login_admin' => true]);
            return redirect()->route('dashboard.admin');
        }
    
       
        return redirect()->route('login.admin')->with('error', 'Key salah atau tidak valid.');
    }
    public function verifyBendahara(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);
        Log::info('Session login_bendahara: ' . session('login_bendahara'));

        $keyInput = $request->input('key');
    
   
        $keyData = Key::where('key', $keyInput)->where('role', 'Bendahara')->first();
    
        if ($keyData) {
           
            session(['login_bendahara' => true]);
            return redirect()->route('dashboard.bendahara');
        }
    
        return redirect()->route('login.bendahara')->with('error', 'Key salah.');
    }
    
    public function indexBendahara()
    {
     
        if (!session('login_bendahara')) {
            return redirect()->route('login.bendahara')->with('error', 'Anda harus login terlebih dahulu.');
        }
        Log::info('Session login_bendahara (di indexBendahara): ' . session('login_bendahara'));
     
        $keys = Key::where('role', 'Bendahara')->get();
    
  
        return view('index-bendahara', compact('keys'));
    }

    public function indexAdmin()
    {
   
        if (!session('login_admin')) {
            return redirect()->route('login.admin')->with('error', 'Silakan login terlebih dahulu.');
        }
    

        $keys = Key::where('role', 'Admin')->get();
    
        return view('index-admin', compact('keys')); 
    }
    public function verifyTeknisi(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);

        $keyInput = $request->input('key');

   
        $keyData = Key::where('key', $keyInput)->where('role', 'Teknisi')->first();

        if ($keyData) {
           
            session(['login_teknisi' => true]);
            Log::info("Login berhasil dengan key: {$keyInput}");
            return redirect()->route('dashboard.teknisi');
        }

        Log::warning("Key tidak valid untuk teknisi: {$keyInput}");
        return redirect()->route('login.teknisi')->with('error', 'Key salah.');
    }

    public function indexTeknisi()
    {
        
        if (!session('login_teknisi')) {
            Log::info("Session login_teknisi tidak ditemukan.");
            return redirect()->route('login.teknisi')->with('error', 'Anda harus login terlebih dahulu.');
        }

        Log::info("Session login_teknisi ditemukan.");
        return view('index-teknisi');
    }

    public function verifyPelaporan(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);

        $keyInput = $request->input('key');

     
        $keyData = Key::where('key', $keyInput)->where('role', 'Pelapor')->first();

        if ($keyData) {
         
            session(['login_pelaporan' => true]);
            Log::info("Session login_pelaporan: 1");
            return redirect()->route('dashboard.pelaporan');
        }

        return redirect()->route('login.pelaporan')->with('error', 'Key salah.');
    }

    public function indexPelaporan()
    {
        if (!session('login_pelaporan')) {
            return redirect()->route('login.pelaporan')->with('error', 'Anda harus login terlebih dahulu.');
        }

        $keys = Key::where('role', 'Pelapor')->get();

        return view('index-pelaporan', compact('keys'));
    }
    public function verifyPenyelia(Request $request)
{
    $request->validate([
        'key' => 'required|string|max:255',
    ]);

    $keyInput = $request->input('key');


    $keyData = Key::where('key', $keyInput)->where('role', 'Penyelia')->first();

    if ($keyData) {
    
        session(['login_penyelia' => true]);
        Log::info("Login berhasil untuk Penyelia dengan key: {$keyInput}.");
        return redirect()->route('dashboard.penyelia');
    }

    Log::warning("Login gagal untuk Penyelia. Key tidak valid: {$keyInput}");
    return redirect()->route('login.penyelia')->with('error', 'Key salah.');
}

    public function indexPenyelia()
    {

        if (!session('login_penyelia')) {
            Log::warning("Akses ditolak ke dashboard Penyelia. User belum login.");
            return redirect()->route('login.penyelia')->with('error', 'Anda harus login terlebih dahulu.');
        }

        Log::info("Akses dashboard Penyelia berhasil. Session login_penyelia aktif.");
        return view('index-penyelia');
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

        return redirect()->back()->with('success-simpan-key', 'Key berhasil disimpan.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login.kepala')->with('success', 'Logout berhasil.');
    }



    public function verifyPencetak(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
        ]);

        $keyInput = $request->input('key');

 
        $keyData = Key::where('key', $keyInput)->where('role', 'Pencetak')->first();

        if ($keyData) {
    
            session(['login_pencetak' => true]);
            Log::info("Login berhasil dengan key: {$keyInput}.");
            return redirect()->route('dashboard.pencetak');
        }

        Log::warning("Key tidak valid untuk role Pencetak. Key: {$keyInput}");
        return redirect()->route('login.pencetak')->with('error', 'Key salah.');
    }

    public function indexPencetak()
    {
     
        if (!session('login_pencetak')) {
            return redirect()->route('login.pencetak')->with('error', 'Anda harus login terlebih dahulu.');
        }

        
        Log::info('Session login_pencetak: ' . session('login_pencetak'));
        return view('index-pencetak');
    }
    public function index()
    {
       
        $keys = Key::all();
        $pengujianData = Pengujian::all();
    
     
        return view('index-kepala', compact('keys', 'pengujianData'));
    }
    
    public function destroy($id)
    {
        $key = Key::find($id);

        if ($key) {
            $key->delete();
            return redirect()->back()->with('success-hapus-key', 'Key berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Key tidak ditemukan.');
    }
}