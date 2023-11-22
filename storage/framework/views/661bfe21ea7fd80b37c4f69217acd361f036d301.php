

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('category.showing-all-categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('category.create-new-category'); ?></h3>
          <ul class="actions">
            <li>
              <a class="btn btn-secondary text-white" href="<?php echo e(route('categories')); ?>">
                <?php echo trans('category.buttons.back-to-categories'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form">
          <?php echo Form::open(array('route' => 'categories.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

            <?php echo csrf_field(); ?>

            <table class="form-table">
              <tbody>
                <tr>
                  <th width="150px"><?php echo trans('category.labels.name'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name', NULL, array('id' => 'name' )); ?>

                      <?php if($errors->has('name')): ?>
                        <p class="validate"><?php echo e($errors->first('name')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('category.labels.desc'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('description', NULL, array('id' => 'description' )); ?>

                      <?php if($errors->has('description')): ?>
                        <p class="validate"><?php echo e($errors->first('description')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('category.labels.image'); ?></th>
                  <td>
                    <div class="form_input">
                      <div class="uploaded_photo_card new">
                        <a class="upload"></a>
                        <span class="remove"></span>
                        <img src="" alt="" class="preview">
                        <input type="file" name="photo" accept="image/*" hidden>
                        <?php echo Form::hidden('photo_id', NULL); ?>

                      </div>
                      <?php if($errors->has('photo_id')): ?>
                        <p class="validate"><?php echo e($errors->first('photo_id')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <ul class="btn-group form-bottom">
              <li>
                <?php echo Form::button(trans('category.buttons.create-new-category'), array('class' => 'form-btn btn-success btn-block text-white','type' => 'submit' )); ?>

              </li>
            </ul>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.upload-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/categories/create.blade.php ENDPATH**/ ?>