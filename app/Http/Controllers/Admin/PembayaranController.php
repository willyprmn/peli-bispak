<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use App\Models\Tagihan;

class PembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.tagihan_id')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.penggunaan_id')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->join('tarif', 'tarif.id_tarif', '=', 'pelanggan.tarif_id')
        ->select('pembayaran.id_pembayaran', 'tagihan.id_tagihan', 'penggunaan.bulan', 'penggunaan.tahun', 'tagihan.status', 'pembayaran.jumlah_bayar')
        ->where([
            ['users.id', auth()->user()->id],
            ['tagihan.status', 'Menunggu Pembayaran'],
            ['penggunaan.bulan', date('m')],
            ['penggunaan.tahun', date('Y')]
        ])
        ->first();

        return view('admin.pembayaran.edit', [
            'title' => 'Pembayaran Tagihan Anda',
            'pembayaran' => $pembayaran
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'bukti_bayar' => ['required', 'mimes:jpeg,jpg,png', 'max:5120']
        ], [
            'bukti_bayar.required' => 'Gambar wajib di unggah',
            'bukti_bayar.mimes' => 'Gambar wajib berformat PNG atau JPEG/JPG',
            'bukti_bayar.max' => 'Gambar melebihi 5 Mb'
        ]);

        if (request()->hasFile('bukti_bayar')) {
            $uniqDoc = $request->file('bukti_bayar')->store('pembayaran', 'public');
        }

        $data = [
            'bukti_bayar' => $uniqDoc,
            'bukti_nama' => $request->file('bukti_bayar')->getClientOriginalName()
        ];

        Pembayaran::where('id_pembayaran', $id)->update($data);


        $tagihan = [
            'status' => 'Pembayaran diproses'
        ];

        Tagihan::where('id_tagihan', $request->id_tagihan)->update($tagihan);

        return redirect('/tagihan')->with('success', 'Data Pembayaran Bulanan Diproses!');
    }

    public function list()
    {
        $pembayaran = Pembayaran::join('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.tagihan_id')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.penggunaan_id')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->join('tarif', 'tarif.id_tarif', '=', 'pelanggan.tarif_id')
        ->select('pembayaran.id_pembayaran', 'tagihan.id_tagihan', 'users.name','penggunaan.bulan', 'penggunaan.tahun', 'tagihan.status', 'pembayaran.jumlah_bayar', 'pelanggan.meter_id', 'pembayaran.bukti_bayar')
        ->where([
            ['tagihan.status', 'Pembayaran diproses']
        ])
        ->get();

        return view('admin.approval.index', [
            'title' => 'Approval Pembayaran',
            'approval' => $pembayaran
        ]);
    }

    public function approve(String $id)
    {
        $tagihan = [
            'status' => 'Pembayaran diterima'
        ];

        Tagihan::where('id_tagihan', $id)->update($tagihan);

        return back()->with('success', 'Pembayaran Pelanggan Telah Diterima!');
    }
}
