@extends('template.template_guru_piket')

@section('content')
<div class="container mt-4 pb-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
        <div class="row">
                <div class="col-md-4">
                    <h5 class="py-2">Data Absensi</h5>
                </div>
                <div class="col-md-4">
                <div class="form-group py-2">
                        <form action="{{ route('cari-absen-peserta') }}" method="GET">
                        <select class="form-control px-4" id="semester" name="semester">
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
                <div class="form-group py-2">
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
            <form action="{{ route('cari-absen') }}" method="GET">
                <div class="row mb-2">
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="tgl" class="form-label">Pilih Tanggal</label>
                            <div class="input-group date">
                                <input type="date" class="form-control" id="tgl" name="tgl" value="{{ request('tgl') }}">
                                @error('tgl')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 ">
                        <div class="form-group">
                            <label for="id_kelas" class="form-label">Kelas</label>
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
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                            <select class="form-control" id="id_mapel" name="id_mapel" {{ request('id_kelas') ? '' : 'disabled' }}>
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $data1)
                                    <option value="{{ $data1->id }}" {{ request('id_mapel') == $data1->id ? 'selected' : '' }}>
                                        {{ $data1->mapel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_mapel')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Done</button>
            </form>
        </div>
        <div class="d-flex justify-content-end my-2 px-3">
            <button id="select-all" class="btn btn-secondary me-2">Select All</button>
            <button id="bulk-absen" class="btn btn-success">Absen</button>
        </div>
        <form id="bulk-absen-form" action="{{ route('input-absen-peserta') }}" method="POST">
            @csrf
            <input type="hidden" name="tgl" value="{{ request('tgl') }}">
            <input type="hidden" name="id_kelas" value="{{ request('id_kelas') }}">
            <input type="hidden" name="id_mapel" value="{{ request('id_mapel') }}">
            <input type="hidden" name="tahun_id" value="{{ request('tahun_id') }}">
            <input type="hidden" name="semester" value="{{ request('semester') }}">
        <div class="table-responsive text-nowrap my-4">
                <div class="table-wrapper">
                    <table class="table table-hover">
                        <thead class="sticky-header">
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Absensi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @if($data->isNotEmpty())
                    <tbody>
                        @foreach($data as $key => $peserta)
                            @php
                                $existingAbsensi = $absensi->get($peserta->id);
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $peserta->nama_peserta }}</td>
                                <td>
                                    @if($existingAbsensi)
                                        <span class="mx-2">{{ ucfirst($existingAbsensi->status) }}</span>
                                    @else
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" name="selected_peserta[]" value="{{ $peserta->id }}" class="form-check-input me-2">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $peserta->id }}" value="hadir" checked>
                                            <label class="form-check-label">Hadir</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $peserta->id }}" value="alfa">
                                            <label class="form-check-label">Alfa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $peserta->id }}" value="izin">
                                            <label class="form-check-label">Izin</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="status_{{ $peserta->id }}" value="sakit">
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
                            <td colspan="4">Tidak ada data peserta untuk tanggal dan kelas yang dipilih.</td>
                        </tr>
                    </tbody>
                @endif
            </table>
                </div>
        </div>
        </form>
    </div>
</div>
@include('guru.guru-piket.edit-absen')
<script>
document.getElementById('id_kelas').addEventListener('change', function() {
    var id_kelas = this.value;
    var mapelSelect = document.getElementById('id_mapel');
    mapelSelect.innerHTML = '<option value="">Pilih Mapel</option>';
    mapelSelect.disabled = true;

    if (id_kelas) {
        fetch('/get-mapel/' + id_kelas)
            .then(response => response.json())
            .then(data => {
                mapelSelect.innerHTML = '<option value="">Pilih Mapel</option>';
                data.forEach(mapel => {
                    var option = document.createElement('option');
                    option.value = mapel.id;
                    option.textContent = mapel.mapel;
                    mapelSelect.appendChild(option);
                });
                mapelSelect.disabled = false;
            });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("select-all").addEventListener("click", function() {
        let checkboxes = document.querySelectorAll('input[name="selected_peserta[]"]');
        checkboxes.forEach((checkbox) => {
            checkbox.checked = !checkbox.checked;
        });
    });

    document.getElementById("bulk-absen").addEventListener("click", function() {
        document.getElementById("bulk-absen-form").submit();
    });

    var today = new Date().toISOString().split('T')[0];
    document.getElementById('tgl').setAttribute('min', today);
});
</script>

@endsection
