<div class="common-form">
    <form action="<?php echo e(route('laravelroles::permissions.store')); ?>" method="POST" accept-charset="utf-8" id="store_permission_form" class="mb-0 needs-validation" enctype="multipart/form-data" role="form" >
        <?php echo e(method_field('POST')); ?>

        <?php echo $__env->make('laravelroles::laravelroles.forms.permission-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="btn-group form-bottom">
            <li>
                <button type="submit" class="btn form-btn btn-success" value="save" name="action">
                    <i class="fa fa-save fa-fw"></i>
                    <?php echo trans("laravelroles::laravelroles.forms.permissions-form.buttons.save-permission.name"); ?>

                </button>
            </li>
        </ul>
    </form>
</div>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/forms/create-permission-form.blade.php ENDPATH**/ ?>