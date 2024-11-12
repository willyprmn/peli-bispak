<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tarif;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.tarif.index', [
            'title' => 'Daftar Master Tarif',
            'tarif' => Tarif::leftJoin('pelanggan', 'pelanggan.tarif_id', '=', 'tarif.id_tarif')
            ->select('tarif.*', 'pelanggan.id_pelanggan')
            ->orderBy('daya', 'asc')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tarif.create', [
            'title' => 'Tambah Tarif'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'daya' => ['required'],
            'tarifperkwh' => ['required'],
        ], [
            'daya.required' => 'Daya wajib di isi',
            'tarifperkwh.required' => 'Tarif/kwh wajib di isi',
        ]);

        $daya = str_replace(",", "", $validatedData['daya']);
        $tarifperkwh = str_replace(",", "", $validatedData['tarifperkwh']);
        $data = [
            'daya' => (float)$daya,
            'tarifperkwh' => (float)$tarifperkwh
        ];

        // Tarif::create($data);
        Tarif::insert($data);

        return redirect()->route('tarif.index')->with('success', 'Data Tarif Berhasil Ditambahkan!');
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
        return view('admin.tarif.edit', [
            'title' => 'Perbaruhi Tarif',
            'tarif' => Tarif::where([
                ['id_tarif', $id],
            ])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'daya' => ['required'],
            'tarifperkwh' => ['required'],
        ], [
            'daya.required' => 'Daya wajib di isi',
            'tarifperkwh.required' => 'Tarif/kwh wajib di isi',
        ]);

        $daya = str_replace(",", "", $validatedData['daya']);
        $tarifperkwh = str_replace(",", "", $validatedData['tarifperkwh']);
        $data = [
            'daya' => (float)$daya,
            'tarifperkwh' => (float)$tarifperkwh
        ];

        Tarif::where('id_tarif', $id)->update($data);

        return redirect()->route('tarif.index')->with('success', 'Data Tarif Berhasil Diperbaruhi!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Hard Delete
        Tarif::destroy($id);

        return redirect()->route('tarif.index')->with('success', 'Data Tarif Berhasil Dihapus!');
    }
}
