<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '.invoice-select', function(e) {
      e.preventDefault();
      document.location.href = "<?php echo e(url('/invoice')); ?>?invoice_id=" + $(this).val();
    });
  });
</script>
<?php /**PATH /home/cptc/www/resources/views/scripts/invoice-select.blade.php ENDPATH**/ ?>