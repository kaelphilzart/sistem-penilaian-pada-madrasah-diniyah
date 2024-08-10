<div class="modal fade" id="edit-angkatan{{$dataAngkatan->id}}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Angkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('update-angkatan', ['id_angkatan' => $dataAngkatan->id]) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="angkatan" class="form-label">Tahun Angkatan</label>
                        <input type="year" class="form-control" id="angkatan" name="angkatan" value="{{ $dataAngkatan->angkatan }}">
                        @error('angkatan')
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
