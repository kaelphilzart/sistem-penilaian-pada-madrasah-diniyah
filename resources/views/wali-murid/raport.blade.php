@extends('template.template_wali-murid')

@section('content')
<div class="container py-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="">Pilih Kelas, Tahun Ajar, dan Semester</h4>
                </div>
            </div>
            <form id="raportForm" class="form-inline pb-4 d-flex justify-content-start">
                <input type="hidden" id="nisn" name="nisn" value="{{ $anak->nisn }}">
                
                <div class="form-group mx-2">
                    <label for="id_kelas" class="form-label mx-2">Kelas</label>
                    <select class="form-control" id="id_kelas" name="id_kelas">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $data1)
                            <option value="{{ $data1->id }}" {{ request('id_kelas') == $data1->id ? 'selected' : '' }}>
                                {{ $data1->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kelas')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mx-2">
                    <label for="tahun_id" class="form-label mx-2">Tahun Ajar</label>
                    <select class="form-control" id="tahun_id" name="tahun_id">
                        <option value="">Pilih Tahun Ajar</option>
                        @foreach($tahun as $tahunAjar)
                            <option value="{{ $tahunAjar->id }}" {{ request('tahun_id') == $tahunAjar->id ? 'selected' : '' }}>
                                {{ $tahunAjar->tahun }}
                            </option>
                        @endforeach
                    </select>
                    @error('tahun_id')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group mx-2">
                    <label for="semester" class="form-label mx-2">Semester</label>
                    <select class="form-control" id="semester" name="semester">
                        <option value="">Pilih Semester</option>
                        <option value="1" {{ request('semester') == '1' ? 'selected' : '' }}>Ganjil</option>
                        <option value="2" {{ request('semester') == '2' ? 'selected' : '' }}>Genap</option>
                    </select>
                    @error('semester')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <button type="button" id="btnCari" class="btn btn-primary mx-2">Cari</button>
            </form>
        </div>
        <div id="raportContent" class="text-center">
            <iframe id="raportIframe" width="100%" height="600px" style="border: none;"></iframe>
            <p id="errorMessage" class="text-danger mt-3" style="display: none;">Raport tidak ada atau salah kelas yang anda pilih.</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('btnCari').addEventListener('click', function () {
        var nisn = document.getElementById('nisn').value;
        var id_kelas = document.getElementById('id_kelas').value;
        var tahun_id = document.getElementById('tahun_id').value;
        var semester = document.getElementById('semester').value;

        if (id_kelas && tahun_id && semester) {
            var iframe = document.getElementById('raportIframe');
            var errorMessage = document.getElementById('errorMessage');

            iframe.onload = function() {
                if (iframe.contentDocument.body.innerText.includes('Raport tidak ada')) {
                    errorMessage.style.display = 'block';
                } else {
                    errorMessage.style.display = 'none';
                }
            };

            iframe.src = `/show-raport/${nisn}/${id_kelas}/${tahun_id}/${semester}`;
        } else {
            alert('Pilih kelas, tahun ajar, dan semester terlebih dahulu.');
        }
    });
</script>
@endsection
