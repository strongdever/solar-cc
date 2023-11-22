

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('usersmanagement.showing-all-users'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <?php if(config('usersmanagement.enabledDatatablesJs')): ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(config('usersmanagement.datatablesCssCDN')); ?>">
  <?php endif; ?>
    <style type="text/css" media="screen">
      .users-table {
          border: 0;
      }
      .users-table tr td:first-child {
          padding-left: 15px;
      }
      .users-table tr td:last-child {
          padding-right: 15px;
      }
      .users-table.table-responsive,
      .users-table.table-responsive table {
          margin-bottom: 0;
      }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <div class="common-caption">
        <h3 class="label y-padding"><?php echo trans('usersmanagement.showing-all-users'); ?></h3>
        <ul class="actions">
          <li>
            <a class="action-btn" href="<?php echo e(url('/users/create')); ?>">
              <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
              <?php echo trans('usersmanagement.buttons.create-new'); ?>

            </a>
          </li>
        </ul>
      </div>
      <div class="p-users-search mb_20">
        <?php if(config('usersmanagement.enableSearchUsers')): ?>
          <?php echo $__env->make('partials.search-users-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
      </div>
      <div class="scroll">
        <table class="table table-sm data-table">
          <caption id="user_count">
            <?php echo e(trans_choice('usersmanagement.users-table.caption', 1, ['userscount' => $users->count()])); ?>

          </caption>
          <thead class="thead">
            <tr>
              <th width="50px"><?php echo trans('usersmanagement.users-table.id'); ?></th>
              <th width="150px"><?php echo trans('usersmanagement.users-table.name'); ?></th>
              <th width="210px" class="hidden-xs"><?php echo trans('usersmanagement.users-table.email'); ?></th>
              <th width="90px" class="hidden-xs"><?php echo trans('usersmanagement.users-table.kname'); ?></th>
              <th width="100px"><?php echo trans('usersmanagement.users-table.role'); ?></th>
              <th width="160px" class="hidden-sm hidden-xs hidden-md"><?php echo trans('usersmanagement.users-table.created'); ?></th>
              <th width="160px" class="hidden-sm hidden-xs hidden-md"><?php echo trans('usersmanagement.users-table.updated'); ?></th>
              <th width="8" colspan="3"><?php echo trans('usersmanagement.users-table.actions'); ?></th>
            </tr>
          </thead>
          <tbody id="users_table">
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($user->id); ?></td>
                <td><?php echo e($user->name); ?></td>
                <td class="hidden-xs"><a href="mailto:<?php echo e($user->email); ?>" title="email <?php echo e($user->email); ?>"><?php echo e($user->email); ?></a></td>
                <td class="hidden-xs"><?php echo e($user->name_kanji); ?></td>
                <td>
                  <?php $__currentLoopData = $user->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($user_role->name == 'User'): ?>
                        <?php $badgeClass = 'primary' ?>
                    <?php elseif($user_role->name == 'Admin'): ?>
                        <?php $badgeClass = 'warning' ?>
                    <?php elseif($user_role->name == 'Unverified'): ?>
                        <?php $badgeClass = 'danger' ?>
                    <?php else: ?>
                        <?php $badgeClass = 'default' ?>
                    <?php endif; ?>
                    <span class="badge badge-<?php echo e($badgeClass); ?>"><?php echo e($user_role->name); ?></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </td>
                <td class="hidden-sm hidden-xs hidden-md"><?php echo e(date_format($user->created_at,"Y年m月d日 H:i")); ?></td>
                <td class="hidden-sm hidden-xs hidden-md"><?php echo e(date_format($user->updated_at,"Y年m月d日 H:i")); ?></td>
                <td class="action-td">
                  <?php echo Form::open(array('url' => 'users/' . $user->id, 'class' => '')); ?>

                    <?php echo Form::hidden('_method', 'DELETE'); ?>

                    <?php echo Form::button(trans('usersmanagement.buttons.delete'), array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'ユーザー削除', 'data-message' => trans("usersmanagement.modals.delete_user_message"))); ?>

                  <?php echo Form::close(); ?>

                </td>
                <td class="action-td">
                  <a class="btn btn-sm btn-success btn-block" href="<?php echo e(URL::to('users/' . $user->id)); ?>" data-toggle="tooltip" title="Show">
                    <?php echo trans('usersmanagement.buttons.show'); ?>

                  </a>
                </td>
                <td class="action-td">
                  <a class="btn btn-sm btn-info btn-block" href="<?php echo e(URL::to('users/' . $user->id . '/edit')); ?>" data-toggle="tooltip" title="Edit">
                    <?php echo trans('usersmanagement.buttons.edit'); ?>

                  </a>
                </td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
          <?php if(config('usersmanagement.enableSearchUsers')): ?>
            <tbody id="search_results"></tbody>
          <?php endif; ?>
        </table>
      </div>
      <div class="table-responsive users-table">
        <?php if(config('usersmanagement.enablePagination')): ?>
          <?php echo e($users->links()); ?>

        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php if((count($users) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs')): ?>
    <?php echo $__env->make('scripts.datatables', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('usersmanagement.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php if(config('usersmanagement.enableSearchUsers')): ?>
    <?php echo $__env->make('scripts.search-users', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/usersmanagement/show-users.blade.php ENDPATH**/ ?>