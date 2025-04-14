<?php

namespace App\Http\Controllers;

use App\MyAgenda_sekolah;
use App\MyAgenda_user;
use App\IndoRegionProvince;
use App\IndoRegionRegency;
use App\IndoRegionDistrict;
use App\IndoRegionVillage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MyAgendaSekolahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $sekolahs = MyAgenda_sekolah::with(['provinsi', 'kabkota', 'kec', 'kel', 'user'])
            ->where('myagenda_sekolah_user_id', $user->myagenda_user_id)
            ->get();
        return view('myagenda_sekolah.index', compact('sekolahs', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = MyAgenda_user::all();
        $provinsi = IndoRegionProvince::all();

        return view('myagenda_sekolah.create', compact('user', 'provinsi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'myagenda_sekolah_logo' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'myagenda_sekolah_nama' => 'required|string|max:100',
            'myagenda_sekolah_email' => 'required|email|unique:myagenda_sekolah,myagenda_sekolah_email',
            'myagenda_sekolah_akreditasi' => 'required|string',
            'myagenda_sekolah_tlp' => 'required|string|max:13',
            'myagenda_sekolah_provinsi' => 'required|exists:indoregion_provinces,id',
            'myagenda_sekolah_kab_kota' => 'required|exists:indoregion_regencies,id',
            'myagenda_sekolah_kec' => 'required|exists:indoregion_districts,id',
            'myagenda_sekolah_kel' => 'required|exists:indoregion_villages,id',
            'myagenda_sekolah_kodepos' => 'required|size:5',
            'myagenda_sekolah_alamat' => 'required|string',
        ]);

        if ($request->hasFile('myagenda_sekolah_logo')) {
            $logoPath = $request->file('myagenda_sekolah_logo')->store('logos', 'public');
        } else {
            $logoPath = null;
        }

        $myagendaSekolah = new MyAgenda_sekolah();
        $myagendaSekolah->myagenda_sekolah_user_id = Auth::id();

        $myagendaSekolah->myagenda_sekolah_logo = $logoPath;
        $myagendaSekolah->myagenda_sekolah_nama = $request->myagenda_sekolah_nama;
        $myagendaSekolah->myagenda_sekolah_email = $request->myagenda_sekolah_email;
        $myagendaSekolah->myagenda_sekolah_akreditasi = $request->myagenda_sekolah_akreditasi;
        $myagendaSekolah->myagenda_sekolah_tlp = $request->myagenda_sekolah_tlp;
        $myagendaSekolah->myagenda_sekolah_provinsi = $request->myagenda_sekolah_provinsi;
        $myagendaSekolah->myagenda_sekolah_kab_kota = $request->myagenda_sekolah_kab_kota;
        $myagendaSekolah->myagenda_sekolah_kec = $request->myagenda_sekolah_kec;
        $myagendaSekolah->myagenda_sekolah_kel = $request->myagenda_sekolah_kel;
        $myagendaSekolah->myagenda_sekolah_kodepos = $request->myagenda_sekolah_kodepos;
        $myagendaSekolah->myagenda_sekolah_alamat = $request->myagenda_sekolah_alamat;

        $myagendaSekolah->save();

        return redirect()->route('myagenda_sekolah.index')->with('success', 'Data sekolah berhasil ditambahkan');
    }

    public function getProvinsi()
    {
        $provinsi = IndoRegionProvince::all();
        return response()->json($provinsi);
    }

    public function getKabupatenKota($provinsi_id)
    {
        $kabupatenKota = IndoRegionRegency::where('province_id', $provinsi_id)->get();
        return response()->json($kabupatenKota);
    }

    public function getKecamatan($kabupaten_id)
    {
        $kecamatan = IndoRegionDistrict::where('regency_id', $kabupaten_id)->get();
        return response()->json($kecamatan);
    }

    public function getKelurahan($kecamatan_id)
    {
        $kelurahan = IndoRegionVillage::where('district_id', $kecamatan_id)->get();
        return response()->json($kelurahan);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sekolah = MyAgenda_sekolah::findOrFail($id);
        $provinsi = IndoRegionProvince::all();
        return view('myagenda_sekolah.edit', compact('sekolah', 'provinsi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'myagenda_sekolah_logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'myagenda_sekolah_nama' => 'required|string|max:100',
            'myagenda_sekolah_email' => 'required|email|unique:myagenda_sekolah,myagenda_sekolah_email,' . $id . ',myagenda_sekolah_id',
            'myagenda_sekolah_akreditasi' => 'required|string',
            'myagenda_sekolah_tlp' => 'required|string|max:13',
            'myagenda_sekolah_provinsi' => 'required|exists:indoregion_provinces,id',
            'myagenda_sekolah_kab_kota' => 'required|exists:indoregion_regencies,id',
            'myagenda_sekolah_kec' => 'required|exists:indoregion_districts,id',
            'myagenda_sekolah_kel' => 'required|exists:indoregion_villages,id',
            'myagenda_sekolah_kodepos' => 'required|size:5',
            'myagenda_sekolah_alamat' => 'required|string',
        ]);

        $sekolah = MyAgenda_sekolah::findOrFail($id);

        // Cek apakah ada file baru yang diunggah
        if ($request->hasFile('myagenda_sekolah_logo')) {
            // Hapus logo lama jika ada
            if ($sekolah->myagenda_sekolah_logo && Storage::exists('public/' . $sekolah->myagenda_sekolah_logo)) {
                Storage::delete('public/' . $sekolah->myagenda_sekolah_logo);
            }

            // Simpan logo baru
            $logoPath = $request->file('myagenda_sekolah_logo')->store('logos', 'public');
        } else {
            // Gunakan logo lama
            $logoPath = $sekolah->myagenda_sekolah_logo;
        }

        // Update data sekolah
        $sekolah->update([
            'myagenda_sekolah_logo' => $logoPath,
            'myagenda_sekolah_nama' => $request->myagenda_sekolah_nama,
            'myagenda_sekolah_email' => $request->myagenda_sekolah_email,
            'myagenda_sekolah_akreditasi' => $request->myagenda_sekolah_akreditasi,
            'myagenda_sekolah_tlp' => $request->myagenda_sekolah_tlp,
            'myagenda_sekolah_provinsi' => $request->myagenda_sekolah_provinsi,
            'myagenda_sekolah_kab_kota' => $request->myagenda_sekolah_kab_kota,
            'myagenda_sekolah_kec' => $request->myagenda_sekolah_kec,
            'myagenda_sekolah_kel' => $request->myagenda_sekolah_kel,
            'myagenda_sekolah_kodepos' => $request->myagenda_sekolah_kodepos,
            'myagenda_sekolah_alamat' => $request->myagenda_sekolah_alamat,
        ]);

        return redirect()->route('myagenda_sekolah.index')->with('success', 'Data sekolah berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sekolah = MyAgenda_sekolah::findOrFail($id);
        $sekolah->delete();

        return redirect()->route('myagenda_sekolah.index')->with('success', 'Data sekolah berhasil dihapus');
    }
}
