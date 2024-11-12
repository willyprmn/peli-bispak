<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tarif;
use App\Models\Pelanggan;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login Web APLPAS'
        ]);
    }

    public function authenticate(Request $request)
    {
        // Validasi username dan password
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required']
        ], [
            'username.required' => 'Username wajib di isi',
            'password.required' => 'Password wajib di isi'
        ]);

        // Hasil validasi akan di cek ke database dan script dibawah ini jika benar akan mendapatkan nilai return
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // Jika hasil validasi salah maka nilai return mengembalikan ke halaman awal
        return back()->with('loginError', 'Username atau Password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register', [
            'title' => 'Register Akun APLPAS',
            'tarif' => Tarif::orderBy('daya', 'asc')->get()
        ]);
    }

    public function verify(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'username' => ['required', 'unique:users'],
            // 'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:8'],
            'password' => ['required', 'min:8'],
            'alamat' => ['required'],
            'meter_id' => ['required', 'regex:/[0-9]{9}/', 'unique:pelanggan', 'min:11', 'max:12'],
            'id_tarif' => ['required']
        ], [
            'name.required' => 'Nama wajib di isi',
            'email.required' => 'Email wajib di isi',
            'email.unique' => 'Email telah terdaftar',
            'username.required' => 'Username wajib di isi',
            'username.unique' => 'Username telah terdaftar',
            'password.required' => 'Password wajib di isi',
            // 'password.regex' => 'Password harus terdiri dari angka, huruf besar dan kecil serta karakter simbol',
            'password.min' => 'Password minimum 8 karakter',
            'alamat.required' => 'Alamat wajib di isi',
            'meter_id.required' => 'ID meter wajib di isi',
            'meter_id.regex' => 'ID meter wajib di isi dengan angka',
            'meter_id.unique' => 'ID meter telah terdaftar',
            'meter_id.min' => 'ID meter minimal 11 angka',
            'meter_id.max' => 'ID meter maksimal 12 angka',
            'id_tarif.required' => 'Daya listrik wajib di pilih'
        ]);

        $dataUser = [
            'name' => $validatedData['name'],     
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => 1
        ];
        User::insert($dataUser);

        $user_id = User::latest('id')->first();
        $dataCustomer = [
            'alamat' => $validatedData['alamat'],     
            'meter_id' => $validatedData['meter_id'],
            'user_id' => $user_id['id'],
            'tarif_id' => $validatedData['id_tarif']
        ];
        Pelanggan::insert($dataCustomer);

        return redirect('/login')->with('registerSuccess', 'Data Tersimpan, Silahkan Login!');
    }
}
