<?php echo Form::open(array('route' => 'clear-activity')); ?>

    <?php echo Form::hidden('_method', 'DELETE'); ?>

    <?php echo Form::button('<i class="fa fa-fw fa-trash" aria-hidden="true"></i>' . trans('LaravelLogger::laravel-logger.dashboard.menu.clear'), array('type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('LaravelLogger::laravel-logger.modals.clearLog.title'),'data-message' => trans('LaravelLogger::laravel-logger.modals.clearLog.message'), 'class' => 'dropdown-item')); ?>

<?php echo Form::close(); ?>

<?php /**PATH E:\SuzukiWork\2023-02-28(laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//forms/clear-activity-log.blade.php ENDPATH**/ ?>