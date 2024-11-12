<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Dashboard'
        ]);
    }

    public function showProfile(){
        return view('admin.profile', [
            'title' => 'Profil Akun',
            'profil' => User::where([['id', auth()->user()->id]])->first(),
        ]);
    }

    public function updateProfile(Request $request){
        $validatedData = $request->validate([
            'name' => ['required', 'unique:users,id,' . auth()->user()->id],
            'email' => ['required', 'unique:users,id,' . auth()->user()->id],
            'username' => ['required', 'unique:users,id,' . auth()->user()->id],
            'password' => ['nullable', 'min:8']
        ], [
            'name.required' => 'Nama pengguna wajib di isi',
            'name.unique' => 'Nama pengguna telah ada',
            'email.required' => 'Email pengguna wajib di isi',
            'email.unique' => 'Email pengguna telah ada',
            'username.required' => 'Username wajib di isi',
            'username.unique' => 'Username telah ada',
            // 'password.regex' => 'Password harus terdiri dari angka, huruf besar dan kecil serta karakter simbol',
            'password.min' => 'Password minimum 8 karakter'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username']
        ];

        User::where('id', auth()->user()->id)->update($data);

        if (!empty($validatedData['password'])){
            $password['password'] = Hash::make($validatedData['password']);
            $data = User::where('id', auth()->user()->id)->update($password);
        }

        return redirect('/profil')->with('success', 'Data Profil Berhasil Diperbaruhi!');
    }
}
