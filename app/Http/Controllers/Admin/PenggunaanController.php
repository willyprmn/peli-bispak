<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Penggunaan;
use App\Models\Pelanggan;
use App\Models\Tagihan;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penggunaan = Pelanggan::join('penggunaan', 'pelanggan.id_pelanggan', '=', 'penggunaan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->select('penggunaan.*', 'pelanggan.meter_id', 'users.name')
        ->where([['penggunaan.bulan', '=', date('m')]])
        ->get();

        return view('admin.penggunaan.index', [
            'title' => 'Penggunaan Pelanggan',
            'penggunaan' => $penggunaan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pelanggan = Pelanggan::leftJoin('penggunaan', 'pelanggan.id_pelanggan', '=', 'penggunaan.pelanggan_id')
        ->join('users', 'users.id', '=', 'pelanggan.user_id')
        ->select('pelanggan.*', 'users.name')
        ->where([['penggunaan.id_penggunaan', NULL]])
        ->get();

        return view('admin.penggunaan.create', [
            'title' => 'Penggunaan Pelanggan',
            'pelanggan' => $pelanggan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pelanggan_id' => ['required'],
            'meter_awal' => ['required'],
        ], [
            'pelanggan_id.required' => 'Pelanggan wajib di isi',
            'meter_awal.required' => 'Meter awal wajib di isi',
        ]);

        $meterAwal = str_replace(",", "", $validatedData['meter_awal']);
        $meterAkhir = 0;
        $data = [
            'pelanggan_id' => $validatedData['pelanggan_id'],
            'bulan' => date('m'),
            'tahun' => date('Y'),
            'meter_awal' => (float)$meterAwal,
            'meter_akhir' => (float)$meterAkhir
        ];

        Penggunaan::insert($data);

        return redirect()->route('penggunaan.index')->with('success', 'Data Pengunaan Bulanan Berhasil Ditambahkan!');
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
        return view('admin.penggunaan.edit', [
            'title' => 'Generate Penggunaan Bulan ini',
            'penggunaan' => Penggunaan::where([
                ['id_penggunaan', $id],
            ])->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'meter_akhir' => ['required'],
        ], [
            'meter_akhir.required' => 'Meter akhir wajib di isi',
        ]);

        $meterAkhir = str_replace(",", "", $validatedData['meter_akhir']);
        $data = [
            'meter_akhir' => (float)$meterAkhir,
        ];
        Penggunaan::where('id_penggunaan', $id)->update($data);

        

        $currentDate = new \DateTime(); // Note the backslash here
        $currentDate->modify('+1 month');
        $nextMonth = $currentDate->format('m');

        if(date('m') == '12'){
            $currentYear = new \DateTime(); // Note the backslash here
            $currentYear->modify('+1 year');
            $year = $currentYear->format('Y');
        }
        else{
            $year = date('Y');
        }
        $meterAkhirNext = 0;
        $nextData = [
            'pelanggan_id' => $request->pelanggan_id,
            'bulan' => $nextMonth,
            'tahun' => $year,
            'meter_awal' => (float)$meterAkhir,
            'meter_akhir' => (float)$meterAkhirNext
        ];
        Penggunaan::insert($nextData);



        $jumlahMeter = (float)$meterAkhir - $request->meter_awal;
        $tagihan = [
            'penggunaan_id' => $id,
            'pelanggan_id' => $request->pelanggan_id,
            'jumlah_meter' => $jumlahMeter,
            'status' => 'Tagihan tersedia'
        ];
        Tagihan::insert($tagihan);

        return redirect()->route('penggunaan.index')->with('success', 'Data Penggunaan Bulan Ini Berhasil Digenerate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
