@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{route('user-cari')}}" method="GET">
                            <label>
                            <input type="search" name="q"  class="form-control" placeholder="Search ">
                            </label>
                            <button type="submit" class="mx-2 btn btn-primary ">
                            <i class="bx bx-search fs-4 lh-0"></i> Cari</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <div class="text-end mx-2">
                   @include('admin.tambah-angkatan')
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-angkatan">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                    <th>No</th>
                        <th>Angkatan</th>
                        <th>Total Peserta Didik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataAngkatan)
                <tbody>
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td>{{ $dataAngkatan->angkatan }}</td>
                        <td>{{$dataAngkatan->peserta_didik_count}}</td>
                        <td>
                            <form action="{{route('delete-angkatan', $dataAngkatan->id)}}" method="post">@csrf
                            <a href="{{ route('peserta-angkatan', $dataAngkatan->id) }}" class="text-dark btn btn-info px-4">Peserta Didik</a>
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-angkatan{{$dataAngkatan->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus Angkatan?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.edit-angkatan')
                    @endforeach
                </tbody>
            </table>
            <div class="pagination py-2 px-2">
            <div class="d-flex justify-content-center align-items-center">
             
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection