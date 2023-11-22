

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('product.product-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_breadcrumbs_section">
    <div class="container">
      <ol>
        <li><a href="<?php echo e(url('/')); ?>">オフィス機器 みんなでつかう</a></li>
        <?php if( $search_params['area'] ): ?>
          <li><a href="<?php echo e(urldecode(route('products') . '?area=' . $search_params['area'])); ?>"><?php echo e(get_area($search_params['area'])->name); ?></a></li>
        <?php endif; ?>
        <?php if( $search_params['cat'] ): ?>
          <li><a href="<?php echo e(urldecode(route('products') . '?cat=' . $search_params['cat'])); ?>"><?php echo e(get_category($search_params['cat'])->name); ?></a></li>
        <?php endif; ?>
      </ol>
    </div>
  </section>

  <section class="l_main_section">
    <div class="container">
      <div class="p_main_search_form_wrapper">
        <div class="p_main_search_form_box">
          <?php echo Form::open(array('route' => 'products', 'method' => 'GET', 'role' => 'form', 'class' => 'p_main_search_form')); ?>

            <div class="search_form_main">
              <select name="area" id="area">
                <option value="">対応地域</option>
                <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($area->id); ?>" <?php echo e($search_params['area'] == $area->id ? 'selected="selected"' : ''); ?>><?php echo e($area->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <select name="cat" id="cat">
                <option value="">カテゴリ</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($category->id); ?>" <?php echo e($search_params['cat'] == $category->id ? 'selected="selected"' : ''); ?>><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <div class="search_input">
                <input type="text" name="keyword" id="keyword" value="<?php echo e($search_params['keyword']); ?>">
                <span class="clear"></span>
              </div>
              <button type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                  <path id="Icon_metro-search" data-name="Icon metro-search" d="M20.013,17.246l-4.264-3.626a1.9,1.9,0,0,0-1.293-.561,6.751,6.751,0,1,0-.756.756,1.9,1.9,0,0,0,.561,1.293l3.626,4.264a1.512,1.512,0,1,0,2.125-2.125ZM9.321,13.178a4.5,4.5,0,1,1,4.5-4.5,4.5,4.5,0,0,1-4.5,4.5Z" transform="translate(-2.571 -1.928)" fill="#fff"/>
                </svg>
                <span>検索</span>
              </button>
            </div>
            <div class="add_conditions">
              <div class="label_wrap">
                <p class="label">条件を絞る</p>
              </div>
              <div class="conditions_wrap">
                <ul class="conditions">
                  <li>
                    <select name="state" id="state">
                      <option value="">ステータス</option>
                      <option value="0" <?php echo e($search_params['state'] == 0 ? 'selected="selected"' : ''); ?>>受付中</option>
                      <option value="1" <?php echo e($search_params['state'] == 1 ? 'selected="selected"' : ''); ?>>取引相談中</option>
                      <option value="3" <?php echo e($search_params['state'] == 3 ? 'selected="selected"' : ''); ?>>取引完了</option>
                    </select>
                  </li>
                  <li>
                    <select name="price" id="price">
                      <option value="">希望価格</option>
                      <option value="0-10000" <?php echo e($search_params['price'] == '0-10000' ? 'selected="selected"' : ''); ?>>10,000円以下</option>
                      <option value="10000-50000" <?php echo e($search_params['price'] == '10000-50000' ? 'selected="selected"' : ''); ?>>10,000円~50,000円</option>
                      <option value="50000-100000" <?php echo e($search_params['price'] == '50000-100000' ? 'selected="selected"' : ''); ?>>50,000円~100,000円</option>
                      <option value="100000-200000" <?php echo e($search_params['price'] == '100000-200000' ? 'selected="selected"' : ''); ?>>100,000円~200,000円</option>
                      <option value="200000-500000" <?php echo e($search_params['price'] == '200000-500000' ? 'selected="selected"' : ''); ?>>200,000円~500,000円</option>
                      <option value="500000-10000000000" <?php echo e($search_params['price'] == '500000-10000000000' ? 'selected="selected"' : ''); ?>>500000以上</option>
                    </select>
                  </li>
                  <li>
                    <select name="response" id="response">
                      <option value="">業者対応</option>
                      <option value="1" <?php echo e($search_params['response'] == 1 ? 'selected="selected"' : ''); ?>>している</option>
                      <option value="2" <?php echo e($search_params['response'] == 2 ? 'selected="selected"' : ''); ?>>していない</option>
                      <option value="3" <?php echo e($search_params['response'] == 3 ? 'selected="selected"' : ''); ?>>わからない</option>
                    </select>
                  </li>
                </ul>
              </div>
              <input type="hidden" name="order" id="order" value="<?php echo e($search_params['order'] ? $search_params['order'] : 'updated_at'); ?>">
            </div>
          <?php echo Form::close(); ?>

        </div>
        <div class="p_main_search_string">
          <?php
          $search_string = '';
          if( $search_params['area'] ) {
            $search_string .= '「' . get_area($search_params['area'])->name . '」';
          }
          if( $search_params['cat'] ) {
            $search_string .= '「' . get_category($search_params['cat'])->name . '」';
          }
          if( $search_params['keyword'] ) {
            $search_string .= '「' . $search_params['keyword'] . '」';
          }
          if( strlen( $search_params['state'] ) > 0 ) {
            $search_string .= '「' . get_status($search_params['state']) . '」';
          }
          if( strlen( $search_params['price'] ) > 0 ) {
            $search_string .= '「' . get_minmax($search_params['price']) . '」';
          }
          if( strlen( $search_params['response'] ) > 0 ) {
            $search_string .= '「' . get_response($search_params['response']) . '」';
          }
          ?>
          <p><?php echo e($search_string); ?>　の検索結果　<strong>全<span class="counter"><?php echo e($products->total()); ?></span>件</strong></p>
        </div>
      </div>
      <div class="p_main_search_result_wrapper">
        <?php if( $products->count() > 0 ): ?>
          <div class="search_result_counter"><?php echo e(( $products->currentPage() - 1 ) * $products->perPage()); ?>件～<?php echo e(( $products->currentPage() - 1 ) * $products->perPage() + $products->count()); ?>件 （全<?php echo e($products->total()); ?>件）</div>
          <div class="search_result_pager top clearfix">
            <div class="wp-order">
              <p class="label">並べ替え：</p>
              <select name="search-order" id="search-order">
                <option value="updated_at" <?php echo e($search_params['order'] == 'updated_at' ? 'selected="selected"' : ''); ?>>新着</option>
                <option value="watchlists_count" <?php echo e($search_params['order'] == 'watchlists_count' ? 'selected="selected"' : ''); ?>>人気</option>
              </select>
            </div>
            <div class="result-pagenavi">
              <?php if($products->lastPage() === 1): ?>
                <ul class="pagination">
                  <li class="page-item disabled"><span class="page-link">«</span></li>
                  <li class="page-item active"><span class="page-link">1</span></li>
                  <li class="page-item disabled"><span class="page-link">»</span></li>
                </ul>
              <?php else: ?>
                <?php echo e($products->links()); ?>

              <?php endif; ?>
            </div>
          </div>
          <ul class="search_result_list">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
          <div class="search_result_pager bottom clearfix">
            <div class="result-pagenavi">
              <?php if($products->lastPage() === 1): ?>
                <ul class="pagination">
                  <li class="page-item disabled"><span class="page-link">«</span></li>
                  <li class="page-item active"><span class="page-link">1</span></li>
                  <li class="page-item disabled"><span class="page-link">»</span></li>
                </ul>
              <?php else: ?>
                <?php echo e($products->links()); ?>

              <?php endif; ?>
            </div>
          </div>
        <?php else: ?>
          <div class="no-result">
            <?php echo trans( 'pagination.noResult' ); ?>

          </div>
        <?php endif; ?>
      </div>
      <div class="p_main_search_form_wrapper bottom">
        <div class="p_main_search_string">
          <p><?php echo e($search_string); ?>　の検索結果　<strong>全<span class="counter"><?php echo e($products->total()); ?></span>件</strong></p>
        </div>
      </div>

      <?php echo $__env->make('partials.history', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </div>
  </section>

  <?php echo $__env->make('partials.guide-section', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/public/show-products.blade.php ENDPATH**/ ?>