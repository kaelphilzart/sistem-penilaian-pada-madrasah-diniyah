@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                   
                </div>
                <div class="col-md-6">
                    <div class="text-end mx-2">
                   @include('admin.tambah-kegiatan')
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-kegiatan">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                    <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataKegiatan)
                <tbody>
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td>{{ $dataKegiatan->nama_kegiatan }}</td>
                        <td>{{ $dataKegiatan->tgl_kegiatan }}</td>
                        <td>{{ $dataKegiatan->keterangan }}</td>
                        <td>
                            <form action="{{route('delete-kegiatan', $dataKegiatan->id)}}" method="post">@csrf
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-kegiatan{{$dataKegiatan->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus kegiatan?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.edit-kegiatan')
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