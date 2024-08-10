@extends('template.template_guru')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-auto">
                            <h5 class="mx-4">Nama Peserta: {{ $peserta->nama_peserta }}</h5>
                        </div>
                        <div class="col-auto">
                            <h5 class="mr-4">Kelas: {{ $tahun->kelas }}</h5>
                        </div>
                        <div class="col-auto">
                            <h5 class="mx-4">Tahun Ajaran: {{ $tahun->tahun }}</h5>
                        </div>
                        <div class="col-auto">
                            <h5 class="mx-4">Semester: {{ $tahun->semester }}</h5>
                        </div>
                    </div>
                    <div class="col-md-12 my-2">
                        <h4 class="text-center">Rekap Nilai</h4>
                    </div>
                    <div class="table-responsive">
                        @if($rekap->isEmpty())
                            <div class="alert alert-warning text-center">
                                Belum ada nilai pada tahun ajaran dan semester ini.
                            </div>
                        @else
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Mata Pelajaran</th>
                                        @foreach($jenisTugas as $tugas)
                                            <th>{{ $tugas }}</th>
                                        @endforeach
                                        <th>Rata-Rata</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekap as $mapel => $nilaiMapel)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mapel }}</td>
                                            @foreach($jenisTugas as $tugas)
                                                <td>
                                                    @php
                                                        $nilai = $nilaiMapel->firstWhere('nama_tugas', $tugas);
                                                    @endphp
                                                    {{ $nilai ? $nilai->isi_nilai : '-' }}
                                                </td>
                                            @endforeach
                                            <td>{{ number_format($rataRata[$mapel], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
