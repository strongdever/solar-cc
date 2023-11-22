

<?php $__env->startSection('template_title'); ?>
	<?php echo trans('titles.resetPwordSuccess'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
    }
    .inner-page .alert-danger {
        display: none;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('status')): ?>
        <div class="alert alert-success">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <div class="sign-form-card">
        <h3 class="card-title">
            <?php echo e(__('パスワードが変更されました')); ?>

        </h3>
        <div class="card-body text-center">
            <a href="<?php echo e(url('/home')); ?>" class="btn btn-info mx-auto form-submit">
                <?php echo e(__('ホーム画面に移動する')); ?>

            </a>
            
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/auth/passwords/success.blade.php ENDPATH**/ ?>