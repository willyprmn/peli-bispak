<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use Illuminate\Support\Facades\DB;
use App\Models\Pembayaran;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.penggunaan_id')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->join('tarif', 'tarif.id_tarif', '=', 'pelanggan.tarif_id')
        ->select('tagihan.id_tagihan', 'tagihan.jumlah_meter', 'penggunaan.bulan', 'penggunaan.tahun', 'tagihan.status', 'tarif.daya', 'tarif.tarifperkwh', DB::raw('tarif.tarifperkwh * tagihan.jumlah_meter as jumlah_bayar'))
        ->where([['users.id', auth()->user()->id]])
        ->orderBy('tagihan.id_tagihan', 'desc')
        ->get();

        // dd($tagihan);
        return view('admin.tagihan.index', [
            'title' => 'Tagihan Bulanan',
            'tagihan' => $tagihan
        ]);
    }

    public function bayar(String $id)
    {
        $tagihan = Tagihan::join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.penggunaan_id')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->join('tarif', 'tarif.id_tarif', '=', 'pelanggan.tarif_id')
        ->select('tagihan.id_tagihan', 'tagihan.jumlah_meter', 'penggunaan.bulan', 'penggunaan.tahun', 'tagihan.status', 'tarif.daya', 'tarif.tarifperkwh', DB::raw('tarif.tarifperkwh * tagihan.jumlah_meter as jumlah_bayar'))
        ->where([['users.id', auth()->user()->id], ['tagihan.id_tagihan', $id]])
        ->orderBy('tagihan.id_tagihan', 'desc')
        ->first();

        $data = [
            'status' => 'Menunggu Pembayaran'
        ];

        Tagihan::where('id_tagihan', $id)->update($data);


        $pembayaran = [
            'tagihan_id' => $id,
            'jumlah_bayar' => $tagihan->jumlah_bayar
        ];
        // dd($pembayaran);

        Pembayaran::insert($pembayaran);

        return back()->with('success', 'Data Tagihan Bulan Ini Dibuat, Silahkan Lakukan Pembayaran Pada Menu Pembayaran!');
    }
}
