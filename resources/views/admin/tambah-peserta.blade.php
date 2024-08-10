<div class="modal fade" id="tambah-peserta" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peserta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('tambah-peserta')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="foto" class="form-label">Upload Foto (3:4)</label>
                                <input type="file" accept="image/*" name="foto" id="foto" class="form-control">
                                <div id="imagePreview" class="mt-3">
                                    <img id="uploadedImage" src="#" alt="Uploaded Image" style="max-width: 100%; height: auto;">
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_kelas" class="form-label">Pilih Tahun</label>
                                <select class="form-select" id="id_kelas" name="id_kelas">
                                    @foreach($data1 as $data)
                                    <option value="{{ $data->id }}">Kelas : {{ $data->nama_kelas }}</option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="nisn" class="form-label">NISN</label>
                                <input type="number" class="form-control" id="nisn" name="nisn" min="0">
                                @error('nisn')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- tambahkan input lainnya sesuai kebutuhan -->
                        </div>
                         <div class="col-md-6">
                            <div class="mb-3">
                                <label for="id_tahun" class="form-label">Pilih Angkatan</label>
                                <select class="form-select" id="id_angkatan" name="id_angkatan">
                                    @foreach($data2 as $data)
                                    <option value="{{ $data->id }}">{{ $data->angkatan }}</option>
                                    @endforeach
                                </select>
                                @error('id_angkatan')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <!-- tambahkan input lainnya sesuai kebutuhan -->
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_peserta" class="form-label">Nama peserta</label>
                                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta">
                                @error('nama_peserta')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="alamat_peserta" class="form-label">Alamat peserta</label>
                                <input type="text" class="form-control" id="alamat_peserta" name="alamat_peserta">
                                @error('alamat_peserta')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ttl_peserta" class="form-label">Ttl Peserta</label>
                                <input type="date" class="form-control" id="ttl_peserta" name="ttl_peserta">
                                @error('ttl_peserta')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_ayah" class="form-label">Nama Ayah</label>
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah">
                                @error('nama_ayah')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_ibu" class="form-label">Nama Ibu</label>
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu">
                                @error('nama_ibu')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_hp_peserta" class="form-label">No Telepon</label>
                                <input type="number" class="form-control" id="no_hp_peserta" name="no_hp_peserta" min="0">
                                @error('no_hp_peserta')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak aktif">Tidak Aktif</option>
                                </select>
                                @error('status')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <!-- tambahkan input lainnya sesuai kebutuhan -->
                        </div>
                    </div>
                    <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('uploadedImage').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('foto').addEventListener('change', function() {
        previewImage(this);
    });

    // Menggunakan event 'submit' untuk menampilkan pratinjau sebelum mengirimkan form
    document.querySelector('form').addEventListener('submit', function(e) {
        e.preventDefault(); // Untuk mencegah form melakukan submit default
        var text = document.getElementById('imageText');
        var uploadedImage = document.getElementById('uploadedImage');
        var fileInput = document.getElementById('foto');

        // Menampilkan pratinjau gambar dan teks yang diinginkan
        var reader = new FileReader();
        reader.onload = function(e) {
            uploadedImage.src = e.target.result;
            text.textContent = "Teks yang Anda inginkan";
        }
        reader.readAsDataURL(fileInput.files[0]);
    });
</script>
