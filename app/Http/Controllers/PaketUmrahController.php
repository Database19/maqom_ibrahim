<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PaketUmrah;
use App\Models\PaketUmrahDetail;
use Illuminate\Http\Request;

class PaketUmrahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paketUmrah = PaketUmrah::select('id','kode_paket','nama_paket','tanggal_keberangkatan','tanggal_akhir_pendaftaran','paket_tersedia','total_hari')->get();
        $pagination = PaketUmrah::paginate(10);



        return view('layanan.paket-umrah.index', compact('paketUmrah','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paketUmrahFields = \Schema::getColumnListing('paket_umrahs');

        $listKaryawan = Karyawan::select([
            'nama_depan',
            'nama_belakang',
            'no_hp',
            'jenis_kelamin',
        ])
        ->where('jabatan', 'Pembimbing')
        ->groupBy('nama_depan', 'nama_belakang', 'no_hp','jenis_kelamin') // Add other columns to the GROUP BY clause
        ->get();


        return view('layanan.paket-umrah.form', compact('paketUmrahFields','listKaryawan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = [
            'kode_paket' => $request->kode_paket,
            'nama_paket' => $request->nama_paket,
            'gambar' => $request->gambar,
            'pajak_bandara' => $request->pajak_bandara,
            'bus_bandara' => $request->bus_bandara,
            'tanggal_keberangkatan' => $request->tanggal_keberangkatan,
            'tanggal_akhir_pendaftaran' => $request->tanggal_akhir_pendaftaran,
            'pembimbing' => $request->pembimbing,
            'contact_person' => $request->contact_person,
            'paket_tersedia' => $request->paket_tersedia,
            'total_hari' => $request->total_hari,
        ];

        $paketUmrah = PaketUmrah::create($data);
        $paketUmrah->gambar = $request->file('gambar');
        $paketUmrah->save();
        $paketUmrahId = $paketUmrah->id; // Get the ID of the newly created $paketUmrah object

        foreach ($request['paketUmrahDetail'] as $value) {
            $numericValue = (int) preg_replace('/[^0-9]/', '', $value['harga_paket']);
            $paketUmrah->paketUmrahDetails()->create([
                'paket_umrah_id' => $paketUmrahId, // Use the $paketUmrahId variable instead of $paketUmrah->id
                'kode_paket' => $paketUmrah->kode_paket,
                'jenis_kamar' => $value['jenis_kamar'],
                'harga_paket' => $numericValue,
                'hotel_mekkah' => $value['hotel_mekkah'],
                'hotel_madinah' => $value['hotel_madinah'],
            ]);
        }

        // Redirect or return a response as needed.
        return redirect()->route('paket-umrah.index')->with('success', 'Paket Umrah added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaketUmrah $paketUmrah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaketUmrah $paketUmrah)
    {
        // da($paketUmrah);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaketUmrah $paketUmrah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaketUmrah $paketUmrah)
    {
        //
    }
}
