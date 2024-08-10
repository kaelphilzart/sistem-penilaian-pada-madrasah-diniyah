@extends('template.template_guru')

@section('content')
<div class="container">
    <h5 class="text-center py-4">Jadwal Kegiatan</h5>
<div class="row">
        @foreach($data as $key => $dataKegiatan)
        <div class="col-md-4 mb-3">
                        <div class="card shadow-sm" style="background-color: #a5a6ff;">
                            <div class="card-body">
                                <div class="text-white mt-3">
                                    <h5 class="card-title text-dark" style="font-weight: bold;">{{ strtoupper($dataKegiatan->nama_kegiatan) }}</h5>
                                   <p>Tanggal : <span class="text-dark fw-bold">{{$dataKegiatan->tgl_kegiatan}}</span></p>
                                   <p><span class="fw-bold text-dark">Keterangan</span> {{$dataKegiatan->keterangan}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
        @endforeach
</div>
</div>
@endsection