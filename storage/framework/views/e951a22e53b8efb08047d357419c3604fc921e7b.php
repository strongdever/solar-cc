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
  $btnSubmitText = trans('LaravelLogger::laravel-logger.modals.shared.btnConfirm');
}
?>
<div class="modal fade common-modal modal-<?php echo e($modalClass); ?>" id="<?php echo e($formTrigger); ?>" role="dialog" aria-labelledby="<?php echo e($formTrigger); ?>Label" aria-hidden="true">
  <div class="modal-layout">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body">
          <p class="txt">本気ですか？</p>
          <ul class="btn-group">
            <li>
              <?php echo Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('LaravelLogger::laravel-logger.modals.shared.btnCancel'), array('class' => 'form-btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

            </li>
            <li>
              <?php echo Form::button('<i class="fa ' . $actionBtnIcon . '" aria-hidden="true"></i> ' . $btnSubmitText, array('class' => 'form-btn btn-' . $modalClass . '', 'type' => 'button', 'id' => 'confirm' )); ?>

            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//modals/confirm-modal.blade.php ENDPATH**/ ?>