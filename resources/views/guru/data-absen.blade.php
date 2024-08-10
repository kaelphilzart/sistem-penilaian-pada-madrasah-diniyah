@extends('template.template_guru')

@section('content')
<div class="container mt-4 pb-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
        <h5 class="text-end">Kelas: {{ $kelasPertama->nama_kelas ?? 'Tidak ada kelas yang ditemukan' }}</h5>
            <div class="row">
                <div class="col-md-4">
                    <p class="mb-3">Pilih Tanggal dan Mata Pelajaran</p>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <form action="{{ route('cari-absen') }}" method="GET" class="form-inline">
                            <input type="hidden" id="id_kelas" name="id_kelas" value="{{ $kelas->id }}">
                            <select class="form-control px-4 mb-2" id="semester" name="semester">
                                <option value="">Pilih Semester</option>
                                <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Ganjil</option>
                                <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <select class="form-control mb-2" id="tahun_dropdown" name="tahun_id">
                            <option value="0">Pilih Tahun</option>
                            @foreach($tahun as $t)
                            <option value="{{ $t->id }}" {{ request('tahun_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->tahun }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-2 align-items-end">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tgl" class="px-2">Pilih Tanggal</label>
                        <div class="input-group date px-2">
                            <input type="date" class="form-control" id="tgl" name="tgl" value="{{ request('tgl') }}" min="{{ date('Y-m-d') }}">
                            @error('tgl')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="id_mapel" class="px-2">Mata Pelajaran</label>
                        <select class="form-control" id="id_mapel" name="id_mapel">
                            <option value="">Pilih Mapel</option>
                            @foreach($mapel as $data1)
                            <option value="{{ $data1->id }}" {{ request('id_mapel')==$data1->id ? 'selected' : '' }}>
                                {{ $data1->mapel }}
                            </option>
                            @endforeach
                        </select>
                        @error('id_mapel')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group px-2">
                        <button type="submit" class="btn btn-primary">Done</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <!-- Tambahkan button untuk select all dan absen -->
        <div class="d-flex justify-content-end my-2 px-3">
            <button id="select-all" class="btn btn-secondary me-2">Select All</button>
            <button id="bulk-absen" class="btn btn-success">Absen</button>
        </div>
        <form id="bulk-absen-form" action="{{ route('input-absen') }}" method="POST">
            @csrf
            <input type="hidden" name="tgl" value="{{ request('tgl') }}">
            <input type="hidden" name="id_kelas" value="{{ $kelas->id }}">
            <input type="hidden" name="id_mapel" value="{{ request('id_mapel') }}">
            <input type="hidden" name="tahun_id" value="{{ request('tahun_id') }}">
            <input type="hidden" name="semester" value="{{ request('semester') }}">
            <div class="table-responsive text-nowrap my-4">
                <div class="table-wrapper">
                    <table class="table table-hover">
                        <thead class="sticky-header">
                            <tr>
                                <th width="10%">No</th>
                                <th width="50%">Nama Siswa</th>
                                <th width="10%">Absensi</th>
                                <th width="30%">Aksi</th>
                            </tr>
                        </thead>
                        @if($data->isNotEmpty())
                        <tbody>
                            @foreach($data as $key => $siswa)
                            @php
                            $existingAbsensi = $absensi->get($siswa->id);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $siswa->nama_peserta }}</td>
                                <td>
                                    @if($existingAbsensi)
                                    <span class="mx-2">{{ ucfirst($existingAbsensi->status) }}</span>
                                    @else
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" name="selected_siswa[]" value="{{ $siswa->id }}" class="form-check-input me-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $siswa->id }}" value="hadir" checked>
                                            <label class="form-check-label">Hadir</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $siswa->id }}" value="alfa">
                                            <label class="form-check-label">Alfa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $siswa->id }}" value="izin">
                                            <label class="form-check-label">Izin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $siswa->id }}" value="sakit">
                                            <label class="form-check-label">Sakit</label>
                                        </div>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($existingAbsensi))
                                    <button class="text-dark btn btn-warning px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-absen{{ $existingAbsensi->id }}">Edit</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @else
                        <tbody>
                            <tr>
                                <td colspan="4">Tidak ada data siswa untuk hari dan mapel yang dipilih.</td>
                            </tr>
                        </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
@include('guru.edit-absen')
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("select-all").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll('input[name="selected_siswa[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = !checkbox.checked;
        });
    });

    document.getElementById("bulk-absen").addEventListener("click", function() {
        document.getElementById("bulk-absen-form").submit();
    });
});
</script>
@endsection
