@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('mapel-cari')}}" method="GET">
                            <label>
                            <input type="search" name="q"  class="form-control" placeholder="mapel atau kode">
                            </label>
                            <button type="submit" class="mx-2 btn btn-primary ">
                            <i class="bx bx-search fs-4 lh-0"></i> Cari</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-end mx-2">
                   
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-mapel">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap py-4">
        <div class="table-wrapper">
        <table class="table table-hover">
          <thead class="sticky-header">
                    <tr class="">
                    <th>No</th>
                        <th>Kode Mapel</th>
                        <th>Nama Pelajaran</th>
                        <th>Kelas</th>
                        <th>Angkatan tahun </th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataMapel)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataMapel->kode_mapel }}</td>
                        <td>{{ $dataMapel->mapel }}</td>
                        <td>{{ $dataMapel->nama_kelas }}</td>
                        <td>{{ $dataMapel->angkatan }}</td>
                        <td>
                            <form action="{{route('delete-mapel', $dataMapel->id)}}" method="post">@csrf
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-mapel{{$dataMapel->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus Mapel?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.edit-mapel')
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@include('admin.tambah-mapel')
@endsection