

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('watchlist.watchlist-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="p_main_search_result_wrapper">
        <?php echo $__env->make('partials.user-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label"><?php echo trans('watchlist.watchlist-menu-alt'); ?></h3>
        </div>
        <?php if( $watchlists->count() > 0 ): ?>
          <ul class="search_result_list">
            <?php $__currentLoopData = $watchlists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $watchlist): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php
              $product = $watchlist->product
              ?>
              <li>
                <div class="search_result_item clearfix">
                  <div class="result_thumb">
                    <a href="<?php echo e(URL::to('/products/' . $product->id)); ?>" class="link">
                      <figure class="picture">
                        <img src="<?php echo e(asset($product->get_photos()[0]->path)); ?>" alt="<?php echo e($product->name); ?>">
                      </figure>
                    </a>
                  </div>
                  <div class="result_side">
                    <p class="update_date">情報更新：<?php echo e($product->updated_at->format('Y年m月d日')); ?></p>
                    <p class="public_date">掲載開始：<?php echo e($product->created_at->format('Y年m月d日')); ?></p>
                    <?php
                      $is_watched = false;
                    ?>

                    <?php if(auth()->guard()->check()): ?>
                      <?php
                        if( $watchlist->user_id === Auth::user()->id ) {
                          $is_watched = true;
                        }
                      ?>
                    <?php endif; ?>
                    <div class="favorite">
                      <div class="favorite_btn <?php if( $is_watched ): ?> active <?php endif; ?>" data-id="<?php echo e($product->id); ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.208" viewBox="0 0 16 15.208">
                          <path id="Icon_ionic-md-star" data-name="Icon ionic-md-star" d="M11.8,16.725l4.944,2.983-1.308-5.626L19.8,10.3,14.044,9.8,11.8,4.5,9.55,9.8,3.8,10.3l4.364,3.783L6.853,19.708Z" transform="translate(-3.797 -4.5)" fill="#FEFEFE" stroke="#000"></path>
                        </svg>
                        <span>気になる</span>
                        <strong class="favorite_counter"><?php echo e($product->watchlists->count()); ?></strong>
                      </div>
                      <?php if(auth()->guard()->guest()): ?>
                      <div class="favorite_balloon">
                        <button class="balloon_close">×</button>
                        <p>ログインが必要です</p>
                        <a href="<?php echo e(route('login')); ?>" class="link">ログイン</a>
                      </div>
                      <?php endif; ?>
                    </div>
                  </div>
                  <div class="result_content">
                    <ul class="cats">
                      <li><a href="<?php echo e(urldecode(route('products') . '?area=' . $product->area->id)); ?>"><?php echo e($product->area->name); ?></a></li>
                      <li><a href="<?php echo e(urldecode(route('products') . '?cat=' . $product->category->id)); ?>"><?php echo e($product->category->name); ?></a></li>
                    </ul>
                    <h4 class="title"><a href="<?php echo e(URL::to('/products/' . $product->id)); ?>"><?php echo e($product->name); ?></a></h4>
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
                </div>
              </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </ul>
          <div class="result-pagenavi mt_30">
            <?php if($watchlists->lastPage() === 1): ?>
              <ul class="pagination">
                <li class="page-item disabled"><span class="page-link">«</span></li>
                <li class="page-item active"><span class="page-link">1</span></li>
                <li class="page-item disabled"><span class="page-link">»</span></li>
              </ul>
            <?php else: ?>
              <?php echo e($watchlists->links()); ?>

            <?php endif; ?>
          </div>
        <?php else: ?>
          <div class="no-result">
            <?php echo trans( 'pagination.noResult' ); ?>

          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.favorite-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/user/show-watchlists.blade.php ENDPATH**/ ?>