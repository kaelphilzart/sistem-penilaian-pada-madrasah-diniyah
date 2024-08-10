@extends('template.template_admin')

@section('content')
<div class="container mt-4 pb-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <form action="{{ route('cari-jadwal-admin') }}" method="GET">
                <div class="row mb-2">
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
                    <div class="col-md-4">
                        <div class="form-group py-2">
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
                        <button type="submit" class="btn btn-primary">Done</button>
                    </div>
                </div>
            </form>
            @if(request('tahun_id') && request('id_kelas'))
            <div class="text-end py-2">
                <a href="#" class="text-dark btn btn-success px-4" type="button" data-bs-toggle="modal" data-bs-target="#tambah-jadwal">Tambah Jadwal</a>
            </div>
            @endif
        </div>
    </div>

    @if($data->isNotEmpty())
    <div class="row py-4">
        @foreach($data as $key => $dataJadwal)
        <div class="col-md-6 mb-3">
            <div class="card shadow-sm" style="background-color: #a5a6ff;">
                <div class="card-body">
                    <div class="text-white mt-3">
                        <h5 class="card-title text-dark" style="font-weight: bold;">{{ strtoupper($dataJadwal->hari) }}</h5>
                        <div class="row">
                            <div class="col-md-7 text-center" style="font-weight: bold;">
                                <p>Guru</p>
                                <p>Guru Piket</p>
                                <p>Mata Pelajaran 1</p>
                                <p>Mata Pelajaran 2</p>
                                <p>Mata Pelajaran 3</p>
                            </div>
                            <div class="col-md-5 text-center" style="font-weight: bold;">
                                <p>{{ $dataJadwal->guru_inti }}</p>
                                <p>{{ $dataJadwal->id_guruPiket != 0 ? $dataJadwal->guru_piket : 'Tidak ada' }}</p>
                                <p>{{ $dataJadwal->id_mapel != 0 ? $dataJadwal->nama_mapel1 : 'Tidak ada' }}</p>
                                <p>{{ $dataJadwal->id_mapel1 != 0 ? $dataJadwal->nama_mapel2 : 'Tidak ada' }}</p>
                                <p>{{ $dataJadwal->id_mapel2 != 0 ? $dataJadwal->nama_mapel3 : 'Tidak ada' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-end shadow-sm">
                        <form action="{{ route('delete-jadwal', $dataJadwal->id) }}" method="post">
                            @csrf
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit-jadwal-{{ $dataJadwal->id }}">
                            Edit Jadwal
                        </button>
                            <button class="btn btn-danger px-3" onClick="return confirm('Yakin hapus jadwal?')">delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center">
        Tidak ada data jadwal yang ditemukan.
    </div>
    @endif
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const hariDropdown = document.getElementById('hari');
    const guruPiketDropdown = document.getElementById('id_guruPiket');

    hariDropdown.addEventListener('change', function () {
        const selectedHari = this.value;
        const id_kelas = document.getElementById('id_kelas').value;
        const tahun_id = document.getElementById('tahun_dropdown').value;

        if (selectedHari !== '0') {
            fetchGuruPiketByHari(selectedHari, tahun_id);
        }
    });

    function fetchGuruPiketByHari(hari, tahun_id) {
        fetch('/admin/guru-piket-by-hari', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ hari, tahun_id })
        })
        .then(response => response.json())
        .then(data => {
            guruPiketDropdown.innerHTML = '<option value="0">Tidak Ada</option>';
            data.forEach(guru => {
                const option = document.createElement('option');
                option.value = guru.id;
                option.textContent = guru.nama_guru;
                guruPiketDropdown.appendChild(option);
            });
        })
        .catch(error => console.error('Error:', error));
    }
});

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-bs-target="#edit-jadwal"]').forEach(button => {
        button.addEventListener('click', function () {
            const jadwalId = this.dataset.jadwalId;
            fetch(`/admin/edit-jadwal/${jadwalId}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('edit-jadwal-modal-body').innerHTML = html;
                });
        });
    });
});
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('[data-bs-target="#tambah-jadwal"]').addEventListener('click', function () {
        fetch('/admin/tambah-jadwal-modal')
            .then(response => response.text())
            .then(html => {
                document.getElementById('tambah-jadwal-modal-body').innerHTML = html;
            });
    });
});
</script>

@endsection
