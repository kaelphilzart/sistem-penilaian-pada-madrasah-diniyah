@extends('template.template_guru')

@section('content')
<div class="container py-4 mb-4">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-md-4">
            <label for="peserta">Nama Peserta</label>
            <p name="peserta">{{ $peserta->nama_peserta }}</p>
            </div>
            <div class="col-md-4">
            <label for="tahun">Tahun Ajaran</label>
            <p name="tahun">{{$tahunAjar->tahun}}</p>
            </div>
            <div class="col-md-4">
            <p class="">Semester: {{ $semester }}</p>
            </div>
            </div>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Mata Pelajaran</th>
                  <th>Ulangan 1</th>
                  <th>UTS</th>
                  <th>Ulangan 2</th>
                  <th>UAS</th>
                  <th>Rata Rata</th>
                </tr>
              </thead>
              <tbody>
                @foreach($nilaiLengkap as $dataNilai)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $dataNilai->mapel }}</td>
                  <td>{{ $dataNilai->ulangan_1 ?? '-' }}</td>
                  <td>{{ $dataNilai->uts ?? '-' }}</td>
                  <td>{{ $dataNilai->ulangan_2 ?? '-' }}</td>
                  <td>{{ $dataNilai->uas ?? '-' }}</td>
                  <td>{{ $dataNilai->rata_rata ? number_format($dataNilai->rata_rata, 2) : '-' }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
