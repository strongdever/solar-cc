

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="p_member_form_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="p_member_form_box">
          <form method="post" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form_title">
              <h3 class="lead">ログイン / 会員登録</h3>
              <p class="sub">持ち主への相談や、やりとりは会員登録が必要です。<br class="pc">すでに会員登録されている方は、ログインしてください。</p>
            </div>
            <div class="form_input_group">
              <div class="form_input">
                <label for="email">メールアドレス</label>
                <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="office@minna-.com" required autocomplete="email" autofocus>
                <?php if($errors->has('email')): ?>
                  <p class="validate"><?php echo e($errors->first('email')); ?></p>
                <?php endif; ?>
              </div>
              <div class="form_input">
                <label for="email">パスワード</label>
                <input type="password" name="password" id="password" placeholder="・・・・・・・・・" required="required">
                <?php if($errors->has('password')): ?>
                  <p class="validate"><?php echo e($errors->first('password')); ?></p>
                <?php endif; ?>
              </div>
            </div>
            <div class="form_btn_row">
              <div class="btn_col">
                <button type="submit" class="form_btn login_btn">
                  <span>ログイン</span>
                </button>
              </div>
              <div class="btn_col">
                <a href="<?php echo e(route('email')); ?>" class="form_btn login_btn">
                  <span>会員登録（無料）</span>
                </a>
              </div>
            </div>
            <div class="form_help">
              <p>未登録の方は 会員登録してください。</p>
              <p>パスワードを変更したい方、または忘れた方は<a href="<?php echo e(route('password.request')); ?>">こちら</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/login.blade.php ENDPATH**/ ?>