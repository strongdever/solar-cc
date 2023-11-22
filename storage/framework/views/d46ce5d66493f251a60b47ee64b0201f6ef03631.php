

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('transaction.transaction-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.user-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label"><?php echo trans('transaction.transaction-menu-alt'); ?></h3>
        </div>
        <div class="p_manager_form message_form">
          <?php if( $transactions->count() > 0 ): ?>
            <table class="table form_table">
              <tbody id="products_table">
                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                  $product = $transaction->product;
                  ?>
                  <tr>
                    <th>品物</th>
                    <td>
                      <div class="wrapper_inline">
                        <div class="product_info">
                          <ul class="cats">
                            <li><a href="<?php echo e(urldecode(route('products') . '?area=' . $product->area->id)); ?>"><?php echo e($product->area->name); ?></a></li>
                            <li><a href="<?php echo e(urldecode(route('products') . '?cat=' . $product->category->id)); ?>"><?php echo e($product->category->name); ?></a></li>
                          </ul>
                          <h4 class="title"><a href="<?php echo e(URL::to('/products/' . $product->id)); ?>"><?php echo e($product->name); ?></a></h4>
                          <p class="type">メーカー名 <?php echo e($product->maker_name); ?>　メーカー型番 <?php echo e($product->maker_model); ?></p>
                          <p class="additions">
                            <?php if($product->status == 0): ?>
                              <span class="state">受付中</span>
                            <?php elseif($product->status == 1): ?>
                              <span class="state">取引相談中</span>
                            <?php elseif($product->status == 2): ?>
                              <span class="state">取引合意中</span>
                            <?php elseif($product->status == 3): ?>
                              <span class="state">取引完了</span>
                            <?php endif; ?>
                            <span class="price">本体希望価格<strong><?php echo e(number_format($product->price)); ?>円</strong>（税込）</span>
                          </p>
                          <ul class="responses">
                            <li>
                              <span>業者メンテナンス対応品</span>
                            </li>
                          </ul>
                        </div>
                        <div class="product_status">
                          <p class="status_label">ステータス</p>
                          <ul class="status_list">
                            <?php if($product->status == 0): ?>
                              <li>
                                <span class="status">受付中</span>
                              </li>
                            <?php elseif($product->status == 1): ?>
                              <li>
                                <span class="status">取引相談中</span>
                              </li>
                            <?php elseif($product->status == 2): ?>
                              <li>
                                <span class="status">取引合意中</span>
                              </li>
                            <?php elseif($product->status == 3): ?>
                              <li>
                                <span class="status">取引完了</span>
                              </li>
                              <?php if( Auth::user()->id === $product->user_id ): ?>
                                <li>
                                  <?php echo Form::open(array('route' => 'format', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                                    <?php echo csrf_field(); ?>

                                    <?php echo Form::hidden('product_id', $product->id); ?>

                                    <?php echo Form::button('受付中に変更する', array('class' => 'status_btn active','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmChange', 'data-message' => trans('message.messages.acceptConfirm'))); ?>

                                  <?php echo Form::close(); ?>

                                </li>
                              <?php endif; ?>
                            <?php endif; ?>
                          </ul>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </tbody>
            </table>
            <div class="result-pagenavi mt_30">
              <?php if($transactions->lastPage() === 1): ?>
                <ul class="pagination">
                  <li class="page-item disabled"><span class="page-link">«</span></li>
                  <li class="page-item active"><span class="page-link">1</span></li>
                  <li class="page-item disabled"><span class="page-link">»</span></li>
                </ul>
              <?php else: ?>
                <?php echo e($transactions->links()); ?>

              <?php endif; ?>
            </div>
          <?php else: ?>
            <div class="no-result">
              <?php echo trans( 'pagination.noResult' ); ?>

            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </section>

  <div class="modal fade common-modal modal-success modal-request" id="actionConfirm" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-layout">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-body">
            <p class="txt">ステータスが、取り引き完了に変更されました。<br>確認後、この品物の持ち主が移動します。</p>
            <ul class="btn-group">
              <li>
                <?php echo Form::button( '取引完了を確認しました', array('class' => 'form-btn btn-secondary btn-clear text-white btn-flat', 'type' => 'button', 'id' => 'confirm' )); ?>

              </li>
              <li>
                <?php echo Form::button( '取引はまだ完了していません', array('class' => 'form-btn btn-secondary btn-clear text-white btn-flat', 'type' => 'button', 'id' => 'reject' )); ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade common-modal modal-success modal-request" id="actionRequest" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-layout">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-body">
            <p class="txt">本当に取引を完了しますか？</p>
            <ul class="btn-group">
              <li>
                <?php echo Form::button( '取引を完了する', array('class' => 'form-btn btn-secondary btn-clear text-white btn-flat', 'type' => 'button', 'id' => 'confirm' )); ?>

              </li>
              <li>
                <?php echo Form::button( 'キャンセル', array('class' => 'form-btn btn-secondary btn-clear text-white btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade common-modal modal-success modal-confirm" id="confirmChange" role="dialog" aria-labelledby="confirmSaveLabel" aria-hidden="true" tabindex="-1">
    <div class="modal-layout">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <div class="modal-body">
            <p class="txt">
              <?php echo trans('modals.confirm_modal_title_text'); ?>

            </p>
            <ul class="btn-group">
              <li>
                <?php echo Form::button( trans('modals.confirm_modal_button_change_text'), array('class' => 'form-btn btn-secondary btn-flat', 'type' => 'button', 'id' => 'confirm' )); ?>

              </li>
              <li>
                <?php echo Form::button(trans('modals.confirm_modal_button_cancel_text'), array('class' => 'form-btn btn-secondary btn-flat', 'type' => 'button', 'data-dismiss' => 'modal' )); ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.message-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/user/show-transactions.blade.php ENDPATH**/ ?>