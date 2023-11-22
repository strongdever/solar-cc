

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('product.product-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.user-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('product.product-menu-alt'); ?></h3>
          <ul class="actions">
            <li>
              <a class="btn btn-secondary text-white" href="<?php echo e(route('myproducts')); ?>">
                <?php echo trans('product.buttons.back-to-products'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form p_manager_form message_form">
          <?php echo Form::open(array('route' => 'myproducts.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

            <?php echo csrf_field(); ?>

            <table class="form-table">
              <tbody>
                <tr>
                  <th width="160px"><?php echo trans('product.labels.category'); ?></th>
                  <td>
                    <div class="form_input">
                      <select name="category_id" id="category_id" class="m">
                        <option value=""><?php echo e(trans('product.labels.category-ph')); ?></option>
                        <?php if($categories): ?>
                          <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                      <?php if($errors->has('category_id')): ?>
                        <p class="validate"><?php echo e($errors->first('category_id')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.maker_name'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('maker_name', NULL, array('id' => 'maker_name', 'class' => 'm' )); ?>

                      <?php if($errors->has('maker_name')): ?>
                        <p class="validate"><?php echo e($errors->first('maker_name')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.name'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name', NULL, array('id' => 'name', 'class' => 'm' )); ?>

                      <?php if($errors->has('name')): ?>
                        <p class="validate"><?php echo e($errors->first('name')); ?></p>
                      <?php endif; ?>
                      <p class="help"><a href="#">タイトルのつけ方</a></p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.maker_model'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('maker_model', NULL, array('id' => 'maker_model', 'class' => 'm' )); ?>

                      <?php if($errors->has('maker_model')): ?>
                        <p class="validate"><?php echo e($errors->first('maker_model')); ?></p>
                      <?php endif; ?>
                      <p class="help"><a href="#">型番の確認方法</a></p>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.photos'); ?></th>
                  <td>
                    <div class="form_input">
                      <div class="product_uploaded_photos">
                        <div class="uploaded_photo_item new">
                          <a class="upload"></a>
                          <span class="remove"></span>
                          <img src="" alt="" class="preview">
                          <input type="file" name="photo[]" accept="image/*" hidden>
                        </div>
                      </div>
                      <?php if($errors->has('photo_id')): ?>
                        <p class="validate"><?php echo e($errors->first('photo_id')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.owner'); ?></th>
                  <td>
                    <div class="form_input">
                      <h4 class="input_lead"><?php echo e(Auth::user()->profile->company_kanji); ?></h4>
                      <ul class="owner_checkbox_group">
                        <li>
                          <label class="form_checkbox">所有者は上記で間違いありません
                            <input type="checkbox" name="owner_type[]" value="1" checked="checked">
                            <span class="checkmark"></span>
                          </label>
                          <a href="#" class="link">所有者とは？</a>
                        </li>
                        <li>
                          <label class="form_checkbox">リース契約の品物ではありません
                            <input type="checkbox" name="owner_type[]" value="2">
                            <span class="checkmark"></span>
                          </label>
                          <a href="#" class="link">リース契約とは？</a>
                        </li>
                        <li>
                          <label class="form_checkbox">割賦（分割払い中）ではありません
                            <input type="checkbox" name="owner_type[]" value="3">
                            <span class="checkmark"></span>
                          </label>
                          <a href="#" class="link">割賦とは？</a>
                        </li>
                        <li>
                          <label class="form_checkbox">レンタル品ではありません
                            <input type="checkbox" name="owner_type[]" value="4">
                            <span class="checkmark"></span>
                          </label>
                          <a href="#" class="link">レンタル品とは？</a>
                        </li>
                      </ul>
                      <?php if($errors->has('owner_type')): ?>
                        <p class="validate"><?php echo e($errors->first('owner_type')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.area'); ?></th>
                  <td>
                    <div class="form_input">
                      <h4 class="input_lead"><?php echo e(Auth::user()->profile->company_prefecture); ?><?php echo e(Auth::user()->profile->company_address); ?></h4>
                      <a class="product_area_tab_link">別の地域に変更する</a>
                      <div id="area-tab" class="product_area_tab_body">
                        <div class="input_sub">
                          <label for="name">郵便番号</label>
                          <?php echo Form::text('zipcode', Auth::user()->profile->company_zipcode, array('id' => 'zipcode', 'class' => 'sm', 'onKeyUp' => "AjaxZip3.zip2addr(this,'','prefecture','address');")); ?>

                          <?php if($errors->has('zipcode')): ?>
                            <p class="validate"><?php echo e($errors->first('zipcode')); ?></p>
                          <?php endif; ?>
                        </div>
                        <div class="input_sub">
                          <label for="name">都道府県</label>
                          <?php echo Form::text('prefecture', Auth::user()->profile->company_prefecture, array('id' => 'prefecture', 'class' => 'm' )); ?>

                          <?php if($errors->has('prefecture')): ?>
                            <p class="validate"><?php echo e($errors->first('prefecture')); ?></p>
                          <?php endif; ?>
                        </div>
                        <div class="input_sub">
                          <label for="name">市区町村・番地・建物名等</label>
                          <?php echo Form::text('address', Auth::user()->profile->company_address, array('id' => 'address', 'class' => 'm' )); ?>

                          <?php if($errors->has('address')): ?>
                            <p class="validate"><?php echo e($errors->first('address')); ?></p>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th width="150px"><?php echo trans('product.labels.response_area'); ?></th>
                  <td>
                    <div class="form_input">
                      <select name="area_id" id="area_id" class="m">
                        <option value=""><?php echo e(trans('product.labels.response_area-ph')); ?></option>
                        <?php if($areas): ?>
                          <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($area->id); ?>"><?php echo e($area->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </select>
                      <?php if($errors->has('area_id')): ?>
                        <p class="validate"><?php echo e($errors->first('area_id')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.price'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('price', NULL, array('id' => 'price', 'class' => 'sm' )); ?>

                      <?php if($errors->has('price')): ?>
                        <p class="validate"><?php echo e($errors->first('price')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.purchased_period'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('purchased_period', NULL, array('id' => 'purchased_period', 'class' => 'm' )); ?>

                      <?php if($errors->has('purchased_period')): ?>
                        <p class="validate"><?php echo e($errors->first('purchased_period')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.purchased_status'); ?></th>
                  <td>
                    <div class="form_input">
                      <ul class="radiobox_group">
                        <li>
                          <label class="form_radiobox">新品
                            <input type="radio" name="purchased_status" value="1" checked="checked">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_radiobox">中古
                            <input type="radio" name="purchased_status" value="2">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                      </ul>
                      <?php if($errors->has('purchased_status')): ?>
                        <p class="validate"><?php echo e($errors->first('purchased_status')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.current_status'); ?></th>
                  <td>
                    <div class="form_input">
                      <ul class="radiobox_group">
                        <li>
                          <label class="form_radiobox">問題なく使っている
                            <input type="radio" name="current_status" value="1" checked="checked">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_radiobox">動作確認済み
                            <input type="radio" name="current_status" value="2">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_radiobox">動作未確認
                            <input type="radio" name="current_status" value="3">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                      </ul>
                      <?php if($errors->has('current_status')): ?>
                        <p class="validate"><?php echo e($errors->first('current_status')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.maintenance'); ?></th>
                  <td>
                    <div class="form_input">
                      <ul class="radiobox_group mb_16 mb_sp_12">
                        <li>
                          <label class="form_radiobox">している
                            <input type="radio" name="maintenance_status" value="1" checked="checked">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_radiobox">していない
                            <input type="radio" name="maintenance_status" value="2">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                        <li>
                          <label class="form_radiobox">わからない
                            <input type="radio" name="maintenance_status" value="3">
                            <span class="checkmark"></span>
                          </label>
                        </li>
                      </ul>
                      <?php echo Form::textarea('maintenance_text', NULL, array('id' => 'maintenance_text', 'rows' => 3, 'style' => 'resize: none' )); ?>

                      <?php if($errors->has('maintenance_status')): ?>
                        <p class="validate"><?php echo e($errors->first('maintenance_status')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('product.labels.comment'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::textarea('comment', NULL, array('id' => 'comment', 'rows' => 8, 'style' => 'resize: none' )); ?>

                      <?php if($errors->has('comment')): ?>
                        <p class="validate"><?php echo e($errors->first('comment')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <ul class="btn-group form-bottom">
              <li>
                <?php echo Form::button(trans('product.buttons.create-product'), array('class' => 'form-btn btn-basic btn-block text-white','type' => 'submit' )); ?>

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
  <?php echo $__env->make('scripts.upload-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/myproducts/create.blade.php ENDPATH**/ ?>