@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    
                </div>
                @include('admin.tambah-kelas')
                <div class="col-md-6">
                    <div class="text-end mx-2">
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-kelas">+&nbsp; Tambah</a>
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
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataKelas)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataKelas->nama_kelas }}</td>
                        <td>{{ $dataKelas->guru->nama_guru }}</td>
                        <td>
                            <form action="{{route('delete-kelas', $dataKelas->id)}}" method="post">@csrf
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-kelas{{$dataKelas->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus Kelas?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.edit-kelas')
                    @endforeach
                </tbody>
            </table>
            
        </div>
        </div>
    </div>
</div>
@endsection