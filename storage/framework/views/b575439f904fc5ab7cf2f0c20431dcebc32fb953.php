<?php $__env->startSection(config('laravelblocker.laravelBlockerTitleExtended')); ?>
    <?php echo trans('laravelblocker::laravelblocker.titles.show-blocked-item'); ?>

<?php $__env->stopSection(); ?>

<?php
    switch (config('laravelblocker.blockerBootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header bg-warning text-white';
            if(isset($typeDeleted)) {
                $containerHeaderClass = 'card-header bg-danger text-white';
            }
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-warning';
            if(isset($typeDeleted)) {
                $containerClass = 'panel panel-danger';
            }
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $blockerBootstrapCardClasses = (is_null(config('laravelblocker.blockerBootstrapCardClasses')) ? '' : config('laravelblocker.blockerBootstrapCardClasses'));
?>

<?php $__env->startSection(config('laravelblocker.blockerBladePlacementCss')); ?>
    <?php if(config('laravelblocker.blockerEnableFontAwesomeCDN')): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo e(config('laravelblocker.blockerFontAwesomeCDN')); ?>">
    <?php endif; ?>
    <?php echo $__env->make('laravelblocker::partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelblocker::partials.bs-visibility-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('laravelblocker::partials.flash-messages', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <section class="l_lead_section">
        <div class="container">
            <div class="common-form-wrapper">
                <div class="common-caption">
                    <h3 class="label y-padding">
                        <?php if(isset($typeDeleted)): ?>
                            <?php echo trans('laravelblocker::laravelblocker.blocked-item-deleted-title', ['name' => $item->value]); ?>

                        <?php else: ?>
                            <?php echo trans('laravelblocker::laravelblocker.blocked-item-title', ['name' => $item->value]); ?>

                        <?php endif; ?>
                    </h3>
                    <ul class="actions">
                        <li>
                            <?php if(isset($typeDeleted)): ?>
                                <a href="<?php echo e(url('blocker-deleted')); ?>" class="btn btn-danger text-white">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('laravelblocker::laravelblocker.buttons.back-to-blocked-deleted'); ?>

                                </a>
                            <?php else: ?>
                                <a href="<?php echo e(url('blocker')); ?>" class="btn btn-secondary text-white">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    <?php echo trans('laravelblocker::laravelblocker.buttons.back-to-blocked'); ?>

                                </a>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
                <div class="common-form">
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ID
                            <span class="badge badge-pill">
                                <?php echo e($item->id); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            タイプID
                            <span class="badge badge-pill">
                                <?php echo e($item->typeId); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            スラッグ
                            <span class="badge badge-pill">
                                <?php echo $item->blockedType->slug; ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            値
                            <span class="badge badge-pill">
                                <?php echo e($item->value); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            要項
                            <span class="badge badge-pill">
                                <?php echo e($item->note); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            ユーザーID
                            <span class="badge badge-pill">
                                <?php if($item->userId): ?>
                                    <?php echo $item->userId; ?>

                                <?php else: ?>
                                    <span class="disabled">
                                        <?php echo trans('laravelblocker::laravelblocker.none'); ?>

                                    </span>
                                <?php endif; ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            登録日
                            <span class="badge badge-pill">
                                <?php echo $item->created_at->format('Y年m月d日 H:i'); ?>

                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            更新日
                            <span class="badge badge-pill">
                                <?php echo $item->updated_at->format('Y年m月d日 H:i'); ?>

                            </span>
                        </li>
                        <?php if($item->deleted_at): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                削除日
                                <span class="badge badge-pill">
                                    <?php echo $item->deleted_at->format('Y年m月d日 H:i'); ?>

                                </span>
                            </li>
                        <?php endif; ?>
                    </ul>
                    <ul class="btn-group form-bottom">
                        <li>
                            <?php if(isset($typeDeleted)): ?>
                                <?php echo $__env->make('laravelblocker::forms.restore-item', ['restoreType' => 'full'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                <a class="btn form-btn btn-info btn-block text-white" href="/blocker/<?php echo e($item->id); ?>/edit" data-toggle="tooltip" title="<?php echo e(trans("laravelblocker::laravelblocker.tooltips.edit")); ?>">
                                    <?php echo trans("laravelblocker::laravelblocker.buttons.edit-larger"); ?>

                                </a>
                            <?php endif; ?>
                        </li>
                        <li>
                            <?php if(isset($typeDeleted)): ?>
                                <?php echo $__env->make('laravelblocker::forms.destroy-full', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php else: ?>
                                <?php echo $__env->make('laravelblocker::forms.delete-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <?php echo $__env->make('laravelblocker::modals.confirm-modal',[
        'formTrigger' => 'confirmRestore',
        'modalClass' => 'success',
        'actionBtnIcon' => 'fa-check'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->make('laravelblocker::modals.confirm-modal',[
        'formTrigger' => 'confirmDelete',
        'modalClass' => 'danger',
        'actionBtnIcon' => 'fa-trash-o'
    ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection(config('laravelblocker.blockerBladePlacementJs')); ?>
    <?php if(config('laravelblocker.enablejQueryCDN')): ?>
        <script type="text/javascript" src="<?php echo e(config('laravelblocker.JQueryCDN')); ?>"></script>
    <?php endif; ?>
    <?php echo $__env->make('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmDelete'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('laravelblocker::scripts.confirm-modal', ['formTrigger' => '#confirmRestore'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php if(config('laravelblocker.tooltipsEnabled')): ?>
        <?php echo $__env->make('laravelblocker::scripts.tooltips', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->yieldContent('inline_template_linked_css'); ?>
<?php echo $__env->yieldContent('inline_footer_scripts'); ?>

<?php echo $__env->make(config('laravelblocker.laravelBlockerBladeExtended'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-blocker\src/resources/views//laravelblocker/show.blade.php ENDPATH**/ ?>