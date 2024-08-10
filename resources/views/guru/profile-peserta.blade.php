<div class="modal fade" id="profile-peserta{{$peserta->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
            <div class="modal-title text-white">
                <h5 class="text-white">Profil Peserta</h5>
                <h5 class="fw-bold text-white">Status : {{$peserta->status}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $peserta->foto }}" class="img-fluid rounded-circle mx-auto d-block" alt="Foto Profil">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                        <h3 class="text-dark text-center" style="font-weight: bold">{{ strtoupper($peserta->nama_peserta) }}</h3>
                    <div class="col-md-4">
                    <p>Angkatan</p>
                    <p>NISN</p>
                    <p>Alamat</p>
                    <p>Tanggal Lahir</p>
                    <p>Nomor Telepon</p>
                    <p>Nama Ayah</p>
                    <p>Nama Ibu</p>

                    </div>
                    <div class="col-md-4">
                    <p>{{ $peserta->angkatan->angkatan }}</p>
                    <p >{{ $peserta->nisn }}</p>
                    <p>{{ $peserta->alamat_peserta }}</p>
                    <p>{{ $peserta->ttl_peserta }}</p>
                    <p>{{ $peserta->no_hp_peserta }}</p>
                    <p>{{ $peserta->nama_ayah }}</p>
                    <p>{{ $peserta->nama_ibu }}</p>
                    </div>
                    </div>
                    <h5 class="text-center">Tahun Masuk : {{ $peserta->created_at->format('d F Y') }}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
