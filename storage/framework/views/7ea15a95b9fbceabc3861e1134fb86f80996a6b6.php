

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('profile.profile-edit-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_linked_css'); ?>
  <style type="text/css">
    .pw-change-container {
        display: none;
    }
  </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('profile.profile-edit-alt'); ?></h3>
          <ul class="actions">
            <li>
              <a href="<?php echo e(url('profile/' . $user->name)); ?>" class="action-btn">
                <?php echo trans('profile.buttons.back'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="common-form">
          <?php echo Form::open(array('route' => ['profile.update', $user->name], 'method' => 'PATCH', 'role' => 'form', 'class' => 'needs-validation')); ?>

            <?php echo csrf_field(); ?>

            <table class="form-table">
              <tbody>
                <tr>
                  <th colspan="2" width="330px">メールアドレス</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('email', $user->email, array('id' => 'email' )); ?>

                      <?php if($errors->has('email')): ?>
                        <p class="validate"><?php echo e($errors->first('email')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th colspan="2">ニックネーム</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name', $user->name, array('id' => 'name' )); ?>

                      <?php if($errors->has('name')): ?>
                        <p class="validate"><?php echo e($errors->first('name')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th rowspan="2" width="100px">氏名</th>
                  <th class="sub-th" width="230px">漢字</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name_kanji', $user->name_kanji, array('id' => 'name_kanji' )); ?>

                      <?php if($errors->has('name_kanji')): ?>
                        <p class="validate"><?php echo e($errors->first('name_kanji')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="sub-th">カナ</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('name_frigana', $user->name_frigana, array('id' => 'name_frigana' )); ?>

                      <?php if($errors->has('name_kanji')): ?>
                        <p class="validate"><?php echo e($errors->first('name_frigana')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th rowspan="2">会社名</th>
                  <th class="sub-th">漢字</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('company_kanji', $user->profile->company_kanji, array('id' => 'company_kanji' )); ?>

                      <?php if($errors->has('company_kanji')): ?>
                        <p class="validate"><?php echo e($errors->first('company_kanji')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="sub-th">カナ</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('company_frigana', $user->profile->company_frigana, array('id' => 'company_frigana' )); ?>

                      <?php if($errors->has('company_frigana')): ?>
                        <p class="validate"><?php echo e($errors->first('company_frigana')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th rowspan="3">会社住所</th>
                  <th class="sub-th">郵便番号</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('company_zipcode', $user->profile->company_zipcode, array('id' => 'company_zipcode', 'class' => 'sm', 'onKeyUp' => "AjaxZip3.zip2addr(this,'','company_prefecture','company_address');" )); ?>

                      <?php if($errors->has('company_zipcode')): ?>
                        <p class="validate"><?php echo e($errors->first('company_zipcode')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="sub-th">都道府県</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('company_prefecture', $user->profile->company_prefecture, array('id' => 'company_prefecture' )); ?>

                      <?php if($errors->has('company_prefecture')): ?>
                        <p class="validate"><?php echo e($errors->first('company_prefecture')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr>
                  <th class="sub-th">市区町村・番地・建物名等</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::text('company_address', $user->profile->company_address, array('id' => 'company_address' )); ?>

                      <?php if($errors->has('company_address')): ?>
                        <p class="validate"><?php echo e($errors->first('company_address')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr class="pw-change-container">
                  <th colspan="2">パスワード</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::password('password', array('id' => 'password' )); ?>

                      <?php if($errors->has('password')): ?>
                        <p class="validate"><?php echo e($errors->first('password')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
                <tr class="pw-change-container">
                  <th colspan="2">パスワード再入力</th>
                  <td>
                    <div class="form_input">
                      <?php echo Form::password('password_confirmation', array('id' => 'password_confirmation' )); ?>

                      <?php if($errors->has('password_confirmation')): ?>
                        <p class="validate"><?php echo e($errors->first('password_confirmation')); ?></p>
                      <?php endif; ?>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
            <ul class="btn-group form-bottom">
              <li>
                <button type="button" class="form-btn btn-secondary btn-block btn-change-pw">
                  <?php echo trans('forms.change-pw'); ?>

                </button>
              </li>
              <li>
                <?php echo Form::button(trans('forms.save-changes'), array('class' => 'form-btn btn-success btn-block btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))); ?>

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
  <?php echo $__env->make('scripts.check-changed', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/profiles/edit.blade.php ENDPATH**/ ?>