<?php

namespace App\Http\Controllers;

use App\Models\DaftarUmrah;
use Illuminate\Http\Request;
use App\Models\PaketUmrah;
use App\Models\Jamaah;

class DaftarUmrahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daftarUmrah = DaftarUmrah::select('id', 'no_pendaftaran', 'tanggal_pendaftaran', 'jamaah_id', 'no_hp', 'kode_paket_umrah', 'rencana_keberangkatan', 'total_biaya', 'tipe_bayar', 'jenis_bayar', 'total_bayar', 'status_pembayaran', 'total_pembayaran')->get();
        $pagination = DaftarUmrah::paginate(10);



        return view('jamaah.daftar-umrah.index', compact('daftarUmrah','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allFields = \Schema::getColumnListing('jamaahs');
        $jamaahFields = array_intersect($allFields, ['id', 'no_ktp', 'nama_lengkap', 'no_telp']);
        $jamaah = Jamaah::get()->toArray();

        $daftarUmrahFields = \Schema::getColumnListing('daftar_umrahs');
        $daftarUmrahFields = array_diff($daftarUmrahFields, ['id', 'created_at', 'updated_at','jenis_identitas']);
        $paketUmrah = PaketUmrah::get();

        return view('jamaah.daftar-umrah.form', compact('daftarUmrahFields','paketUmrah','jamaahFields','jamaah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarUmrah $daftarUmrah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarUmrah $daftarUmrah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarUmrah $daftarUmrah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarUmrah $daftarUmrah)
    {
        //
    }
}
