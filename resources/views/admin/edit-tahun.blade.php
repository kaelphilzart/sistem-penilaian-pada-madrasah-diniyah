<div class="modal fade" id="edit-tahun{{$dataTahun->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Tahun Ajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-tahun', ['id' => $dataTahun->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="tahun" class="form-label">Tahun</label>
                        <input type="year" class="form-control" id="tahun" name="tahun" value="{{ $dataTahun->tahun }}">
                        @error('tahun')
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
