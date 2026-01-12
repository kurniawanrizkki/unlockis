<?php $__env->startSection('title', 'Dashboard - Analytics'); ?>

<?php $__env->startSection('vendor-style'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/libs/apex-charts/apex-charts.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('vendor-script'); ?>
<script src="<?php echo e(asset('assets/vendor/libs/apex-charts/apexcharts.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-script'); ?>
<script src="<?php echo e(asset('assets/vendor/fullcalender/dist/index.global.min.js')); ?>"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
     let data_jadwal;
     fetch("http://localhost:8000/api/jadwal")
     .then(response => response.json())
     .then(data => {
         var calendarEl = document.getElementById('calendar');
         var calendar = new FullCalendar.Calendar(calendarEl, {
             headerToolbar: {
                 left: '',  // Only show the title in the header
                 center: 'title',
                 right: ''       // No prev/next buttons
                 },

                 eventTimeFormat: { // like '14:30:00'
                 hour: '2-digit',
                 minute: '2-digit',
                 meridiem: false
             },
             events: data,
             locale:"id",

         });
         calendar.getOption('locale');
         calendar.render();
     })

   });
</script>
<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row gy-4">
  <?php
  $pemesan_hari_ini = App\Models\Pemesanan::where("tanggal_booking", date('Y-m-d'))->count();
  ?>
  <!-- Congratulations card -->
  <div class="col-lg-12 col-lg-4">
    <div class="card" style="color:white;background-image:url('<?php echo e(asset('assets/img/admin.png')); ?>');background-repeat:no-repeat;background-size:cover">
      <div class="card-body">
        <h4 style="color:white" class="card-title mb-1">Halo <?php echo e(auth()->user()->nama); ?> 🎉</h4>
        <p class="pb-0 mt-1">Selamat datang di web unlockis</p>
        <p class="mb-2 pb-1">Ada <span class="text-primary"><?php echo e($pemesan_hari_ini); ?></span> Pemesanan Hari Ini</p>
        <a href="javascript:;" class="btn btn-sm btn-primary">Lihat Pemesanan Hari Ini</a>
      </div>
    </div>
  </div>
  <!--/ Congratulations card -->

  <!-- Transactions -->
  
  <!--/ Transactions -->

  
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header">
        <div class="d-flex justify-content-between">
          <h5 class="mb-1">Kalender Pemesanan</h5>
          <div class="dropdown">
            <button class="btn p-0" type="button" id="weeklyOverviewDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="mdi mdi-dots-vertical mdi-24px"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="weeklyOverviewDropdown">
              <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
              <a class="dropdown-item" href="javascript:void(0);">Share</a>
              <a class="dropdown-item" href="javascript:void(0);">Update</a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
    <div id='calendar' style="width:100%;"></div>
        
        <?php
        $currentMonth = now()->month; // Mendapatkan bulan saat ini
        $currentYear = now()->year;   // Mendapatkan tahun saat ini

        // Mengambil jumlah pemesanan berdasarkan bulan dan tahun saat ini
        $jumlah_pemesanan_bulan_skrg = App\Models\Pemesanan::whereMonth('tanggal_booking', $currentMonth)
                                    ->whereYear('tanggal_booking', $currentYear)
                                    ->where("status_pembayaran", "DP")
                                    ->count(); // Menghitung jumlah pemesanan

        $previousMonth = now()->subMonth()->month;
        $previousYear = now()->subMonth()->year;

        $jumlah_pemesanan_bulan_sblm = App\Models\Pemesanan::whereMonth('tanggal_booking', $previousMonth)
                                    ->whereYear('tanggal_booking', $previousYear)
                                    ->count();
        $pembanding_str = $jumlah_pemesanan_bulan_skrg > $jumlah_pemesanan_bulan_sblm ? "Lebih banyak dibanding bulan lalu 🎉" : "Lebih sedikit dibanding bulan lalu"
        ?>
        <div class="mt-1 mt-md-3">
          <div class="d-flex align-items-center gap-3">
            <h3 class="mb-0 text-primary"><?php echo e($jumlah_pemesanan_bulan_skrg); ?></h3>
            <p class="mb-0">Terdapat <b><?php echo e($jumlah_pemesanan_bulan_skrg); ?></b> pemesanan dibulan ini, <?php echo e($pembanding_str); ?></p>
          </div>
          <div class="d-grid mt-3 mt-md-4">
            <a href="<?php echo e(Route("kalender-index")); ?>"><button class="btn btn-primary" type="button">Details</button></a>
          </div>
        </div>
      </div>
    </div>
  </div>


  <!-- Total Earnings -->
  <div class="col-xl-4 col-md-6">
    <div class="card">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="card-title m-0 me-2">5 Harga Pemesanan Termahal Bulan Ini</h5>
        
      </div>
      <div class="card-body">
        <?php
        use Carbon\Carbon;
        $pemesanan_termahal = App\Models\Pemesanan::orderBy('total_harga', 'desc')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->paginate(5);

        $profit_bulan_ini = App\Models\Pemesanan::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('total_harga');
        $profit_bulan_lalu = App\Models\Pemesanan::whereMonth('created_at', Carbon::now()->subMonth()->month)
        ->whereYear('created_at', Carbon::now()->subMonth()->year)
        ->sum('total_harga');
        $profit_bulan_lalu_2 = App\Models\Pemesanan::whereMonth('created_at', Carbon::now()->subMonth(2)->month)
        ->whereYear('created_at', Carbon::now()->subMonth(2)->year)
        ->sum('total_harga');

        $perubahanProfit = 0;
        $perubahanProfit2= 0;
        if ($profit_bulan_lalu > 0) {
          $perubahanProfit = (($profit_bulan_ini - $profit_bulan_lalu) / $profit_bulan_lalu) * 100;
        }

        if ($perubahanProfit2> 0) {
          $perubahanProfit = (( $profit_bulan_lalu -  $profit_bulan_lalu_2) / $profit_bulan_lalu_2) * 100;
        }
        $i = 0;
        ?>
    <?php $__currentLoopData = $pemesanan_termahal; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
          <div class="d-flex align-items-center">
            <div class="avatar me-3">
              <h3><?php echo e(++$i); ?></h3>
            </div>
            <div>
              <div class="d-flex align-items-center gap-1">
                <h6 class="mb-0"><?php echo e('Rp ' . number_format((int)$pt->total_harga, 0, ',', '.')); ?></h6>
              </div>
              <small><?php echo e(substr(App\Models\Pelanggan::find($pt->id_pelanggan)->nama_lengkap, 0, 10)); ?></small>
            </div>
          </div>
          <div class="text-end">
            <h6 class="mb-0">Tanggal</h6>
            <small><?php echo e($pt->tanggal_booking); ?></small>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      </div>
    </div>
  </div>
  <!--/ Total Earnings -->

  <!-- Four Cards -->
  <div class="col-xl-4 col-md-6">
    <div class="row gy-4">
      <!-- Total Profit line chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-primary rounded-circle shadow">
                <i class="mdi mdi-poll mdi-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body mt-mg-1">
            <h6 class="mb-2">Total Profit</h6>
            <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
              <h6 class="mb-0 me-2">Rp. <?php echo e(number_format((int)$profit_bulan_ini, 0, ',', '.')); ?></h6>
              <small class="text-success mt-1">+ <?php echo e(number_format($perubahanProfit, 2)); ?>%</small>
            </div>
            <small>Dibulan ini</small>
          </div>
        </div>
      </div>
      <!--/ Total Profit line chart -->
      <!-- Total Profit Weekly Project -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-danger rounded-circle shadow">
                <i class="mdi mdi-poll mdi-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="totalProfitID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="totalProfitID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <div class="card-body mt-mg-1">
            <h6 class="mb-2">Total Profit</h6>
            <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
              <h6 class="mb-0 me-2">Rp. <?php echo e(number_format((int)$profit_bulan_lalu, 0, ',', '.')); ?></h6>
              <small class="text-success mt-1">+ <?php echo e(number_format($perubahanProfit2, 2)); ?>%</small>
            </div>

            <small>Dibulan lalu</small>
          </div>
        </div>
      </div>
      <!--/ Total Profit Weekly Project -->
      <!-- New Yearly Project -->
      <?php
       $pemesanan_total = App\Models\Pemesanan::whereYear('created_at', Carbon::now()->year)
        ->count();
      ?>
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <div class="avatar">
              <div class="avatar-initial bg-primary rounded-circle shadow-sm">
                <i class="mdi mdi-cart mdi-24px"></i>
              </div>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="newProjectID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="mdi mdi-dots-vertical mdi-24px"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="newProjectID">
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                <a class="dropdown-item" href="javascript:void(0);">Update</a>
              </div>
            </div>
          </div>
          <?php
          ?>
          <div class="card-body mt-mg-1">
            <h6 class="mb-2">Total Pemesanan</h6>
            <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
              <h4 class="mb-0 me-2"><?php echo e($pemesanan_total); ?></h4>
            </div>
            <small>Di Tahun Ini</small>
          </div>
        </div>
      </div>
      <!--/ New Yearly Project -->
      <!-- Sessions chart -->
      <div class="col-sm-6">
        <div class="card h-100">
          <div class="card-header pb-0">
            <h4 class="mb-0">100</h4>
          </div>
          <div class="card-body">
            <div id="sessionsColumnChart" class="mb-3"></div>
            <h6 class="text-center mb-0">Pengunjung Web Hari Ini</h6>
          </div>
        </div>
      </div>
      <!--/ Sessions chart -->
    </div>
  </div>
  <!--/ Total Earning -->

  <!-- Data Tables -->
  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th class="text-truncate">Bio</th>
              <th class="text-truncate">Paket</th>
              <th class="text-truncate">Total Orang</th>
              <th class="text-truncate">Tanggal Booking</th>
              <th class="text-truncate">Jam Booking</th>
              <th class="text-truncate">Status Pembayaran</th>
              <th class="text-truncate">Status Pengerjaan</th>

            </tr>
          </thead>
          <tbody>
            <?php $__currentLoopData = $data[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="modal-pemesanan-<?php echo e($pemesanan->id_pemesanan); ?>" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel4">Detail Pemesanan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   <div class="row">
                    <div class="card">

                      <div class="card-body">
                        <ul style="list-style-type: none">
                          <li><b>Detail Pelanggan</b></li>
                          <li>Nama Lengkap: <?php echo e($pemesanan->pelanggan->nama_lengkap); ?></li>
                          <li>No Whatsapp: <a href="https://api.whatsapp.com/send/?phone=<?php echo e($pemesanan->pelanggan->no_wa); ?>&text&type=phone_number"><?php echo e($pemesanan->pelanggan->no_wa); ?></a></li>
                          <li>Instagram: <?php echo e($pemesanan->pelanggan->instagram); ?></li>
                          <li>Rekening: <?php echo e($pemesanan->pelanggan->no_rekening); ?> (<?php echo e($pemesanan->pelanggan->nama_bank); ?>)</li>
                          
                        </ul>
                        <hr>
                        <ul style="list-style-type: none">
                          <li><b>Detail Pemesanan</b></li>
                          <li>Paket Pilihan: <?php echo e($pemesanan->paket->nama_paket); ?></li>
                          <li>Jam Booking: <?php echo e($pemesanan->jam_booking); ?></li>
                          <li>Tanggal Booking: <?php echo e($pemesanan->tanggal_booking); ?></li>
                        </ul>

                      </div>
                    </div>
                   </div>
                  </div>
                  <div class="modal-footer">
                      <a href="<?php echo e(Route("invoice-index", App\Models\Invoice::where("id_pemesanan",  $pemesanan->id_pemesanan)->first()->uuid)); ?>" class="btn btn-sm btn-primary">View Invoice</a>
                      <a href="<?php echo e(Route("pemesanan-index", "q=".$pemesanan->pelanggan->nama_lengkap)); ?>" class="btn btn-sm btn-primary">Detail Pemesanan</a>
                  </div>
                </div>
              </div>
            </div>
            <tr data-bs-toggle="modal" data-bs-target="#modal-pemesanan-<?php echo e($pemesanan->id_pemesanan); ?>">
              <td>
                <div class="d-flex align-items-center">
                  <div>
                    <h6 class="mb-0 text-truncate" style="max-width:150px"><?php echo e($pemesanan->pelanggan->nama_lengkap); ?></h6>
                    <small class="text-truncate"><a href="https://api.whatsapp.com/send/?phone=<?php echo e($pemesanan->pelanggan->no_wa); ?>&text&type=phone_number"><?php echo e($pemesanan->pelanggan->no_wa); ?></a></small>
                  </div>
                </div>
              </td>
              <td class="text-truncate"><?php echo e($pemesanan->paket->nama_paket); ?></td>
              <td class="text-truncate"><?php echo e($pemesanan->total_orang_foto); ?></td>
              <td class="text-truncate"><?php echo e($pemesanan->tanggal_booking); ?></td>
              <td class="text-truncate"><?php echo e($pemesanan->jam_booking); ?></td>
              <td class="text-truncate">
                <?php if($pemesanan->status_pembayaran == "Belum DP"): ?>
                <span class='badge bg-label-danger rounded-pill'><?php echo e($pemesanan->status_pembayaran); ?></span>
                <?php elseif($pemesanan->status_pembayaran == "DP"): ?>
                <span class='badge bg-label-warning rounded-pill'><?php echo e($pemesanan->status_pembayaran); ?></span>
                <?php else: ?>
                <span class='badge bg-label-success rounded-pill'><?php echo e($pemesanan->status_pembayaran); ?></span>
                <?php endif; ?>
              </td>
              <td class="text-truncate">
                <?php if($pemesanan->status_pengerjaan == "File belum diedit"): ?>
                <span class='badge bg-label-danger rounded-pill'><?php echo e($pemesanan->status_pengerjaan); ?></span>
                <?php elseif($pemesanan->status_pengerjaan == "Belum cetak"): ?>
                <span class='badge bg-label-warning rounded-pill'><?php echo e($pemesanan->status_pengerjaan); ?></span>
                <?php elseif($pemesanan->status_pengerjaan == "revisi"): ?>
                <span class='badge bg-label-danger rounded-pill'><?php echo e($pemesanan->status_pengerjaan); ?></span>
                <?php elseif($pemesanan->status_pengerjaan == "orderan selesai"): ?>
                <span class='badge bg-label-sucess rounded-pill'><?php echo e($pemesanan->status_pengerjaan); ?></span>
                <?php endif; ?>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <script>
              function postData(data) {
                fetch("<?php echo e(route('status_pembayaran')); ?>", { // Use route helper for URL
                  method: "POST",
                  headers: { // Set content type
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    "status_pembayaran": data.value,
                    "id_pemesanan": data.getAttribute("id_pemesanan") // Make sure to set this attribute in your HTML
                  })
                })
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Network response was not ok');
                  }
                  alert("status pembayaran berhasil diubah")
                  return response.json(); // Correctly call response.json()
                })
                .then(data => {
                  console.log(data); // Use the response data here
                })
                .catch(error => {
                  console.error('Error:', error);
                });
              }
              </script>

          </tbody>
        </table>
      </div>
    </div>
  </div>
  <!--/ Data Tables -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/dashboard/dashboards-admin.blade.php ENDPATH**/ ?>