

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('area.showing-all-area'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('area.editing-area', ['name' => $area->name]); ?></h3>
          <ul class="actions">
            <li>
              <a class="btn btn-secondary text-white" href="<?php echo e(route('areas')); ?>">
                <?php echo trans('area.buttons.back-to-areas'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form">
          <?php echo Form::open(array('route' => ['areas.update', $area->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')); ?>

            <?php echo csrf_field(); ?>

            <table class="form-table">
              <tbody>
                <tr>
                  <th width="150px"><?php echo trans('area.labels.name'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name', $area->name, array('id' => 'name' )); ?>

                      <?php if($errors->has('name')): ?>
                        <p class="validate"><?php echo e($errors->first('name')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th><?php echo trans('area.labels.desc'); ?></th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('description', $area->description, array('id' => 'description' )); ?>

                      <?php if($errors->has('description')): ?>
                        <p class="validate"><?php echo e($errors->first('description')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <ul class="btn-group form-bottom">
              <li>
                <?php echo Form::button(trans('forms.save-changes'), array('class' => 'form-btn btn-success btn-block text-white btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('area.modals.confirm_title'), 'data-message' => trans('area.modals.confirm_message'))); ?>

              </li>
            </ul>
          <?php echo Form::close(); ?>

        </div>
      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-save', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/areas/edit.blade.php ENDPATH**/ ?>