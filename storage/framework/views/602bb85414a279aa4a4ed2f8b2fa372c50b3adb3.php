<div class="modal fade common-modal modal-success modal-save" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-layout">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body">
          <p class="txt">
            <?php echo trans('modals.confirm_modal_title_text'); ?>

          </p>
          <ul class="btn-group">
            <li>
              <?php echo Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_cancel_text'), array('class' => 'form-btn btn-secondary btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

            </li>
            <li>
              <?php echo Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_save_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_save_text'), array('class' => 'form-btn btn-success btn-flat', 'type' => 'button', 'id' => 'confirm' )); ?>

            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/modals/modal-save.blade.php ENDPATH**/ ?>