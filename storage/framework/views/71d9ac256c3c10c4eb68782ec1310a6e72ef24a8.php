

<?php $__env->startSection('content'); ?>
<section class="l_lead_section">
    <div class="container">
        <div class="p_member_form_wrapper">
            <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <div class="p_member_form_box">
                <form method="POST" action="<?php echo e(route('password.email')); ?>">
                    <div class="form_title">
                        <h3 class="lead">パスワードの再設定</h3>
                    </div>
                    <?php echo csrf_field(); ?>
                    <div class="form_input_group">
                        <div class="form_input">
                            <label for="email">メールアドレス</label>
                            <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="office@minna-.com" required autocomplete="email" autofocus>
                            <?php if($errors->has('email')): ?>
                                <p class="validate"><?php echo e($errors->first('email')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form_btn_row">
                        <div class="btn_col">
                            <button type="submit" class="form_btn login_btn">
                                <span>送信する</span>
                            </button>
                        </div>
                    </div>
                </form>  
            </div>        
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/passwords/email.blade.php ENDPATH**/ ?>