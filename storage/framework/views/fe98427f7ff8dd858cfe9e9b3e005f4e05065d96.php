

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="p_member_form_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="p_member_form_box">
          <div class="form_title">
            <h3 class="lead">会員登録が完了しました。</h3>
          </div>
          <a href="<?php echo e(route('guide')); ?>" class="form_btn login_btn">
            <span>使い方を確認する</span>
          </a>
        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/accepted.blade.php ENDPATH**/ ?>