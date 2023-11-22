<script type="text/javascript">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).on('click', '.uploaded_photo_item .upload', function(e) {
      e.preventDefault();
      $(this).parent('.uploaded_photo_item').find('input[type="file"]').click();
    });
    $(document).on('click', '.uploaded_photo_item .remove', function(e) {
      e.preventDefault();
      $(this).parent('.uploaded_photo_item').remove();
    });
    $(document).on('change', '.uploaded_photo_item input[type="file"]', function(e) {
      const file = this.files[0];
      const item = $(this).parent('.uploaded_photo_item');
      const html = `<div class="uploaded_photo_item new">
                      <a class="upload"></a>
                      <span class="remove"></span>
                      <img src="" alt="" class="preview">
                      <input type="file" name="photo[]" accept="image/*" hidden>
                    </div>`;
      if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
          var imagedata = event.target.result;
          $.ajax({
            type:'POST',
            url: "<?php echo e(route('ajax-upload')); ?>",
            data: {
              imagedata: imagedata
            },
            success: function (result) {
              let jsonData = JSON.parse(result);
              console.log(jsonData);
              if (jsonData.length != 0) {
                $(item).find('.preview').attr("src", event.target.result);
                if( $(item).find('input[name="photo_id[]"]').length === 0 ) {
                  $(item).append('<input type="hidden" name="photo_id[]">');
                }
                $(item).find('input[name="photo_id[]"]').val(jsonData.photo_id);
                if( $(item).hasClass('new') ) {
                  $(item).removeClass('new');
                  $(item).parent('.product_uploaded_photos').append(html);
                }
              }
            },
            error: function (response, status, error) {
              console.log(error);
            },
          });
          
        };
        reader.readAsDataURL(file);
      }
    });

    $(document).on('click', '.uploaded_photo_card .upload', function(e) {
      e.preventDefault();
      $(this).parent('.uploaded_photo_card').find('input[type="file"]').click();
    });
    $(document).on('click', '.uploaded_photo_card .remove', function(e) {
      e.preventDefault();
      const item = $(this).parent('.uploaded_photo_card');
      $(item).addClass('new');
      $(item).find('.preview').attr("src", '');
      $(item).find('input[name="photo_id"]').val('');
    });

    $(document).on('change', '.uploaded_photo_card input[type="file"]', function(e) {
      const file = this.files[0];
      const item = $(this).parent('.uploaded_photo_card');
      if (file) {
        let reader = new FileReader();
        reader.onload = function (event) {
          var imagedata = event.target.result;
          $.ajax({
            type:'POST',
            url: "<?php echo e(route('ajax-upload')); ?>",
            data: {
              imagedata: imagedata
            },
            success: function (result) {
              let jsonData = JSON.parse(result);
              console.log(jsonData);
              if (jsonData.length != 0) {
                $(item).find('.preview').attr("src", event.target.result);
                $(item).find('input[name="photo_id"]').val(jsonData.photo_id);
                if( $(item).hasClass('new') ) {
                  $(item).removeClass('new');
                }
              }
            },
            error: function (response, status, error) {
              console.log(error);
            },
          });
          
        };
        reader.readAsDataURL(file);
      }
    });

    $(document).on('click', '.product_area_tab_link', function(e) {
      e.preventDefault();
      $('.product_area_tab_body').slideToggle(400);
    });
  });
</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/upload-script.blade.php ENDPATH**/ ?>