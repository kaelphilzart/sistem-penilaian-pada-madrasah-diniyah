@extends('template.template_wali-murid')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm" >
        <div class="row no-gutters">
            <div class="col-md-4 py-4 px-2">
                <img src="{{ $peserta->foto }}" class="card-img px-3" style="object-fit: cover; height: 100%;" alt="Foto peserta">
            </div>
            <div class="col-md-8">
                <h5 class="card-title text-center mt-4" ><b>{{ $peserta->nisn }}</b></h5>
                <div class="card-body">
                <div class="row">
                        <div class=" mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <p><strong>Nama Lengkap</strong></p>
                                    <p><strong>Alamat</strong></p>
                                    <p><strong>Tanggal Lahir</strong></p>
                                    <p><strong>No Hp</strong></p>
                                    <p><strong>Nama Ayah</strong></p>
                                    <p><strong>Nama Ibu</strong></p>
                                </div>
                                <div class="col-md-8">
                                    <p>: {{ $peserta->nama_peserta }}</p>
                                    <p>: {{ $peserta->alamat_peserta }}</p>
                                    <p>: {{ $peserta->ttl_peserta }}</p>
                                    <p>: {{ $peserta->no_hp_peserta }}</p>
                                    <p>: {{ $peserta->nama_ayah }}</p>
                                    <p>: {{ $peserta->nama_ibu }}</p>
                                </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
