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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="modal-body">
                    <p class="txt">本当によろしいですか？</p>
                    <ul class="btn-group">
                        <li>
                            <button class="form-btn btn-secondary" type="button" data-dismiss="modal" >
                                <i class="fa fa-fw fa-close" aria-hidden="true"></i>
                                <?php echo trans('laravelroles::laravelroles.modals.btnCancel'); ?>

                            </button>
                        </li>
                        <li>
                            <button class="form-btn btn-<?php echo e($modalClass); ?>" id="confirm" type="button" >
                                <i class="fa <?php echo e($actionBtnIcon); ?>" aria-hidden="true"></i>
                                <?php echo e($btnSubmitText); ?>

                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/modals/confirm-modal.blade.php ENDPATH**/ ?>