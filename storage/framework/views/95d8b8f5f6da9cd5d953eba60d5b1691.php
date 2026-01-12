<!DOCTYPE html>

<html class="light-style layout-menu-fixed" data-theme="theme-default" data-assets-path="<?php echo e(asset('/assets') . '/'); ?>" data-base-url="<?php echo e(url('/')); ?>" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title><?php echo $__env->yieldContent('title'); ?> | Materio - HTML Laravel Free Admin Template </title>
  <meta name="description" content="<?php echo e(config('variables.templateDescription') ? config('variables.templateDescription') : ''); ?>" />
  <meta name="keywords" content="<?php echo e(config('variables.templateKeyword') ? config('variables.templateKeyword') : ''); ?>">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
  <!-- Canonical SEO -->
  <link rel="canonical" href="<?php echo e(config('variables.productPage') ? config('variables.productPage') : ''); ?>">
  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?php echo e(asset('assets/img/favicon/favicon.ico')); ?>" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    .fc-license-message {
      display: none;
    }
    .swal2-container {
    z-index: 1120 !important; /* Ensure the modal is on top */
    }

  .swal2-backdrop-show {
      z-index: 1120 !important; /* Place the backdrop below the modal */
  }
  .modal {
    z-index: 1120 !important; /* Place the backdrop below the modal */
  }

  .modal-backdrop {
    z-index:1110 !important;
  }

  </style>
  <!-- Include Styles -->
  <?php echo $__env->make('layouts/sections/styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->yieldContent("urgentStyle"); ?>

  <!-- Include Scripts for customizer, helper, analytics, config -->
  <?php echo $__env->make('layouts/sections/scriptsIncludes', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
  

  <!-- Layout Content -->
  <?php echo $__env->yieldContent('layoutContent'); ?>
  <!--/ Layout Content -->

  

  <!-- Include Scripts -->
  <?php echo $__env->make('layouts/sections/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function alertSure(form) {
      Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Deleted!",
          text: "Your file has been deleted.",
          icon: "success"
        });
        form.submit()
      }
    });
    }
    </script>
  <?php echo $__env->yieldContent("urgentScript"); ?>
</body>

</html>
<?php /**PATH C:\code\unlockis\resources\views/layouts/commonMaster.blade.php ENDPATH**/ ?>