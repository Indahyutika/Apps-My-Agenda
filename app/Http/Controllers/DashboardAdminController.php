<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyAgenda_sekolah;
use App\MyAgenda_user;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlahPengguna = MyAgenda_user::where('myagenda_user_role', 'pengguna')->count();
        $bulanLalu = Carbon::now()->subMonth();
    $jumlahPenggunaBulanLalu = MyAgenda_user::where('myagenda_user_role', 'pengguna')
        ->whereMonth('created_at', $bulanLalu->month)
        ->whereYear('created_at', $bulanLalu->year)
        ->count();

    // Hitung persentase pertumbuhan
    if ($jumlahPenggunaBulanLalu > 0) {
        $persentasePertumbuhan = (($jumlahPengguna - $jumlahPenggunaBulanLalu) / $jumlahPenggunaBulanLalu) * 100;
    } else {
        $persentasePertumbuhan = 0;
    }
        $sekolah = MyAgenda_sekolah::all();
        return view('page.dashboard_admin', compact('sekolah', 'jumlahPengguna', 'persentasePertumbuhan'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
