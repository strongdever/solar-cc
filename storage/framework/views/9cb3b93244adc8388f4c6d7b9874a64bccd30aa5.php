<div class="modal fade common-modal modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
  <div class="modal-layout">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-body">
          <p class="txt">
            <?php echo trans('usersmanagement.modals.delete_user_message'); ?>

          </p>
          <ul class="btn-group">
            <li>
              <?php echo Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_cancel_text'), array('class' => 'form-btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

            </li>
            <li>
              <?php echo Form::button('<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_delete_text'), array('class' => 'form-btn btn-danger', 'type' => 'button', 'id' => 'confirm' )); ?>

            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/modals/modal-delete.blade.php ENDPATH**/ ?>