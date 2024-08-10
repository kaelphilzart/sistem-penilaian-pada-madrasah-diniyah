<div class="modal fade" id="tambahUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('create-user') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Enter Name" />
                        @error('name')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" />
                        @error('email')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" />
                        @error('password')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="admin">admin</option>
                            <option value="kepalaMadrasah">Kepala Madrasah</option>
                            <option value="guru">Guru</option>
                            <option value="waliMurid">Wali Murid</option>
                        </select>
                        @error('level')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-success">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
