

<?php $__env->startSection('template_title'); ?>
	<?php echo trans('titles.register'); ?>

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
        <h3 class="card-title">
            <?php echo e(__('カーポート倶楽部新規登録')); ?>

        </h3>
        <div class="card-body">
            <form action="<?php echo e(route('register')); ?>" method="post" class="form sign-form">
                <?php echo csrf_field(); ?>
                <ul class="form-group">
                    <li>
                        <div class="input-group">
                            <label for="uuid" class="label"><?php echo e(__('ID')); ?></label>
                            <input type="text" class="form-control<?php echo e($errors->has('uuid') ? ' is-invalid' : ''); ?>" name="uuid" value="<?php echo e(old('uuid')); ?>" placeholder="carport123" required autofocus>
                            <?php if($errors->has('uuid')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('uuid')); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                    <li>
                        <div class="input-group">
                            <label for="email" class="label"><?php echo e(__('メールアドレス')); ?></label>
                            <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="carport1234@gmail.com" required>
                            <?php if($errors->has('email')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('email')); ?></p>
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
                    <li>
                        <div class="input-group">
                            <label for="password" class="label"><?php echo e(__('パスワード（確認用）')); ?></label>
                            <input type="password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?>" name="password_confirmation" placeholder="******" required>
                            <?php if($errors->has('password_confirmation')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>
                <div class="form-term">
                    <label class="form-checkbox">当社の<a href="#">利用規約</a>と<a href="#">プライバシーポリシー</a>に<br>同意する
                        <input type="checkbox" name="confirm_term" value="1">
                        <span class="checkmark"></span>
                    </label>
                </div>
                <div class="form-action">
                    <button type="submit" class="btn btn-block btn-info form-submit" disabled>
                        <?php echo e(__('登録する')); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/auth/register.blade.php ENDPATH**/ ?>