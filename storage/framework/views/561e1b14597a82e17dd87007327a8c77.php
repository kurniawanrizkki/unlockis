<?php $__env->startSection('title', 'Layanan Foto'); ?>
<?php $__env->startSection('content'); ?>

<!-- Add New Background Modal -->
<div class="modal fade" id="modal-post-layanan-foto" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Background Foto Baru</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?php echo e(Route('background-foto-post')); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="background">Nama</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="nama_background" id="background">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="min">Kapasitas Minimal</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="kapasitas_min" id="min">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="max">Kapasitas Maximal</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="number" name="kapasitas_max" id="max">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="bg">Gambar Background</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" name="gambar_bg" id="bg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row gy-4">  
    <div>
        <button data-bs-toggle="modal" data-bs-target="#modal-post-layanan-foto" class="btn btn-primary">Tambah Baru</button>
    </div>
    <div class="card">
        <h5 class="card-header">Data Background Foto</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-truncate">Nama Background</th>
                        <th class="text-truncate">Kapasitas</th>
                        <th class="text-truncate">Gambar</th>
                        <th class="text-truncate">Aksi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $__currentLoopData = $datas[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $background): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Edit Background Modal -->
                    <div class="modal fade" id="modal-edit-background-<?php echo e($background->id_background); ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Edit Background Foto</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form method="POST" action="<?php echo e(Route('background-foto-edit', $background->id_background)); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="background">Nama</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="text" value="<?php echo e($background->nama_background); ?>" name="nama_background" id="background">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="min">Kapasitas Minimal</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="number" value="<?php echo e($background->kapasitas_min); ?>" name="kapasitas_min" id="min">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="max">Kapasitas Maximal</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control" type="number" value="<?php echo e($background->kapasitas_max); ?>" name="kapasitas_max" id="max">
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-sm-2 col-form-label" for="bg">Gambar Background</label>
                                                        <div class="col-sm-5 d-flex">
                                                            <input class="form-control" type="file" name="gambar_bg" id="bg">
                                                            <?php if(!empty($background->gambar_bg)): ?>
                                                                <img src="<?php echo e(asset('storage/' . $background->gambar_bg)); ?>" width="100" height="100" alt="Background Image" class="ms-3">
                                                            <?php else: ?>
                                                                <span class="text-muted">Belum Ada Gambar</span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Data Row -->
                    <tr>
                        <td class="text-truncate"><?php echo e($background->nama_background); ?></td>
                        <td class="text-truncate"><?php echo e($background->kapasitas_min); ?> - <?php echo e($background->kapasitas_max); ?></td>
                        <td class="text-truncate">
                            <?php if(!empty($background->gambar_bg)): ?>
                                <img width="100" height="100" src="<?php echo e(asset('storage/' . $background->gambar_bg)); ?>" alt="Background Image">
                            <?php else: ?>
                                <span class="text-muted">Belum Ada Gambar</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <button data-bs-toggle="modal" data-bs-target="#modal-edit-background-<?php echo e($background->id_background); ?>" class="btn btn-success">Edit</button>
                                <form id="form-delete-bg-<?php echo e($background->id_background); ?>" action="<?php echo e(Route('background-foto-delete', $background->id_background)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="button" onclick="alertSure(document.getElementById('form-delete-bg-<?php echo e($background->id_background); ?>'))" class="btn btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/pemesanan/background.blade.php ENDPATH**/ ?>