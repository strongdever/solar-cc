<?php echo Form::open([
    'route' => 'laravelblocker::blocker-deleted-restore-all',
    'method' => 'POST',
    'accept-charset' => 'UTF-8'
]); ?>

    <?php echo csrf_field(); ?>

    <?php echo Form::button('
        <i class="fa fa-fw fa-history" aria-hidden="true"></i> ' . trans_choice('laravelblocker::laravelblocker.buttons.restore-all-blocked', 1, ['count' => $blocked->count()]),
        [
            'type' => 'button',
            'class' => 'btn dropdown-item',
            'data-toggle' => 'modal',
            'data-target' => '#confirmRestore',
            'data-title' => trans('laravelblocker::laravelblocker.modals.resotreAllBlockedTitle'),
            'data-message' => trans('laravelblocker::laravelblocker.modals.resotreAllBlockedMessage')
        ]); ?>

<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/restore-all.blade.php ENDPATH**/ ?>