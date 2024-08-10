@extends('template.template_kepala-madrasah')

@section('content')
<div class="container my-4">
    <div class="card">
        <h5 class="card-header">Data Guru</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('filter-guru') }}" method="GET" class="form-inline d-flex align-items-center">
                        <select class="form-control me-2" id="status" name="status">
                            <option value="">Filter Guru</option>
                            <option value="guru_inti" {{ request('status') == 'guru_inti' ? 'selected' : '' }}>Guru Inti</option>
                            <option value="guru_piket" {{ request('status') == 'guru_piket' ? 'selected' : '' }}>Guru Piket</option>
                        </select>
                        <button type="submit" class="btn btn-primary">FILTER</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h5 class="text-end fw-bold">Guru : {{$total}}</h5>
                </div>
            </div>
            <div class="table-responsive text-nowrap my-4">
                <div class="table-wrapper">
                    <table class="table table-hover">
                        <thead class="sticky-header">
                            <tr>
                                <th>No</th>
                                <th>Kode Guru</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Ttl</th>
                                <th>No HP</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        @foreach($data as $key => $dataGuru)
                        <tbody>
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $dataGuru->kode_guru }}</td>
                                <td>{{ $dataGuru->nama_guru }}</td>
                                <td>{{ $dataGuru->alamat_guru }}</td>
                                <td>{{ $dataGuru->ttl_guru }}</td>
                                <td>{{ $dataGuru->no_hp_guru }}</td>
                                <td>{{ $dataGuru->status }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
