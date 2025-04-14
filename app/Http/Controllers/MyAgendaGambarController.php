<?php

namespace App\Http\Controllers;

use App\MyAgenda_gambar;
use App\MyAgenda_sekolah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MyAgendaGambarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if (!$user->myagenda_sekolah) {
            return redirect()->route('myagenda_sekolah.index')->with('error', 'Isi data sekolah terlebih dahulu.');
        }

        $gambars = MyAgenda_gambar::where('myagenda_gambar_sekolah_id',$user->myagenda_sekolah->myagenda_sekolah_id)->get();
        return view('myagenda_gambar.index', compact('gambars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myagenda_gambar.create');
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
            'myagenda_gambar_tanggal' => 'required|date',
            'myagenda_gambar_media.*' => 'required|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'myagenda_gambar_deskripsi.*' => 'required|string',
        ]);

        $user = Auth::user();
        $myagendaSekolah = MyAgenda_sekolah::where('myagenda_sekolah_user_id', $user->myagenda_user_id)->first();

        // cek apakah sekolahnya ada
        if (!$myagendaSekolah || !$myagendaSekolah->myagenda_sekolah_id) {
            return redirect()->back()->with('error', 'Sekolah tidak ditemukan atau ID Sekolah NULL!');
        }

        $tanggalHariIni = now()->toDateString();

        foreach ($request->file('myagenda_gambar_media') as $index => $file) {
            $path = $file->store('uploads', 'public');

            MyAgenda_gambar::create([
                'myagenda_gambar_tanggal' => $tanggalHariIni,
                'myagenda_gambar_media' => $path,
                'myagenda_gambar_deskripsi' => $request->myagenda_gambar_deskripsi[$index],
                'myagenda_gambar_sekolah_id' => $myagendaSekolah->myagenda_sekolah_id, // dipastikan selalu ada
            ]);
        }

        return redirect()->route('myagenda_gambar.index')->with('success', 'Data berhasil ditambahkan!');
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
        $gambars = MyAgenda_gambar::findOrFail($id);
        return view('myagenda_gambar.edit', compact('gambars'));
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
            'myagenda_gambar_tanggal' => 'required|date',
            'myagenda_gambar_deskripsi' => 'required|string',
            'myagenda_gambar_media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:307200',
        ]);

        $gambars = MyAgenda_gambar::findOrFail($id);

        if ($request->hasFile('myagenda_gambar_media')) {
            if ($gambars->myagenda_gambar_media && Storage::exists('public/' . $gambars->myagenda_gambar_media)) {
                Storage::delete('public/' . $gambars->myagenda_gambar_media);
            }
            $mediaPath = $request->file('myagenda_gambar_media')->store('media', 'public');
        } else {
            $mediaPath = $gambars->myagenda_gambar_media;
        }

        $gambars->update([
            'myagenda_gambar_media' => $mediaPath,
            'myagenda_gambar_tanggal' => $request->myagenda_gambar_tanggal,
            'myagenda_gambar_deskripsi' => $request->myagenda_gambar_deskripsi,
        ]);

        return redirect()->route('myagenda_gambar.index')->with('success', 'Data Media berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $gambars = MyAgenda_gambar::findOrFail($id);
        $gambars->delete();

        return redirect()->route('myagenda_gambar.index')->with('success', 'Data media berhasil dihapus');
    }
}
