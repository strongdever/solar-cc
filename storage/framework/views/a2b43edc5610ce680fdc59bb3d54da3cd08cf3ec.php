<div class="modal fade" id="carportDetailModal<?php echo $carport->id; ?>" role="dialog" aria-labelledby="carportNewModal<?php echo $carport->id; ?>" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog">
        <?php echo Form::open(array('route' => ['carport.update', $carport->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'modal-content needs-validation', 'id' => 'carportUpdateModalForm')); ?>

            <div class="modal-header">
                <h4 class="modal-title"><?php echo $carport->company; ?><?php echo e(__('の詳細')); ?></h4>
                <button type="button" data-dismiss="modal" aria-label="Close" class="close"><i class="icon-close" aria-hidden="true"></i></button>
            </div>
            <div class="modal-body">
                <div class="modal-scroll">
                    <div class="form">
                        <?php echo csrf_field(); ?>

                        <h3 class="form-lead"><?php echo e(__('基本情報')); ?></h3>
                        <div class="form-card card-sm mb-40 mb-sp-30">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="input-group">
                                            <label for="uuid" class="label"><?php echo e(__('商品ID')); ?></label>
                                            <input type="text" class="form-control ss" name="uuid" placeholder="<?php echo e(__('例）10001')); ?>" value="<?php echo $carport->uuid; ?>">
                                            <p class="help">※通知された商品IDを入力してください</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="company" class="label"><?php echo e(__('発電所登録名')); ?></label>
                                            <input type="text" class="form-control md" name="company" placeholder="<?php echo e(__('例）カーポート株式会社')); ?>" value="<?php echo $carport->company; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="address" class="label"><?php echo e(__('設置場所')); ?></label>
                                            <input type="text" class="form-control xs" name="address" placeholder="<?php echo e(__('例）茨城県水戸市千波町1950 ウェーブ21ビル2F')); ?>" value="<?php echo $carport->address; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="phone" class="label"><?php echo e(__('電話番号')); ?></label>
                                            <input type="text" class="form-control sm" name="phone" placeholder="<?php echo e(__('例）029-303-8581')); ?>" value="<?php echo $carport->phone; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="email" class="label"><?php echo e(__('メールアドレス')); ?></label>
                                            <input type="email" class="form-control md" name="email" placeholder="<?php echo e(__('例）info@example.com')); ?>" value="<?php echo $carport->email; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="manager" class="label"><?php echo e(__('担当者')); ?></label>
                                            <input type="text" class="form-control md" name="manager" placeholder="<?php echo e(__('例）山田太郎')); ?>" value="<?php echo $carport->manager; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="contract_type_id" class="label"><?php echo e(__('契約形態')); ?></label>
                                            <select name="contract_type_id" id="contract_type_id" class="form-control sm">
                                                <option>選択してください</option>
                                                <?php if(get_carport_types()): ?>
                                                    <?php $__currentLoopData = get_carport_types(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carport_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($carport_type->id); ?>" <?php if( $carport_type->id === $carport->contract_type_id ): ?> selected <?php endif; ?>><?php echo e($carport_type->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="form-row">
                                            <div class="form-col">
                                                <div class="input-group">
                                                    <label for="name" class="label"><?php echo e(__('登録日')); ?></label>
                                                    <p class="noinput"><?php echo $carport->registered_at->format('Y年m月d日'); ?></p>
                                                </div>
                                            </div>
                                            <div class="form-col">
                                                <div class="input-group">
                                                    <label for="name" class="label"><?php echo e(__('開始日')); ?></label>
                                                    <p class="noinput"><?php echo $carport->started_at->format('Y年m月d日'); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="unit_price" class="label"><?php echo e(__('自家消費分販売電力単価（税込）')); ?></label>
                                            <div class="input-inline">
                                                <input type="text" class="form-control sd" name="unit_price" value="<?php echo $carport->unit_price; ?>">
                                                <span class="text">円 / 1kwh</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="form-lead"><?php echo e(__('請求先情報')); ?></h3>
                        <div class="form-card card-sm mb-40 mb-sp-30">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_name" class="label"><?php echo e(__('請求先名')); ?></label>
                                            <input type="text" class="form-control md" name="bill_name" placeholder="<?php echo e(__('例）カーポート株式会社')); ?>" value="<?php echo $carport->bill->name; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_zipcode" class="label"><?php echo e(__('請求先郵便番号')); ?></label>
                                            <input type="text" class="form-control sd" name="bill_zipcode" placeholder="<?php echo e(__('例）310-0851')); ?>" value="<?php echo $carport->bill->zipcode; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_address1" class="label"><?php echo e(__('請求先住所1')); ?></label>
                                            <input type="text" class="form-control xs" name="bill_address1" placeholder="<?php echo e(__('例）茨城県水戸市千波町1950')); ?>" value="<?php echo $carport->bill->address1; ?>">
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="bill_address2" class="label"><?php echo e(__('請求先住所2')); ?></label>
                                            <input type="text" class="form-control xs" name="bill_address2" placeholder="<?php echo e(__('例）ウェーブ21ビル2F')); ?>" value="<?php echo $carport->bill->address2; ?>">
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <h3 class="form-lead"><?php echo e(__('その他請求項目')); ?></h3>
                        <div class="form-card card-sm">
                            <div class="card-body">
                                <ul class="form-group">
                                    <li>
                                        <div class="carport-other-fee-wrapper">
                                            <?php
                                                $feeItems = $carport->fee->get_data();
                                            ?>
                                            <div class="form-row mb-0">
                                                <?php $__currentLoopData = $feeItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feeItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="form-col mb-24 mb-sp-20">
                                                    <div class="input-group">
                                                        <label for="fee_value" class="label"><?php echo e($feeItem->name); ?></label>
                                                        <div class="input-inline">
                                                            <input type="hidden" name="fee_name[]" value="<?php echo e($feeItem->name); ?>">
                                                            <input type="hidden" name="fee_unit[]" value="<?php echo e($feeItem->unit); ?>">
                                                            <input type="number" class="form-control sd" name="fee_value[]" value="<?php echo e($feeItem->value); ?>">
                                                            <span class="text">円</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </div>
                                        <div class="carport-other-fee-add mt-0">
                                            <button type="button" class="btn btn-sm btn-info btn-outline"><i class="icon-plus" aria-hidden="true"></i><?php echo e(__('請求項目の追加')); ?></button>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="input-group">
                                            <label for="fee_comment" class="label"><?php echo e(__('備考')); ?></label>
                                            <textarea name="fee_comment" id="fee_comment" rows="6" class="xs" placeholder="<?php echo e(__('ここに備考を入力してください')); ?>"><?php echo e($carport->fee->comment); ?></textarea>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" id="updateCarportBtn" class="btn btn-info"><?php echo e(__('更新する')); ?></button>
            </div>
        <?php echo Form::close(); ?>

    </div>
</div><?php /**PATH /home/cptc/www/resources/views/modals/modal-carport-detail.blade.php ENDPATH**/ ?>