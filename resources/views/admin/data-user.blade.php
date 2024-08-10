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
                     
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambahUser">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataUser)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataUser->name }}</td>
                        <td>{{ $dataUser->email }}</td>
                        <td>
                            <form action="{{route('delete-user', $dataUser->id)}}" method="post">@csrf
                                <a href="#" class="text-dark btn btn-warning  px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-user{{$dataUser->id}}">Edit</a>
                                <button class="btn btn-danger px-3"
                                    onClick="return confirm('Yakin Hapus User?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @include('admin.edit-user')
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@include('admin.tambah-user')
@endsection