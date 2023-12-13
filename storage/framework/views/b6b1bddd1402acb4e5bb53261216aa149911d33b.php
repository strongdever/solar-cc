<script type="text/javascript">
  $(document).ready(function() {
    var pwInput = $('#password');
    var pwInputConf = $('#password_confirmation');
    pwInput.val('').prop('disabled', true);
    pwInputConf.val('').prop('disabled', true);
    $(document).on('click', '.btn-change-pw', function(e) {
      e.preventDefault();
      pwInput.val('').prop('disabled', true);
      pwInputConf.val('').prop('disabled', true);
      $('.pw-change-container').slideToggle(100, function() {
        pwInput.prop('disabled', function () {
          return ! pwInput.prop('disabled', false);
        });
        pwInputConf.prop('disabled', function () {
          return ! pwInputConf.prop('disabled', false);
        });
      });
    });
  });
</script>
<?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/scripts/check-changed.blade.php ENDPATH**/ ?>