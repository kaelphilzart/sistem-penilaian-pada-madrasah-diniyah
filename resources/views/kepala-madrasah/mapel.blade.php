@extends('template.template_kepala-madrasah')

@section('content')
<div class="container my-4">
    <div class="card">

        <h5 class="card-header">Mata Pelajaran</h5>
        <div class="container">
            <h5>Kelas : <span>{{$tahun->nama_kelas}}</span></h5>
        </div>
        <div class="table-responsive text-nowrap">
        @if($mapel->isEmpty())
                <div class="alert alert-warning text-center mt-3">
                    Mata Pelajaran belum ada.
                </div>
            @else
            <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="">
                        <th>No</th>
                        <th>kode Mata Pelajaran</th>
                        <th>Mata Pelajaran</th>
                    </tr>
                </thead>
                @foreach($mapel as $key => $dataMapel)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataMapel->kode_mapel }}</td>
                        <td>{{ $dataMapel->mapel }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            </div>
        </div>
        @endif
        </div>
    </div>
</div>
@endsection