<script type="text/javascript">
    $(document).on('mouseenter', "div.activity-table table > tbody > tr > td ", function () {
        var $this = $(this);
        if (this.offsetWidth < this.scrollWidth && !$this.attr('title')) {
            $this.attr('title', $this.text());
        }
    });
</script>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//scripts/add-title-attribute.blade.php ENDPATH**/ ?>