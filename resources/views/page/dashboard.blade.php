@extends('template')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div id="media-container">
                        @foreach($media as $item)
                        @php
                        $filePath = 'storage/' . $item->myagenda_gambar_media;
                        $fileExtension = pathinfo(public_path($filePath), PATHINFO_EXTENSION);
                        @endphp

                        @if(in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif']))
                        <img class="media-item" src="{{ asset($filePath) }}" alt="media">
                        @elseif(in_array($fileExtension, ['mp4', 'mov', 'avi']))
                        <video class="media-item" controls>
                            <source src="{{ asset($filePath) }}" type="video/{{ $fileExtension }}">
                            browser kamu gak support video tag sayangkuu~
                        </video>
                        @else
                        <p class="media-item">file tidak bisa ditampilkan</p>
                        @endif
                        @endforeach
                    </div>
                    <div class="card-body text-center">
                        <p id="media-description" class="card-text"></p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <h5 class="card-header text-center mb-4">
                        {{ optional($agenda->first())->myagenda_agenda_judul ?? 'Tidak Ada Agenda' }}
                    </h5>
                    <div class="card-body">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-bordered">
                                <thead class="table-secondary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Tgl Mulai</th>
                                        <th>Tgl Akhir</th>
                                        <th>Kegiatan</th>
                                        <th>Deskripsi</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @php
                                    $currentMonth = now()->month;
                                    @endphp
                                    @forelse (optional($agenda->first())->agendaDetails->filter(function($detail) use ($currentMonth) {
                                    $startMonth = \Carbon\Carbon::parse($detail->myagenda_agendadetail_tgl_awal)->month;
                                    $endMonth = \Carbon\Carbon::parse($detail->myagenda_agendadetail_tgl_akhir)->month;
                                    return $startMonth == $currentMonth || $endMonth == $currentMonth;
                                    }) ?? [] as $key => $detail)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->myagenda_agendadetail_tgl_awal)->format('d F') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($detail->myagenda_agendadetail_tgl_akhir)->format('d F') }}</td>
                                        <td>{{ $detail->myagenda_agendadetail_kegiatan }}</td>
                                        <td>{{ $detail->myagenda_agendadetail_deskripsi }}</td>
                                        <td>
                                            @php
                                            $status = $detail->status;
                                            $btnClass = 'badge bg-label-primary me-1'; // default merah

                                            if ($status === 'Belum Terlaksana') {
                                            $btnClass = 'badge bg-label-danger me-1'; // kuning
                                            } elseif ($status === 'Sedang Terlaksana') {
                                            $btnClass = 'badge bg-label-info me-1'; // biru
                                            } elseif ($status === 'Sudah Terlaksana') {
                                            $btnClass = 'badge bg-label-success me-1'; // hijau
                                            }
                                            @endphp

                                            <button class="btn {{ $btnClass }} btn-sm" disabled>{{ $status }}</button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6">Tidak ada detail agenda</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    @if($runningtext->isNotEmpty())
                    <div class="running-text-container">
                        <div class="running-text">
                            @foreach($runningtext as $index => $text)
                            <span>{{ $text->myagenda_runningtext_konten }}@if(!$loop->last) ⏐@endif</span>
                            @endforeach
                        </div>
                    </div>
                    @else
                    <p class="text-center text-muted">Tidak ada informasi saat ini.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    #media-container {
        position: relative;
        width: 100%;
        height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .media-item {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    .media-item.active {
        opacity: 1;
    }

    #media-description {
        font-size: 16px;
        font-weight: bold;
        margin-top: 10px;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }

    #media-description.active {
        opacity: 1;
    }

    .card {
        margin-top: 10px;
    }

    .running-text-container {
        width: 100%;
        overflow: hidden;
        /* soft beige gradient */
        color:rgb(78, 172, 185);
        padding: 12px 0;
        border-radius: 8px;
        white-space: nowrap;
        position: relative;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    }

   
    .running-text {
        display: inline-block;
        white-space: nowrap;
        padding-left: 100%;
        animation: running-text-fast 3s linear 1, running-text-scroll 15s linear infinite 3s;
        font-weight: 600;
        font-size: 13px;
        /* color: #7a5c44; */
        /* coklat soft */
    }

    .running-text span {
        display: inline-block;
        color: rgb(41, 41, 41);
        /* lebih warm */
        text-shadow: 1px 1px 2px rgba(139, 111, 80, 0.2);
        letter-spacing: 1px;
        word-spacing: 0;
    }

    @keyframes running-text-fast {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(0%);
        }
    }

    @keyframes running-text-scroll {
        from {
            transform: translateX(0%);
        }

        to {
            transform: translateX(-100%);
        }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let mediaItems = document.querySelectorAll(".media-item");
        let descriptions = @json($media->pluck('myagenda_gambar_deskripsi'));
        let descElement = document.getElementById("media-description");

        let index = 0;

        function showMedia() {
            if (mediaItems.length === 0) return;

            mediaItems.forEach(item => item.classList.remove("active"));
            mediaItems[index].classList.add("active");

            descElement.classList.remove("active");
            setTimeout(() => {
                descElement.textContent = descriptions[index] ?? "Tidak ada deskripsi";
                descElement.classList.add("active");
            }, 500);

            index = (index + 1) % mediaItems.length;
        }

        showMedia();
        setInterval(showMedia, 6000);
    });
</script>
@endsection