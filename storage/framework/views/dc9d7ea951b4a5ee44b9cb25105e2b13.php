<?php $__env->startSection("css"); ?>
<link rel="stylesheet" href="<?php echo e(asset("assets/css/servis.css")); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection("content"); ?>
    <div style="padding-top: 100px">

    </div>
    <div class="section-success" style="margin-top:30px;background-size:cover;background-position:center;background-repeat:no-repeat;display: grid;justify-content:center;align-items:center;width:100%;height:50vh;background-image:url(<?php echo e(asset("assets/img/success_pemesanan.png")); ?>)">
        <div style="text-align: center">
            <h1>TERIMAKASIH TELAH BOOKING</h1>
            <h1>SILAHKAN MENUNGGU INVOICE MELALUI WHATSAPP </h1>
            <br><br>
            <a href="<?php echo e(Route("main-index")); ?>">
                <button type="button" class="btn-primary" >Kembali Ke Home</button>

            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("js"); ?>
<script>
    hiddenFooter();
    headerStatus = true;
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.mainLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/Main/success.blade.php ENDPATH**/ ?>