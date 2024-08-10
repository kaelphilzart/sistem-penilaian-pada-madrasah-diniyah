@extends('template.template_wali-murid')

@section('content')
<div class="container mt4">
    <h4> <h3 class="text-center fw-bold">Catatan Ngaji Tahun Pelajaran</h3>
    </h4>
    <div class="card">
        <div class="card-body">
        <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="">
                        <th>No</th>
                        <th>Waktu</th>
                        <th>Juz / surat</th>
                        <th>Keterangan</th>
                        <th>Penyimak</th>
                    </tr>
                </thead>
                @foreach($catatan as $key => $dataCatatan)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($dataCatatan->created_at)->format('d-m-Y') }}</td>
                        <td>{{$dataCatatan->catatan->juz_surat}}</td>
                        <td>{{$dataCatatan->ket_catatan}}</td>
                        <td>{{$dataCatatan->nama_guru}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
        </div>
    </div>
</div>
@endsection