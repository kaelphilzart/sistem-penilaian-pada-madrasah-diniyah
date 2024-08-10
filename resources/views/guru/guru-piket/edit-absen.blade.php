@foreach($data as $peserta)
    @if(isset($absensi[$peserta->id]))
    <div class="modal fade" id="edit-absen{{ $absensi[$peserta->id]->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title text-white">Edit Absen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('update-absen-peserta', ['id' => $absensi[$peserta->id]->id]) }}" method="POST" >
                        @csrf
                        <h3>Status</h3>
                        <div class="d-flex align-items-center mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_hadir{{ $absensi[$peserta->id]->id }}" value="hadir" {{ $absensi[$peserta->id]->status == 'hadir' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_hadir{{ $absensi[$peserta->id]->id }}">Hadir</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_alfa{{ $absensi[$peserta->id]->id }}" value="alfa" {{ $absensi[$peserta->id]->status == 'alfa' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_alfa{{ $absensi[$peserta->id]->id }}">Alfa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="status_izin{{ $absensi[$peserta->id]->id }}" value="izin" {{ $absensi[$peserta->id]->status == 'izin' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_izin{{ $absensi[$peserta->id]->id }}">Izin</label>
                            </div>
                        </div>
                        <input type="hidden" name="tgl" value="{{ request('tgl') }}">
                        <input type="hidden" name="id_tahun" value="{{ $peserta->id_tahun }}">
                        <input type="hidden" name="id_mapel" value="{{ request('id_mapel') }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach