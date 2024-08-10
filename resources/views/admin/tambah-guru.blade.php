<div class="modal fade" id="tambah-guru" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Guru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-guru')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <label for="id_user" class="form-label">Email</label>
                        <select class="form-select" id="id_user" name="id_user">
                        @foreach($data1 as $data1)
                        <option value="{{ $data1->id }}">{{ $data1->email }}</option>
                        @endforeach
                        </select>
                        @error('id_user')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="nama_guru" class="form-label">Nama Guru</label>
                        <input type="text" class="form-control" id="nama_guru" name="nama_guru">
                        @error('nama_guru')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="alamat_guru" class="form-label">Alamat Guru</label>
                        <input type="text" class="form-control" id="alamat_guru" name="alamat_guru">
                        @error('alamat_guru')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ttl_guru" class="form-label">Ttl Guru</label>
                        <input type="date" class="form-control" id="ttl_guru" name="ttl_guru">
                        @error('ttl_guru')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="no_hp_guru" class="form-label">No Telepon</label>
                        <input type="number" class="form-control" id="no_hp_guru" name="no_hp_guru">
                        @error('no_hp_guru')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status">
                        <option value="">Pilih Status</option>
                        <option value="guru_inti">Guru Inti</option>
                        <option value="guru_piket">Guru Piket</option>
                        </select>
                        @error('status')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <!-- tambahkan input lainnya sesuai kebutuhan -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
