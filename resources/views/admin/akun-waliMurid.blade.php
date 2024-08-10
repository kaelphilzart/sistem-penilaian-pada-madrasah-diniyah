@extends('template.template_admin')
@section('content')
<div class="container mt-4">
    <div class="card">
        <h5 class="card-header">{{ ucfirst(request()->route()->getName()) }}</h5>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-6">
                </div>
                <div class="col-md-6">
                    <div class="text-end mx-2 text-right">
                        <form action="{{ route('buat-akun-wali') }}" method="POST" id="buatAkunForm">
                            @csrf
                            <input type="hidden" name="nisn" id="nisn">
                            <input type="hidden" name="email" id="email">
                            <button type="submit" class="mx-2 btn btn-primary">
                                <i class="mdi mdi-account-multiple-plus fs-5 mx-2 lh-0"></i> Buat Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Siswa</th>
                        <th>Tahun Masuk</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $key => $dataPeserta)
                    <tr>
                        <td><input type="checkbox" class="selectItem" data-nisn="{{ $dataPeserta->nisn }}" data-email="{{ $dataPeserta->email }}"></td>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataPeserta->nisn }}</td>
                        <td>{{ $dataPeserta->nama_peserta }}</td>
                        <td>{{ $dataPeserta->created_at->format('d-m-Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checkboxes = document.querySelectorAll('.selectItem');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });

    document.getElementById('buatAkunForm').addEventListener('submit', function(e) {
        const selectedNISNs = [];
        const selectedEmails = [];
        const checkboxes = document.querySelectorAll('.selectItem:checked');
        checkboxes.forEach(checkbox => {
            selectedNISNs.push(checkbox.getAttribute('data-nisn'));
            selectedEmails.push(checkbox.getAttribute('data-email'));
        });
        document.getElementById('nisn').value = selectedNISNs.join(',');
        document.getElementById('email').value = selectedEmails.join(',');
    });
</script>
@endsection
