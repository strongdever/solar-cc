

<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('titles.activeUsers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<section class="l_lead_section">
    <div class="container">
        <users-count :registered=<?php echo e($users); ?> ></users-count>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/admin/active-users.blade.php ENDPATH**/ ?>