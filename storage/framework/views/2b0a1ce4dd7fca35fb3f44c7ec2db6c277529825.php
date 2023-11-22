

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="p_common_wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="guide_panel">
          <li>
            <h4>使い方説明</h4>
            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </li>
          <li>
            <h4>必要なオフィス機器を探す</h4>
            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </li>
          <li>
            <h4>不要なオフィス機器を登録する</h4>
            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </li>
          <li>
            <h4>オフィス機器を取引きする</h4>
            <p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
          </li>
        </ul>
        <?php if(Session::has('registration_token')): ?>
          <a href="<?php echo e(route('register')); ?>" class="form-btn btn-basic btn-xs text-white mx_auto">
            <span>オフィス登録</span>
          </a>
        <?php else: ?>
          <a href="<?php echo e(url('/')); ?>" class="form-btn btn-basic btn-xs text-white mx_auto">
            <span>TOPへ</span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/auth/guide.blade.php ENDPATH**/ ?>