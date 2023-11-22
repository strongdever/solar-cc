<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        
        <meta name="keywords" content="" />
        <meta name="description" content="" />

        <title><?php if (! empty(trim($__env->yieldContent('template_title')))): ?><?php echo $__env->yieldContent('template_title'); ?> | <?php endif; ?> <?php echo e(config('app.name', Lang::get('titles.app'))); ?></title>
        
        
        <link rel="stylesheet" href="<?php echo e(asset('assets/font/fonts.css')); ?>">

        
        <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/reset.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/common.css')); ?>">
        <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">

        <?php echo $__env->yieldContent('template_linked_css'); ?>

        <style type="text/css">
            <?php echo $__env->yieldContent('template_fastload_css'); ?>
        </style>

        
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>;
        </script>

        <?php echo $__env->yieldContent('head'); ?>
        
        <?php echo $__env->make('scripts.ga-analytics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
    </head>
    <body>
        <div id="app">

            <?php echo $__env->make('partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main id="main">

                <section class="inner-page">

                    <div class="container">

                        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php echo $__env->yieldContent('content'); ?>

                    </div>

                </section>

            </main>

        </div>

        <div class="copyright">© All Rights Reserved.</div>

        
        <script src="<?php echo e(asset('js/app.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('assets/js/common.js')); ?>"></script>

        <?php echo $__env->yieldContent('footer_scripts'); ?>

    </body>
</html>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/layouts/app.blade.php ENDPATH**/ ?>