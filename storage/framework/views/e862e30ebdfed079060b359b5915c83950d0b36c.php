    <header id="header">
        <div class="container">
            <div class="header-wrapper clearfix">
                <h1 class="header-logo scrollto">
                    <a href="<?php echo e(url('/home')); ?>">
                        <img src="<?php echo asset('assets/img/logo.svg'); ?>" alt="">
                    </a>
                </h1>
                <div class="collapse header-collapse navbar-collapse show" id="admin-collapse">
                    <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <span class="hidden-md"><?php echo trans('titles.adminDropdownNav'); ?> </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('laravelroles::roles.index')); ?>">権限管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/stores')); ?>">販売店管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/contract_types')); ?>">契約形態管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/logs')); ?>">ログファイル</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/activity')); ?>">履歴管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/phpinfo')); ?>">PHP情報</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(url('/active-users')); ?>">オンライン販売店</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('laravelblocker::blocker.index')); ?>">ブロッカー管理</a>
                                </div>
                            </li>
                        </ul>
                    <?php endif; ?>
                    <ul class="navbar-nav pc">
                        <?php if(auth()->guard()->guest()): ?>
                            <li>
                                <ul class="block-menu">
                                    <li>
                                        <a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(trans('titles.login')); ?></a>
                                    </li>
                                    <?php if(Route::has('register')): ?>
                                        <li>
                                            <a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(trans('titles.register')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="icon-building" aria-hidden="true"></i> <?php echo e(Auth::user()->uuid); ?>様
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item <?php echo e(Request::is('store/'.Auth::user()->uuid, 'store/'.Auth::user()->uuid . '/edit') ? 'active' : null); ?>" href="<?php echo e(url('/store/'.Auth::user()->uuid)); ?>">
                                        <?php echo trans('titles.profile'); ?>

                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <?php echo e(__('ログアウト')); ?>

                                    </a>
                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php if(auth()->guard()->check()): ?>
            <nav class="header-nav">
                <div class="container">
                    <ul class="nav-menu">
                        <li>
                            <a href="<?php echo e(url('/home')); ?>" class="menu-link<?php echo e(Request::is('home') ? ' active' : ''); ?>">ホーム</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/power-register')); ?>" class="menu-link<?php echo e(Request::is('power-register') ? ' active' : ''); ?>">電力データ登録</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/invoice')); ?>" class="menu-link<?php echo e(Request::is('invoice') ? ' active' : ''); ?>">請求一覧</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/carport')); ?>" class="menu-link<?php echo e(Request::is('carport') ? ' active' : ''); ?>">カーポート一覧</a>
                        </li>
                        <li>
                            <a href="<?php echo e(url('/store/'.Auth::user()->uuid)); ?>" class="menu-link<?php echo e(Request::is('store/'.Auth::user()->uuid, 'store/'.Auth::user()->uuid . '/edit') ? ' active' : ''); ?>">販売店情報</a>
                        </li>
                    </ul>
                </div>
            </nav>
        <?php endif; ?>
    </header>

    <?php if(auth()->guard()->check()): ?>
        <div id="mobile-nav">
            <nav class="mobile-nav-container">
                <div class="mobile-user">
                    <p class="user-name"><i class="icon-building" aria-hidden="true"></i><?php echo e(Auth::user()->uuid); ?>様</p>
                </div>
                <ul class="mobile-nav-menu">
                    <li>
                        <a href="" class="menu-link active">ホーム</a>
                    </li>
                    <li>
                        <a href="" class="menu-link">電力データ登録</a>
                    </li>
                    <li>
                        <a href="" class="menu-link">請求一覧</a>
                    </li>
                    <li>
                        <a href="" class="menu-link">カーポート一覧</a>
                    </li>
                    <li>
                        <a href="" class="menu-link">販売店情報</a>
                    </li>
                </ul>
            </nav>
        </div>
    <?php endif; ?><?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/partials/nav.blade.php ENDPATH**/ ?>