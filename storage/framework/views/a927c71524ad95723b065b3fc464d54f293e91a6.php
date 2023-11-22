<?php echo Form::open(array('route' => 'destroy-activity', 'class' => 'mb-0')); ?>

    <?php echo Form::hidden('_method', 'DELETE'); ?>

    <?php echo Form::button('<i class="fa fa-fw fa-eraser" aria-hidden="true"></i>' . trans('LaravelLogger::laravel-logger.dashboardCleared.menu.deleteAll'), array('type' => 'button', 'class' => 'text-danger dropdown-item', 'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => trans('LaravelLogger::laravel-logger.modals.deleteLog.title'),'data-message' => trans('LaravelLogger::laravel-logger.modals.deleteLog.message'))); ?>

<?php echo Form::close(); ?>

<?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\vendor\jeremykenedy\laravel-logger\src/resources/views//forms/delete-activity-log.blade.php ENDPATH**/ ?>