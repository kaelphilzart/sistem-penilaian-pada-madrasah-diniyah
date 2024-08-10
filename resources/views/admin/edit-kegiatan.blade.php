<div class="modal fade" id="edit-kegiatan{{$dataKegiatan->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kegiatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-kegiatan', ['id' => $dataKegiatan->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                        <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="{{$dataKegiatan->nama_kegiatan}}">
                        @error('angkatan')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                        <label for="tgl_kegiatan" class="form-label">Pelaksanaan</label>
                        <input type="date" class="form-control" id="tgl_kegiatan" name="tgl_kegiatan" value="{{$dataKegiatan->pelaksanaan}}">
                        @error('tgl_kegiatan')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Keterangan" id="keterangan" name="keterangan" style="height: 100px" >{{$dataKegiatan->keterangan}}
                    </textarea>
                        <label for="keterangan">Keterangan</label>
                        </div>
                        @error('keterangan')
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
