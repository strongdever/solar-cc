

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="p_member_form_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="p_member_form_box">
          <form method="post" action="<?php echo e(route('accept')); ?>">
            <?php echo csrf_field(); ?>
            <input id="email" type="hidden" name="email" value="<?php echo e($email); ?>">
            <div class="form_title">
              <h3 class="lead">パスワード設定</h3>
              <p class="sub">ログイン用のパスワードを<br>設定してください。</p>
            </div>
            <div class="password_lead">
              <h4>パスワード設定条件</h4>
              <div class="inner">
                <p>半角英数字8文字以上20文字以内で設定してください。<br>英数最低1文字ずつ含ませてください。</p>
              </div>
            </div>
            <div class="form_input_group">
              <div class="form_input">
                <label for="email">パスワード</label>
                <input type="password" name="password" id="password" value="<?php echo e(old('password')); ?>" placeholder="・・・・・・・・・・" required="required">
                <?php if($errors->has('password')): ?>
                  <p class="validate"><?php echo e($errors->first('password')); ?></p>
                <?php endif; ?>
              </div>
              <div class="form_input">
                <label for="email">パスワード再入力（確認用）</label>
                <input type="password" name="password_confirmation" id="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>" placeholder="・・・・・・・・・・" required="required">
                <?php if($errors->has('password_confirmation')): ?>
                  <p class="validate"><?php echo e($errors->first('password_confirmation')); ?></p>
                <?php endif; ?>
              </div>
              <div class="password_show">
                <div class="form_checkbox">
                  <label class="checkbox_container">
                    <span class="text">パスワードを表示する</span>
                    <input type="checkbox" name="show_password" id="show_password">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
              <div class="term_panel">
                <h4>利用規約</h4>
                <div class="inner">
                  <ul>
                    <li>テキストテキストテキストテキストテキスト</li>
                    <li>テキストテキストテキストテキストテキストテキスト</li>
                    <li>テキストテキストテキストテキストテキストテキスト</li>
                  </ul>
                </div>
              </div>
              <div class="term_check_panel">
                <label class="form_checkbox">利用規約に同意する
                  <input type="checkbox" name="confirm_term" value="confirm_term">
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
            <button type="submit" class="form_btn login_btn confirm_term_btn btn-disible">
              <span>登録する</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/accept.blade.php ENDPATH**/ ?>