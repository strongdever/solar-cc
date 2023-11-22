<div id="search_blocked_form">
    <?php echo Form::open([
        'route' => 'laravelblocker::search-blocked',
        'method' => 'POST',
        'role' => 'form',
        'class' => 'common-search-form clearfix',
        'id' => 'search_blocked'
    ]); ?>

        <?php echo csrf_field(); ?>

        <div class="search-form-group right mb_20">
            <div class="search_input">
                <?php echo Form::text('blocked_search_box', NULL, ['id' => 'blocked_search_box', 'class' => '', 'placeholder' => trans('laravelblocker::laravelblocker.forms.search-blocked-ph'), 'aria-label' => trans('laravelblocker::forms.search-users-ph'), 'required' => false]); ?>

                <span class="clear-search"></span>
            </div>
            <button type="button" id="search_trigger">
                <i class="fa fa-search fa-fw" aria-hidden="true"></i>
                <span>検索</span>
            </button>
        </div>
    <?php echo Form::close(); ?>

</div><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//forms/search-blocked.blade.php ENDPATH**/ ?>