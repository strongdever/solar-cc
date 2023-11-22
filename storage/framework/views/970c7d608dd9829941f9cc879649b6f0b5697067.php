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
        $btnSubmitText = trans('laravelroles::laravelroles.modals.btnConfirm');
    }
?>
<div class="modal fade common-modal modal-<?php echo e($modalClass); ?>" id="<?php echo e($formTrigger); ?>" role="dialog" aria-labelledby="<?php echo e($formTrigger); ?>Label" aria-hidden="true">
    <div class="modal-layout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">確認</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <p class="txt">本当に削除してもよろしいですか？</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal" >
                        <i class="fa fa-fw fa-close" aria-hidden="true"></i>
                        <?php echo trans('laravelroles::laravelroles.modals.btnCancel'); ?>

                    </button>
                    <button class="btn btn-<?php echo e($modalClass); ?>" id="confirm" type="button" >
                        <i class="fa <?php echo e($actionBtnIcon); ?>" aria-hidden="true"></i>
                        <?php echo e($btnSubmitText); ?>

                    </button>
              </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /home/cptc/www/vendor/jeremykenedy/laravel-roles/src/resources/views//laravelroles/modals/confirm-modal.blade.php ENDPATH**/ ?>