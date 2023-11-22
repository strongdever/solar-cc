<script type="text/javascript">
  $(document).ready(function(){
    var swiper = new Swiper(".single_swiper_sub", {
      spaceBetween: 15,
      slidesPerView: 3,
      freeMode: true,
      watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".single_swiper_main", {
      spaceBetween: 15,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      thumbs: {
        swiper: swiper,
      },
    });
  });
</script><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/swiper-script.blade.php ENDPATH**/ ?>