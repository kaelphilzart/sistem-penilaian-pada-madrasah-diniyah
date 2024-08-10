
<!DOCTYPE html>
<html>
<head>
    <style>
        .page-break {
            page-break-after: always;
        }
        .invoice-box {
            padding: 10px;
            font-size: 14px;
            line-height: 17px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #333;
        }
        .header, .footer {
            position: fixed;
            width: 100%;
        }
        .header {
            top: 0;
            border-bottom: 1px solid #333;
        }
        .footer {
            bottom: 0;
            font-size: smaller;
            border-top: 1px solid #333;
            padding-top: 5px;
        }
        .content {
            padding-top: 10px;
        }
        .content h1, .content h3 {
            text-align: center;
        }
        table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }
        table tr.heading td, table tr.sikap td, table tr.nilai td {
            border: 1px solid #333;
        }
        table tr.heading td {
            background: #eee;
            font-weight: bold;
            text-align: center;
            height: 25px;
        }
        table tr.sikap td {
            padding: 6px;
            height: 150px;
        }
        table tr.sikap td.predikat {
            text-align: center;
        }
        table tr.sikap td.description, table tr.nilai td.description {
            line-height: 20px;
            height: 150px;
            font-size: 12px;
        }
        table tr.nilai td {
            padding: 3px;
        }
        table tr.nilai td.center {
            text-align: center;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 15px;
        }
    </style>
</head>
<body>
    <div class="invoice-box">
        <div style="border-bottom: 1px solid #333;">
            <table>
                <tr>
                    <td style="width: 26%;">Nama Peserta Didik</td>
                    <td style="width: 40%;">: {{ $peserta->nama_peserta }}</td>
                    <td style="width: 21%;">Kelas</td>
                    <td style="width: 13%;">: {{ $peserta->kelas->nama_kelas }}</td>
                </tr>
                <tr>
                    <td style="width: 26%;">NISN</td>
                    <td style="width: 40%;">: {{ $peserta->nisn }}</td>
                    <td style="width: 21%;">Semester</td>
                    <td style="width: 13%;">: 
                        @if($semester == 1)
                            Ganjil
                        @else
                            Genap
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="width: 26%;">Madrasah</td>
                    <td style="width: 40%;">: Hidayatul Muta'alimin</td>
                    <td style="width: 21%;">Tahun Pelajaran</td>
                    <td style="width: 13%;">: {{ $tahunAjaran->tahun }}</td>
                </tr>
                <tr>
                    <td style="width: 26%;">Alamat</td>
                    <td style="width: 40%;">: Jl. Bujel</td>
                </tr>
            </table>
        </div>
        <div style="text-align: center; padding-bottom: 10px; padding-top: 20px;">
            <strong>LAPORAN HASIL<br>
            PENILAIAN SEMESTER {{ strtoupper($peserta->semester) }}<br>
            TAHUN PELAJARAN {{ strtoupper($peserta->tahun) }}
            </strong>
        </div>
        <div class="content">
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; border: 1px solid black;">
                <thead>
                    <tr class="heading">
                        <th style="width: 5%; border: 1px solid black; text-align: center;">No</th>
                        <th style="width: 50%; border: 1px solid black; text-align: center;">Muatan Pelajaran</th>
                        <th style="width: 15%; border: 1px solid black; text-align: center;">Hasil Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $totalRataRata = 0;
                    $jumlahMapel = $nilaiMapel->count();
                    @endphp

                    @foreach($nilaiMapel as $dataMapel)
                    @php
                    $rataRata = $dataMapel->rata_rata ?? '-';
                    if ($rataRata !== '-') {
                        $totalRataRata += $rataRata;
                    }
                    @endphp
                    <tr>
                        <td style="width: 5%; border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                        <td style="width: 50%; border: 1px solid black;">{{ $dataMapel->mapel }}</td>
                        <td style="width: 15%; border: 1px solid black; text-align: center;">{{ $rataRata }}</td>
                    </tr>
                    @endforeach

                    @php
                    $nilaiRataRataKeseluruhan = $jumlahMapel > 0 ? $totalRataRata / $jumlahMapel : 0;
                    @endphp
                    <tr>
                        <td colspan="2" style="border: 1px solid black; text-align: center; font-weight: bold;">Nilai
                            Rata-Rata Keseluruhan</td>
                        <td style="border: 1px solid black; text-align: center;">{{
                            number_format($nilaiRataRataKeseluruhan, 2) }}</td>
                    </tr>
                </tbody>
            </table>
            <h4 style="text-align: center;">Pencapaian Ngaji Harian</h4>
            <table style="width: 100%; margin-top: 10px; border: 1px solid black; border-collapse: collapse;">
                <thead>
                    <tr class="heading">
                        <th style="width: 20%; border: 1px solid black; text-align: center;">Juz / Surat</th>
                        <th style="width: 20%; border: 1px solid black; text-align: center;">Halaman</th>
                        <th style="width: 20%; border: 1px solid black; text-align: center;">Ayat</th>
                    </tr>
                </thead>
                <tbody>
                @if($catatan)
                        <tr>
                            <td style="width: 20%; border: 1px solid black; text-align: center;">{{ $catatan->juz_surat }}</td>
                            <td style="width: 20%; border: 1px solid black; text-align: center;">{{ $catatan->hal }}</td>
                            @if($catatan->ayat !== null)
                            <td style="width: 20%; border: 1px solid black; text-align: center;">{{ $catatan->ayat }}</td>
                            @else
                            <td style="width: 20%; border: 1px solid black; text-align: center;">-</td>
                            @endif
                        </tr>
                    @else
                        <tr>
                            <td style="width: 20%; border: 1px solid black; text-align: center;">-</td>
                            <td style="width: 20%; border: 1px solid black; text-align: center;">-</td>
                            <td style="width: 20%; border: 1px solid black; text-align: center;">-</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6">
                    <table style="width: 100%; margin-top: 10px; border: 1px solid black; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="width: 70%; border: 1px solid black; text-align: center;">Ketidakhadiran</th>
                                <th style="width: 30%; border: 1px solid black; text-align: center;">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absenData as $status => $total)
                            <tr>
                                <td style="width: 70%; border: 1px solid black;">{{ ucfirst($status) }}</td>
                                <td style="width: 30%; border: 1px solid black; text-align: center;">{{ $total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p style="text-align: right; padding-top: 20px;">Kediri, {{
                \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        </div>
        <div style="padding-bottom: 10px;">
            <table>
                <tr>
                    <td style="width: 20%; text-align: center;">Orang Tua/Wali</td>
                    <td style="width: 30%;"></td>
                    <td style="width: 50%; text-align: center;">Kepala Madrasah</td>
                </tr>
            </table>
            <div style="padding-top: 80px;">
                <table>
                    <tr>
                        <td style="width: 20%; text-align: center;">
                            ..............................................
                        </td>
                        <td style="width: 30%;"></td>
                        <td style="width: 50%; text-align: center;">
                            <span style="font-weight: bold;">{{$kepalaMadrasah->name}}</span>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>
