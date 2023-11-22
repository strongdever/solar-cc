<script type="text/javascript">

	// CONFIRMATION SAVE MODEL
	$('#confirmSave').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$(this).find('#confirm').data('form', form);
	});
	$('#confirmSave').find('#confirm').on('click', function(){
	  	$(this).data('form').submit();
	});

</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/save-modal-script.blade.php ENDPATH**/ ?>