<div class="modal fade" id="tambah-mapel" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mata Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-mapel')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="mapel" class="form-label">Nama Pelajaran</label>
                        <input type="text" class="form-control" id="mapel" name="mapel">
                        @error('mapel')
                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                @enderror
                    </div>
                    <div class="mb-3">
                                <label for="id_kelas" class="form-label">Kelas</label>
                                <select class="form-select" id="id_kelas" name="id_kelas">
                                <option value="0">pilih kelas</option>
                                    @foreach($data1 as $data)
                                    <option value="{{ $data->id }}">Kelas : {{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                            <div class="mb-3">
                                <label for="id_angkatan" class="form-label">Angkatan</label>
                                <select class="form-select" id="id_angkatan" name="id_angkatan">
                                    <option value="0">pilih angkatan</option>
                                    @foreach($data2 as $data)
                                    <option value="{{ $data->id }}">{{$data->angkatan}}</option>
                                    @endforeach
                                </select>
                                @error('id_angkatan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                    <div class="mb-3">
                        <label for="kode_mapel" class="form-label">Kode Mapel</label>
                        <input type="text" class="form-control" id="kode_mapel" name="kode_mapel">
                        @error('kode_mapel')
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
