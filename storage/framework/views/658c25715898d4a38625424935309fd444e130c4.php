<?php echo Form::open([
    'route' => ['laravelblocker::blocker.update', $item->id],
    'method' => 'PUT',
    'role' => 'form',
    'class' => 'needs-validation'
]); ?>

    <?php echo csrf_field(); ?>

    <table class="form-table">
        <tbody>
            <tr>
                <th width="300px">
                    <?php echo trans('laravelblocker::laravelblocker.forms.blockedTypeLabel'); ?>

                </th>
                <td>
                    <div class="form_input">
                        <select name="typeId" id="typeId">
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
                            <p class="validate"><?php echo e($errors->first('typeId')); ?></p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo trans('laravelblocker::laravelblocker.forms.blockedValueLabel'); ?>

                </th>
                <td>
                    <div class="form_input">
                        <?php if(isset($item)): ?>
                            <?php echo Form::text('value', $item->value, array('id' => 'value', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedValuePH'))); ?>

                        <?php else: ?>
                            <?php echo Form::text('value', NULL, array('id' => 'value', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedValuePH'))); ?>

                        <?php endif; ?>
                        <?php if($errors->has('value')): ?>
                            <p class="validate"><?php echo e($errors->first('value')); ?></p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo trans('laravelblocker::laravelblocker.forms.blockedUserLabel'); ?>

                </th>
                <td>
                    <div class="form_input">
                        <select name="userId" id="userId">
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
                            <p class="validate"><?php echo e($errors->first('userId')); ?></p>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <tr>
                <th>
                    <?php echo trans('laravelblocker::laravelblocker.forms.blockedNoteLabel'); ?>

                </th>
                <td>
                    <div class="form_input">
                        <?php if(isset($item)): ?>
                            <?php echo Form::textarea('note', $item->note, array('id' => 'note', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedNotePH'))); ?>

                        <?php else: ?>
                            <?php echo Form::textarea('note', NULL, array('id' => 'note', 'placeholder' => trans('laravelblocker::laravelblocker.forms.blockedNotePH'))); ?>

                        <?php endif; ?>
                        <?php if($errors->has('note')): ?>
                            <p class="validate"><?php echo e($errors->first('note')); ?></p>
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
<?php echo Form::close(); ?>


<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/edit-form.blade.php ENDPATH**/ ?>