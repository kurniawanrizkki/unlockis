<?php $__env->startSection('title', 'Dashboard - Analytics'); ?>

<?php $__env->startSection('page-script'); ?>
<script src="<?php echo e(asset('assets/js/dashboards-analytics.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row gy-4">  
    <div class="card">
        <h5 class="card-header">Data Pemesanan</h5>
        <div class="table-responsive text-nowrap">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split("tabel-pemesanan");

$__html = app('livewire')->mount($__name, $__params, 'lw-768686938-0', $__slots ?? [], get_defined_vars());

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>
</div>

<script>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts/contentNavbarLayout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\code\unlockis\resources\views/content/pemesanan/pemesanan.blade.php ENDPATH**/ ?>