@extends('template.template_guru')

@section('content')
<div class="content-wrapper">
<div class="container mt-4 ">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
                    <h4 class="text-center">Data Peserta Didik</h4>
                    <h5 class="mb-3">Pilih Kelas</h5>
            <form action="{{ route('cari-rekap-nilai') }}" method="GET" class="row gx-3 gy-2 align-items-center">
                <div class="col-sm-4">                            
                            <select class="form-control" id="id_tahun" name="id_tahun">
                                <option value="">Pilih Kelas</option>
                                @foreach($tahun as $data1)
                                    <option value="{{ $data1->id }}" {{ request('id_tahun') == $data1->id ? 'selected' : '' }}>
                                     Kelas : {{ $data1->kelas }} | {{ $data1->tahun }} | {{ $data1->semester }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('id_tahun')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                            </div>

               <div class="col-auto">
                        <button type="submit" class="btn btn-primary mx-2">Cari</button>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NiSN</th>
                        <th>Nama Peserta Didik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @if($data->isNotEmpty())
                    <tbody>
                        @foreach($data as $key => $peserta)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->nisn }}</td>
                                <td>{{ $peserta->nama_peserta }}</td>
                                <td>
                                <a href="{{ route('lihat-rekap', ['id_peserta' => $peserta->id, 'id_tahun' => $peserta->id_tahun]) }}" class="text-dark btn btn-success mb-2" >Lihat Rekap</a>
                                <a href="{{ url('/lihat-raport/'.$peserta->id.'/'.$peserta->id_tahun) }}" class="btn btn-primary mb-2">
                                <i class="menu-icon tf-icons bx bx-edit"></i>
                                <span class="align-middle">Raport</span>
                                </a>
                                </div>
                            </td>
                            </tr>
                            @include('guru.profile-peserta')
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
            @if($data->count() > 0)
                <div class="d-flex justify-content-center py-2">
                    {{ $data->links('pagination::bootstrap-4') }}
                </div>
            @endif
        </div>
    </div>
</div>
</div>
@endsection
