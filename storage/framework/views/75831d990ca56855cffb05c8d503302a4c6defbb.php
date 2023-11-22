<?php echo e(csrf_field()); ?>


<table class="form-table">
    <tbody>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-name.label")); ?>

            </th>
            <td>
                <div class="form-input">
                    <input type="text" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>" id="name" name="name" value="<?php echo e($name); ?>" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.roles-form.role-name.placeholder')); ?>">
                    <?php if($errors->has('name')): ?>
                        <p class="invalid-feedback"><?php echo e($errors->first('name')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-slug.label")); ?>

            </th>
            <td>
                <div class="form-input">
                    <input type="text" class="form-control<?php echo e($errors->has('slug') ? ' is-invalid' : ''); ?>" id="slug" name="slug" value="<?php echo e($slug); ?>" onkeypress="return numbersAndLettersOnly()" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.roles-form.role-slug.placeholder')); ?>">
                    <?php if($errors->has('slug')): ?>
                        <p class="invalid-feedback"><?php echo e($errors->first('slug')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-desc.label")); ?>

            </th>
            <td>
                <div class="form-input">
                    <textarea class="form-control<?php echo e($errors->has('description') ? ' is-invalid' : ''); ?>" id="description" name="description" rows="6" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.roles-form.role-desc.placeholder')); ?>"><?php echo e($description); ?></textarea>
                    <?php if($errors->has('description')): ?>
                        <p class="invalid-feedback"><?php echo e($errors->first('description')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <?php
            if(!$level){
                $level = 0;
            }
        ?>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-level.label")); ?>

            </th>
            <td>
                <div class="form-input">
                    <input type="number" class="form-control<?php echo e($errors->has('level') ? ' is-invalid' : ''); ?>" id="level" name="level" min="0" step="1" onkeypress="return event.charCode >= 48" value="<?php echo e($level); ?>" placeholder="<?php echo e(trans('laravelroles::laravelroles.forms.roles-form.role-level.placeholder')); ?>">
                    <?php if($errors->has('level')): ?>
                        <p class="invalid-feedback"><?php echo e($errors->first('level')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        <tr>
            <th>
                <?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-permissions.label")); ?>

            </th>
            <td>
                <div class="form-input">
                <select class="<?php echo e($errors->has('permissions') ? ' is-invalid' : ''); ?>" name="permissions[]" id="permissions" multiple>
                    <option value=""><?php echo e(trans("laravelroles::laravelroles.forms.roles-form.role-permissions.placeholder")); ?></option>
                    <?php $__currentLoopData = $allPermissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option <?php if(in_array($permission->id, $rolePermissionsIds)): ?> selected <?php endif; ?> value="<?php echo e($permission); ?>">
                            <?php echo e($permission->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                    <?php if($errors->has('permissions')): ?>
                        <p class="invalid-feedback"><?php echo e($errors->first('permissions')); ?></p>
                    <?php endif; ?>
                </div>
            </td>
        </tr>
        
    </tbody>
</table><?php /**PATH /home/cptc/www/vendor/jeremykenedy/laravel-roles/src/resources/views//laravelroles/forms/role-form.blade.php ENDPATH**/ ?>