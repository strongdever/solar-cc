

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('usersmanagement.menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="dashboard-card">
        <div class="common-caption">
            <h3 class="label y-padding"><?php echo trans('usersmanagement.titles.create-alt'); ?></h3>
            <ul class="actions">
                <li>
                    <a class="btn btn-secondary text-white" href="<?php echo e(route('stores')); ?>">
                        <?php echo trans('usersmanagement.buttons.back-to-list'); ?>

                    </a>
                </li>
            </ul>
        </div>
        <div class="common-form">
            <?php echo Form::open(array('route' => 'stores.store', 'method' => 'POST', 'role' => 'form', 'class' => 'form needs-validation')); ?>

                <?php echo csrf_field(); ?>

                <div class="form-card mb-40 mb-sp-30">
                    <h3 class="card-title"><?php echo e(__('販売店情報')); ?></h3>
                    <div class="card-body">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><?php echo e(__('販売店ID')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('uuid') ? ' is-invalid' : ''); ?>" name="uuid" value="<?php echo e(old('uuid')); ?>" placeholder="<?php echo e(__('例）carport123')); ?>" autofocus>
                                            <?php if($errors->has('uuid')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('uuid')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('販売店名称')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('company') ? ' is-invalid' : ''); ?>" name="company" value="<?php echo e(old('company')); ?>" placeholder="<?php echo e(__('例）株式会社カーポートソーラーシステム')); ?>">
                                            <?php if($errors->has('company')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('company')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('郵便番号')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('zipcode') ? ' is-invalid' : ''); ?>" name="zipcode" value="<?php echo e(old('zipcode')); ?>" placeholder="<?php echo e(__('例）310-0851')); ?>">
                                            <?php if($errors->has('zipcode')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('zipcode')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('住所1')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('address1') ? ' is-invalid' : ''); ?>" name="address1" value="<?php echo e(old('address1')); ?>" placeholder="<?php echo e(__('例）茨城県水戸市千波町1950')); ?>">
                                            <?php if($errors->has('address1')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('address1')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('住所2')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('address2') ? ' is-invalid' : ''); ?>" name="address2" value="<?php echo e(old('address2')); ?>" placeholder="<?php echo e(__('例）ウェーブ21ビル2F')); ?>">
                                            <?php if($errors->has('address2')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('address2')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('連絡先')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="tel" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" name="phone" value="<?php echo e(old('phone')); ?>" placeholder="<?php echo e(__('例）029-303-8581')); ?>">
                                            <?php if($errors->has('phone')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('phone')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('メールアドレス')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('例）info@example.com')); ?>">
                                            <?php if($errors->has('email')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('email')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('担当者')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo e(__('例）山田太郎')); ?>">
                                            <?php if($errors->has('name')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('name')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('権限')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <select name="role" id="role">
                                                <option value=""><?php echo e(trans('forms.create_user_ph_role')); ?></option>
                                                <?php if($roles): ?>
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if($errors->has('role')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('role')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                    </div>
                </div>
                <div class="form-card mb-40 mb-sp-30">
                    <h3 class="card-title"><?php echo e(__('契約情報')); ?></h3>
                    <div class="card-body">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><?php echo e(__('締め日')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <ul class="choice-group">
                                                <li>
                                                    <label class="form-radiobox">10日
                                                        <input type="radio" name="deadline" value="10">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="form-radiobox">20日
                                                        <input type="radio" name="deadline" value="20">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="form-radiobox">末日
                                                        <input type="radio" name="deadline" value="30">
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </li>
                                            </ul>
                                            <?php if($errors->has('deadline')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('deadline')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('備考')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <textarea class="form-control<?php echo e($errors->has('comment') ? ' is-invalid' : ''); ?>" name="comment" id="comment" rows="8" placeholder="<?php echo e(__('ここに備考を入力してください')); ?>"><?php echo e(old('comment')); ?></textarea>
                                            <?php if($errors->has('comment')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('comment')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-card mb-40 mb-sp-30">
                    <h3 class="card-title"><?php echo e(__('口座情報')); ?></h3>
                    <div class="card-body">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><?php echo e(__('金融機関名')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('bank_name') ? ' is-invalid' : ''); ?>" name="bank_name" value="<?php echo e(old('bank_name')); ?>" placeholder="<?php echo e(__('例）日本銀行')); ?>">
                                            <?php if($errors->has('bank_name')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('bank_name')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('支店名')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('bank_branch') ? ' is-invalid' : ''); ?>" name="bank_branch" value="<?php echo e(old('bank_branch')); ?>" placeholder="<?php echo e(__('例）東京支店')); ?>">
                                            <?php if($errors->has('bank_branch')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('bank_branch')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('種別')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('bank_kind') ? ' is-invalid' : ''); ?>" name="bank_kind" value="<?php echo e(old('bank_kind')); ?>" placeholder="<?php echo e(__('例）普通')); ?>">
                                            <?php if($errors->has('bank_kind')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('bank_kind')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('口座番号')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('bank_number') ? ' is-invalid' : ''); ?>" name="bank_number" value="<?php echo e(old('bank_number')); ?>" placeholder="<?php echo e(__('例）12345678')); ?>">
                                            <?php if($errors->has('bank_number')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('bank_number')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('口座名義')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="text" class="form-control<?php echo e($errors->has('bank_holder') ? ' is-invalid' : ''); ?>" name="bank_holder" value="<?php echo e(old('bank_holder')); ?>" placeholder="<?php echo e(__('例）ヤマダタロウ')); ?>">
                                            <?php if($errors->has('bank_holder')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('bank_holder')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-card mb-40 mb-sp-30">
                    <h3 class="card-title"><?php echo e(__('パスワード設定')); ?></h3>
                    <div class="card-body">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><?php echo e(__('パスワード')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" value="<?php echo e(old('password')); ?>">
                                            <?php if($errors->has('password')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('password')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th><?php echo e(__('パスワード（確認）')); ?></th>
                                    <td>
                                        <div class="form-input">
                                            <input type="password" class="form-control<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?>" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>">
                                            <?php if($errors->has('password_confirmation')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <ul class="btn-group form-bottom">
                    <li>
                        <?php echo Form::button(trans('usersmanagement.buttons.create-alt'), array('class' => 'btn form-btn btn-info','type' => 'submit' )); ?>

                    </li>
                </ul>
            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/cptc/www/resources/views/usersmanagement/create-user.blade.php ENDPATH**/ ?>