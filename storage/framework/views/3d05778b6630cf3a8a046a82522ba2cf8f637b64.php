<?php echo Form::open([
    'route' => 'laravelblocker::destroy-all-blocked',
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8'
]); ?>

    <?php echo Form::hidden("_method", "DELETE"); ?>

    <?php echo csrf_field(); ?>

    <button class="dropdown-item btn pointer" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans('laravelblocker::laravelblocker.modals.destroy_all_blocked_title')); ?>" data-message="<?php echo trans("laravelblocker::laravelblocker.modals.destroy_all_blocked_message"); ?>">
        <i class="fa fa-trash fa-fw" aria-hidden="true"></i> <?php echo trans_choice("laravelblocker::laravelblocker.buttons.destroy-all", 1, ['count' => $blocked->count()]); ?>

    </button>
<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/destroy-all.blade.php ENDPATH**/ ?>