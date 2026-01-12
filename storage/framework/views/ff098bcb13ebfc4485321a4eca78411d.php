<?php $__env->startSection('title', 'Layanan Foto'); ?>
<?php $__env->startSection('content'); ?>

<div class="row gy-4">  
  <div class="card">
    <h5 class="card-header">
        Manajemen Notifikasi
    </h5>
    <div class="card-body">
        <div class="row mb-4">
            <label for="email" class="text-truncate">Tambah Email</label>
            <label for="" style="font-size: 12px;"><i>Pisahkan dengan "," untuk email lebih dari 1</i></label>
            <div class="col-md-10 d-flex">
               <form action="<?php echo e(Route("notif-post")); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input id="email" type="text" name="email" class="form-control" placeholder="jhondoe@gmail.com, johanal@yahoo.com">
                <button type="submit" class="btn btn-primary">Submit</button>
               </form>
            </div>
        </div>
        <div>
            <p>Email Penerima Notif <br>            <i style="font-size: 12px">Click Email Untuk Hapus</i>
            </p>
            <ul>
                <?php $__currentLoopData = $datas[0]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><a href="<?php echo e(Route("hapus-notif", $nf->email)); ?>"><?php echo e($nf->email); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/notif/notif.blade.php ENDPATH**/ ?>