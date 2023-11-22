

<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('titles.activeUsers')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <users-count :registered=<?php echo e($users); ?> ></users-count>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/pages/admin/active-users.blade.php ENDPATH**/ ?>