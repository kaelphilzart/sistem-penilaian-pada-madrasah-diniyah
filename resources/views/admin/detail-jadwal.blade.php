@extends('template.template_admin')

@section('content')
<section class="section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 py-4">
        <div class="card">
          <div class="card-body ">
            <div class="row mt-4">
              <div class="col-md-6 ">
              <form action="{{ route('cari-jadwal') }}" method="GET">
                <input type="text" value="{{$id}}" name="id_kelas">
              <div class="form-group">
                <label fort="tahun_id">Tahun Ajaran</label>
                        <select class="form-control mb-2" id="tahun_dropdown" name="tahun_id">
                            <option value="0">Pilih Tahun</option>
                            @foreach($tahun as $t)
                            <option value="{{ $t->id }}" {{ request('tahun_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->tahun }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </form>
              </div>
              <div class="col-md-6 text-center">
                <h5 class="">Kelas : {{ $dataKelas->nama_kelas }}</h5>
              </div>
            </div>
            <div class="text-end mx-4">
              @include('admin.tambah-jadwal')
              <a href="#" class="text-dark btn btn-success px-4" type="button" data-bs-toggle="modal" data-bs-target="#tambah-jadwal{{ $dataKelas->id }}">Tambah Jadwal</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
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
                <a href="#" class="text-dark btn btn-warning px-4" type="button" data-bs-toggle="modal" data-bs-target="#edit-jadwal{{ $dataJadwal->id }}">Edit</a>
                <button class="btn btn-danger px-3" onClick="return confirm('Yakin hapus jadwal?')">delete</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      @include('admin.edit-jadwal')
      @endforeach
    </div>
  </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const hariDropdown = document.getElementById('hari');
    const guruPiketDropdown = document.getElementById('id_guruPiket');

    hariDropdown.addEventListener('change', function () {
        const selectedHari = this.value;

        if (selectedHari !== '0') {
            fetchGuruPiketByHari(selectedHari);
        }
    });

    function fetchGuruPiketByHari(hari) {
        fetch('/admin/guru-piket-by-hari', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ hari })
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
</script>

@endsection
