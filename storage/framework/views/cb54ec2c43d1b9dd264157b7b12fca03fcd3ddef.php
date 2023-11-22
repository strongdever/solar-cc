

<?php $__env->startSection('template_title'); ?>
	<?php echo trans('titles.resetPword'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
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
            <?php echo e(__('パスワード再設定')); ?>

        </h3>
        <div class="card-body">
            <form action="<?php echo e(route('password.email')); ?>" method="post" class="form sign-form">
                <?php echo csrf_field(); ?>
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="email" class="label"><?php echo e(__('メールアドレス')); ?></label>
                            <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="carport1234@gmail.com" required autofocus>
                            <?php if($errors->has('email')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('email')); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit">
                        <?php echo e(__('送信する')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>