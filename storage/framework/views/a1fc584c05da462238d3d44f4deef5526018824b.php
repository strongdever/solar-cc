<script>
    $(function() {
        var cardTitle = $('#card_title');
        var usersTable = $('#users_table');
        var resultsContainer = $('#search_results');
        var usersCount = $('#user_count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search_users');
        var searchformInput = $('#user_search_box');
        var userPagination = $('#user_pagination');
        var searchSubmit = $('#search_trigger');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('');
            usersTable.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td colspan="10"><?php echo trans("usersmanagement.search.no-results"); ?></td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "<?php echo e(route('search-users')); ?>",
                data: searchform.serialize(),
                success: function (result) {
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        $.each(jsonData, function(index, val) {
                            let rolesHtml = '';
                            let roleClass = '';
                            let showCellHtml = '<a class="btn btn-sm btn-success btn-block" href="users/' + val.id + '"><?php echo trans("usersmanagement.buttons.show"); ?></a>';
                            let editCellHtml = '<a class="btn btn-sm btn-info btn-block" href="users/' + val.id + '/edit"><?php echo trans("usersmanagement.buttons.edit"); ?></a>';
                            let deleteCellHtml = '<form method="POST" action="/users/'+ val.id +'" accept-charset="UTF-8">' +
                                    '<?php echo Form::hidden("_method", "DELETE"); ?>' +
                                    '<?php echo csrf_field(); ?>' +
                                    '<button class="btn btn-danger btn-sm" type="button" style="width: 100%;" data-toggle="modal" data-target="#confirmDelete" data-title="ユーザー削除" data-message="<?php echo trans("usersmanagement.modals.delete_user_message"); ?>">' +
                                        '<?php echo trans("usersmanagement.buttons.delete"); ?>' +
                                    '</button>' +
                                '</form>';

                            $.each(val.roles, function(roleIndex, role) {
                                if (role.name == "User") {
                                    roleClass = 'primary';
                                } else if (role.name == "Admin") {
                                    roleClass = 'warning';
                                } else if (role.name == "Unverified") {
                                    roleClass = 'danger';
                                } else {
                                    roleClass = 'default';
                                };
                                rolesHtml = '<span class="label label-' + roleClass + '">' + role.name + '</span> ';
                            });
                            resultsContainer.append('<tr>' +
                                '<td>' + val.id + '</td>' +
                                '<td>' + val.name + '</td>' +
                                '<td class="hidden-xs">' + val.email + '</td>' +
                                '<td class="hidden-xs">' + val.name_kanji + '</td>' +
                                '<td class="hidden-sm hidden-xs"> ' + rolesHtml  +'</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + new Date(val.created_at).getUTCFullYear() + "年" + ("0" + (new Date(val.created_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.created_at).getUTCDate()).slice(-2) + "日" + ("0" + new Date(val.created_at).getUTCHours()).slice(-2) + ":" + ("0" + new Date(val.created_at).getUTCMinutes()).slice(-2) + '</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + new Date(val.updated_at).getUTCFullYear() + "年" + ("0" + (new Date(val.updated_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.updated_at).getUTCDate()).slice(-2) + "日" + ("0" + new Date(val.updated_at).getUTCHours()).slice(-2) + ":" + ("0" + new Date(val.updated_at).getUTCMinutes()).slice(-2) + '</td>' +
                                '<td class="action-td">' + deleteCellHtml + '</td>' +
                                '<td class="action-td">' + showCellHtml + '</td>' +
                                '<td class="action-td">' + editCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    usersCount.html(jsonData.length + " <?php echo trans('usersmanagement.search.found-footer'); ?>");
                    userPagination.hide();
                    cardTitle.html("<?php echo trans('usersmanagement.search.title'); ?>");
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        usersCount.html(0 + " <?php echo trans('usersmanagement.search.found-footer'); ?>");
                        userPagination.hide();
                        cardTitle.html("<?php echo trans('usersmanagement.search.title'); ?>");
                    };
                },
            });
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#user_search_box').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                usersTable.show();
                cardTitle.html("<?php echo trans('usersmanagement.showing-all-users'); ?>");
                userPagination.show();
                usersCount.html(" ");
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            usersTable.show();
            resultsContainer.html('');
            searchformInput.val('');
            cardTitle.html("<?php echo trans('usersmanagement.showing-all-users'); ?>");
            userPagination.show();
            usersCount.html(" ");
        });
    });
</script>
<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/scripts/search-users.blade.php ENDPATH**/ ?>