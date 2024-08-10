@extends('template.template_admin')

@section('content')
<div class="container mt-4">
    <div class="card">

        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <!-- <div class="row">
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
                   @include('admin.tambah-kegiatan')
                        <a href="#" class="text-dark btn btn-success  mb-0  px-4 mx-2" type="button"
                            data-bs-toggle="modal" data-bs-target="#tambah-kegiatan">+&nbsp; Tambah</a>
                    </div>
                </div>
            </div> -->
        </div>
        <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="">
                    <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Guru Penyimak</th>
                        <th>Juz / surat</th>
                        <th>Halaman</th>
                        <th>Ayat</th>
                        <th>ket</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataCatatan)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataCatatan->peserta->nama_peserta }}</td>
                        <td>{{ $dataCatatan->guru->nama_guru }}</td>
                        <td>{{ $dataCatatan->juz_surat }}</td>
                        <td>{{ $dataCatatan->hal }}</td>
                        <td>{{ $dataCatatan->ayat ?? '-' }}</td>
                        <td>{{ $dataCatatan->ket }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataCatatan->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>
@endsection