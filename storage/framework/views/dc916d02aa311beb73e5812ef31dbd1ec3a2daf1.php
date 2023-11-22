

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
          <h3 class="label"><?php echo trans('message.message-menu-alt'); ?></h3>
        </div>
        <div class="p_manager_form">
          <?php if( $consults->count() > 0 ): ?>
            <ul class="message-list">
              <?php $__currentLoopData = $consults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $consult): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                $messageCount = count($consult->messages);
                ?>
                <?php if( $messageCount ): ?>
                  <li>
                    <a href="<?php echo e(URL::to('/messages/' . $consult->id)); ?>" class="message-item">
                      <figure class="thumb">
                        <img src="<?php echo e(asset($consult->product->get_photos()[0]->path)); ?>" alt="<?php echo e($consult->product->name); ?>">
                      </figure>
                      <div class="content">
                        <h4 class="title"><?php echo e($consult->product->name); ?></h4>
                        <div class="text"><?php echo html_entity_decode(nl2br(e($consult->messages[$messageCount-1]->message))); ?></div>
                      </div>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <div class="result-pagenavi mt_30">
              <?php if($consults->lastPage() === 1): ?>
                <ul class="pagination">
                  <li class="page-item disabled"><span class="page-link">«</span></li>
                  <li class="page-item active"><span class="page-link">1</span></li>
                  <li class="page-item disabled"><span class="page-link">»</span></li>
                </ul>
              <?php else: ?>
                <?php echo e($consults->links()); ?>

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

  <?php echo $__env->make('modals.modal-delete', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
  <?php echo $__env->make('scripts.delete-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php echo $__env->make('scripts.save-modal-script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php if(config('options.tooltipsEnabled')): ?>
    <?php echo $__env->make('scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/pages/user/show-messages.blade.php ENDPATH**/ ?>