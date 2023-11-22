<script>
    $(function() {
        var cardTitle = $('#card-title');
        var usersTable = $('#users-table');
        var resultsContainer = $('#search-results');
        var usersCount = $('#users-count');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search-users-form');
        var searchformInput = $('#user-search-input');
        var userPagination = $('#users-pagination');
        var searchSubmit = $('#user-search-trigger');
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
                                '<td colspan="9"><?php echo trans("usersmanagement.search.no-results"); ?></td>' +
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
                                    '<button class="btn btn-sm btn-danger btn-block" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="<?php echo trans("usersmanagement.modals.delete_title"); ?>" data-message="<?php echo trans("usersmanagement.modals.delete_message"); ?>">' +
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
                                rolesHtml = '<span class="badge badge-' + roleClass + '">' + role.name + '</span> ';
                            });
                            resultsContainer.append('<tr>' +
                                '<td>' + val.uuid + '</td>' +
                                '<td>' + val.company + '</td>' +
                                '<td class="hidden-xs hidden-sm hidden-md"><a href="mailto:' + val.email + '" title="email ' + val.email + '">' + val.email + '</a></td>' +
                                '<td> ' + rolesHtml  +'</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + new Date(val.created_at).getUTCFullYear() + "年" + ("0" + (new Date(val.created_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.created_at).getUTCDate()).slice(-2) + "日" + '</td>' +
                                '<td class="hidden-sm hidden-xs hidden-md">' + new Date(val.updated_at).getUTCFullYear() + "年" + ("0" + (new Date(val.updated_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.updated_at).getUTCDate()).slice(-2) + "日" + '</td>' +
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
            if ($('#user-search-input').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                usersTable.show();
                cardTitle.html("<?php echo trans('usersmanagement.menu-alt'); ?>");
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
            cardTitle.html("<?php echo trans('usersmanagement.menu-alt'); ?>");
            userPagination.show();
            usersCount.html(" ");
        });
    });
</script>
<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/scripts/search-users.blade.php ENDPATH**/ ?>