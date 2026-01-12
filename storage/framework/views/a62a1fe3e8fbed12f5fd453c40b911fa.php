<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo e(asset("assets/css/init.css")); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?php echo $__env->yieldContent("css"); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <title><?php echo $__env->yieldContent("title"); ?></title>
</head>
<body>
    <?php echo $__env->make("content.Main.header.header", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make("content.Main.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make("content.Main.chat", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="chatbot-container" id="btn-chat">
    </div>
    <div class="loading-layer" id="loading-layer">
        <div class="logo-loading">
            <img id="logo-nav" src="<?php echo e(asset("assets/img/logo-unlock.png")); ?>" alt="logo unlock studio">
        </div>
    </div>
    <main>
        <?php echo $__env->yieldContent("content"); ?>
    </main>
     <?php echo $__env->make("content.Main.footer.footer", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script>
        var headerStatus;
        var scrolls = true;
        
        function hiddenFooter() {
            document.querySelector("footer").style.display = "none"
        }
    </script>
    <script src="<?php echo e(asset("assets/js/scroll.js")); ?>"></script>
    <script src="<?php echo e(asset("assets/js/sidebar.js")); ?>"></script>
    <script src="<?php echo e(asset("assets/js/chat.js")); ?>"></script>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php echo $__env->yieldContent("js"); ?>
</body>
</html><?php /**PATH C:\code\unlockis\resources\views/layouts/mainLayout.blade.php ENDPATH**/ ?>