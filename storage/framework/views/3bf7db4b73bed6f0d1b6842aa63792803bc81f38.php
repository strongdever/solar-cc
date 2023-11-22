

<?php $__env->startSection('content'); ?>
  <section class="l_mainvisual_section">
    <div class="container">
      <h2 class="mainvisual_title">余っているものを必要なところへ<br>必要なものは余ってるところから</h2>
      <?php echo Form::open(array('route' => 'products', 'method' => 'GET', 'role' => 'form', 'class' => 'p_main_search_form')); ?>

        <div class="search_form_main">
          <select name="area" id="area">
            <option value="">対応地域</option>
            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($area->id); ?>"><?php echo e($area->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <select name="cat" id="cat">
            <option value="">カテゴリ</option>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <div class="search_input">
            <input type="text" name="keyword" id="keyword">
            <span class="clear"></span>
          </div>
          <button type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
              <path id="Icon_metro-search" data-name="Icon metro-search" d="M20.013,17.246l-4.264-3.626a1.9,1.9,0,0,0-1.293-.561,6.751,6.751,0,1,0-.756.756,1.9,1.9,0,0,0,.561,1.293l3.626,4.264a1.512,1.512,0,1,0,2.125-2.125ZM9.321,13.178a4.5,4.5,0,1,1,4.5-4.5,4.5,4.5,0,0,1-4.5,4.5Z" transform="translate(-2.571 -1.928)" fill="#fff"/>
            </svg>
            <span>検索</span>
          </button>
        </div>
        <div class="popular_keywords">
          <div class="label_wrap">
            <p class="label">人気キーワード</p>
          </div>
          <div class="keywords_wrap">
            <ul class="keywords">
              <li>カラー複合機</li>
              <li>スキャナ</li>
            </ul>
          </div>
        </div>
      <?php echo Form::close(); ?>

    </div>
  </section>

  <section class="l_indexs_section">
    <div class="container">
      <?php if( $categories !== null ): ?>
        <h3 class="section_label">カテゴリ</h3>
        <div class="p_index_cat_list_wrapper">
          <ul class="p_index_cat_list">
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <a href="<?php echo e(urldecode(route('products') . '?cat=' . $category->id)); ?>" class="p_index_cat">
                <figure class="cat_thumb">
                  <img src="<?php echo e(asset( $category->photo->path )); ?>" alt="<?php echo e($category->name); ?>">
                </figure>
                <h4 class="cat_name"><?php echo e($category->name); ?></h4>
              </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
        </div>
      <?php endif; ?>

      <?php if( $areas !== null ): ?>
      <h3 class="section_label">対応地域</h3>
      <div class="p_index_area_list_wrapper">
        <?php
        $area_nav_columns = [7, 7, 6, 4, 6, 5, 4, 4, 4];
        $area_count = 0;
        ?>
        <div class="p_index_area_list_row">
          <?php $__currentLoopData = $area_nav_columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col">
              <ul class="p_index_area_nav">
                <?php for($i = 0; $i < $column; $i++): ?>
                  <li>
                    <a href="<?php echo e(urldecode(route('products') . '?area=' . $areas[$area_count]->id)); ?>"><?php echo e($areas[$area_count]->name); ?></a>
                  </li>
                  <?php
                  $area_count ++;
                  ?>
                <?php endfor; ?>
              </ul>
            </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
      </div>
      <?php endif; ?>

      <?php echo $__env->make('partials.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
  </section>

  <?php echo $__env->make('partials.guide-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/home.blade.php ENDPATH**/ ?>