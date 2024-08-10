@extends('template.template_guru')

@section('content')
<div class="container py-4 mb-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container text-end">
        <h5>Kelas: {{ $kelasPertama->nama_kelas ?? 'Tidak ada kelas yang ditemukan' }}</h5>
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
                    @if($data->isNotEmpty())
                    <tbody>
                        @foreach($data as $key => $peserta)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $peserta->nisn }}</td>
                            <td>{{ $peserta->nama_peserta }}</td>
                           <td> <a href="#" class="text-dark btn btn-info  px-4" type="button" data-bs-toggle="modal" data-bs-target="#profile-peserta{{$peserta->id}}">Profile</a></td>
                        </tr>
                        @include('guru.profile-peserta')
                        @endforeach
                    </tbody>
                    @else
                    <tbody>
                        <tr>
                            <td colspan="4">Tidak ada data peserta Didik.</td>
                        </tr>
                    </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const semesterSelect = document.getElementById('semester');
        const tahunSelect = document.getElementById('tahun_id');
        const kelasSelect = document.getElementById('id_kelas');
        
        const importSemester = document.getElementById('import_semester');
        const importTahunId = document.getElementById('import_tahun_id');
        const importKelas = document.getElementById('import_id_kelas');

        function updateImportFields() {
            importSemester.value = semesterSelect.value;
            importTahunId.value = tahunSelect.value;
            importKelas.value = kelasSelect.value;
        }

        semesterSelect.addEventListener('change', updateImportFields);
        tahunSelect.addEventListener('change', updateImportFields);
        kelasSelect.addEventListener('change', updateImportFields);

        // Update links on page load
        updateImportFields();

        // Update links on semester change
        semesterSelect.addEventListener('change', function() {
            var semester = this.value;
            var tahun_id = tahunSelect.value;
            var links = document.querySelectorAll('.data-nilai-link');
            links.forEach(function(link) {
                var nisn = link.getAttribute('data-nisn');
                var idKelas = link.getAttribute('data-id-kelas');
                var url = "{{ route('data-nilai', ['nisn' => ':nisn', 'id_kelas' => ':id_kelas', 'semester' => ':semester', 'tahun_id' => ':tahun_id']) }}"
                            .replace(':nisn', nisn)
                            .replace(':id_kelas', idKelas)
                            .replace(':semester', semester)
                            .replace(':tahun_id', tahun_id);
                link.href = url;
            });
        });

        // Update links on tahun_id change
        tahunSelect.addEventListener('change', function() {
            var tahun_id = this.value;
            var semester = semesterSelect.value;
            var links = document.querySelectorAll('.data-nilai-link');
            links.forEach(function(link) {
                var nisn = link.getAttribute('data-nisn');
                var idKelas = link.getAttribute('data-id-kelas');
                var url = "{{ route('data-nilai', ['nisn' => ':nisn', 'id_kelas' => ':id_kelas', 'semester' => ':semester', 'tahun_id' => ':tahun_id']) }}"
                            .replace(':nisn', nisn)
                            .replace(':id_kelas', idKelas)
                            .replace(':semester', semester)
                            .replace(':tahun_id', tahun_id);
                link.href = url;
            });
        });
    });
</script>

@endsection
