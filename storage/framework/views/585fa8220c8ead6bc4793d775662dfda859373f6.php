

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('product.product-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <link rel="stylesheet" href="<?php echo e(config('options.swiperCssCDN')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_breadcrumbs_section">
    <div class="container">
      <ol>
        <li><a href="<?php echo e(url('/')); ?>">オフィス機器 みんなでつかう</a></li>
        <li><a href="<?php echo e(urldecode(route('products') . '?area=' . $product->area->id)); ?>"><?php echo e($product->area->name); ?></a></li>
        <li><a href="<?php echo e(urldecode(route('products') . '?cat=' . $product->category->id)); ?>"><?php echo e($product->category->name); ?></a></li>
        <li><?php echo e($product->name); ?></li>
      </ol>
    </div>
  </section>

  <section class="l_main_section">
    <div class="container">
      <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="p_main_single_wrapper clearfix">
        <div class="p_single_swiper">
          <div class="swiper single_swiper_main">
            <div class="swiper-wrapper">
              <?php $__currentLoopData = $product->get_photos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <img src="<?php echo e(asset($photo->path)); ?>" alt="<?php echo e($product->name); ?>">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
          <div class="swiper single_swiper_sub">
            <div class="swiper-wrapper">
              <?php $__currentLoopData = $product->get_photos(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                  <img src="<?php echo e(asset($photo->path)); ?>" alt="<?php echo e($product->name); ?>">
                </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
          </div>
        </div>
        <div class="p_single_content">
          <div class="info_wrap">
            <ul class="cats">
              <li><a href="<?php echo e(url('/products', ['area' => $product->area->id])); ?>"><?php echo e($product->area->name); ?></a></li>
              <li><a href="<?php echo e(url('/products', ['area' => $product->area->id, 'category' => $product->category->id])); ?>"><?php echo e($product->category->name); ?></a></li>
            </ul>
            <h4 class="title"><?php echo e($product->name); ?></h4>
            <p class="type">メーカー名 SHARP　メーカー型番 MX-2022</p>
            <p class="additions">
              <?php if($product->status == 0): ?>
                <span class="state">受付中</span>
              <?php elseif($product->status == 1): ?>
                <span class="state">取引相談中</span>
              <?php elseif($product->status == 2): ?>
                <span class="state">取引合意中</span>
              <?php elseif($product->status == 3): ?>
                <span class="state">取引完了</span>
              <?php endif; ?>
              <span class="price">本体希望価格<strong><?php echo e(number_format($product->price)); ?>円</strong>（税込）</span>
            </p>
            <ul class="responses">
              <li>
                <span>業者メンテナンス対応品</span>
              </li>
            </ul>
          </div>
          <div class="desc_wrap">
            <div class="desc"><?php echo html_entity_decode(nl2br(e($product->comment))); ?></div>
          </div>
          <div class="actions_wrap">
            <ul class="actions">
              <?php
                $watchlists = $product->watchlists;
                $is_watched = false;
              ?>

              <?php if(auth()->guard()->check()): ?>
                <?php
                foreach($watchlists as $watchlist) {
                  if( $watchlist->user_id === Auth::user()->id ) {
                    $is_watched = true; break;
                  }
                }
                ?>
              <?php endif; ?>
              <li class="favorite">
                <button class="favorite_btn  <?php if( $is_watched ): ?> active <?php endif; ?>" data-id="<?php echo e($product->id); ?>">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.208" viewBox="0 0 16 15.208">
                    <path id="Icon_ionic-md-star" data-name="Icon ionic-md-star" d="M11.8,16.725l4.944,2.983-1.308-5.626L19.8,10.3,14.044,9.8,11.8,4.5,9.55,9.8,3.8,10.3l4.364,3.783L6.853,19.708Z" transform="translate(-3.797 -4.5)" fill="#FEFEFE" stroke="#000"></path>
                  </svg>
                  <span>気になる</span>
                  <strong class="favorite_counter"><?php echo e($product->watchlists->count()); ?></strong>
                </button>
                <?php if(auth()->guard()->guest()): ?>
                <div class="favorite_balloon">
                  <button class="balloon_close">×</button>
                  <p>ログインが必要です</p>
                  <a href="<?php echo e(route('login')); ?>" class="link">ログイン</a>
                </div>
                <?php endif; ?>
              </li>
              <li>
                <a href="<?php echo e(URL::to('/consult/' . $product->id)); ?>" class="btn btn-basic text-white consult_btn">
                  <span>持ち主に相談する</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <?php echo $__env->make('partials.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
  </section>

  <?php echo $__env->make('partials.guide-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <script src="<?php echo e(config('options.swiperJsCDN')); ?>"></script>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.swiper-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.favorite-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/public/show-product.blade.php ENDPATH**/ ?>