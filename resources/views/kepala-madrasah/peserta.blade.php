@extends('template.template_kepala-madrasah')

@section('content')
<div class="container my-4">
    <div class="card">
        <h5 class="card-header">Data Peserta Didik</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('filter-peserta') }}" method="GET" class="form-inline d-flex align-items-center">
                        <select class="form-control me-2" id="status" name="status">
                            <option value="">Filter Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ request('status') == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        <select class="form-control me-2" id="id_kelas" name="id_kelas">
                            <option value="">Pilih Kelas</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ request('id_kelas') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">FILTER</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5 class="text-end fw-bold">Peserta Didik : {{$total}}</h5>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap my-4">
            <div class="table-wrapper">
                <table class="table table-hover">
                    <thead class="sticky-header">
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Lengkap</th>
                            <th>Kelas</th>
                            <th>Status</th>
                            <th>Profil</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $key => $dataPeserta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataPeserta->nisn }}</td>
                            <td>{{ $dataPeserta->nama_peserta }}</td>
                            <td>{{ $dataPeserta->kelas->nama_kelas }}</td>
                            <td>{{ $dataPeserta->status }}</td>
                            <td>
                                <a href="#" class="text-dark btn btn-info px-4" type="button" data-bs-toggle="modal" data-bs-target="#profile-peserta{{$dataPeserta->id}}">Profil</a>
                            </td>
                        </tr>
                        @include('kepala-madrasah.profile-peserta')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
