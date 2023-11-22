<?php if(auth()->guard()->check()): ?>
<div class="p_manager_nav_wrapper">
  <ul class="p_manager_nav">
    <li>
      <a href="<?php echo e(route('myproducts')); ?>">オフィス機器管理</a>
    </li>
    <li>
      <a href="<?php echo e(route('messages')); ?>">メッセージ</a>
    </li>
    <li>
      <a href="<?php echo e(route('transactions')); ?>">取引履歴</a>
    </li>
    <li>
      <a href="<?php echo e(route('watchlists')); ?>">お気に入り</a>
    </li>
    <li>
      <a href="<?php echo e(url('profile/' . Auth::user()->name)); ?>">プロフィール</a>
    </li>
  </ul>
</div>
<?php endif; ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/partials/user-nav.blade.php ENDPATH**/ ?>