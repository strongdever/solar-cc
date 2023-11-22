<?php echo Form::open([
    'route' => ['laravelblocker::blocker-item-destroy', $blockedItem->id],
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans("laravelblocker::laravelblocker.tooltips.destroy_blocked_tooltip")
]); ?>

    <?php echo Form::hidden("_method", "DELETE"); ?>

    <?php echo csrf_field(); ?>

    <button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo e(trans("laravelblocker::laravelblocker.modals.destroy_blocked_title")); ?>" data-message="<?php echo trans("laravelblocker::laravelblocker.modals.destroy_blocked_message", ["blocked" => $blockedItem->value]); ?>">
        <?php echo trans("laravelblocker::laravelblocker.buttons.destroy"); ?>

    </button>
<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/destroy-sm.blade.php ENDPATH**/ ?>