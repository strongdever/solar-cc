

<?php $__env->startSection('template_title'); ?>
	<?php echo trans('titles.login'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .inner-page .alert {
        max-width: 50rem;
        margin-left: auto;
        margin-right: auto;
    }
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="sign-form-card">
        <h3 class="card-title"><?php echo e(__('販売店様ログイン')); ?></h3>
        <div class="card-body">
            <form action="<?php echo e(route('login')); ?>" method="post" class="form sign-form">
                <?php echo csrf_field(); ?>
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="name" class="label"><?php echo e(__('ID')); ?></label>
                            <input type="text" class="form-control<?php echo e($errors->has('uuid') ? ' is-invalid' : ''); ?>" name="uuid" value="<?php echo e(old('uuid')); ?>" placeholder="carport123" required autofocus>
                            <?php if($errors->has('uuid')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('uuid')); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="password" class="label"><?php echo e(__('パスワード')); ?></label>
                            <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" placeholder="******" required>
                            <?php if($errors->has('password')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('password')); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
                <div class="form-meta">パスワードをお忘れの方は<a href="<?php echo e(route('password.request')); ?>">こちら</a></div>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit">
                        <?php echo e(__('ログイン')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/auth/login.blade.php ENDPATH**/ ?>