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
                    <div class="text-end mx-2 fw-bold">
                        <p>angkatan : {{$angkatan->angkatan}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr class="text-nowrap">
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Peserta Didik</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($peserta as $key => $dataPeserta)
                <tbody>
                    <tr>
                        <td>{{ $peserta->firstItem() + $key }}</td>
                        <td>{{ $dataPeserta->nisn }}</td>
                        <td>{{ $dataPeserta->nama_peserta }}</td>
                        <td>{{ $dataPeserta->kelas->nama_kelas }}</td>
                        <td>
                            <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#profile-peserta-angkatan{{$dataPeserta->id}}">Profile</a>
                        </td>
                    </tr>
                    @include('admin.profile-peserta-angkatan')
                    @endforeach
                </tbody>
            </table>
            <div class="pagination py-2 px-2">
            <div class="d-flex justify-content-center align-items-center">
             
                {{ $peserta->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection