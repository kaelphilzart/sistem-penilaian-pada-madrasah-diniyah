<div class="modal fade" id="tambah-jadwal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jawal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-jadwal-admin')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                    <input type="hidden" class="form-control" id="id_kelas" name="id_kelas"  value="{{ request('id_kelas', 0) }}" >
                    <input type="hidden" class="form-control" id="tahun_id" name="tahun_id"  value="{{ request('tahun_id', 0) }}" >
                    </div>
                    <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari">
                                <option value="0">Pilih Hari</option>
                                <option value="senin">Senin</option>
                                <option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option>
                                <option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option>
                                <option value="sabtu">Sabtu</option>
                            </select>
                            @error('hari')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    <div class="mb-3">
                                <input type="hidden" value="{{$data2->id}}" id="id_guru" name="id_guru">
                                @error('id_guru')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                            <div class="mb-3">
                            <label for="id_guruPiket" class="form-label">Guru Piket</label>
                            <select class="form-select" id="id_guruPiket" name="id_guruPiket">
                                <option value="0">Tidak Ada</option>
                                @foreach($data3 as $data)
                                <option value="{{ $data->id }}">{{ $data->nama_guru }}</option>
                                @endforeach
                            </select>
                            @error('id_guruPiket')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div> 
                    <div class="mb-3">
                                <label for="id_mapel" class="form-label">Mata Pelajaran 1</label>
                                <select class="form-select" id="id_mapel" name="id_mapel">
                                <option value="0">Tidak ada</option>
                                    @foreach($mapel as $data)
                                    <option value="{{ $data->id }}">{{ $data->mapel }} ( {{ $data->kode_mapel }} )</option>
                                    @endforeach
                                </select>
                                @error('id_mapel')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                            <div class="mb-3">
                                <label for="id_mapel1" class="form-label">Mata Pelajaran 2</label>
                                <select class="form-select" id="id_mapel1" name="id_mapel1">
                                    <option value="0">Tidak ada</option>
                                    @foreach($mapel as $data)
                                    <option value="{{ $data->id }}">{{ $data->mapel }} ( {{ $data->kode_mapel }} )</option>
                                    @endforeach
                                </select>
                                @error('id_mapel1')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div> 
                            <div class="mb-3">
                                <label for="id_mapel2" class="form-label">Mata Pelajaran 3</label>
                                <select class="form-select" id="id_mapel2" name="id_mapel2">
                                    <option value="0">Tidak ada</option>
                                    @foreach($mapel as $data)
                                    <option value="{{ $data->id }}">{{ $data->mapel }} ( {{ $data->kode_mapel }} )</option>
                                    @endforeach
                                </select>
                                @error('id_mapel2')
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
