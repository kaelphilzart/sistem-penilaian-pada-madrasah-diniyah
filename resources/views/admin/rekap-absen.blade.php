@extends('template.template_admin')

@section('content')
<div class="content-wrapper">
<div class="container mt-4 ">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <form action="{{ route('cari-rekap-absen') }}" method="GET" class="row gx-3 gy-2 align-items-center">
                <div class="col-sm-4">                            
                            <select class="form-control" id="id_kelas" name="id_kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $data1)
                                    <option value="{{ $data1->id }}" {{ request('id_kelas') == $data1->id ? 'selected' : '' }}>
                                     Kelas : {{ $data1->nama_kelas }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-sm-4">                            
                            <select class="form-control" id="tahun_id" name="tahun_id">
                                <option value="">Pilih Tahun</option>
                                @foreach($tahun as $data1)
                                    <option value="{{ $data1->id }}" {{ request('tahun_id') == $data1->id ? 'selected' : '' }}>
                                   {{ $data1->tahun }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                    <div class="col-sm-4">                            
                        <select class="form-control px-4" id="semester" name="semester">
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Ganjil</option>
                                <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
               <div class="col-auto">
                        <button type="submit" class="btn btn-primary mx-2">Cari</button>
                </div>
            </form>
        </div>
        <div class="table-responsive text-nowrap my-4">
                <div class="table-wrapper">
                    <table class="table table-hover">
                        <thead class="sticky-header">
                    <tr class="text-center">
                        <th>No</th>
                        <th>NiSN</th>
                        <th >Nama Peserta Didik</th>
                        <th>Kelas</th>
                        <th>Rekapan</th>
                    </tr>
                </thead>
                @if($data->isNotEmpty())
                    <tbody>
                        @foreach($data as $key => $peserta)
                            <tr class="text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->nisn }}</td>
                                <td >{{ $peserta->nama_peserta }}</td>
                                <td>{{ $peserta->nama_kelas }}</td>
                                <td>Izin : {{ $peserta->izin }} <br> Alfa : {{ $peserta->alfa }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                @else
                    <tbody>
                        <tr>
                            <td colspan="3">Tidak ada data peserta untuk kelas yang dipilih.</td>
                        </tr>
                    </tbody>
                @endif
            </table>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
