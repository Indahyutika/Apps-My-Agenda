<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyAgenda_agenda;
use App\MyAgenda_gambar;
use App\MyAgenda_sekolah;
use App\Myagenda_runningtext;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $myagendaSekolah = MyAgenda_sekolah::where('myagenda_sekolah_user_id', $user->myagenda_user_id)->first();
        $runningtext = Myagenda_runningtext::whereDate('myagenda_runningtext_tgl_mulai', '<=', now())
            ->whereDate('myagenda_runningtext_tgl_akhir', '>=', now())
            ->get();

        $myagendaProfile = null;
        if ($user->myagenda_user_role == 'admin') {
            $myagendaProfile = DB::table('myagenda_profile')->where('myagenda_profile_user_id', $user->id)->first();
        }

        if (!$myagendaSekolah) {
            return view('error.dashboard_sekolah', compact('user'));
        }

        $agenda = MyAgenda_agenda::where('myagenda_agenda_sekolah_id', $myagendaSekolah->myagenda_sekolah_id)
            ->whereHas('agendaDetails', function ($query) {
                $query->where(function ($q) {
                    $q->whereDate('myagenda_agendadetail_tgl_awal', '<=', now())
                        ->whereDate('myagenda_agendadetail_tgl_akhir', '>=', now());
                })
                    ->orWhere(function ($q) {
                        $q->whereMonth('myagenda_agendadetail_tgl_awal', '<=', now()->month)
                            ->whereMonth('myagenda_agendadetail_tgl_akhir', '>=', now()->month)
                            ->whereYear('myagenda_agendadetail_tgl_awal', '<=', now()->year)
                            ->whereYear('myagenda_agendadetail_tgl_akhir', '>=', now()->year);
                    });
            })
            ->with('agendaDetails')
            ->get();

        $mediaExists = MyAgenda_gambar::where('myagenda_gambar_sekolah_id', $myagendaSekolah->myagenda_sekolah_id)->exists();
        $agendaExists = !$agenda->isEmpty();

        if (!$mediaExists || !$agendaExists) {
            return view('error.dashboard_picagenda', compact('user', 'myagendaSekolah', 'mediaExists', 'agendaExists'));
        }

        $media = MyAgenda_gambar::where('myagenda_gambar_sekolah_id', $myagendaSekolah->myagenda_sekolah_id)
            ->latest()->take(10)->get();

        $agendaStart = $agenda->flatMap->agendaDetails->min('myagenda_agendadetail_tgl_awal');
        $agendaEnd = $agenda->flatMap->agendaDetails->max('myagenda_agendadetail_tgl_akhir');

        $agendaTitle = 'Agenda';
        if ($agendaStart && $agendaEnd) {
            $startDate = Carbon::parse($agendaStart);
            $endDate = Carbon::parse($agendaEnd);
            $startMonth = $startDate->translatedFormat('F Y');
            $endMonth = $endDate->translatedFormat('F Y');
            $agendaTitle = $startMonth === $endMonth ? "Agenda Bulan $startMonth" : "Agenda $startMonth - $endMonth";
        }

        return view('page.dashboard', compact('user', 'myagendaSekolah', 'myagendaProfile', 'media', 'agenda', 'runningtext', 'agendaTitle'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
