@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                <form action="{{route('peserta-cari')}}" method="GET" class="form-inline">
                            <label>
                            <input type="search" name="q" class="form-control" placeholder="nama atau kode">

                            </label>
                            <button type="submit" class="mx-2 btn btn-primary ">
                            <i class="bx bx-search fs-4 lh-0"></i> Cari</button>
                    </form>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div class="text-end mx-2">
                   
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-peserta">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="">
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Peserta Didik</th>
                        <th>Kelas</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataPeserta)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataPeserta->nisn }}</td>
                        <td>{{ $dataPeserta->nama_peserta }}</td>
                        <td>{{ $dataPeserta->nama_kelas }}</td>
                        <td>{{ $dataPeserta->angkatan }}</td>
                        <td>
                            <form action="{{route('delete-peserta', $dataPeserta->id)}}" method="post">@csrf
                            <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#profile-peserta{{$dataPeserta->id}}">Profile</a>
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-peserta{{$dataPeserta->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus Peserta?')">Delete</button>
                            </form>
                        </td>
                        <td>{{ $dataPeserta->status }}</td>
                    </tr>
                    @include('admin.edit-peserta')
                    @include('admin.profile-peserta')
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@include('admin.tambah-peserta')
@endsection