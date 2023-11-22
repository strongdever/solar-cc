<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '.invoice-select', function(e) {
      e.preventDefault();
      document.location.href = "{{ url('/invoice') }}?invoice_id=" + $(this).val();
    });
  });
</script>
