

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('usersmanagement.showing-user', ['name' => $user->name]); ?>

<?php $__env->stopSection(); ?>

<?php
  $levelAmount = trans('usersmanagement.labelUserLevel');
  if ($user->level() >= 2) {
    $levelAmount = trans('usersmanagement.labelUserLevels');
  }
?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('usersmanagement.showing-user-title', ['name' => $user->name]); ?></h3>
          <ul class="actions">
            <li>
              <a href="<?php echo e(route('users')); ?>" class="action-btn">
                <?php echo trans('usersmanagement.buttons.back-to-users'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form">
          <div class="user-single">
            <div class="row">
              <div class="col-sm-4 offset-sm-2 col-md-2 offset-md-2">
                <img src="<?php if($user->profile && $user->profile->avatar_status == 1): ?> <?php echo e($user->profile->avatar); ?> <?php else: ?> <?php echo e(asset('images/user.jpg')); ?> <?php endif; ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle center-block user-image">
              </div>
              <div class="col-sm-4 col-md-5">
                <h4 class="name"><?php echo e($user->name); ?></h4>
                <p class="full-name"><?php echo e($user->name_kanji); ?> (<?php echo e($user->name_frigana); ?>)</p>
                <p class="email"><?php echo e(Html::mailto($user->email, $user->email)); ?></p>
                <?php if($user->profile): ?>
                  <ul class="actions">
                    <li>
                      <a href="<?php echo e(url('/profile/'.$user->name)); ?>" class="btn btn-sm btn-info">
                        <i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> <?php echo e(trans('usersmanagement.viewProfile')); ?></span>
                      </a>
                    </li>
                    <li>
                      <a href="/users/<?php echo e($user->id); ?>/edit" class="btn btn-sm btn-warning">
                        <i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md"> <?php echo e(trans('usersmanagement.editUser')); ?> </span>
                      </a>
                    </li>
                    <li>
                      <?php echo Form::open(array('url' => 'users/' . $user->id, 'class' => 'form-inline')); ?>

                        <?php echo Form::hidden('_method', 'DELETE'); ?>

                        <?php echo Form::button('<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm hidden-md">' . trans('usersmanagement.deleteUser') . '</span>' , array('class' => 'btn btn-danger btn-sm','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'ユーザー削除', 'data-message' => trans("usersmanagement.modals.delete_user_message"))); ?>

                      <?php echo Form::close(); ?>

                    </li>
                  </ul>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <table class="form-table">
            <tbody>
              <tr>
                <th colspan="2" width="330px">メールアドレス</th>
                <td><?php echo e(HTML::mailto($user->email, $user->email)); ?></td>
              </tr>
              <tr>
                <th colspan="2">ニックネーム</th>
                <td><?php echo e($user->name); ?></td>
              </tr>
              <tr>
                <th colspan="2">権限</th>
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
              </tr>
              <tr>
                <th rowspan="2" width="100px">氏名</th>
                <th class="sub-th" width="230px">漢字</th>
                <td><?php echo e($user->name_kanji); ?></td>
              </tr>
              <tr>
                <th class="sub-th">カナ</th>
                <td><?php echo e($user->name_frigana); ?></td>
              </tr>
              <tr>
                <th rowspan="2">会社名</th>
                <th class="sub-th">漢字</th>
                <td><?php echo e($user->company_kanji); ?></td>
              </tr>
              <tr>
                <th class="sub-th">カナ</th>
                <td><?php echo e($user->company_frigana); ?></td>
              </tr>
              <tr>
                <th rowspan="3">会社住所</th>
                <th class="sub-th">郵便番号</th>
                <td><?php echo e($user->company_zipcode); ?></td>
              </tr>
              <tr>
                <th class="sub-th">都道府県</th>
                <td><?php echo e($user->company_prefecture); ?></td>
              </tr>
              <tr>
                <th class="sub-th">市区町村・番地・建物名等</th>
                <td><?php echo e($user->company_address); ?></td>
              </tr>
              <tr>
                <th colspan="2">状態</th>
                <td>
                  <?php if($user->activated == 1): ?>
                    <span class="badge badge-success">
                      Activated
                    </span>
                  <?php else: ?>
                    <span class="badge badge-danger">
                      Not-Activated
                    </span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th colspan="2">アクセスレベル</th>
                <td>
                  <?php if($user->level() >= 5): ?>
                  <span class="badge badge-primary mr_5">5</span>
                  <?php endif; ?>

                  <?php if($user->level() >= 4): ?>
                    <span class="badge badge-info mr_5">4</span>
                  <?php endif; ?>

                  <?php if($user->level() >= 3): ?>
                    <span class="badge badge-success mr_5">3</span>
                  <?php endif; ?>

                  <?php if($user->level() >= 2): ?>
                    <span class="badge badge-warning mr_5">2</span>
                  <?php endif; ?>

                  <?php if($user->level() >= 1): ?>
                    <span class="badge badge-default mr_5">1</span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th colspan="2">特権</th>
                <td>
                  <?php if($user->canViewUsers()): ?>
                    <span class="badge badge-primary mr_5">
                      <?php echo e(trans('permsandroles.permissionView')); ?>

                    </span>
                  <?php endif; ?>

                  <?php if($user->canCreateUsers()): ?>
                    <span class="badge badge-info mr_5">
                      <?php echo e(trans('permsandroles.permissionCreate')); ?>

                    </span>
                  <?php endif; ?>

                  <?php if($user->canEditUsers()): ?>
                    <span class="badge badge-warning mr_5">
                      <?php echo e(trans('permsandroles.permissionEdit')); ?>

                    </span>
                  <?php endif; ?>

                  <?php if($user->canDeleteUsers()): ?>
                    <span class="badge badge-danger mr_5">
                      <?php echo e(trans('permsandroles.permissionDelete')); ?>

                    </span>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th colspan="2">登録日</th>
                <td><?php echo e(date_format($user->created_at,"Y年m月d日 H:i")); ?></td>
              </tr>
              <tr>
                <th colspan="2">更新日</th>
                <td><?php echo e(date_format($user->updated_at,"Y年m月d日 H:i")); ?></td>
              </tr>
              <tr>
                <th colspan="2">メール登録IP</th>
                <td><code><?php echo e($user->signup_ip_address); ?></code></td>
              </tr>
              <tr>
                <th colspan="2">メール確認IP</th>
                <td><code><?php echo e($user->signup_confirmation_ip_address); ?></code></td>
              </tr>
              <tr>
                <th colspan="2">最終更新IP</th>
                <td><code><?php echo e($user->updated_ip_address); ?></code></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('usersmanagement.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/usersmanagement/show-user.blade.php ENDPATH**/ ?>