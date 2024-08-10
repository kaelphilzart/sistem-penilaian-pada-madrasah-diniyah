@extends('template.template_guru_piket')

@section('content')
<div class="container mt-4 pb-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <form action="{{ route('cari-catatan-ngaji-guru-piket') }}" method="GET">
                        <div class="form-group py-2">
                            <label for="id_kelas" class="form-label">Kelas</label>
                            <select class="form-control" id="id_kelas" name="id_kelas">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $data1)
                                    <option value="{{ $data1->id }}" {{ request('id_kelas') == $data1->id ? 'selected' : '' }}>
                                        Kelas: {{ $data1->nama_kelas }} 
                                    </option>
                                @endforeach
                            </select>
                            @error('id_kelas')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                </div>
        @if($data->isNotEmpty())
                <div class="col-md-4">
                    <div class="form-group py-2">
                        <label for="semester" class="form-label">Semester</label>
                        <select class="form-control px-4" id="semester_dropdown" name="semester">
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
                        <label for="tahun_dropdown" class="form-label">Tahun</label>
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
                @else
                <div class="alert alert-info text-center">
                    Pilih kelas terlebih dahulu
                </div>
            @endif
            </div>
            <button type="submit" class="btn btn-primary">Done</button>
            </form>
        </div>
        <div class="table-responsive">
            <div class="table-wrapper text-nowrap my-4">
                <table class="table table-hover">
                    <thead class="sticky-header">
                        <tr>
                            <th>No</th>
                            <th>NISN</th>
                            <th>Nama Peserta</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($data->isNotEmpty())
                            @foreach($data as $key => $peserta)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $peserta->nisn }}</td>
                                    <td>{{ $peserta->nama_peserta }}</td>
                                    <td>
                                        <a href="{{ route('lihat-catatan-ngaji', ['nisn' => $peserta->nisn, 'id_kelas' => $peserta->id_kelas, 'semester' => request('semester', 0), 'tahun_id' => request('tahun_id', 0) ]) }}" class="text-dark btn btn-success px-4 data-nilai-link" data-nisn="{{ $peserta->nisn }}" data-id-kelas="{{ $peserta->id_kelas }}">Lihat Catatan</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">Tidak ada data peserta Didik.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    function updateLinks() {
        var semester = document.getElementById('semester_dropdown').value || 0;
        var tahun = document.getElementById('tahun_dropdown').value || 0;

        var links = document.querySelectorAll('.data-nilai-link');
        links.forEach(function(link) {
            var nisn = link.getAttribute('data-nisn');
            var idKelas = link.getAttribute('data-id-kelas');
            var url = "{{ route('lihat-catatan-ngaji', ['nisn' => ':nisn', 'id_kelas' => ':id_kelas', 'semester' => ':semester', 'tahun_id' => ':tahun_id']) }}"
                        .replace(':nisn', nisn)
                        .replace(':id_kelas', idKelas)
                        .replace(':semester', semester)
                        .replace(':tahun_id', tahun);
            link.href = url;
        });
    }

    document.getElementById('semester_dropdown').addEventListener('change', updateLinks);
    document.getElementById('tahun_dropdown').addEventListener('change', updateLinks);

    // Initialize links with default values
    updateLinks();
</script>
@endsection
