<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Lengkap - {{ $selectedMonth }}</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; }
        .title { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <div class="title">
        <h2>LAPORAN LENGKAP HRIS - {{ $selectedMonth }}</h2>
    </div>

    <h3>1. Detail Kinerja per Karyawan per Divisi</h3>
    <table>
        <tr>
            <th>Divisi</th>
            <th>Nama Karyawan</th>
            <th>Skor Kinerja</th>
        </tr>
        @foreach($divisiList as $divisi)
            @foreach($divisi->employees as $emp)
            <tr>
                <td>{{ $divisi->name }}</td>
                <td>{{ $emp->name }}</td>
                <td>{{ $emp->performance_score }}</td>
            </tr>
            @endforeach
        @endforeach
    </table>

    <h3>2. Detail Seluruh Keluhan</h3>
    <table>
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Prioritas</th>
            <th>Status</th>
        </tr>
        @foreach($keluhanList as $k)
        <tr>
            <td>{{ $k->title }}</td>
            <td>{{ $k->description }}</td>
            <td>{{ $k->priority }}</td>
            <td>{{ $k->status }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>