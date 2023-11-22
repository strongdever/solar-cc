

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('usersmanagement.create-new-user'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="l_lead_section">
  <div class="container">
    <div class="common-form-wrapper">
      <div class="common-caption">
        <h3 class="label y-padding"><?php echo trans('usersmanagement.create-new-user'); ?></h3>
        <ul class="actions">
          <li>
            <a href="<?php echo e(route('users')); ?>" class="action-btn">
              <?php echo trans('usersmanagement.buttons.back-to-users'); ?>

            </a>
          </li>
        </ul>
      </div>
      <div class="common-form">
        <?php echo Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

          <?php echo csrf_field(); ?>

          <table class="form-table">
            <tbody>
              <tr>
                <th colspan="2" width="330px">メールアドレス</th>
                <td>
                  <div class="form_input">
                    <?php echo Form::text('email', NULL, array('id' => 'email' )); ?>

                    <?php if($errors->has('email')): ?>
                      <p class="validate"><?php echo e($errors->first('email')); ?></p>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <tr>
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
              <tr>
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
              <tr>
                <th colspan="2">ニックネーム</th>
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
                <th colspan="2">役割</th>
                <td>
                  <div class="form_input">
                    <select name="role" id="role">
                      <option value=""><?php echo e(trans('forms.create_user_ph_role')); ?></option>
                      <?php if($roles): ?>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      <?php endif; ?>
                    </select>
                    <?php if($errors->has('role')): ?>
                      <p class="validate"><?php echo e($errors->first('role')); ?></p>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
              <tr>
                <th rowspan="2" width="100px">氏名</th>
                <th class="sub-th" width="230px">漢字</th>
                <td>
                  <div class="form_input">
                    <?php echo Form::text('name_kanji', NULL, array('id' => 'name_kanji' )); ?>

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
                    <?php echo Form::text('name_frigana', NULL, array('id' => 'name_frigana' )); ?>

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
                    <?php echo Form::text('company_kanji', NULL, array('id' => 'company_kanji' )); ?>

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
                    <?php echo Form::text('company_frigana', NULL, array('id' => 'company_frigana' )); ?>

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
                    <?php echo Form::text('company_zipcode', NULL, array('id' => 'company_zipcode', 'class' => 'sm', 'onKeyUp' => "AjaxZip3.zip2addr(this,'','company_prefecture','company_address');" )); ?>

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
                    <?php echo Form::text('company_prefecture', NULL, array('id' => 'company_prefecture' )); ?>

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
                    <?php echo Form::text('company_address', NULL, array('id' => 'company_address' )); ?>

                    <?php if($errors->has('company_address')): ?>
                      <p class="validate"><?php echo e($errors->first('company_address')); ?></p>
                    <?php endif; ?>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <ul class="btn-group form-bottom">
            <li>
              <?php echo Form::button(trans('forms.create_user_button_text'), array('class' => 'form-btn btn-success','type' => 'submit' )); ?>

            </li>
          </ul>
        <?php echo Form::close(); ?>

      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/usersmanagement/create-user.blade.php ENDPATH**/ ?>