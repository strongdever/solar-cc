

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="p_member_form_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="p_member_form_box">
          <div class="form_title">
            <h3 class="lead">登録メールを<br class="sp">送信しました。</h3>
          </div>
          <p class="help">24時間以内に、メール内のURLをクリックし、パスワードを設定してください。なお、迷惑メール防止のための受信設定をしている方は、＠minna.comのドメイン指定解除をお願いいたします。</p>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/emailed.blade.php ENDPATH**/ ?>