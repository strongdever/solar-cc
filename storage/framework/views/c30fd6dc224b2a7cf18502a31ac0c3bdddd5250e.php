<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('change', 'input[name="confirm_term"]', function(e) {
      e.preventDefault();
      if( $(this).is(':checked') ){
        $('.confirm_term_btn').removeClass('btn-disible');
      }
      else{
        $('.confirm_term_btn').addClass('btn-disible');
      }
    });
  });
</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/term-script.blade.php ENDPATH**/ ?>