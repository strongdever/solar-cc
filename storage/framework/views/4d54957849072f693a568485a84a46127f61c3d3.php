<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    
    $(document).on('submit', '#message-form', function(e) {
      e.preventDefault();
      if( $(this).find('#message').val() != "" ) {
        $.ajax({
          type:'POST',
          url: "<?php echo e(route('ajax-message')); ?>",
          data: $(this).serialize(),
          success: function (result) {
            let jsonData = JSON.parse(result);
            console.log(jsonData);
            if (jsonData.length != 0) {
              const html = '<tr>' +
                              '<th>' + jsonData.user_name + '</th>' +
                              '<td>' +
                                '<div class="clearfix">' +
                                  '<div class="message_text">' + jsonData.message + '</div>' +
                                  '<p class="message_date">' + jsonData.date + '</p>' +
                                '</div>' +
                              '</td>' +
                            '</tr>';
              $('#messages_body').append(html);
              $('#message').val('');
            }
          },
          error: function (response, status, error) {
            console.log(error);
          },
        });
      }
    });

    $(document).on('click', '.product_status .complete-btn', function(e) {
      e.preventDefault();
      $(this).parent('.uploaded_photo_item').find('input[type="file"]').click();
    });

    // CONFIRMATION SAVE MODEL
    $('#actionConfirm').on('show.bs.modal', function (e) {
      var message = $(e.relatedTarget).attr('data-message');
      var title = $(e.relatedTarget).attr('data-title');
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-body p').html(message);
      $(this).find('.modal-title').text(title);
      $(this).find('#confirm').data('form', form);
    });
    $('#actionConfirm').find('#confirm').on('click', function(){
      $(this).data('form').submit();
    });
    $('#actionConfirm').find('#reject').on('click', function(){
      console.log($(this).parents('.btn-group').find('#confirm').data('form'));
      $(this).parents('.btn-group').find('#confirm').data('form').find('input[name="action"]').val('reject');
      $(this).parents('.btn-group').find('#confirm').data('form').submit();
    });

    $('#actionRequest').on('show.bs.modal', function (e) {
      var message = $(e.relatedTarget).attr('data-message');
      var title = $(e.relatedTarget).attr('data-title');
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-body p').html(message);
      $(this).find('.modal-title').text(title);
      $(this).find('#confirm').data('form', form);
    });
    $('#actionRequest').find('#confirm').on('click', function(){
      $(this).data('form').submit();
    });

    $('#confirmChange').on('show.bs.modal', function (e) {
      var message = $(e.relatedTarget).attr('data-message');
      var title = $(e.relatedTarget).attr('data-title');
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-body p').html(message);
      $(this).find('.modal-title').text(title);
      $(this).find('#confirm').data('form', form);
    });
    $('#confirmChange').find('#confirm').on('click', function(){
      $(this).data('form').submit();
    });
    
  });
</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/message-script.blade.php ENDPATH**/ ?>