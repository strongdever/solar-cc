<?php echo e(csrf_field()); ?>


<table class="form-table">
    <tbody>
        <tr>
            <th width="300px">
                <?php echo e(trans("laravelroles::laravelroles.forms.permissions-form.permission-name.label")); ?>

            </th>
            <td>
                <div class="form_input">
                <input type="text" id="name" name="name" value="<?php echo e($name); ?>" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.permissions-form.permission-name.placeholder')); ?>">
                    <?php if($errors->has('name')): ?>
                        <p class="validate"><?php echo e($errors->first('name')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.permissions-form.permission-slug.label")); ?>

            </th>
            <td>
                <div class="form_input">
                <input type="text" id="slug" name="slug" value="<?php echo e($slug); ?>" onkeypress="return numbersAndLettersOnly()" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.permissions-form.permission-slug.placeholder')); ?>">
                    <?php if($errors->has('slug')): ?>
                        <p class="validate"><?php echo e($errors->first('slug')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.permissions-form.permission-desc.label")); ?>

            </th>
            <td>
                <div class="form_input">
                    <textarea id="description" name="description" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.permissions-form.permission-desc.placeholder')); ?>"><?php echo e($description); ?></textarea>
                    <?php if($errors->has('description')): ?>
                        <p class="validate"><?php echo e($errors->first('description')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.permissions-form.permission-model.label")); ?>

            </th>
            <td>
                <div class="form_input">
                    <select name="model" id="model">
                        <option value=""><?php echo e(trans("laravelroles::laravelroles.forms.permissions-form.permission-model.placeholder")); ?></option>
                        <?php $__currentLoopData = $permissionModels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permissionModel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option <?php if($permissionModel == $model): ?> selected <?php endif; ?> value="<?php echo e($permissionModel); ?>">
                                <?php echo e($permissionModel); ?>

                            </option>}
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </td>
        </tr>
        
    </tbody>
</table><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/forms/permission-form.blade.php ENDPATH**/ ?>