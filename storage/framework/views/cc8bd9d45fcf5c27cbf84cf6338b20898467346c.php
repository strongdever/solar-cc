<?php if($restoreType == 'full'): ?>
    <?php
        $itemId = $item->id;
        $itemValue = $item->value;
        $itemClasses = 'btn form-btn btn-success btn-block';
        $itemText = trans('laravelblocker::laravelblocker.buttons.restore-blocked-item-full');
    ?>
<?php endif; ?>
<?php if($restoreType == 'small'): ?>
    <?php
        $itemId = $blockedItem->id;
        $itemValue = $blockedItem->value;
        $itemClasses = 'btn btn-sm btn-success btn-block';
        $itemText = trans('laravelblocker::laravelblocker.buttons.restore-blocked-item');
    ?>
<?php endif; ?>

<?php echo Form::open([
    'route' => ['laravelblocker::blocker-item-restore', $itemId],
    'method' => 'PUT',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans("laravelblocker::laravelblocker.tooltips.restoreItem")
]); ?>

    <?php echo Form::hidden("_method", "PUT"); ?>

    <?php echo csrf_field(); ?>

    <?php echo Form::button($itemText, [
            'type' => 'button',
            'class' => $itemClasses,
            'data-toggle' => 'modal',
            'data-target' => '#confirmRestore',
            'data-title' => trans('laravelblocker::laravelblocker.modals.resotreBlockedItemTitle'),
            'data-message' => trans('laravelblocker::laravelblocker.modals.resotreBlockedItemMessage', ['value' => $itemValue])
        ]); ?>

<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/restore-item.blade.php ENDPATH**/ ?>