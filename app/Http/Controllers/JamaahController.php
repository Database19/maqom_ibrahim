<?php

namespace App\Http\Controllers;

use App\Models\Jamaah;
use Illuminate\Http\Request;

class JamaahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jamaahs = Jamaah::select('id','no_ktp','nama_lengkap','kota','no_telp','role_relasi')->get();
        $pagination = Jamaah::paginate(10);



        return view('jamaah.buku-tamu.index', compact('jamaahs','pagination'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jamaahFields = \Schema::getColumnListing('jamaahs');
        $jamaahs = Jamaah::where('role_relasi', 'member')
                  ->whereNotNull('parent_id')
                  ->get()
                  ->toArray();
        $golonganDarah = \App\Models\GolonganDarah::all()->sortBy('golongan_darah');
        $jenisKelamin = \App\Models\JenisKelamin::all()->sortBy('jenis_kelamin');
        $statusPernikahan = \App\Models\StatusPernikahan::all()->sortBy('status_perkawinan');

        $provinsi = getProvinces();
        $namaRelasi = Jamaah::select([
            'role_relasi',
            'no_ktp',
            'nama_relasi',
            'nama_lengkap',
        ])
        ->where('role_relasi', 'ketua')
        ->groupBy('role_relasi', 'no_ktp', 'nama_relasi','nama_lengkap') // Add other columns to the GROUP BY clause
        ->get();

        // dd($namaRelasi);



        return view('jamaah.buku-tamu.form', compact('jamaahFields','jamaahs','provinsi','golonganDarah','jenisKelamin','statusPernikahan','namaRelasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation for Jamaah details
        $request->validate([
            'no_ktp' => 'required|string',
            'nama_lengkap' => 'required|string',
            'no_telp' => 'required|string',
            'email' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Unset request member if it is null
        if($request['members'][0]['no_ktp'] == '' || $request['members'][0]['no_ktp'] == null){
            unset($request['members']);
        }

        // dd($request->all());


        // create jamaah dari request
        $data = [
            'no_ktp' => $request['no_ktp'],
            'nama_lengkap' => $request['nama_lengkap'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'status_pernikahan' => $request['status_pernikahan'],
            // 'foto' => $request['data_foto'],
            'nama_foto' => $request['foto'],
            'tempat_lahir' => $request['tempat_lahir'],
            'tanggal_lahir' => $request['tanggal_lahir'],
            'usia' => $request['usia'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'golongan_darah' => $request['golongan_darah'],
            'nama_relasi' => ($request['role_relasi'] == 'member') ? '' : $request['nama_relasi'],
            'role_relasi' => $request['role_relasi'],
            'alamat_lengkap' => $request['alamat_lengkap'],
            'alamat_lengkap2' => $request['alamat_lengkap2'],
            'provinsi' => $request['provinsi'],
            'kota' => $request['kota'],
            'kecamatan' => $request['kecamatan'],
            'kelurahan' => $request['kelurahan'],
            'rw' => $request['rw'],
            'rt' => $request['rt'],
            'kodepos' => $request['kodepos'],
            'no_telp' => $request['no_telp'],
            'email' => $request['email'],
            'nama_sekolah' => $request['nama_sekolah'],
            'alamat_sekolah' => $request['alamat_sekolah'],
            'pendidikan' => $request['pendidikan'],
            'tempat_kerja' => $request['tempat_kerja'],
            'nama_bagian' => $request['nama_bagian'],
            'profesi' => $request['profesi'],
            'is_deleted' => 0,
        ];

        if (!empty($request->members)) {
            $no_ktp_values = [];
            # code...
            foreach ($request->members as $memberData) {
                $no_ktp_values[] = $memberData['no_ktp'];
            }

            $data['members'] = implode(', ', $no_ktp_values);
        }

        // Handle Members
        // dd($request->members);
        // dd($request->all());
        $data['members'] = '';
        // dd($request->all());
        $jamaah = Jamaah::create($data);
        if($request['nama_relasi'] != '' && $request['role_relasi'] == 'ketua'){
            if ($request->has('members') && is_array($request->members)) {
                foreach ($request->members as $memberData) {
                    Jamaah::updateOrCreate(['no_ktp' => $memberData['no_ktp']], [
                        'nama_relasi' => $data['nama_relasi'],
                        'parent_id' => $jamaah->id,
                    ]);
                }
            }
        }

        // Redirect or return response as needed
        return redirect()->route('buku-tamu.index');
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jamaahFields = \Schema::getColumnListing('jamaahs');
        $dataJamaah = Jamaah::find($id);
        $jamaahs = Jamaah::all()->toArray();

        $data = Jamaah::find($id);

        if($data){
            $children = $data->children;
        }

        // da($children);

        return view('jamaah.buku-tamu.form', compact('dataJamaah','jamaahs','jamaahFields','children'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // da($id);
        $jamaahFields = \Schema::getColumnListing('jamaahs');
        // dd($jamaahFields);
        $jamaahs = Jamaah::where('role_relasi', 'member')
                  ->whereNull('parent_id')
                  ->get()
                  ->toArray();
        $dataJamaah = Jamaah::find($id);
        if ($dataJamaah->children) {
            $children = $dataJamaah->children;
        }

        $golonganDarah = \App\Models\GolonganDarah::all()->sortBy('golongan_darah');
        $jenisKelamin = \App\Models\JenisKelamin::all()->sortBy('jenis_kelamin');
        $statusPernikahan = \App\Models\StatusPernikahan::all()->sortBy('status_perkawinan');
        $provinsi = getProvinces();
        $kota = getRegencies($dataJamaah->provinsi);
        $kecamatan = getDistricts($dataJamaah->kota);
        $kelurahan = getVillages($dataJamaah->kecamatan);
        $namaRelasi = Jamaah::select([
            'role_relasi',
            'no_ktp',
            'nama_relasi',
            'nama_lengkap',
        ])
        ->where('role_relasi', 'ketua')
        ->groupBy('role_relasi', 'no_ktp', 'nama_relasi','nama_lengkap') // Add other columns to the GROUP BY clause
        ->get();

            // dd($namaRelasi);


        return view('jamaah.buku-tamu.form', compact('jamaahs','dataJamaah','jamaahFields','golonganDarah','jenisKelamin','statusPernikahan','provinsi','kota','kecamatan','kelurahan','namaRelasi','children'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jamaah $jamaah)
    {
        if ($request['nama_relasi'] != '' && $request['role_relasi'] == 'ketua') {
            if ($request->has('members') && is_array($request->members)) {
                foreach ($request->members as $memberData) {
                    Jamaah::where('no_ktp', '=', $memberData['no_ktp'])->update([
                        'parent_id' => $jamaah->id,
                        'nama_relasi' => $request['nama_relasi'],
                    ]);
                }
            }
        }

    return redirect()->route('jamaah.buku-tamu.index');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Check if the Jamaah instance exists
        $jamaah = Jamaah::find($id);
        if ($jamaah) {
            // Delete the Jamaah record
            $jamaah->delete();

            // Optionally, you can redirect or return a response
            return redirect()->route('buku-tamu.index')->with('success', 'Jamaah deleted successfully');
        } else {
            // Handle the case where the Jamaah instance is not found
            return redirect()->route('buku-tamu.index')->with('error', 'Jamaah not found');
        }
    }
}
