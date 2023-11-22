<?php echo Form::open(['route' => 'search-users', 'method' => 'POST', 'role' => 'form', 'class' => 'common-search-form clearfix', 'id' => 'search_users']); ?>

    <?php echo csrf_field(); ?>

    <div class="search-form-group right">
        <div class="search_input">
            <?php echo Form::text('user_search_box', NULL, ['id' => 'user_search_box', 'class' => 'form-input', 'required' => false]); ?>

            <span class="clear-search"></span>
        </div>
        <button type="button" id="search_trigger">
            <i class="fa fa-search fa-fw" aria-hidden="true"></i>
            <span>検索</span>
        </button>
    </div>
<?php echo Form::close(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/partials/search-users-form.blade.php ENDPATH**/ ?>