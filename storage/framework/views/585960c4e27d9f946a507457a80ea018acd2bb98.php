<script type="text/javascript">

	// CONFIRMATION DELETE MODAL
	$('#confirmDelete').on('show.bs.modal', function (e) {
		var message = $(e.relatedTarget).attr('data-message');
		var title = $(e.relatedTarget).attr('data-title');
		var form = $(e.relatedTarget).closest('form');
		$(this).find('.modal-body p').text(message);
		$(this).find('.modal-title').text(title);
		$(this).find('#confirm').data('form', form);
	});
	$('#confirmDelete').find('#confirm').on('click', function(){
	  	$(this).data('form').submit();
	});

</script><?php /**PATH E:\xampp\htdocs\carport-club\resources\views/scripts/delete-modal-script.blade.php ENDPATH**/ ?>