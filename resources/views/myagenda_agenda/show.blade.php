@extends('template')
@section('content')

<style>
    .card {
        margin: 3px;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #fff;
        background-clip: border-box;
        border: 0 solid #d9dee3;
        border-radius: 0.5rem;
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="card">
        <h5 class="card-header" style="text-align: center;">{{ $agenda->myagenda_agenda_judul }}</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead style="text-align: center;">
                        <tr>
                            <th>No</th>
                            <th>Tgl Mulai</th>
                            <th>Tgl Akhir</th>
                            <th>Kegiatan</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody style="text-align: center;">
                        @foreach ($agenda->agendaDetails as $key => $detail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->myagenda_agendadetail_tgl_awal }}</td>
                            <td>{{ $detail->myagenda_agendadetail_tgl_akhir }}</td>
                            <td>{{ $detail->myagenda_agendadetail_kegiatan }}</td>
                            <td>{{ $detail->myagenda_agendadetail_deskripsi }}</td>
                            <td>{{ $detail->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @if ($agenda->agendaDetails->isEmpty())
                <p class="text-center">Tidak ada detail agenda</p>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
