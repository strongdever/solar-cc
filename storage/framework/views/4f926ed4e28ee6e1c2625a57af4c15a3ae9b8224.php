<?php if(config('roles.builtInFlashMessagesEnabled')): ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php echo $__env->make('laravelroles::laravelroles.partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/partials/flash-messages.blade.php ENDPATH**/ ?>