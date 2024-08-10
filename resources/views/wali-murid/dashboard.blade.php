@extends('template.template_wali-murid')

@section('content')

  <!-- Content wrapper -->
  <div class="container py-4">
    <div class="card mb-3" style="max-width: 100%;">
      <div class="row">
        <div class="col-md-6 d-flex justify-content-center align-items-center">
          <img src="{{ asset('img/logo.png') }}" class="img-fluid w-50 rounded-start my-4" alt="Logo">
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h5 class="card-title">Informasi Madrasah</h5>
            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
            <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
