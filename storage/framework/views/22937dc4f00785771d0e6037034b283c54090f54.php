<div class="common-form">
    <form action="<?php echo e(route('laravelroles::roles.store')); ?>" method="POST" accept-charset="utf-8" id="store_role_form" class="mb-0 needs-validation" enctype="multipart/form-data" role="form" >
        <?php echo e(method_field('POST')); ?>

        <?php echo $__env->make('laravelroles::laravelroles.forms.role-form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <ul class="btn-group form-bottom">
            <li>
                <button type="submit" class="btn form-btn btn-success btn-block" value="save" name="action">
                    <i class="fa fa-save fa-fw"></i>
                    <?php echo trans("laravelroles::laravelroles.forms.roles-form.buttons.save-role.name"); ?>

                </button>
            </li>
        </ul>
    </form>
</div>

<?php echo $__env->make('laravelroles::laravelroles.scripts.form-inputs-helpers', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/cptc/www/vendor/jeremykenedy/laravel-roles/src/resources/views//laravelroles/forms/create-role-form.blade.php ENDPATH**/ ?>