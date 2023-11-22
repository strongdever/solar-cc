<?php echo Form::open([
    'route' => ['laravelblocker::blocker.destroy', $blockedItem->id],
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8',
]); ?>

    <?php echo Form::hidden("_method", "DELETE"); ?>

    <?php echo csrf_field(); ?>

    <button class="btn btn-danger btn-sm btn-block" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo trans('laravelblocker::laravelblocker.modals.delete_blocked_title'); ?>" data-message="<?php echo trans('laravelblocker::laravelblocker.modals.delete_blocked_message'); ?>">
        <?php echo trans("laravelblocker::laravelblocker.buttons.delete"); ?>

    </button>
<?php echo Form::close(); ?>

<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/delete-sm.blade.php ENDPATH**/ ?>