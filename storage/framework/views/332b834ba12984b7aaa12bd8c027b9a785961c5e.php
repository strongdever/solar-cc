<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

<script type="text/javascript">
    Dropzone.autoDiscover = false;
    $(document).ready(function() {
        var myDropzone = new Dropzone(".dropzone",{ 
            maxFilesize: 50,
            addRemoveLinks: true,
            maxFiles: 1,
            acceptedFiles: ".csv",
            dictDefaultMessage: "ここにファイルをドロップしてアップロードします。",
            dictFallbackMessage: "お使いのブラウザは、ドラッグ&ドロップによるファイルのアップロードをサポートしていません。",
            dictFallbackText: "以下のフォールバック フォームを使用して、昔のようにファイルをアップロードしてください。",
            dictFileTooBig: "ファイルが大きすぎます。 最大ファイルサイズ: 50MB。",
            dictInvalidFileType: "このタイプのファイルはアップロードできません。",
            dictResponseError: "エラーが発生しました。",
            dictCancelUpload: "アップロードをキャンセル",
            dictCancelUploadConfirmation: "本当にこのアップロードをキャンセルしますか?",
            dictRemoveFile: "ファイルを削除",
            dictRemoveFileConfirmation: null,
            dictMaxFilesExceeded: "1個のファイルのみをアップロードできます。"
        });

        myDropzone.on("success", function(file, response) {
            console.log(file, "response: ", response);
            if(response.success == 0){ 
              alert(response.error);
            }
        });

        myDropzone.on("uploadprogress", function(file) {
            var html = '<div class="progress">';
            html += '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">';
            html += '</div>';
            html += '</div>';
            $('.dz-message').html(html).show();
        });

        myDropzone.on("success", function(file, response) {
            var result = JSON.parse(response);
            var html = '<div class="progress">';
            html += '<div class="progress-bar progress-bar-striped bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">';
            html += 'アップロードが完了しました';
            html += '</div>';
            html += '</div>';
            $('.dz-message').html(html).show();
            console.log( result.data );
            if( result.success ) {
                setTimeout(function() {
                    var assetURL = "<?php echo e(asset('/')); ?>";
                    var defaultHTML = '<span class="lead">ここにファイルをドラッグ＆ドロップ</span><div class="sep">または</div><span class="btn btn-outline">ファイルを選択</span>';
                    $('.dz-message').html(defaultHTML).show();
                    var rowHTML = '<tr>' +
                            '<td>'+result.data.name+'</td>' +
                            '<td>' + new Date(result.data.uploaded_at).getUTCFullYear() + "年" + ("0" + (new Date(result.data.uploaded_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(result.data.uploaded_at).getUTCDate()).slice(-2) + "日" + '</td>' +
                            '<td class="action">' +
                                '<a href="'+assetURL+result.data.path+'" class="btn btn-sm btn-info btn-outline" download="'+result.data.name+'">' +
                                    '<i class="icon-download" aria-hidden="true"></i>' +
                                    '<span><?php echo e(__("ダウンロード")); ?></span>' +
                                '</a>' +
                            '</td>' +
                        '</tr>';
                    $('#csv-table').prepend(rowHTML);
                    $('#no-result').hide();
                    $('#csv-dropzone .csv-meta').text('前回のアップロード日：' + new Date(result.data.uploaded_at).getUTCFullYear() + "年" + ("0" + (new Date(result.data.uploaded_at).getUTCMonth()+1)).slice(-2) + "月" + ("0" + new Date(result.data.uploaded_at).getUTCDate()).slice(-2) + "日");
                }, 3000);
            }
        });
        myDropzone.on("complete", function(file) {
            // this.removeFile(file);
        });
        myDropzone.on("error", function(file, res) {
            var html = '<div class="progress">';
            html += '<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">';
            html += 'アップロードに失敗しました。';
            html += '</div>';
            html += '</div>';
            $('.dz-message').html(html).show();
            setTimeout(function() {
                var defaultHTML = '<span class="lead">ここにファイルをドラッグ＆ドロップ</span><div class="sep">または</div><span class="btn btn-outline">ファイルを選択</span>';
                $('.dz-message').html(defaultHTML).show();
            }, 3000);
        });
    });
</script><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/scripts/dropzone-script.blade.php ENDPATH**/ ?>