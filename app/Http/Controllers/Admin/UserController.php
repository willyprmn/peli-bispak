<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            'title' => 'Daftar Master User',
            'user' => User::orderBy('id', 'desc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create', [
            'title' => 'Tambah User'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:users'],
            'email' => ['required', 'unique:users'],
            'username' => ['required', 'unique:users'],
            // 'password' => ['required', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:8'],
            'password' => ['required', 'min:8'],
            'role' => ['required']
        ], [
            'name.required' => 'Nama pengguna wajib di isi',
            'name.unique' => 'Nama pengguna telah ada',
            'email.required' => 'Email pengguna wajib di isi',
            'email.unique' => 'Email pengguna telah ada',
            'username.required' => 'Username wajib di isi',
            'username.unique' => 'Username telah ada',
            'password.required' => 'Password wajib di isi',
            // 'password.regex' => 'Password harus terdiri dari angka, huruf besar dan kecil serta karakter simbol',
            'password.min' => 'Password minimum 8 karakter',
            'role.required' => 'Role akses wajib di pilih'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['role']
        ];

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.user.edit', [
            'title' => 'Perbaruhi User',
            'user' => User::where([
                ['id', $id],
                ['deleted_at', NULL]
            ])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'unique:users,id,' . auth()->user()->id],
            'email' => ['required', 'unique:users,id,' . auth()->user()->id],
            'username' => ['required', 'unique:users,id,' . auth()->user()->id],
            // 'password' => ['nullable', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/', 'min:8'],
            'password' => ['nullable', 'min:8'],
            'role' => ['required']
        ], [
            'name.required' => 'Nama pengguna wajib di isi',
            'name.unique' => 'Nama pengguna telah ada',
            'email.required' => 'Email pengguna wajib di isi',
            'email.unique' => 'Email pengguna telah ada',
            'username.required' => 'Username wajib di isi',
            'username.unique' => 'Username telah ada',
            // 'password.regex' => 'Password harus terdiri dari angka, huruf besar dan kecil serta karakter simbol',
            'password.min' => 'Password minimum 8 karakter',
            'role.required' => 'Role akses wajib di pilih'
        ]);

        $data = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'role' => $validatedData['role']
        ];

        User::where('id', $id)->update($data);

        if (!empty($validatedData['password'])){
            $password['password'] = Hash::make($validatedData['password']);
            $data = User::where('id', $id)->update($password);
        }

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data User Berhasil Dihapus!');
    }
}
