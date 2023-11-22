<?php echo Form::open([
    'route' => ['laravelblocker::blocker.update', $item->id],
    'method' => 'PUT',
    'role' => 'form',
    'class' => 'needs-validation'
]); ?>

    <?php echo csrf_field(); ?>

    <div class="form-card">
        <table class="form-table">
            <tbody>
                <tr>
                    <th>
                        <?php echo trans('laravelblocker::laravelblocker.forms.blockedTypeLabel'); ?>

                    </th>
                    <td>
                        <div class="form-input">
                            <select class="form-control<?php echo e($errors->has('typeId') ? ' is-invalid' : ''); ?>" name="typeId" id="typeId">
                                <option value="">
                                    <?php echo e(trans('laravelblocker::laravelblocker.forms.blockedTypeSelect')); ?>

                                </option>
                                <?php if($blockedTypes): ?>
                                    <?php $__currentLoopData = $blockedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blockedType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($blockedType->id); ?>" data-type="<?php echo e($blockedType->slug); ?>" <?php if(isset($item)): ?> <?php echo e($item->typeId == $blockedType->id ? 'selected="selected"' : ''); ?> <?php endif; ?> >
                                            <?php echo e($blockedType->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php if($errors->has('typeId')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('typeId')); ?></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo trans('laravelblocker::laravelblocker.forms.blockedValueLabel'); ?>

                    </th>
                    <td>
                        <div class="form-input">
                            <?php if(isset($item)): ?>
                                <input type="text" class="form-control<?php echo e($errors->has('value') ? ' is-invalid' : ''); ?>" name="value" value="<?php echo $item->value; ?>" placeholder="<?php echo trans('laravelblocker::laravelblocker.forms.blockedValuePH'); ?>">
                            <?php else: ?>
                                <input type="text" class="form-control<?php echo e($errors->has('value') ? ' is-invalid' : ''); ?>" name="value" value="<?php echo e(old('value')); ?>" placeholder="<?php echo trans('laravelblocker::laravelblocker.forms.blockedValuePH'); ?>">
                            <?php endif; ?>
                            <?php if($errors->has('value')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('value')); ?></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo trans('laravelblocker::laravelblocker.forms.blockedUserLabel'); ?>

                    </th>
                    <td>
                        <div class="form-input">
                            <select class="form-control<?php echo e($errors->has('userId') ? ' is-invalid' : ''); ?>" name="userId" id="userId">
                                <option value="">
                                    <?php echo e(trans('laravelblocker::laravelblocker.forms.blockedUserSelect')); ?>

                                </option>
                                <?php if($users): ?>
                                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aUser): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($aUser->id); ?>" data-email="<?php echo e($aUser->email); ?>" <?php if(isset($item->userId)): ?> <?php echo e($item->userId == $aUser->id ? 'selected="selected"' : ''); ?> <?php endif; ?> >
                                            <?php echo e($aUser->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <?php if($errors->has('userId')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('userId')); ?></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        <?php echo trans('laravelblocker::laravelblocker.forms.blockedNoteLabel'); ?>

                    </th>
                    <td>
                        <div class="form-input">
                            <?php if(isset($item)): ?>
                                <textarea class="form-control<?php echo e($errors->has('note') ? ' is-invalid' : ''); ?>" name="note" id="note" rows="8" placeholder="<?php echo trans('laravelblocker::laravelblocker.forms.blockedNotePH'); ?>"><?php echo $item->note; ?></textarea>
                            <?php else: ?>
                                <textarea class="form-control<?php echo e($errors->has('note') ? ' is-invalid' : ''); ?>" name="note" id="note" rows="8" placeholder="<?php echo trans('laravelblocker::laravelblocker.forms.blockedNotePH'); ?>"><?php echo e(old('note')); ?></textarea>
                            <?php endif; ?>
                            <?php if($errors->has('note')): ?>
                                <p class="invalid-feedback"><?php echo e($errors->first('note')); ?></p>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <ul class="btn-group form-bottom">
            <li>
                <?php echo Form::button(trans('laravelblocker::laravelblocker.buttons.save-larger'), array('class' => 'btn form-btn btn-success btn-block','type' => 'submit' )); ?>

            </li>
        </ul>
    </div>
<?php echo Form::close(); ?>


<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/edit-form.blade.php ENDPATH**/ ?>