<div class="modal fade common-modal modal-success modal-save" id="confirmSave" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-layout">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{!! trans('modals.confirm_modal_title_text') !!}</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
                </div>
                <div class="modal-body">
                    <p class="txt">
                        {!! trans('modals.confirm_modal_title_std_msg') !!}
                    </p>
                </div>
                <div class="modal-footer">
                    {!! Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_cancel_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_cancel_text'), array('class' => 'btn btn-secondary', 'type' => 'button', 'data-dismiss' => 'modal' )) !!}
                    {!! Form::button('<i class="fa fa-fw '.trans('modals.confirm_modal_button_save_icon').'" aria-hidden="true"></i> ' . trans('modals.confirm_modal_button_save_text'), array('class' => 'btn btn-success', 'type' => 'button', 'id' => 'confirm' )) !!}
                </div>
            </div>
        </div>
    </div>
</div>