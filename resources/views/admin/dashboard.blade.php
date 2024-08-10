@extends('template.template_admin')

@section('content')

<!-- Content wrapper -->
<div class="container py-4">
  <div class="stretch-card grid-margin py-4">
  <div class="card shadow-sm">  
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-7 text-cen">
                        <h5>Statistik Peserta</h5>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="flot-chart-wrapper">
                            <div id="flotChart" class="flot-chart mx-4">
                                <canvas id="combinedChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <div class="card mb-3" style="max-width: 100%;">
    <div class="row">
      <div class="col-md-4 d-flex justify-content-center align-items-center">
        <img src="{{ asset('img/logo.png') }}" class="img-fluid w-50 rounded-start my-4" alt="Logo">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title fw-bold">Informasi Madrasah</h5>
          <p class="card-text" style="text-align: justify;">
            Madrasah Diniyah Hidayatul Muta‘allimin terletak di Kelurahan Ngampel Kecamatan Mojoroto Kota Kediri Jawa
            Timur, tepatnya di RT 29 RW 04. Madrasah ini dibina langsung oleh beliau Dr.KH. Reza Ahmad Zahid, Lc.MA
            selaku Pengasuh PonPes Lirboyo HM Al Mahrusiyah & Wakil Ketua PWNU Jawa Timur.
            Madrasah “Hidayatul Muta’allimin” berfokus mencetak generasi yang tangguh, terampil, berakhlak mulia, dan
            berintegritas tinggi. Menyikapi krisis multidimensional di Indonesia, madrasah ini berupaya mempersiapkan
            generasi mendatang sebagai pemimpin masa depan, terutama bagi mereka yang terhambat pendidikan dan hidup
            dalam keterbatasan.
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="card ">
    <div class="row">
      <div class="col-md-6 mb-2">
        <div class="card-body">
          <h5 class="card-title fw-bold mb-4 pt-2">VISI</h5>
          <p class="card-text" style="text-align: justify;">
            “Mencetak santri khususnya yang Yatim, Piatu dan Dhuafa menjadi ahli agama Islam terutama Hamilil Quran
            Lafdzan wa Ma’nan wa ‘Amalan wa Mutakalliman”.
          </p>
          <img src="/img/ds1.jpg" class="img-fluid rounded shadow mb-2" alt="...">

        </div>
      </div>
      <div class="col-md-6 mb-2">
        <div class="card-body">
          <img src="/img/ds.jpg" class="img-fluid rounded shadow mb-2" alt="...">
          <h5 class="card-title fw-bold mb-4 pt-2">MISI</h5>
          <p class="card-text" style="text-align: justify;">
          <ol type="a">
            <li>Mempersiapkan kader-kader atau generasi muda yang mampu menghafalkan Al-Quran.</li>
            <li>Menjadikan Al-Quran sebagai prioritas utama layanan pendidikan dengan mengedepankan Akhlaqul Karimah.
            </li>
            <li>Meningkatkan kualitas penghafal Al-Quran dari tahun ke tahun.</li>
            <li>Menjalin kerjasama yang erat dengan masyarakat, pemerintah, dan instansi terkait.</li>
          </ol>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="card mt-2">
    <h5 class="card-title text-center py-4">SUSUNAN PENGURUS
      MDT. HIDAYATUL MUTA’ALLIMIN
      KELURAHAN NGAMPEL KECAMATAN MOJOROTO KOTA KEDIRI
      TAHUN 2024
    </h5>
    <div class="col-md-12">
      <img src="/img/struktur.png" class="img-fluid rounded " alt="...">
    </div>

  </div>
</div>
<script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('combinedChart').getContext('2d');
            var combinedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($labels) !!},
                    datasets: [
                        {
                            label: 'Jumlah Siswa Masuk',
                            data: {!! json_encode($siswaValues) !!},
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1,
                            barThickness: 20,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Mengubah ini jika ingin chart menyesuaikan kontainer
                    scales: {
                        x: {
                            barPercentage: 0.5,
                            categoryPercentage: 0.5
                        },
                        y: {
                            beginAtZero: true
                        }
                    },
                    animation: {
                        duration: 0 // Menghilangkan animasi untuk troubleshooting
                    }
                }
            });
        });
    </script>

@endsection