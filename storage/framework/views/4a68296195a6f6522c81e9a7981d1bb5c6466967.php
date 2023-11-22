

<?php $__env->startSection('template_title'); ?>
    <?php echo trans('profile.title-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('template_fastload_css'); ?>
    .inner-page .alert {
        max-width: 90rem;
        margin-left: auto;
        margin-right: auto;
    }
<?php $__env->stopSection(); ?>

<?php
    $levelAmount = trans('usersmanagement.labelUserLevel');
    if ($user->level() >= 2) {
        $levelAmount = trans('usersmanagement.labelUserLevels');
    }
?>

<?php $__env->startSection('content'); ?>

<div class="dashboard-wrapper">
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead text-center">
                <?php echo trans('profile.title-alt'); ?>

            </h3>
        </div>
        <div class="card-body">
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title"><?php echo e(__('新規カーポートの登録')); ?></h3>
                <div class="card-body">
                    <form action="" method="post" class="form">
                    <?php echo Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="action" value="update">
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="uuid" class="label"><?php echo e(__('販売店ID')); ?></label>
                                    <p class="noinput"><?php echo e($user->uuid); ?></p>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="company" class="label"><?php echo e(__('販売店名称')); ?></label>
                                    <input type="text" class="form-control md<?php echo e($errors->has('company') ? ' is-invalid' : ''); ?>" name="company" value="<?php echo e($user->company); ?>" placeholder="例）株式会社株式会社ティーエムユニオン" autofocus>
                                    <?php if($errors->has('company')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('company')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="zipcode" class="label"><?php echo e(__('郵便番号')); ?></label>
                                    <input type="text" class="form-control sd<?php echo e($errors->has('zipcode') ? ' is-invalid' : ''); ?>" name="zipcode" value="<?php echo e($user->zipcode); ?>" placeholder="例）310-0851">
                                    <?php if($errors->has('zipcode')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('zipcode')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="form-row">
                                    <div class="form-col">
                                        <div class="input-group">
                                            <label for="address1" class="label"><?php echo e(__('住所1')); ?></label>
                                            <input type="text" class="form-control sm<?php echo e($errors->has('address1') ? ' is-invalid' : ''); ?>" name="address1" value="<?php echo e($user->address1); ?>" placeholder="例）茨城県水戸市千波町1950">
                                            <?php if($errors->has('address1')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('address1')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-col">
                                        <div class="input-group">
                                            <label for="address2" class="label"><?php echo e(__('住所2')); ?></label>
                                            <input type="text" class="form-control sm<?php echo e($errors->has('address2') ? ' is-invalid' : ''); ?>" name="address2" value="<?php echo e($user->address2); ?>" placeholder="例）ウェーブ21ビル2F">
                                            <?php if($errors->has('address2')): ?>
                                                <p class="invalid-feedback"><?php echo e($errors->first('address2')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="phone" class="label"><?php echo e(__('連絡先')); ?></label>
                                    <input type="text" class="form-control sm<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" name="phone" value="<?php echo e($user->phone); ?>" placeholder="例）029-303-8581">
                                    <?php if($errors->has('phone')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('phone')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="email" class="label"><?php echo e(__('メールアドレス')); ?></label>
                                    <input type="email" class="form-control md<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" name="email" value="<?php echo e($user->email); ?>" placeholder="例）info@example.com">
                                    <?php if($errors->has('email')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('email')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label"><?php echo e(__('担当者')); ?></label>
                                    <input type="text" class="form-control sm<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($user->name); ?>" placeholder="例）山田太郎">
                                    <?php if($errors->has('name')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('name')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            <?php echo Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title"><?php echo e(__('契約情報変更')); ?></h3>
                <div class="card-body">
                    <?php echo Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="action" value="term">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="deadline" class="label"><?php echo e(__('締め日')); ?></label>
                                    <ul class="choice-group">
                                        <li>
                                            <label class="form-radiobox">10日
                                                <input type="radio" name="deadline" value="10" <?php if((int)$user->term->deadline === 10): ?> checked <?php endif; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="form-radiobox">20日
                                                <input type="radio" name="deadline" value="20" <?php if((int)$user->term->deadline === 20): ?> checked <?php endif; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>
                                        <li>
                                            <label class="form-radiobox">末日
                                                <input type="radio" name="deadline" value="30" <?php if((int)$user->term->deadline === 30): ?> checked <?php endif; ?>>
                                                <span class="checkmark"></span>
                                            </label>
                                        </li>

                                    </ul>
                                    <?php if($errors->has('deadline')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('deadline')); ?></p>
                                    <?php endif; ?>

                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="comment" class="label"><?php echo e(__('備考')); ?></label>
                                    <textarea class="form-control xs<?php echo e($errors->has('comment') ? ' is-invalid' : ''); ?>" name="comment" id="comment" rows="8" placeholder="ここに備考を入力してください"><?php echo e($user->term->comment); ?></textarea>
                                    <?php if($errors->has('comment')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('comment')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            <?php echo Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div class="form-card mb-50 mb-sp-40">
                <h3 class="card-title"><?php echo e(__('口座情報')); ?></h3>
                <div class="card-body">
                    <?php echo Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="action" value="bank">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="name" class="label"><?php echo e(__('金融機関名')); ?></label>
                                    <input type="text" class="form-control sm<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" name="name" value="<?php echo e($user->bank->name); ?>" placeholder="<?php echo e(__('例）日本銀行')); ?>">
                                    <?php if($errors->has('name')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('name')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="branch" class="label"><?php echo e(__('支店名')); ?></label>
                                    <input type="text" class="form-control sd<?php echo e($errors->has('branch') ? ' is-invalid' : ''); ?>" name="branch" value="<?php echo e($user->bank->branch); ?>" placeholder="<?php echo e(__('例）東京支店')); ?>">
                                    <?php if($errors->has('branch')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('branch')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="kind" class="label"><?php echo e(__('種別')); ?></label>
                                    <input type="text" class="form-control sd<?php echo e($errors->has('kind') ? ' is-invalid' : ''); ?>" name="kind" value="<?php echo e($user->bank->kind); ?>" placeholder="<?php echo e(__('例）普通')); ?>">
                                    <?php if($errors->has('kind')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('kind')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="number" class="label"><?php echo e(__('口座番号')); ?></label>
                                    <input type="text" class="form-control sm<?php echo e($errors->has('number') ? ' is-invalid' : ''); ?>" name="number" value="<?php echo e($user->bank->number); ?>" placeholder="<?php echo e(__('例）12345678')); ?>">
                                    <?php if($errors->has('number')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('number')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="holder" class="label"><?php echo e(__('口座名義')); ?></label>
                                    <input type="text" class="form-control sm<?php echo e($errors->has('holder') ? ' is-invalid' : ''); ?>" name="holder" value="<?php echo e($user->bank->holder); ?>" placeholder="<?php echo e(__('例）ヤマダタロウ')); ?>">
                                    <?php if($errors->has('holder')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('holder')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            <?php echo Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
            <div class="form-card">
                <h3 class="card-title"><?php echo e(__('パスワード変更')); ?></h3>
                <div class="card-body">
                    <?php echo Form::open(array('route' => ['profile.update', $user->uuid], 'method' => 'PATCH', 'role' => 'form', 'class' => 'form needs-validation')); ?>

                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="action" value="password">    
                        <ul class="form-group">
                            <li>
                                <div class="input-group">
                                    <label for="old_password" class="label"><?php echo e(__('現在のパスワード')); ?></label>
                                    <input type="password" class="form-control sm<?php echo e($errors->has('old_password') ? ' is-invalid' : ''); ?>" name="old_password" value="<?php echo e(old('old_password')); ?>">
                                    <?php if($errors->has('old_password')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('old_password')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="password" class="label"><?php echo e(__('新しいパスワード')); ?></label>
                                    <input type="password" class="form-control sm<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" name="password" value="<?php echo e(old('password')); ?>">
                                    <?php if($errors->has('password')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('password')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                            <li>
                                <div class="input-group">
                                    <label for="password_confirmation" class="label"><?php echo e(__('新しいパスワード（確認）')); ?></label>
                                    <input type="password" class="form-control sm<?php echo e($errors->has('password_confirmation') ? ' is-invalid' : ''); ?>" name="password_confirmation" value="<?php echo e(old('password_confirmation')); ?>">
                                    <?php if($errors->has('password_confirmation')): ?>
                                        <p class="invalid-feedback"><?php echo e($errors->first('password_confirmation')); ?></p>
                                    <?php endif; ?>
                                </div>
                            </li>
                        </ul>
                        <div class="form-action">
                            <?php echo Form::button(trans('profile.buttons.update'), array('class' => 'btn btn-info', 'type' => 'submit' ) ); ?>

                        </div>
                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php if(config('usersmanagement.tooltipsEnabled')): ?>
<?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\carport-club\resources\views/profiles/show.blade.php ENDPATH**/ ?>