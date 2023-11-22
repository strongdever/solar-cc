

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('area.showing-all-area'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <link rel="stylesheet" type="text/css" href="<?php echo e(config('options.datatablesCssCDN')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="common-caption">
        <h3 class="label y-padding"><?php echo trans('area.showing-all-area'); ?></h3>
        <ul class="actions">
          <li>
            <a class="btn btn-secondary text-white" href="<?php echo e(url('/areas/create')); ?>">
              <?php echo trans('area.buttons.create'); ?>

            </a>
          </li>
        </ul>
      </div>
      <div class="scroll">
        <table class="table table-sm data-table">
          <caption id="user_count">
            <?php echo e(trans('area.tables.caption', ['count' => $areas->count()])); ?>

          </caption>
          <thead class="thead">
            <tr>
              <th width="60px"><?php echo trans('area.tables.id'); ?></th>
              <th width="150px"><?php echo trans('area.tables.name'); ?></th>
              <th width="390px" class="hidden-xs"><?php echo trans('area.tables.desc'); ?></th>
              <th width="160px" class="hidden-sm hidden-xs hidden-md"><?php echo trans('area.tables.created'); ?></th>
              <th width="160px" class="hidden-sm hidden-xs hidden-md"><?php echo trans('area.tables.updated'); ?></th>
              <th colspan="3"><?php echo trans('area.tables.actions'); ?></th>
            </tr>
          </thead>
          <tbody id="users_table">
            <?php $__currentLoopData = $areas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($area->id); ?></td>
                <td><?php echo e($area->name); ?></td>
                <td class="hidden-xs"><?php echo e($area->description); ?></td>
                <td class="hidden-sm hidden-xs hidden-md"><?php echo e($area->created_at->format("Y年m月d日 H:i")); ?></td>
                <td class="hidden-sm hidden-xs hidden-md"><?php echo e($area->updated_at->format("Y年m月d日 H:i")); ?></td>
                <td class="action-td">
                  <?php echo Form::open(array('url' => 'areas/' . $area->id, 'class' => '')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('area.buttons.delete'), array('class' => 'btn btn-sm btn-danger btn-block','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans("area.modals.delete_title"), 'data-message' => trans("area.modals.delete_message"))); ?>

                  <?php echo Form::close(); ?>

                </td>
                <td class="action-td">
                  <a class="btn btn-sm btn-success btn-block" href="<?php echo e(URL::to('areas/' . $area->id)); ?>">
                    <?php echo trans('area.buttons.show'); ?>

                  </a>
                </td>
                <td class="action-td">
                  <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('areas/' . $area->id . '/edit')); ?>">
                    <?php echo trans('area.buttons.edit'); ?>

                  </a>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="table-responsive data-table">
        <?php echo e($areas->links()); ?>

      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php if((count($areas) > config('options.datatablesJsStartCount'))): ?>
    <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/areas/show.blade.php ENDPATH**/ ?>