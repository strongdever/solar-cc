

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('consult.consult-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.user-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label"><?php echo trans('consult.consult-menu-alt'); ?></h3>
        </div>
        <div class="common-form p_manager_form consult_form">
          <?php echo Form::open(array('route' => 'consult.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

            <?php echo csrf_field(); ?>

            <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
            <table class="form-table">
              <tbody>
                <tr>
                  <th width="150px">品物</th>
                  <td>
                    <div class="product_info">
                      <ul class="cats">
                        <li><a href="<?php echo e(url('/products', ['area' => $product->area->id])); ?>"><?php echo e($product->area->name); ?></a></li>
                        <li><a href="<?php echo e(url('/products', ['area' => $product->area->id, 'category' => $product->category->id])); ?>"><?php echo e($product->category->name); ?></a></li>
                      </ul>
                      <h4 class="title"><a href="<?php echo e(URL::to('/products/' . $product->id)); ?>"><?php echo e($product->name); ?></a></h4>
                      <p class="type">メーカー名 <?php echo e($product->maker_name); ?>　メーカー型番 <?php echo e($product->maker_model); ?></p>
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
                  </td>
                </tr>
                <tr>
                  <th>相談内容</th>
                  <td>
                    <div class="form_input">
                      <ul class="checkbox_list mb_16 mb_sp_12">
                        <li>
                          <label class="form_checkbox">品物に興味があります。お取り引き可能ですか？
                            <input type="checkbox" name="short[]" value="品物に興味があります。お取り引き可能ですか？">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_checkbox">品物の状態を知りたいです。詳細を教えてください。
                            <input type="checkbox" name="short[]" value="品物の状態を知りたいです。詳細を教えてください。">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_checkbox">品物の取引き方法について質問があります。
                            <input type="checkbox" name="short[]" value="品物の取引き方法について質問があります。">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_checkbox">以下の相談をさせてください。
                            <input type="checkbox" name="short[]" value="以下の相談をさせてください。">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                      </ul>
                      <label for="comment">詳細</label>
                      <?php echo Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => 8, 'style' => 'resize: none' )); ?>

                      <?php if($errors->has('comment')): ?>
                        <p class="validate"><?php echo e($errors->first('comment')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <div class="confirm_term">
              <label class="form_checkbox"><a href="#">利用規約</a> と <a href="#">プライバシーポリシー</a> に同意します。
                <input type="checkbox" name="confirm_term" value="confirm_term">
                <span class="checkmark"></span>
              </label>
            </div>
            <ul class="btn-group form-bottom">
              <li>
                <?php echo Form::button(trans('consult.buttons.create'), array('class' => 'form-btn btn-basic btn-block confirm_term_btn text-white btn-disible','type' => 'submit' )); ?>

              </li>
            </ul>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php echo $__env->make('scripts.term-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/user/create-consult.blade.php ENDPATH**/ ?>