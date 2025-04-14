<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyAgenda_profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MyAgendaProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = MyAgenda_profile::all();
        return view('myagenda_profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        return view('myagenda_profile.create');
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
            'myagenda_profile_foto' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'myagenda_profile_nama' => 'required|string',
        ]);

        // simpan file foto
        if ($request->hasFile('myagenda_profile_foto')) {
            $logoPath = $request->file('myagenda_profile_foto')->store('profile', 'public');
        } else {
            $logoPath = null;
        }

        // simpan ke tabel myagenda_profile
        $profile = new MyAgenda_profile();
        $profile->myagenda_profile_user_id = Auth::id();
        $profile->myagenda_profile_foto = $logoPath;
        $profile->myagenda_profile_nama = $request->myagenda_profile_nama;
        $profile->save();

        return redirect()->route('myagenda_profile.index')->with('success', 'Profile berhasil ditambahkan');
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
        $profile = MyAgenda_profile::findOrFail($id);
        return view('myagenda_profile.edit', compact('profile'));
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
            'myagenda_profile_foto' => 'required|file|mimes:jpeg,png,jpg|max:2048',
            'myagenda_profile_nama' => 'required|string',
        ]);

        $profile = MyAgenda_profile::findOrFail($id);

        if ($request->hasFile('myagenda_profile_foto')) {
            // Hapus logo lama jika ada
            if ($profile->myagenda_profile_foto && Storage::exists('public/' . $profile->myagenda_profile_foto)) {
                Storage::delete('public/' . $profile->myagenda_profile_foto);
            }

            // Simpan logo baru
            $logoPath = $request->file('myagenda_profile_foto')->store('profile', 'public');
        } else {
            // Gunakan logo lama
            $logoPath = $profile->myagenda_profile_foto;
        }

        // Update data profile
        $profile->update([
            'myagenda_profile_foto' => $logoPath,
            'myagenda_profile_nama' => $request->myagenda_profile_nama,
        ]);

        return redirect()->route('myagenda_profile.index')->with('success', 'Profile berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profile = MyAgenda_profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('myagenda_profile.index')->with('success', 'Profile berhasil dihapus');
    }
}
