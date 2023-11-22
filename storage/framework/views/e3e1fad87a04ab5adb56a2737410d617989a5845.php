<?php
    if (!isset($actionBtnIcon)) {
        $actionBtnIcon = null;
    } else {
        $actionBtnIcon = $actionBtnIcon . ' fa-fw';
    }
    if (!isset($modalClass)) {
        $modalClass = null;
    }
    if (!isset($btnSubmitText)) {
        $btnSubmitText = trans('laravelblocker::laravelblocker.modals.btnConfirm');
    }
?>
<div class="modal fade common-modal modal-<?php echo e($modalClass); ?>" id="<?php echo e($formTrigger); ?>" role="dialog" aria-labelledby="<?php echo e($formTrigger); ?>Label" aria-hidden="true">
    <div class="modal-layout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">カーポートの登録</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <p class="txt">本気ですか？</p>
                </div>
                <div class="modal-footer">
                    <?php echo Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('laravelblocker::laravelblocker.modals.btnCancel'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

                    <?php echo Form::button('<i class="fa ' . $actionBtnIcon . '" aria-hidden="true"></i> ' . $btnSubmitText, array('class' => 'btn btn-' . $modalClass . '', 'type' => 'button', 'id' => 'confirm' )); ?>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//modals/confirm-modal.blade.php ENDPATH**/ ?>