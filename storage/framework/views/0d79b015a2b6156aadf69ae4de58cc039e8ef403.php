<?php
    $userIdField = config('LaravelLogger.defaultUserIDField')
?>

<div class="activity-search mb_10">
    <form action="<?php echo e(route('activity')); ?>" method="get">
        <div class="sm-row">
            <?php if(in_array('description',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <input type="text" name="description" value="<?php echo e(request()->get('description') ? request()->get('description'):null); ?>" placeholder="説明">
                </div>
            <?php endif; ?>
            <?php if(in_array('user',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <select name="user">
                        <option value=""><?php echo e(trans('LaravelLogger::laravel-logger.dashboard.search.all')); ?></option>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($user->$userIdField); ?>"<?php echo e(request()->get('user') && request()->get('user') == $user->$userIdField ? ' selected':''); ?>><?php echo e($user->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php endif; ?>
            <?php if(in_array('method',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <select name="method">
                        <option value=""><?php echo e(trans('LaravelLogger::laravel-logger.dashboard.search.all')); ?></option>
                        <?php $__currentLoopData = explode(' ','CONNECT DELETE GET OPTIONS PATCH POST PUT TRACE'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($val); ?>"<?php echo e(request()->get('method') && request()->get('method') == $val ? ' selected':''); ?>><?php echo e($val); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            <?php endif; ?>
            <?php if(in_array('route',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <input type="text" name="route" value="<?php echo e(request()->get('route') ? request()->get('route'):null); ?>" placeholder="経路">
                </div>
            <?php endif; ?>
            <?php if(in_array('ip',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <input type="text" name="ip_address" value="<?php echo e(request()->get('ip_address') ? request()->get('ip_address'):null); ?>" placeholder="IPアドレス">
                </div>
            <?php endif; ?>
            <?php if(in_array('description',explode(',', config('LaravelLogger.searchFields')))||in_array('user',explode(',', config('LaravelLogger.searchFields'))) ||in_array('method',explode(',', config('LaravelLogger.searchFields'))) || in_array('route',explode(',', config('LaravelLogger.searchFields'))) || in_array('ip',explode(',', config('LaravelLogger.searchFields')))): ?>
                <div class="col-12 col-sm-4 col-lg-2 mb_12">
                    <input type="submit" class="btn btn-basic btn-block" value="<?php echo e(trans('LaravelLogger::laravel-logger.dashboard.search.search')); ?>">
                </div>
            <?php endif; ?>
        </div>
    </form>
</div><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//partials/form-search.blade.php ENDPATH**/ ?>