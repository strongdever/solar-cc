<?php echo Form::open(array('route' => 'restore-activity', 'method' => 'POST', 'class' => 'mb-0')); ?>

    <?php echo Form::button('<i class="fa fa-fw fa-history" aria-hidden="true"></i>' . trans('LaravelLogger::laravel-logger.dashboardCleared.menu.restoreAll'), array('type' => 'button', 'class' => 'text-success dropdown-item', 'data-toggle' => 'modal', 'data-target' => '#confirmRestore', 'data-title' => trans('LaravelLogger::laravel-logger.modals.restoreLog.title'),'data-message' => trans('LaravelLogger::laravel-logger.modals.restoreLog.message'))); ?>

<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//forms/restore-activity-log.blade.php ENDPATH**/ ?>