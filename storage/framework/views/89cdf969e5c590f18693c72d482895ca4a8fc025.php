<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '.invoice-select', function(e) {
      e.preventDefault();
      document.location.href = "<?php echo e(url('/invoice')); ?>?invoice_id=" + $(this).val();
    });
  });
</script>
<?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/scripts/invoice-select.blade.php ENDPATH**/ ?>