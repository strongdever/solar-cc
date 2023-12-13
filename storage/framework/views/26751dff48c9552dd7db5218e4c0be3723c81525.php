<?php
    $formClass  = '';
    $btnClass   = 'btn-danger btn-sm';
    $btnText    = trans("laravelroles::laravelroles.buttons.delete");
    $btnTooltip = trans('laravelroles::laravelroles.tooltips.delete-role');
    $formAction = route('laravelroles::roles.destroy', $item->id);
    if(isset($large)) {
        $formClass  = 'mb-0';
        $btnClass   = 'form-btn btn-danger mb-0';
        $btnText    = trans("laravelroles::laravelroles.buttons.delete-large");
    }
    if($type == 'Permission') {
        $btnTooltip = trans('laravelroles::laravelroles.tooltips.delete-permission');
        $formAction = route('laravelroles::permissions.destroy', $item->id);
    }
?>

<form action="<?php echo e($formAction); ?>" method="POST" accept-charset="utf-8" class="<?php echo e($formClass); ?>" >
    <?php echo e(csrf_field()); ?>

    <?php echo e(method_field('DELETE')); ?>

    <button class="btn <?php echo e($btnClass); ?>" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo trans('laravelroles::laravelroles.modals.delete_modal_title', ['type' => $type, 'item' => $item->name]); ?>" data-message="<?php echo trans('laravelroles::laravelroles.modals.delete_modal_message', ['type' => $type, 'item' => $item->name]); ?>" >
        <?php echo $btnText; ?>

    </button>
</form>
<?php /**PATH E:\xampp\htdocs\solar-cc\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/forms/delete-sm.blade.php ENDPATH**/ ?>