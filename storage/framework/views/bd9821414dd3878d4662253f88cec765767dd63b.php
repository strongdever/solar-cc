<script type="text/javascript">
    $(function() {
        // Confirm Form Submit Modal
        $('<?php echo e($formTrigger); ?>').on('show.bs.modal', function (e) {
            var message = $(e.relatedTarget).attr('data-message');
            var title = $(e.relatedTarget).attr('data-title');
            var form = $(e.relatedTarget).closest('form');
            $(this).find('.modal-body p').text(message);
            $(this).find('.modal-title').text(title);
            $(this).find('#confirm').data('form', form);
        });
        $('<?php echo e($formTrigger); ?>').find('#confirm').on('click', function(){
            $(this).data('form').submit();
        });
    });
</script>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-roles\src/resources/views//laravelroles/scripts/confirm-modal.blade.php ENDPATH**/ ?>