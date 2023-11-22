

<?php $__env->startSection('content'); ?>
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-carport" aria-hidden="true"></i><?php echo e(__('新規カーポートの登録')); ?></h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20"><?php echo e(__('商品IDが届きましたらカーポート登録を行ってください。')); ?></div>
            <div class="action">
                <a href="<?php echo e(url('/carport')); ?>" class="link-btn"><?php echo e(__('新規カーポートを登録する')); ?></a>
            </div>
        </div>
    </div>
    <div class="dashboard-card mb-50 mb-sp-40">
        <div class="card-header">
            <h3 class="lead"><i class="icon-upload" aria-hidden="true"></i><?php echo e(__('電力データのアップロード')); ?></h3>
        </div>
        <div class="card-body">
            <div class="description mb-24 mb-sp-20"><?php echo e(__('請求用の電力データのアップロードがこちらから行ってください。')); ?></div>
            <div class="action">
                <a href="<?php echo e(url('/power-register')); ?>" class="link-btn"><?php echo e(__('電力データをアップロードする')); ?></a>
            </div>
        </div>
    </div>
    <div class="dashboard-card">
        <div class="card-header">
            <h3 class="lead"><i class="icon-list" aria-hidden="true"></i><?php echo e(__('請求一覧')); ?></h3>
        </div>
        <div class="card-body">
            <h4 class="caption">2022年10月分<small>（2022年9月11日～10月10日）</small></h4>
            <div class="describe-panel mb-50 mb-sp-30">
                <div class="inner-row">
                    <div class="inner-left">
                        <ul class="describe-list">
                            <li>
                                <div class="describe-item">
                                    <h4 class="label">件数</h4>
                                    <div class="value"><strong>42</strong><small>件</small></div>
                                </div>
                            </li>
                            <li>
                                <div class="describe-item">
                                    <h4 class="label">総自家消費電力量</h4>
                                    <div class="value"><strong>90,279</strong><small>kWh</small></div>
                                </div>
                            </li>
                            <li>
                                <div class="describe-item">
                                    <h4 class="label">総請求額</h4>
                                    <div class="value"><strong>803,402</strong><small>円</small></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="inner-right">
                        <div class="download-action">
                            <a href="#" class="link-btn"><i class="icon-download" aria-hidden="true"></i>一括ダウンロード</a>
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="caption">カーポート別 当月請求データ一覧</h4>
            <div class="table-responsive requests-table">
                <table class="table table-sm data-table">
                    <thead class="thead">
                        <tr>
                            <th class="id">ID</th>
                            <th>名前</th>
                            <th>請求月</th>
                            <th>請求額</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="users_table">
                        <tr>
                            <td>100001</td>
                            <td>○○○邸発電所</td>
                            <td>10月分</td>
                            <td>4320円</td>
                            <td class="action">
                                <a href="#" class="btn btn-sm btn-info btn-outline">詳細<span class="hidden-sm">を確認</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>100001</td>
                            <td>○○○邸発電所</td>
                            <td>10月分</td>
                            <td>4320円</td>
                            <td class="action">
                                <a href="#" class="btn btn-sm btn-info btn-outline">詳細<span class="hidden-sm">を確認</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>100001</td>
                            <td>○○○邸発電所</td>
                            <td>10月分</td>
                            <td>4320円</td>
                            <td class="action">
                                <a href="#" class="btn btn-sm btn-info btn-outline">詳細<span class="hidden-sm">を確認</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>100001</td>
                            <td>○○○邸発電所</td>
                            <td>10月分</td>
                            <td>4320円</td>
                            <td class="action">
                                <a href="#" class="btn btn-sm btn-info btn-outline">詳細<span class="hidden-sm">を確認</span></a>
                            </td>
                        </tr>
                        <tr>
                            <td>100001</td>
                            <td>○○○邸発電所</td>
                            <td>10月分</td>
                            <td>4320円</td>
                            <td class="action">
                                <a href="#" class="btn btn-sm btn-info btn-outline">詳細<span class="hidden-sm">を確認</span></a>
                            </td>
                        </tr>
                    </tbody>
                    <tbody id="search_results"></tbody>
                    <tbody id="search_results"></tbody>
                </table>
            </div>
            <div class="table-action text-right">
                <a href="#" class="viewmore"><span>全ての請求データを見る</span><i class="icon-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\resources\views/home.blade.php ENDPATH**/ ?>