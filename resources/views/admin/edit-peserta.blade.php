<div class="modal fade" id="edit-peserta{{$dataPeserta->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-peserta', ['id' => $dataPeserta->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" class="form-control" id="nisn" name="nisn" min="0" value="{{ $dataPeserta->nisn }}">
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $dataPeserta->email }}">
                            </div>
                            <div class="mb-3">
                                    <label for="id_kelas" class="form-label">Pilih Kelas</label>
                                    <select class="form-select" id="id_kelas" name="id_kelas">
                                        @foreach($data1 as $data)
                                        <option value="{{ $data->id }}" {{ $dataPeserta->id_kelas == $data->id ? 'selected' : '' }}>Kelas : {{ $data->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            <div class="mb-3">
                                <label for="id_angkatan" class="form-label">Pilih Angkatan</label>
                                <select class="form-select" id="id_angkatan" name="id_angkatan">
                                    @foreach($data2 as $data)
                                    <option value="{{ $data->id }}" {{ $dataPeserta->id_angkatan == $data->id ? 'selected' : '' }}>{{ $data->angkatan }}</option>
                                    @endforeach
                                </select>
                                @error('id_angkatan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                    <div class="mb-3">
                        <label for="nama_peserta" class="form-label">Nama peserta</label>
                        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{ $dataPeserta->nama_peserta }}">
                        @error('nama_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_peserta" class="form-label">Alamat peserta</label>
                        <input type="text" class="form-control" id="alamat_peserta" name="alamat_peserta" value="{{ $dataPeserta->alamat_peserta }}">
                        @error('alamat_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ttl_peserta" class="form-label">Ttl peserta</label>
                        <input type="date" class="form-control" id="ttl_peserta" name="ttl_peserta"value="{{ $dataPeserta->ttl_peserta }}">
                        @error('ttl_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp_peserta" class="form-label">Contact peserta</label>
                        <input type="number" class="form-control" id="no_hp_peserta" name="no_hp_peserta" value="{{ $dataPeserta->no_hp_peserta }}">
                        @error('no_hp_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_ayah" class="form-label">Nama Ayah</label>
                        <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" value="{{ $dataPeserta->nama_ayah }}">
                        @error('no_hp_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_ibu" class="form-label">Nama Ibu</label>
                        <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" value="{{ $dataPeserta->nama_ibu }}">
                        @error('no_hp_peserta')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="aktif" {{ $dataPeserta->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="tidak aktif" {{ $dataPeserta->status == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- tambahkan input lainnya sesuai kebutuhan -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
