<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click', '.favorite_btn', function(e) {
      e.preventDefault();
      var product_id = $(this).data("id");
      var element = $(this).parent('.favorite');
      var is_logined = $(this).find('.favorite_balloon').length ? false : true;
      var views = parseInt( $(this).find('.favorite_counter').text() );
      if( $(element).find('.favorite_balloon').length ) {
        $('.favorite_balloon').fadeOut();
        $(this).parent('.favorite').find('.favorite_balloon').fadeIn();
      } else {
        if( product_id ) {
          $.ajax({
            type:'POST',
            url: "<?php echo e(route('ajax-watchlist')); ?>",
            data: {
              product_id: product_id
            },
            success: function (result) {
              let jsonData = JSON.parse(result);
              console.log(jsonData);
              if (jsonData.length != 0) {
                if( jsonData.success === 'true' && jsonData.action == 'added' ) {
                  $(element).find('.favorite_btn').addClass('active');
                  $(element).find('.favorite_counter').text(views + 1);
                } else if ( jsonData.success === 'true' && jsonData.action == 'removed' ) {
                  $(element).find('.favorite_btn').removeClass('active');
                  $(element).find('.favorite_counter').text(views - 1);
                }
              }
            },
            error: function (response, status, error) {
              console.log(error);
            },
          });
        }
      }
    });
  });
</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/favorite-script.blade.php ENDPATH**/ ?>