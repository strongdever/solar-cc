<script>
    $(function() {
        var tableBody = $('#table-body');
        var resultsContainer = $('#search-results');
        var clearSearchTrigger = $('.clear-search');
        var searchform = $('#search-carports-form');
        var searchformInput = $('#search-keyword');
        var searchPagination = $('#search-pagination');
        var searchSubmit = $('#search-trigger');    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        searchform.submit(function(e) {
            e.preventDefault();
            resultsContainer.html('');
            tableBody.hide();
            clearSearchTrigger.show();
            let noResulsHtml = '<tr>' +
                                '<td colspan="6" class="no-result">{{ __("検索結果がありません。") }}</td>' +
                                '</tr>';

            $.ajax({
                type:'POST',
                url: "{{ route('search-carport') }}",
                data: searchform.serialize(),
                success: function (result) {
                    console.log(result);
                    let jsonData = JSON.parse(result);
                    if (jsonData.length != 0) {
                        $.each(jsonData, function(index, val) {
                            let rolesHtml = '';
                            let roleClass = '';
                            let detailCellHtml = '<button class="btn btn-sm btn-info btn-outline caportDetailModalLink" data-id="'+val.id+'" data-target="#carportDetailModal" data-toggle="modal">{{ __("詳細") }}</button>';
                            
                            resultsContainer.append('<tr>' +
                                '<td>' + val.uuid + '</td>' +
                                '<td>' + val.company + '</td>' +
                                '<td>' + val.contract_type.name + '</td>' +
                                '<td>' + new Date(val.registered_at).getUTCFullYear() + "年" + ("0" + (new Date(val.registered_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.registered_at).getUTCDate()).slice(-2) + "日" + '</td>' +
                                '<td>' + new Date(val.started_at).getUTCFullYear() + "年" + ("0" + (new Date(val.started_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(val.started_at).getUTCDate()).slice(-2) + "日" + '</td>' +
                                '<td class="action">' + detailCellHtml + '</td>' +
                            '</tr>');
                        });
                    } else {
                        resultsContainer.append(noResulsHtml);
                    };
                    searchPagination.hide();
                },
                error: function (response, status, error) {
                    if (response.status === 422) {
                        resultsContainer.append(noResulsHtml);
                        searchPagination.hide();
                    };
                },
            });
        });
        searchSubmit.click(function(event) {
            event.preventDefault();
            searchform.submit();
        });
        searchformInput.keyup(function(event) {
            if ($('#search-keyword').val() != '') {
                clearSearchTrigger.show();
            } else {
                clearSearchTrigger.hide();
                resultsContainer.html('');
                tableBody.show();
                searchPagination.show();
            };
        });
        clearSearchTrigger.click(function(e) {
            e.preventDefault();
            clearSearchTrigger.hide();
            tableBody.show();
            resultsContainer.html('');
            searchformInput.val('');
            searchPagination.show();
        });
    });
</script>
