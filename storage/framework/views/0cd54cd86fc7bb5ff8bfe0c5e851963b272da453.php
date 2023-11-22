<?php
  $products = products_history();
?>
<div class="p_browse_history_wrapper">
  <h3 class="section_label">閲覧履歴</h3>
  <ul class="p_history_index_list">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li>
      <a href="#" class="p_history_index">
        <figure class="history_thumb">
          <img src="<?php echo e(asset($product->get_photos()[0]->path)); ?>" alt="<?php echo e($product->name); ?>">
        </figure>
        <h4 class="history_title"><?php echo e($product->name); ?></h4>
      </a>
    </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </ul>
</div><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/partials/history.blade.php ENDPATH**/ ?>