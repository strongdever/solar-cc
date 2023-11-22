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
</script>