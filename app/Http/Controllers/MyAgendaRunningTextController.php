<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Myagenda_runningtext;
use Illuminate\Support\Facades\Auth;

class MyAgendaRunningTextController extends Controller
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

        $runningtext = Myagenda_runningtext::where('myagenda_runningtext_sekolah_id', $user->myagenda_sekolah->myagenda_sekolah_id)->get();
        return view('myagenda_runningtext.index', compact('runningtext'));
    }

    public function create()
    {
        return view('myagenda_runningtext.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'myagenda_runningtext_judul' => 'required|string|max:150',
            'myagenda_runningtext_konten' => 'required|string',
            'myagenda_runningtext_tgl_mulai' => 'required|date',
            'myagenda_runningtext_tgl_akhir' => 'required|date'
        ]);

        $sekolah = auth()->user()->myagenda_sekolah;

        if (!$sekolah) {
            return redirect()->back()->with('error', 'Kamu belum punya sekolah. Harap hubungi admin.');
        }

        $tanggalHariIni = now()->toDateString();

        Myagenda_runningtext::create([
            'myagenda_runningtext_judul' => $request->myagenda_runningtext_judul,
            'myagenda_runningtext_konten' => $request->myagenda_runningtext_konten,
            'myagenda_runningtext_tgl_mulai' =>  $request->myagenda_runningtext_tgl_mulai,
            'myagenda_runningtext_tgl_akhir' => $request->myagenda_runningtext_tgl_akhir,
            'myagenda_runningtext_sekolah_id' => $sekolah->myagenda_sekolah_id,
        ]);

        return redirect()->route('myagenda_runningtext.index')->with('success', 'Data informasi berhasil ditambahkan');
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
        $runningtext = Myagenda_runningtext::findOrFail($id);
        return view('myagenda_runningtext.edit', compact('runningtext'));
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
            'myagenda_runningtext_judul' => 'required|string|max:150',
            'myagenda_runningtext_konten' => 'required|string',
            'myagenda_runningtext_tgl_mulai' => 'required|date',
            'myagenda_runningtext_tgl_akhir' => 'required|date'
        ]);

        $runningtext = Myagenda_runningtext::findOrFail($id);
        $runningtext->update([
            'myagenda_runningtext_judul' => $request->myagenda_runningtext_judul,
            'myagenda_runningtext_konten' => $request->myagenda_runningtext_konten,
            'myagenda_runningtext_tgl_mulai' => $request->myagenda_runningtext_tgl_mulai,
            'myagenda_runningtext_tgl_akhir' => $request->myagenda_runningtext_tgl_akhir
        ]);

        return redirect()->route('myagenda_runningtext.index')->with('success', 'Data informasi berhasil ditambahkan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $runningtext = Myagenda_runningtext::findOrFail($id);
        $runningtext->delete();

        return redirect()->route('myagenda_runningtext.index')->with('success', 'Data berhasil dihapus');
    }
}
