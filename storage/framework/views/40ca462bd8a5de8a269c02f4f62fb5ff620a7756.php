<?php
    $userIdField = config('LaravelLogger.defaultUserIDField')
?>



<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->startSection(config('LaravelLogger.bladePlacementCss')); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->startPush(config('LaravelLogger.bladePlacementCss')); ?>
<?php endif; ?>

<?php echo $__env->make('LaravelLogger::partials.styles', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->stopSection(); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->startSection(config('LaravelLogger.bladePlacementJs')); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->startPush(config('LaravelLogger.bladePlacementJs')); ?>
<?php endif; ?>

<?php echo $__env->make('LaravelLogger::partials.scripts', ['activities' => $userActivities], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php if(config('LaravelLogger.bladePlacement') == 'yield'): ?>
    <?php $__env->stopSection(); ?>
<?php elseif(config('LaravelLogger.bladePlacement') == 'stack'): ?>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php $__env->startSection('template_title'); ?>
    <?php echo e(trans('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id])); ?>

<?php $__env->stopSection(); ?>

<?php
    switch (config('LaravelLogger.bootstapVersion')) {
        case '4':
            $containerClass = 'card';
            $containerHeaderClass = 'card-header';
            $containerBodyClass = 'card-body';
            break;
        case '3':
        default:
            $containerClass = 'panel panel-default';
            $containerHeaderClass = 'panel-heading';
            $containerBodyClass = 'panel-body';
    }
    $bootstrapCardClasses = (is_null(config('LaravelLogger.bootstrapCardClasses')) ? '' : config('LaravelLogger.bootstrapCardClasses'));

    switch ($activity->userType) {
        case trans('LaravelLogger::laravel-logger.userTypes.registered'):
            $userTypeClass = 'success';
            break;

        case trans('LaravelLogger::laravel-logger.userTypes.crawler'):
            $userTypeClass = 'danger';
            break;

        case trans('LaravelLogger::laravel-logger.userTypes.guest'):
        default:
            $userTypeClass = 'warning';
            break;
    }

    switch (strtolower($activity->methodType)) {
        case 'get':
            $methodClass = 'info';
            break;

        case 'post':
            $methodClass = 'primary';
            break;

        case 'put':
            $methodClass = 'caution';
            break;

        case 'delete':
            $methodClass = 'danger';
            break;

        default:
            $methodClass = 'info';
            break;
    }

    $platform       = $userAgentDetails['platform'];
    $browser        = $userAgentDetails['browser'];
    $browserVersion = $userAgentDetails['version'];

    switch ($platform) {

        case 'Windows':
            $platformIcon = 'fa-windows';
            break;

        case 'iPad':
            $platformIcon = 'fa-';
            break;

        case 'iPhone':
            $platformIcon = 'fa-';
            break;

        case 'Macintosh':
            $platformIcon = 'fa-apple';
            break;

        case 'Android':
            $platformIcon = 'fa-android';
            break;

        case 'BlackBerry':
            $platformIcon = 'fa-';
            break;

        case 'Unix':
        case 'Linux':
            $platformIcon = 'fa-linux';
            break;

        case 'CrOS':
            $platformIcon = 'fa-chrome';
            break;

        default:
            $platformIcon = 'fa-';
            break;
    }

    switch ($browser) {

        case 'Chrome':
            $browserIcon  = 'fa-chrome';
            break;

        case 'Firefox':
            $browserIcon  = 'fa-';
            break;

        case 'Opera':
            $browserIcon  = 'fa-opera';
            break;

        case 'Safari':
            $browserIcon  = 'fa-safari';
            break;

        case 'Internet Explorer':
            $browserIcon  = 'fa-edge';
            break;

        default:
            $browserIcon  = 'fa-';
            break;
    }
?>

<?php $__env->startSection('content'); ?>

    <?php if(config('LaravelLogger.enablePackageFlashMessageBlade')): ?>
        <?php echo $__env->make('LaravelLogger::partials.form-status', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="common-caption">
        <h3 class="label y-padding">
            <?php echo trans('LaravelLogger::laravel-logger.drilldown.title', ['id' => $activity->id]); ?>

        </h3>
        <ul class="actions">
            <li>
                <a href="<?php if($isClearedEntry): ?> <?php echo e(route('cleared')); ?> <?php else: ?> <?php echo e(route('activity')); ?> <?php endif; ?>" class="btn btn-basic">
                    <i class="fa fa-fw fa-mail-reply" aria-hidden="true"></i>
                    <?php echo trans('LaravelLogger::laravel-logger.drilldown.buttons.back'); ?>

                </a>
            </li>
        </ul>
    </div>
    <div class="sm-row">
        <div class="col-md-6 col-lg-4 mb-30">
            <ul class="list-group">
                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                    <?php echo trans('LaravelLogger::laravel-logger.drilldown.title-details'); ?>

                </li>
                <li class="list-group-item">
                    <dl class="dl-horizontal">
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.id'); ?></dt>
                        <dd><?php echo e($activity->id); ?></dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.description'); ?></dt>
                        <dd><?php echo e($activity->description); ?></dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.route'); ?></dt>
                        <dd>
                            <a href="<?php if($activity->route != '/'): ?>/<?php endif; ?><?php echo e($activity->route); ?>">
                                <?php echo e($activity->route); ?>

                            </a>
                        </dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.agent'); ?></dt>
                        <dd>
                            <i class="fa <?php echo e($platformIcon); ?> fa-fw" aria-hidden="true">
                                <span class="sr-only">
                                    <?php echo e($platform); ?>

                                </span>
                            </i>
                            <i class="fa <?php echo e($browserIcon); ?> fa-fw" aria-hidden="true">
                                <span class="sr-only">
                                    <?php echo e($browser); ?>

                                </span>
                            </i>
                            <sup>
                                <small>
                                    <?php echo e($browserVersion); ?>

                                </small>
                            </sup>
                        </dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.locale'); ?></dt>
                        <dd>
                            <?php echo e($langDetails); ?>

                        </dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.referer'); ?></dt>
                        <dd>
                            <a href="<?php echo e($activity->referer); ?>">
                                <?php echo e($activity->referer); ?>

                            </a>
                        </dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.methodType'); ?></dt>
                        <dd>
                            <span class="badge badge-<?php echo e($methodClass); ?>">
                                <?php echo e($activity->methodType); ?>

                            </span>
                        </dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.timePassed'); ?></dt>
                        <dd><?php echo e($timePassed); ?></dd>
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.createdAt'); ?></dt>
                        <dd><?php echo e($activity->created_at->format('Y年月d日 H:i')); ?></dd>
                    </dl>
                </li>
            </ul>
        </div>

        <div class="col-md-6 col-lg-4 mb-30">
            <ul class="list-group">
                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                    <?php echo trans('LaravelLogger::laravel-logger.drilldown.title-ip-details'); ?>

                </li>
                <li class="list-group-item">
                    <dl class="dl-horizontal">
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.ip'); ?></dt>
                        <dd><?php echo e($activity->ipAddress); ?></dd>
                        <?php if($ipAddressDetails): ?>
                            <?php $__currentLoopData = $ipAddressDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ipAddressDetailKey => $ipAddressDetailValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <dt><?php echo e($ipAddressDetailKey); ?></dt>
                                <dd><?php echo e($ipAddressDetailValue); ?></dd>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </dl>
                </li>
            </ul>
        </div>
        <div class="col-md-12 col-lg-4 mb-30">
            <ul class="list-group">
                <li class="list-group-item <?php if($isClearedEntry): ?> list-group-item-danger <?php else: ?> active <?php endif; ?>">
                    <?php echo trans('LaravelLogger::laravel-logger.drilldown.title-user-details'); ?>

                </li>
                <li class="list-group-item">
                    <dl class="dl-horizontal">
                        <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userType'); ?></dt>
                        <dd>
                            <span class="badge badge-<?php echo e($userTypeClass); ?>">
                                <?php echo e($activity->userType); ?>

                            </span>
                        </dd>
                        <?php if($userDetails): ?>
                            <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userId'); ?></dt>
                            <dd><?php echo e($userDetails->uuid); ?></dd>
                            <?php if(config('LaravelLogger.rolesEnabled')): ?>
                                <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.labels.userRoles'); ?></dt>
                                <?php $__currentLoopData = $userDetails->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user_role->name == 'User'): ?>
                                    <?php $labelClass = 'primary' ?>
                                    <?php elseif($user_role->name == 'Admin'): ?>
                                    <?php $labelClass = 'warning' ?>
                                    <?php elseif($user_role->name == 'Unverified'): ?>
                                    <?php $labelClass = 'danger' ?>
                                    <?php else: ?>
                                    <?php $labelClass = 'default' ?>
                                    <?php endif; ?>
                                    <dd>
                                        <span class="badge badge-<?php echo e($labelClass); ?>">
                                            <?php echo e($user_role->name); ?> - <?php echo trans('LaravelLogger::laravel-logger.drilldown.labels.userLevel'); ?> <?php echo e($user_role->level); ?>

                                        </span>
                                    </dd>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userName'); ?></dt>
                            <dd><?php echo e($userDetails->name); ?></dd>
                            <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userEmail'); ?></dt>
                            <dd>
                                <a href="mailto:<?php echo e($userDetails->email); ?>">
                                    <?php echo e($userDetails->email); ?>

                                </a>
                            </dd>
                            <?php if($userDetails->name_kanji): ?>
                                <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userFulltName'); ?></dt>
                                <dd><?php echo e($userDetails->name_kanji); ?></dd>
                            <?php endif; ?>
                            <?php if($userDetails->signup_ip_address): ?>
                                <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userSignupIp'); ?></dt>
                                <dd><?php echo e($userDetails->signup_ip_address); ?></dd>
                            <?php endif; ?>
                            <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userCreatedAt'); ?></dt>
                            <dd><?php echo e($userDetails->created_at->format('Y年月d日 H:i')); ?></dd>
                            <dt><?php echo trans('LaravelLogger::laravel-logger.drilldown.list-group.labels.userUpdatedAt'); ?></dt>
                            <dd><?php echo e($userDetails->updated_at->format('Y年月d日 H:i')); ?></dd>
                        <?php endif; ?>
                    </dl>
                </li>
            </ul>
        </div>
    </div>

    <?php if(!$isClearedEntry): ?>
        <div class="common-caption">
            <h3 class="label y-padding">
                <?php echo trans('LaravelLogger::laravel-logger.drilldown.title-user-activity'); ?>

                <span class="badge badge-info">
                    <?php echo e($totalUserActivities); ?> <?php echo trans('LaravelLogger::laravel-logger.dashboard.subtitle'); ?>

                </span>
            </h3>
        </div>
        <div class="common-form">
            <?php echo $__env->make('LaravelLogger::logger.partials.activity-table', ['activities' => $userActivities], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make(config('LaravelLogger.loggerBladeExtended'), \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//logger/activity-log-item.blade.php ENDPATH**/ ?>