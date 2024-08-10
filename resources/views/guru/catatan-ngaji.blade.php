@extends('template.template_guru')

@section('content')
<div class="container py-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
        <h5 class="text-end">Kelas: {{ $kelasPertama->nama_kelas ?? 'Tidak ada kelas yang ditemukan' }}</h5>
            <div class="row mb-2">
                <div class="col-md-4">
                    <select class="form-control" id="semester_dropdown" name="semester">
                        <option value="0" {{ request('semester') == '0' ? 'selected' : '' }}>Pilih Semester</option>
                        <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Ganjil</option>
                        <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Genap</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <select class="form-control" id="tahun_dropdown" name="tahun_id">
                        <option value="0">Pilih Tahun</option>
                        @foreach($tahun as $t)
                            <option value="{{ $t->id }}" {{ request('tahun_id') == $t->id ? 'selected' : '' }}>
                                {{ $t->tahun }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4"></div>
            </div>
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
                                        <a href="{{ route('lihat-catatan', ['nisn' => $peserta->nisn, 'id_kelas' => $peserta->id_kelas, 'semester' => request('semester', 0), 'tahun_id' => request('tahun_id', 0) ]) }}" class="text-dark btn btn-success px-4 data-nilai-link" data-nisn="{{ $peserta->nisn }}" data-id-kelas="{{ $peserta->id_kelas }}">Lihat Catatan</a>
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
            var url = "{{ route('lihat-catatan', ['nisn' => ':nisn', 'id_kelas' => ':id_kelas', 'semester' => ':semester', 'tahun_id' => ':tahun_id']) }}"
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
