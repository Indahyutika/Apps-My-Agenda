<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MyAgenda_agenda;
use App\MyAgenda_gambar;
use App\MyAgenda_sekolah;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $user = Auth::user();
    $myagendaSekolah = MyAgenda_sekolah::where('myagenda_user_id', $user->id)->first();

    if (!$myagendaSekolah) {
        return redirect()->back()->with('error', 'Sekolah tidak ditemukan');
    }

    $media = MyAgenda_gambar::where('myagenda_gambar_sekolah_id', $myagendaSekolah->id)
        ->latest()->take(10)->get() ?? collect([]);

        dd($media);
        $agenda = MyAgenda_agenda::where('myagenda_agenda_sekolah_id', $myagendaSekolah->id)
        ->with('agendaDetails')->get() ?? collect([]);

    return view('page.dashboard', compact('user', 'myagendaSekolah', 'media', 'agenda'));
}

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login'); 
    }
}
