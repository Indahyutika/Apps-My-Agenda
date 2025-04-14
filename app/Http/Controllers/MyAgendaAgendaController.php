<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyAgenda_agenda;
use App\MyAgenda_sekolah;
use App\MyAgenda_agendadetail;
use Illuminate\Support\Facades\Auth;

class MyAgendaAgendaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $agenda = MyAgenda_agenda::all();

        if (!$user->myagenda_sekolah) {
            return redirect()->route('myagenda_sekolah.index')
                ->with('error', 'Isi data sekolah terlebih dahulu.');
        }

        $agenda = MyAgenda_agenda::with('sekolah')
            ->where('myagenda_agenda_sekolah_id', $user->myagenda_sekolah->myagenda_sekolah_id)
            ->get();

        return view('myagenda_agenda.index', compact('agenda'));
    }

    public function create()
    {
        $sekolah = MyAgenda_sekolah::all();
        return view('myagenda_agenda.create', compact('sekolah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'myagenda_agenda_judul' => 'required|string|max:255',
            'myagenda_agenda_tanggal' => 'required|date',
            'details' => 'required|array',
            'details.*.myagenda_agendadetail_kegiatan' => 'required|string',
            'details.*.myagenda_agendadetail_tgl_awal' => 'required|date',
            'details.*.myagenda_agendadetail_tgl_akhir' => 'required|date',
            'details.*.myagenda_agendadetail_jumlah_hari' => 'required',
            'details.*.myagenda_agendadetail_deskripsi' => 'required|string',
            'details.*.myagenda_agendadetail_email_pic' => 'required|email',
            'details.*.myagenda_agendadetail_pic' => 'required|string',
        ]);

        $sekolah = auth()->user()->myagenda_sekolah;

        if (!$sekolah) {
            return redirect()->back()->with('error', 'Kamu belum punya sekolah. Harap hubungi admin.');
        }

        $tanggalHariIni = now()->toDateString();

        $agenda = MyAgenda_agenda::create([
            'myagenda_agenda_judul' => $request->myagenda_agenda_judul,
            'myagenda_agenda_tanggal' => $tanggalHariIni,
            'myagenda_agenda_sekolah_id' => $sekolah->myagenda_sekolah_id,
        ]);

        foreach ($request->details as $detail) {
            $pic = is_array($detail['myagenda_agendadetail_pic'])
                ? implode(',', $detail['myagenda_agendadetail_pic'])
                : $detail['myagenda_agendadetail_pic'];

            MyAgenda_agendadetail::create([
                'myagenda_agendadetail_agenda_id' => $agenda->myagenda_agenda_id,
                'myagenda_agendadetail_kegiatan' => $detail['myagenda_agendadetail_kegiatan'],
                'myagenda_agendadetail_tgl_awal' => $detail['myagenda_agendadetail_tgl_awal'],
                'myagenda_agendadetail_tgl_akhir' => $detail['myagenda_agendadetail_tgl_akhir'],
                'myagenda_agendadetail_jumlah_hari' => $detail['myagenda_agendadetail_jumlah_hari'],
                'myagenda_agendadetail_deskripsi' => $detail['myagenda_agendadetail_deskripsi'],
                'myagenda_agendadetail_email_pic' => $detail['myagenda_agendadetail_email_pic'],
                'myagenda_agendadetail_pic' => $pic,
            ]);
        }

        return redirect()->route('myagenda_agenda.index')->with('success', 'Agenda dan Detail Agenda berhasil disimpan');
    }

    public function show($id)
    {
        $agenda = MyAgenda_agenda::with('sekolah', 'agendaDetails')->findOrFail($id);
        return view('myagenda_agenda.show', compact('agenda'));
    }

    public function edit($id)
    {
        $agenda = MyAgenda_agenda::with('sekolah', 'agendaDetails')->findOrFail($id);
        $sekolah = MyAgenda_sekolah::all();

        return view('myagenda_agenda.edit', compact('agenda', 'sekolah'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'myagenda_agenda_judul' => 'required|string|max:150',
            'myagenda_agenda_tanggal' => 'required|date',
            'details' => 'sometimes|array',
            'details.*.myagenda_agendadetail_kegiatan' => 'required|string',
            'details.*.myagenda_agendadetail_tgl_awal' => 'required|date',
            'details.*.myagenda_agendadetail_tgl_akhir' => 'required|date',
            'details.*.myagenda_agendadetail_jumlah_hari' => 'required|numeric',
            'details.*.myagenda_agendadetail_deskripsi' => 'required|string',
            'details.*.myagenda_agendadetail_email_pic' => 'required|email|unique:myagenda_agendadetail,myagenda_agendadetail_email_pic',
            'details.*.myagenda_agendadetail_pic' => 'required|string',
            'details_to_remove' => 'nullable|array',
        ]);

        $agenda = MyAgenda_agenda::findOrFail($id);
        $agenda->update($request->only([
            'myagenda_agenda_sekolah_id',
            'myagenda_agenda_judul',
            'myagenda_agenda_tanggal'
        ]));

        // hapus detail yang diminta dihapus
        if ($request->has('details_to_remove')) {
            MyAgenda_agendadetail::whereIn('myagenda_agendadetail_id', $request->details_to_remove)->delete();
        }

        $existingDetailsIds = $agenda->agendaDetails()->pluck('myagenda_agendadetail_id')->toArray();
        $incomingDetailIds = [];

        if ($request->has('details')) {
            foreach ($request->details as $detail) {
                if (!empty($detail['id'])) {
                    $incomingDetailIds[] = $detail['id'];
                }

                MyAgenda_agendadetail::updateOrCreate(
                    ['myagenda_agendadetail_id' => $detail['id'] ?? null],
                    [
                        'myagenda_agendadetail_agenda_id' => $agenda->myagenda_agenda_id,
                        'myagenda_agendadetail_kegiatan' => $detail['myagenda_agendadetail_kegiatan'],
                        'myagenda_agendadetail_tgl_awal' => $detail['myagenda_agendadetail_tgl_awal'],
                        'myagenda_agendadetail_tgl_akhir' => $detail['myagenda_agendadetail_tgl_akhir'],
                        'details.*.myagenda_agendadetail_jumlah_hari' => $detail['myagenda_agendadetail_jumlah_hari'],
                        'myagenda_agendadetail_deskripsi' => $detail['myagenda_agendadetail_deskripsi'],
                        'myagenda_agendadetail_email_pic' => $detail['myagenda_agendadetail_email_pic'],
                        'myagenda_agendadetail_pic' => $detail['myagenda_agendadetail_pic'],
                    ]
                );
            }
        }

        $detailsToDelete = array_diff($existingDetailsIds, $incomingDetailIds);
        MyAgenda_agendadetail::whereIn('myagenda_agendadetail_id', $detailsToDelete)->delete();

        return redirect()->route('myagenda_agenda.index')->with('success', 'Data agenda berhasil diubah');
    }

    public function destroy($id)
    {
        MyAgenda_agendadetail::where('myagenda_agendadetail_agenda_id', $id)->delete();
        $agenda = MyAgenda_agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('myagenda_agenda.index')->with('success', 'Data agenda berhasil dihapus');
    }
}
