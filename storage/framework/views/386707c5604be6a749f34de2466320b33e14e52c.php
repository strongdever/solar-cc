<div class="modal fade common-modal modal-danger" id="confirmDelete" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-layout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo trans('modals.edit_modal_text_confirm_title'); ?></h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <p class="txt">
                        <?php echo trans('modals.edit_modal_text_confirm_message'); ?>

                    </p>
                </div>
                <div class="modal-footer">
                    <?php echo Form::button('<i class="fa fa-fw fa-close" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_cancel_text'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

                    <?php echo Form::button('<i class="fa fa-fw fa-trash-o" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_delete_text'), array('class' => 'btn btn-danger', 'type' => 'button', 'id' => 'confirm' )); ?>

                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH E:\xampp\htdocs\carport-club\resources\views/modals/modal-delete.blade.php ENDPATH**/ ?>