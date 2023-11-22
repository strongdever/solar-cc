<div class="common-form">
    <form action="<?php echo e(route('laravelroles::roles.update', $id)); ?>" method="POST" accept-charset="utf-8" id="edit_role_form" class="mb-0 needs-validation" enctype="multipart/form-data" role="form" >
        <?php echo e(method_field('PATCH')); ?>

        <input type="hidden" name="id" value="<?php echo e($id); ?>">
        <?php echo $__env->make('laravelroles::laravelroles.forms.role-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="btn-group form-bottom">
            <li>
                <button type="submit" class="form-btn btn-success btn-block" value="save" name="action">
                    <i class="fa fa-save fa-fw"></i>
                    <?php echo trans("laravelroles::laravelroles.forms.roles-form.buttons.update-role.name"); ?>

                </button>
            </li>
        </ul>
    </form>
</div>

<?php echo $__env->make('laravelroles::laravelroles.scripts.form-inputs-helpers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/forms/edit-role-form.blade.php ENDPATH**/ ?>