<?php if(session('error')): ?>
  <div class="alert alert-danger">
    <p><?php echo e(session('error')); ?></p>
  </div>
<?php endif; ?>

<?php if(session('success')): ?>
  <div class="alert alert-success">
    <p><?php echo e(session('success')); ?></p>
  </div>
<?php endif; ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/layouts/partials/messages.blade.php ENDPATH**/ ?>