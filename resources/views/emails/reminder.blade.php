<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pengingat Agenda</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            margin: auto;
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        .highlight {
            font-weight: bold;
            color: #007bff;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Pengingat Agenda</h2>
        <p>Yth. <strong>{{ $sekolah->myagenda_sekolah_nama }}</strong></p>
        <p>
            Kami informasikan bahwa agenda <span class="highlight">{{ $agenda->myagenda_agendadetail_kegiatan }}</span> akan dilaksanakan mulai tanggal 
            <span class="highlight">{{ $agenda->myagenda_agendadetail_tgl_awal }}</span> hingga 
            <span class="highlight">{{ $agenda->myagenda_agendadetail_tgl_akhir }}</span>.
        </p>
        <p>
            Mohon pastikan seluruh persiapan telah dilakukan dengan baik agar kegiatan berjalan lancar.
            Jika terdapat hal yang perlu dikonfirmasi, silakan menghubungi PIC: <strong>{{ $agenda->myagenda_agendadetail_email_pic }}</strong>.
        </p>
        <p>Terima kasih atas perhatian dan kerja samanya.</p>
        <div class="footer">
            <p>— Tim MyAgenda</p>
        </div>
    </div>
</body>
</html>
