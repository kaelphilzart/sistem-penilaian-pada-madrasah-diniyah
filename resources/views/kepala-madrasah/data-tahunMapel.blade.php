@extends('template.template_kepala-madrasah')

@section('content')
<div class="container my-4">
    <div class="card">

        <h5 class="card-header">Kelas</h5>
        <div class="table-responsive text-nowrap my-4">
        <div class="table-wrapper">
              <table class="table table-hover">
                <thead class="sticky-header">
                    <tr class="">
                        <th>No</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                    </tr>
                </thead>
                @foreach($data as $key => $dataTahun)
                <tbody>
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $dataTahun->nama_kelas }}</td>
                        <td>
                            <a href="{{ route('mapel', $dataTahun->id) }}" class="text-dark btn btn-info px-4">Lihat Mapel</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</div>
@endsection