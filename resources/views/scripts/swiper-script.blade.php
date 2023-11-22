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
</script>