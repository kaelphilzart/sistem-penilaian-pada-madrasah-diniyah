<div class="modal fade" id="tambah-catatan{{$peserta->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Catatan Ngaji</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-catatan')}}" method="POST">
                    @csrf
                    <input type="hidden" value="{{$peserta->nisn}}" id="nisn" name="nisn">
                    <input type="hidden" value="{{$kelas->id}}" id="id_kelas" name="id_kelas">
                    <input type="hidden" value="{{$tahunAjar->id}}" id="tahun_id" name="tahun_id">
                    <input type="hidden" value="{{$semester}}" id="semester" name="semester">
                    <div class="form-floating mb-3">
                        <textarea class="form-control" placeholder="isi lengkap" id="juz_surat" name="juz_surat"
                            style="height: 100px"></textarea>
                        <label for="juz_surat">Juz Surat</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control"  id="hal" name="hal">
                        <label for="hal">Halaman</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control"  id="ayat" name="ayat">
                        <label for="ayat">Ayat</label>
                    </div>
                    <div class="mb-3">
                        <label for="ket">Keterangan</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ket" id="ket" value="L">
                                <label class="form-check-label" for="ket">L</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ket" id="ket" value="U">
                                <label class="form-check-label" for="ket">U</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ket" id="ket" value="L-">
                                <label class="form-check-label" for="ket">L-</label>
                            </div>
                        </div>
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