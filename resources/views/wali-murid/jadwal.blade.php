@extends('template.template_wali-murid')

@section('content')
<div class="container mt-4">
    <h3 class="text-center fw-bold">Jadwal Pelajaran </h3>

    <div class="row">
      @foreach($jadwal as $key => $dataJadwal)
      <div class="col-md-6 mb-3">
        <div class="card shadow-sm" style="background-color: #a5a6ff;">
          <div class="card-body">
            <div class="text-white mt-3">
              <h5 class="card-title text-dark text-center" style="font-weight: bold;">{{ strtoupper($dataJadwal->hari) }}</h5>
              <div class="row">
                <div class="col-md-6 text-center" style="font-weight: bold;">
                  <p>Mata Pelajaran 1</p>
                  <p>Mata Pelajaran 2</p>
                  <p>Mata Pelajaran 3</p>
                </div>
                <div class="col-md-6 text-center" style="font-weight: bold;">
                  <p>{{ $dataJadwal->nama_mapel1 }}</p>
                  <p>{{ $dataJadwal->nama_mapel2 }}</p>
                  <p>{{ $dataJadwal->nama_mapel3 }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>
</div>
@endsection
