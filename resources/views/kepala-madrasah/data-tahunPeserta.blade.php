@extends('template.template_kepala-madrasah')

@section('content')
<div class="container my-4">
    <div class="card">

        <h5 class="card-header">Kelas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataTahun)
                <tbody>
                    <tr>
                        <td>{{ $data->firstItem() + $key }}</td>
                        <td>{{ $dataTahun->nama_kelas }}</td>
                        <td>
                            <a href="{{ route('peserta', $dataTahun->id) }}" class="text-dark btn btn-outline-warning px-4">Lihat Peserta Didik</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination py-2 px-2">
            <div class="d-flex justify-content-center align-items-center">
             
                {{ $data->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>
</div>
@endsection