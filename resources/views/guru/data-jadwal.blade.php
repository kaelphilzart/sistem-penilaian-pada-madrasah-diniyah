@extends('template.template_guru')

@section('content')
<div class="content-wrapper">
    <div class="container mt-4">
        <div class="card">
            <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
            <div class="container">
            <h4 class="text-center">Jadwal Mata Pelajaran</h4>
            <h5 class="text-end">Kelas: {{ $kelasPertama->nama_kelas ?? 'Tidak ada kelas yang ditemukan' }}</h5>
                <h5 class="mb-3">Pilih Tahun Ajaran</h5>
                <form action="{{ route('cari-jadwal') }}" method="GET" class="row gx-3 gy-2 align-items-center">
                    <div class="col-sm-4">
                        <select class="form-control" id="tahun_id" name="tahun_id">
                            <option value="">Pilih Tahun Ajaran</option>
                            @foreach($tahun as $data1)
                                <option value="{{ $data1->id }}" {{ request('tahun_id') == $data1->id ? 'selected' : '' }}>
                                    {{ $data1->tahun }} 
                                </option>
                            @endforeach
                        </select>
                        @error('tahun_id')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mx-2">Cari</button>
                    </div>
                </form>
            </div>
            @if($data->isNotEmpty())
            <div class="container">
            <div class="row py-4">
                @foreach($data as $key => $dataJadwal)
                    <div class="col-md-6 mb-3">
                        <div class="card shadow-sm" style="background-color: #a5a6ff;">
                            <div class="card-body">
                                <div class="text-white mt-3">
                                    <h5 class="card-title text-dark" style="font-weight: bold;">{{ strtoupper($dataJadwal->hari) }}</h5>
                                    <div class="row">
                                        <div class="col-md-6 text-center" style="font-weight: bold;">
                                            <p>Guru</p>
                                            <p>Guru Piket</p>
                                            <p>Mata Pelajaran 1</p>
                                            <p>Mata Pelajaran 2</p>
                                            <p>Mata Pelajaran 3</p>
                                        </div>
                                        <div class="col-md-6 text-center" style="font-weight: bold;">
                                        <p>{{ $dataJadwal->guru_inti }}</p>
                                        <p>{{ $dataJadwal->id_guruPiket != 0 ? $dataJadwal->guru_piket : 'Tidak ada' }}</p>
                                        <p>
                                            {{ $dataJadwal->id_mapel != 0 ? $dataJadwal->nama_mapel1 . ' (' . $dataJadwal->kode_mapel1 . ')' : 'Tidak ada' }}
                                        </p>
                                        <p>
                                            {{ $dataJadwal->id_mapel1 != 0 ? $dataJadwal->nama_mapel2 . ' (' . $dataJadwal->kode_mapel2 . ')' : 'Tidak ada' }}
                                        </p>
                                        <p>
                                            {{ $dataJadwal->id_mapel2 != 0 ? $dataJadwal->nama_mapel3 . ' (' . $dataJadwal->kode_mapel3 . ')' : 'Tidak ada' }}
                                        </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </div>
                </div>
            @else
                <h5 class="text-center mt-4">Tidak ada jadwal pada kelas ini</h5>
            @endif
           
        </div>
    </div>
</div>
@endsection
