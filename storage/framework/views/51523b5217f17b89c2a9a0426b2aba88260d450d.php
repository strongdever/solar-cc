

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('category.showing-all-categories'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('category.showing-category', ['name' => $category->name]); ?></h3>
          <ul class="actions">
            <li>
              <a class="btn btn-secondary text-white" href="<?php echo e(route('categories')); ?>">
                <?php echo trans('category.buttons.back-to-categories'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form">
          <table class="form-table">
            <tbody>
              <tr>
                <th width="150px"><?php echo trans('category.labels.name'); ?></th>
                <td><?php echo e($category->name); ?></td>
              </tr>
              <tr>
                <th><?php echo trans('category.labels.desc'); ?></th>
                <td><?php echo e($category->description); ?></td>
              </tr>
              <tr>
                <th><?php echo trans('category.labels.image'); ?></th>
                <td>
                  <img style="width: 180px; height: 180px; object-fit: cover; vertical-align: middle;" src="<?php echo e(asset( $category->photo->path )); ?>" alt="<?php echo e($category->name); ?>">
                </td>
              </tr>
            </tbody>
          </table>
          <ul class="btn-group form-bottom">
            <li>
              <a class="form-btn btn-info btn-block text-white" href="<?php echo e(URL::to('categories/' . $category->id . '/edit')); ?>">
                <?php echo trans("category.buttons.edit-category"); ?>

              </a>
            </li>
            <li>
              <?php echo Form::open(array('url' => 'categories/' . $category->id, 'class' => '')); ?>

                <?php echo Form::hidden('_method', 'DELETE'); ?>

                <?php echo Form::button(trans('category.buttons.delete-category'), array('class' => 'form-btn btn-danger btn-block text-white','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("category.modals.delete_title"), 'data-message' => trans("category.modals.delete_message"))); ?>

              <?php echo Form::close(); ?>

            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/categories/index.blade.php ENDPATH**/ ?>