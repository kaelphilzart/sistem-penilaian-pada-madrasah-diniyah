<!DOCTYPE html>


<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="..//"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Madrasah Diniyah Hidayatul Muta'alimin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="\vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="\vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="\vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="\css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="\vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="\vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="\vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="\js/config.js"></script>
    <style>
          .table-wrapper {
          max-height: 500px; /* Sesuaikan tinggi tabel sesuai kebutuhan Anda */
          overflow-y: auto;
        }

        .sticky-header th {
          position: sticky;
          top: 0;
          background: #e7e7ff; /* Sesuaikan warna latar belakang sesuai tema Anda */
          z-index: 1000;
          box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.4);
        }
    </style>
  </head>

  <body>
    
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" width="25" class="img-fluid">
        </span>
            <span class=" demo menu-text fw-bolder ms-2">Madrasah Diniyah Hidayatul Muta'alimin</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item ">
              <a href="{{route('dashboard_guru_inti')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('data-peserta')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-id-card"></i>
                <div data-i18n="Layouts">Peserta Didik</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('data-jadwal')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Jadwal</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('nilai')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Nilai</div>
              </a>
            </li>
            <!-- <li class="menu-item">
              <a href="{{route('rekap-nilai')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-cube-alt"></i>
                <div data-i18n="Misc">Rekap Nilai</div>
              </a>
            </li> -->
            <li class="menu-item">
              <a href="{{route('data-absen')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Absensi</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('catatan-ngaji-guru')}}" class="menu-link ">
                <i class="menu-icon tf-icons bx bx-detail"></i>
                <div data-i18n="Form Layouts">Catatan Ngaji</div>
              </a>
            </li>
            <li class="menu-item">
              <a href="{{route('data-kegiatan')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Kegiatan</div>
              </a>
            </li>
           
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <!-- <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div> -->
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
            

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('img/logo.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('img/logo.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{Auth::user()->name}}</span>
                            <small class="text-muted">{{Auth::user()->level}}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <!-- <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li> -->
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{route('logout-guru')}}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
          <div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
        <div class="col-md-3 mt-4">
            <div class="card mb-3" style="height: 100%">
                <div class="container">
                    <div class="text-center py-2">
                        <h4 class="text-dark fw-bold">Kegiatan</h4>
                    </div>
                    <div class="table-responsive text-nowrap" style="max-height: 400px; overflow-y: auto;">
                     <table class="table table-borderless">
                            <tbody id="kegiatan-list">
                                <!-- Data Kegiatan akan dimuat di sini -->
                            </tbody>
                        </table>
                        <div id="load-more-btn" class="text-center mt-2">
                            <a href="javascript:void(0);" class="text-decoration-none text-primary"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            <!-- Footer -->
          
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div id="liveToast" class="toast @if(session('error') || session('success')) show @else hide @endif" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            @if(session('error'))
                <img src="/img/close.png" class="rounded me-2" alt="Gagal" style="width: 16px; height: 16px;">
                <strong class="me-auto">Gagal</strong>
            @elseif(session('success'))
                <img src="/img/succes.png" class="rounded me-2" alt="Berhasil" style="width: 16px; height: 16px;">
                <strong class="me-auto">Berhasil</strong>
            @endif
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            @if(session('error'))
                {{ session('error') }}
            @elseif(session('success'))
                {{ session('success') }}
            @endif
        </div>
    </div>
</div>


    <!-- Core JS -->
    <!-- build:js/vendor/js/core.js -->
    <script src="\vendor/libs/jquery/jquery.js"></script>
    <script src="\vendor/libs/popper/popper.js"></script>
    <script src="\vendor/js/bootstrap.js"></script>
    <script src="\vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="\vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="\vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="\js/main.js"></script>

    <!-- Page JS -->
    <script src="\js/dashboards-analytics.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('nilaiForm').submit();
    });
});

  </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('error') || session('success'))
            var toastEl = document.getElementById('liveToast');
            var toast = new bootstrap.Toast(toastEl, { delay: 6000 });
            toast.show();
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        var page = 1;

        function loadKegiatan() {
            $.ajax({
                url: "{{ route('load-kegiatan-guru') }}",
                type: "GET",
                data: { page: page },
                success: function(response) {
                    if (response.data.length > 0) {
                        $.each(response.data, function(index, kegiatan) {
                            $('#kegiatan-list').append(
                                `<tr>
                                    <td class="text-wrap">${kegiatan.nama_kegiatan}, ${kegiatan.tgl_kegiatan}</td>
                                </tr>`
                            );
                        });
                        page++;
                    } else {
                        $('#load-more-btn').hide();
                    }
                }
            });
        }

        // Load data pertama kali
        loadKegiatan();

        // Load more button
        $('#load-more-btn').click(function() {
            loadKegiatan();
        });
    });
</script>
<script>
       $(document).ready(function() {
    @if(session('error') || session('succes'))
        $('#liveToast').toast('show');
    @endif
});

    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
      </body>
</html>

<script>
    // fungsi untuk mengecek dan mengubah warna menu saat berada di halaman yang sesuai
    function setActiveMenuColor() {
        var currentUrl = window.location.href;
        var links = document.querySelectorAll('.menu-link');

        links.forEach(function(link) {
            if (link.href === currentUrl) {
                link.parentElement.classList.add('active'); // Tambahkan kelas 'active' pada elemen li
                link.style.color = 'blue'; // Ubah warna teks link menjadi biru
            } else {
                link.parentElement.classList.remove('active'); // Hapus kelas 'active' dari elemen li
                link.style.color = 'black'; // Kembalikan warna teks link ke hitam
            }
        });
    }

    // Panggil fungsi ketika halaman dimuat
    window.onload = setActiveMenuColor;
</script>
