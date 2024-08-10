@extends('template.template_guru_piket')

@section('content')
<div class="container py-4 mb-4">
<div class="card">
    <div class="card-body">
    <div class="row mb-2">
            <div class="col-md-4">
            <label for="peserta">Nama Peserta</label>
            <p name="peserta">{{ $peserta->nama_peserta }}</p>
            </div>
            <div class="col-md-4">
            <label for="tahun">Tahun Ajaran</label>
            <p name="tahun">{{$tahunAjar->tahun}}</p>
            </div>
            <div class="col-md-4">
            <p class="">Semester: {{ $semester }}</p>
            </div>
            </div>
        <h4 class="text-center">Catatan Ngaji</h4>
        <div class="row">
            <div class="col-md-6">
               
            </div>
            <div class="col-md-6">
            <div class="text-end mx-2">
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-catatan{{$peserta->id}}">+&nbsp; Tambah</a>
                    </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap my-4">
                <div class="table-wrapper">
                    <table class="table table-hover">
                        <thead class="sticky-header">
                    <tr>
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Juz - Surat</th>
                        <th>Halaman</th>
                        <th>Ayat</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($catatan as $key => $dataCatatan)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataCatatan->created_at->format('d-m-Y') }}</td>
                        <td>{{ $dataCatatan->juz_surat }}</td>
                        <td>{{ $dataCatatan->hal }}</td>
                        <td>{{ $dataCatatan->ayat ?? '-' }}</td>
                        <td>{{ $dataCatatan->ket }}</td>
                        <td>
                            <a href="#" class="text-dark btn btn-warning px-2" type="button" data-bs-toggle="modal" data-bs-target="#edit-catatan{{ $dataCatatan->id }}">Edit Catatan</a>
                        </td>
                    </tr>
                    @include('guru.guru-piket.edit-catatan')
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
</div>
@include('guru.guru-piket.tambah-catatan')
@include('guru.validasi-modal-nilai')
@endsection
