<div class="modal fade" id="profile-peserta{{$dataPeserta->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <div class="modal-title text-white">
                <h5 class="text-white">Profil Peserta</h5>
                <h5 class="fw-bold text-white">Status : {{$dataPeserta->status}}</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="\{{ $dataPeserta->foto }}" class="img-fluid rounded-circle mx-auto d-block" alt="Foto Profil">
                        
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                        <h3 class="text-dark text-center" style="font-weight: bold">{{ strtoupper($dataPeserta->nama_peserta) }}</h3>
                    <div class="col-md-4">
                    <p>Angkatan</p>
                    <p>Alamat</p>
                    <p>Tempat, Tanggal Lahir</p>
                    <p>Nomor Telepon</p>
                    <p>Nama Ayah</p>
                    <p>Nama Ibu</p>

                    </div>
                    <div class="col-md-4">
                    <p>{{ $dataPeserta->angkatan }}</p>
                    <p>{{ $dataPeserta->alamat_peserta }}</p>
                    <p>{{ $dataPeserta->ttl_peserta }}</p>
                    <p>{{ $dataPeserta->no_hp_peserta }}</p>
                    <p>{{ $dataPeserta->nama_ayah }}</p>
                    <p>{{ $dataPeserta->nama_ibu }}</p>
                    </div>
                    </div>
                    <h5 class="text-center">Tahun Masuk : {{ $dataPeserta->created_at->format('d F Y') }}</h5>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
