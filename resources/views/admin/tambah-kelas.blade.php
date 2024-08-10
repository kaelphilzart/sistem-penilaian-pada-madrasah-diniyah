<div class="modal fade" id="tambah-kelas" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kelas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-kelas')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kelas" style="text-align:left;">Kelas</label>
                        <input type="text" class="form-control" id="nama_kelas" name="nama_kelas">
                        @error('nama_kelas')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3 input-group">
                    <label for="id_guru" class="form-label">Guru</label>
                        <select class="dropdown-item" id="id_guru" name="id_guru">
                        @foreach($guru as $data1)
                        <option value="{{ $data1->id }}">{{ $data1->nama_guru }}</option>
                        @endforeach
                        </select>
                        @error('id_guru')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
