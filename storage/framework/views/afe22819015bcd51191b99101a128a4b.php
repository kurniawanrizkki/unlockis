<div>
    <div>
        <input id="search-pemesanan" value="<?php echo e(isset($_GET["q"]) ? $_GET["q"] : ""); ?>" type="text" wire:keydown.debounce.300ms="fillSearch($event.target.value)" class="form-control" placeholder="Cari berdasarkan nama pelanggan/paket/tanggal_booking">
    </div>
    <table class="table">
        <thead>
            <tr>
                <th class="text-truncate">Bio</th>
                <th class="text-truncate">Paket</th>
                <th class="text-truncate">Tanggal & Jam Booking</th>
                <th class="text-truncate">Status Pembayaran</th>
                <th class="text-truncate">Aksi</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <div class="modal fade" id="modal-pemesanan-<?php echo e($pemesanan->id_pemesanan); ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-xl" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Detail Pemesanan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <ul class="list-unstyled">
                                                                <li><strong>Detail Pelanggan</strong></li>
                                                                <li>Nama Lengkap: <?php echo e($pemesanan->pelanggan->nama_lengkap); ?></li>
                                                                <li>No Whatsapp: <a href="https://api.whatsapp.com/send/?phone=<?php echo e($pemesanan->pelanggan->no_wa); ?>&text&type=phone_number"><?php echo e($pemesanan->pelanggan->no_wa); ?></a></li>
                                                                <li>Instagram: <?php echo e($pemesanan->pelanggan->instagram); ?></li>
                                                                <li>Rekening: <?php echo e($pemesanan->pelanggan->no_rekening); ?> (<?php echo e($pemesanan->pelanggan->nama_bank); ?>)</li>
                                                                <li>No Member: <?php echo e($pemesanan->pelanggan->member_id ?? '-'); ?></li>
                                                            </ul>
                                                            <hr>
                                                            
                                                            
                                                            <?php
                                                              $file_sent = App\Models\PemesananFileSent::where("id_pemesanan", $pemesanan->id_pemesanan)
                                                              ->get()
                                                              ->map(function($d) {
                                                                return App\Models\FileSent::find($d->id_file_sent)->nama_file_sent;
                                                              })->toArray();
                                                            
                                                              $servis_tambahan = App\Models\ServisTambahanPemesanan::where("id_pemesanan", $pemesanan->id_pemesanan)
                                                              ->get()
                                                              ->map(function($d) {
                                                                return App\Models\ServisTambahan::find($d->id_servis)->nama_servis;
                                                              })->toArray();
                                                            
                                                              $background = App\Models\PemesananBackground::where("id_pemesanan", $pemesanan->id_pemesanan)
                                                              ->get()
                                                              ->map(function($d) {
                                                                return App\Models\Background::find($d->id_background)->nama_background;
                                                              })->toArray();
                                                            ?>
            
                                                            <ul class="list-unstyled">
                                                                <li><strong>Detail Pemesanan</strong></li>
                                                                <li>Paket Pilihan: <?php echo e($pemesanan->paket->nama_paket); ?></li>
                                                                <li>Tipe File Sent :</li>
                                                                <ul>
                                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $file_sent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><?php echo e($fs); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                                </ul>
                                                                <li>Servis Tambahan :</li>
                                                                <ul>
                                                                    <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $servis_tambahan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <li><?php echo e($st); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
                                                                </ul>
                                                                <li>Background : <?php echo e(implode(", ", $background)); ?></li>
                                                                <li>Jam Booking: <?php echo e($pemesanan->jam_booking); ?></li>
                                                                <li>Tanggal Booking: <?php echo e($pemesanan->tanggal_booking); ?></li>
                                                                <li>Fotografer: <?php echo e(App\Models\User::where('id_user',$pemesanan->id_photographer)->count() ? App\Models\User::where('id_user',$pemesanan->id_photographer)->first()->nama : "Tidak Ada"); ?></li>
                                                              </ul>
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <a href="<?php echo e(Route("invoice-index", App\Models\Invoice::where("id_pemesanan", $pemesanan->id_pemesanan)->first()->uuid)); ?>" class="btn btn-sm btn-primary">View Invoice</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            
                                    
                                    <div class="modal fade" id="modal-pemesanan-edit-<?php echo e($pemesanan->id_pemesanan); ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-sm" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Pemesanan</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row gap-2">
                                                        <a href="<?php echo e(Route('pemesanan-edit-index', $pemesanan->id_pemesanan)); ?>" class="btn btn-primary">Edit Pemesanan</a>
                                                        <a href="<?php echo e(Route('pemesanan-bg-edit-index', $pemesanan->id_pemesanan)); ?>" class="btn btn-primary">Edit Background Pilihan</a>
                                                        <a href="<?php echo e(Route('pemesanan-servis-edit-index', $pemesanan->id_pemesanan)); ?>" class="btn btn-primary">Edit Servis Tambahan</a>
                                                        <a href="<?php echo e(Route('pemesanan-Fs-edit-index', $pemesanan->id_pemesanan)); ?>" class="btn btn-primary">Edit Tipe File Sent</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0 text-truncate" style="max-width:150px"><?php echo e($pemesanan->pelanggan->nama_lengkap); ?></h6>
                                <small>
                                    <a href="https://api.whatsapp.com/send/?phone=<?php echo e($pemesanan->pelanggan->no_wa); ?>&text&type=phone_number">
                                        <?php echo e($pemesanan->pelanggan->no_wa); ?>

                                    </a>
                                </small>
                            </div>
                        </div>
                    </td>
                    <td class="text-truncate"><?php echo e($pemesanan->paket->nama_paket); ?></td>
                    <td class="text-truncate"><?php echo e($pemesanan->tanggal_booking); ?> <br><?php echo e($pemesanan->jam_booking); ?></td>
                    <td>
                        <span class='badge rounded-pill bg-label-<?php echo e($pemesanan->status_pembayaran == "Belum DP" ? "danger" : ($pemesanan->status_pembayaran == "DP" ? "warning" : "success")); ?>'>
                            <?php echo e($pemesanan->status_pembayaran); ?>

                        </span>
                    </td>
                    <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="mdi mdi-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button data-bs-toggle="modal" class="dropdown-item" data-bs-target="#modal-pemesanan-<?php echo e($pemesanan->id_pemesanan); ?>">
                                    <i class="mdi mdi-details me-2"></i> Detail
                                </button>
                                <button data-bs-toggle="modal" class="dropdown-item" data-bs-target="#modal-pemesanan-edit-<?php echo e($pemesanan->id_pemesanan); ?>">
                                    <i class="mdi mdi-pencil-outline me-2"></i> Edit
                                </button>
                                <a href="<?php echo e(Route('hapus-pemesanan', $pemesanan->id_pemesanan)); ?>">
                                    <button class="dropdown-item">
                                        <i class="mdi mdi-delete-outline me-2"></i> Hapus
                                    </button>
                                </a>
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
        </tbody>
    </table>
    
    
    <div class="d-flex justify-content-end">
        <?php echo e($data->links()); ?>

    </div>
</div>
<?php /**PATH C:\code\unlockis\resources\views/livewire/tabel-pemesanan.blade.php ENDPATH**/ ?>