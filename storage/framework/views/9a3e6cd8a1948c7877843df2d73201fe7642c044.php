

<?php $__env->startSection('template_title'); ?>
  <?php echo trans('message.message-menu-alt'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <section class="l_lead_section">
    <div class="container">
      <div class="common-form-wrapper">
        <?php echo $__env->make('partials.user-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="common-caption">
          <h3 class="label y-padding"><?php echo trans('message.message-menu-alt'); ?></h3>
          <ul class="actions">
            <li>
              <a class="btn btn-secondary text-white" href="<?php echo e(route('messages')); ?>">
                <?php echo trans('message.buttons.back-to-messages'); ?>

              </a>
            </li>
          </ul>
        </div>
        <div class="p_manager_form message_form">
          <table class="table form_table">
            <tbody>
              <tr>
                <th>品物</th>
                <td>
                  <div class="wrapper_inline">
                    <div class="product_info">
                      <ul class="cats">
                        <li><a href="<?php echo e(url('/products', ['area' => $product->area->id])); ?>"><?php echo e($product->area->name); ?></a></li>
                        <li><a href="<?php echo e(url('/products', ['area' => $product->area->id, 'category' => $product->category->id])); ?>"><?php echo e($product->category->name); ?></a></li>
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
                        <?php if($consult->status == 0): ?>
                          <li>
                            <span class="status_btn disible">受付中</span>
                          </li>
                        <?php elseif($consult->status == 1): ?>
                          <li>
                            <span class="status_btn disible">取引相談中</span>
                          </li>
                          <?php if( Auth::user()->id !== $consult->product->user_id && $consult->product->status < 3 ): ?>
                            <li>
                              <?php echo Form::open(array('route' => 'transaction', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                                <?php echo csrf_field(); ?>

                                <?php echo Form::hidden('action', 'request'); ?>

                                <?php echo Form::hidden('consult_id', $consult->id); ?>

                                <?php echo Form::button('取引完了', array('class' => 'status_btn complete-btn','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#actionRequest', 'data-message' => trans('message.messages.requestConfirm'))); ?>

                              <?php echo Form::close(); ?>

                            </li>
                          <?php endif; ?>
                        <?php elseif($consult->status == 2): ?>
                          <?php if( Auth::user()->id === $consult->product->user_id ): ?>
                            <li>
                              <span class="status_btn disible">取引相談中</span>
                            </li>
                            <li>
                              <?php echo Form::open(array('route' => 'transaction', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                                <?php echo csrf_field(); ?>

                                <?php echo Form::hidden('action', 'confirm'); ?>

                                <?php echo Form::hidden('consult_id', $consult->id); ?>

                                <?php echo Form::button('取引完了を確認する', array('class' => 'status_btn complete-btn','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#actionConfirm', 'data-message' => trans('message.messages.requestedConfirm'))); ?>

                              <?php echo Form::close(); ?>

                            </li>
                          <?php else: ?>
                            <li>
                              <span class="status_btn disible">取引合意中</span>
                            </li>
                          <?php endif; ?>
                        <?php elseif($consult->status == 3): ?>
                          <li>
                            <span class="status_btn disible">取引完了</span>
                          </li>
                          <?php if( Auth::user()->id === $consult->product->user_id && $consult->product->status >= 3 ): ?>
                            <li>
                              <?php echo Form::open(array('route' => 'format', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')); ?>

                                <?php echo csrf_field(); ?>

                                <?php echo Form::hidden('product_id', $consult->product->id); ?>

                                <?php echo Form::button('受付中に変更する', array('class' => 'status_btn','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmChange', 'data-message' => trans('message.messages.acceptConfirm'))); ?>

                              <?php echo Form::close(); ?>

                            </li>
                          <?php endif; ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <table class="message_table">
            <tbody id="messages_body">
              <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                  <th><?php echo e($message->user->name); ?></th>
                  <td>
                    <div class="clearfix">
                      <div class="message_text"><?php echo html_entity_decode(nl2br(e($message->message))); ?></div>
                      <p class="message_date"><?php echo e($message->created_at->format("Y.m.d H:i")); ?></p>
                    </div>
                  </td>
                </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2">
                  <?php echo Form::open(array('route' => 'ajax-message', 'method' => 'POST', 'role' => 'form', 'id' => 'message-form', 'class' => 'needs-validation')); ?>

                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="consult_id" value="<?php echo e($consult->id); ?>">
                    <div class="form_info">
                      <div class="form_input">
                        <label for="message">返信</label>
                        <?php echo Form::textarea('message', NULL, array('id' => 'message', 'rows' => 10, 'placeholder' => trans('message.messages.messageRequired'), 'style' => 'resize: none' )); ?>

                        <?php if($errors->has('message')): ?>
                          <p class="validate"><?php echo e($errors->first('message')); ?></p>
                        <?php endif; ?>
                      </div>
                    </div>
                    <div class="form_submit">
                      <?php echo Form::button(trans('message.buttons.create'), array('class' => 'form_btn btn-basic btn-block text-white','type' => 'submit' )); ?>

                    </div>
                  <?php echo Form::close(); ?>

                </td>
              </tr>
            </tfoot>
          </table>
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
  <?php echo $__env->make('scripts.message-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/user/show-message.blade.php ENDPATH**/ ?>