<?php if(config('laravelblocker.blockerFlashMessagesEnabled')): ?>
    <div class="row">
        <div class="col-sm-12">
            <?php echo $__env->make('laravelblocker::partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH /home/cptc/www/vendor/jeremykenedy/laravel-blocker/src/resources/views//partials/flash-messages.blade.php ENDPATH**/ ?>