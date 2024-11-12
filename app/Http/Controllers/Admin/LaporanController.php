<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pembayaran;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Pembayaran::leftJoin('tagihan', 'tagihan.id_tagihan', '=', 'pembayaran.tagihan_id')
        ->join('penggunaan', 'penggunaan.id_penggunaan', '=', 'tagihan.penggunaan_id')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'tagihan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->join('tarif', 'tarif.id_tarif', '=', 'pelanggan.tarif_id')
        ->select('users.name', 'pelanggan.meter_id', 'penggunaan.bulan', 'penggunaan.tahun', 'tagihan.status', 'pembayaran.jumlah_bayar')
        ->where([
            ['penggunaan.bulan', '=', date('m')],
            ['penggunaan.tahun', '=', date('Y')]
        ])
        ->get();


        $pdf = PDF::loadView('admin.laporan.index', [
            'data' => $laporan
        ])->setPaper('a4', 'potrair');
        return $pdf->stream('Laporan Pengguna APLPAS.pdf');
    }
}
