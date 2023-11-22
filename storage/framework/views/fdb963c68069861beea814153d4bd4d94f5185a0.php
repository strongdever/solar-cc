<?php echo Form::open([
    'route' => ['laravelblocker::blocker.destroy', $item->id],
    'method' => 'DELETE',
    'accept-charset' => 'UTF-8',
    'data-toggle' => 'tooltip',
    'title' => trans('laravelblocker::laravelblocker.tooltips.delete')
]); ?>

    <?php echo Form::hidden("_method", "DELETE"); ?>

    <?php echo csrf_field(); ?>

    <button class="btn form-btn btn-danger" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="確認" data-message="<?php echo trans('laravelblocker::laravelblocker.modals.delete_blocked_message'); ?>">
        <?php echo trans("laravelblocker::laravelblocker.buttons.delete-larger"); ?>

    </button>
<?php echo Form::close(); ?>

<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/delete-item.blade.php ENDPATH**/ ?>