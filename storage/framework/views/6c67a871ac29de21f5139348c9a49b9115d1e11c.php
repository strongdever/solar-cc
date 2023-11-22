<header id="header">
  <div class="container">
    <div class="header_wrapper clearfix">
      <h1 class="logo scrollto">
        <a href="<?php echo e(url('/')); ?>" class="logo_link">
          <figure class="logo_img">
            <img src="<?php echo asset('assets/img/logo.png'); ?>" alt="オフィス機器">
          </figure>
        </a>
      </h1>
      <nav class="nav_menu_container">
        <ul class="nav_menu">
          <?php if(auth()->guard()->check()): ?>
            <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
            <li class="dropdown">
              <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">管理者ページ</a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="<?php echo e(route('laravelroles::roles.index')); ?>">役割管理</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/users')); ?>">ユーザー管理</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/activity')); ?>">履歴管理</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/phpinfo')); ?>">PHP情報</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(url('/active-users')); ?>">オンラインユーザー</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('laravelblocker::blocker.index')); ?>">ブロッカー管理</a>
              </div>
            </li>
            <?php endif; ?>
          <?php endif; ?>
          <li>
            <a href="<?php echo e(route('guide')); ?>">
              <span>ご利用方法</span>
            </a>
          </li>
          <li>
            <a href="">
              <span>譲りたいアイテムを登録する</span>
            </a>
          </li>
          <li>
            <a href="">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.208" viewBox="0 0 16 15.208">
                <path id="Icon_ionic-md-star" data-name="Icon ionic-md-star" d="M11.8,16.725l4.944,2.983-1.308-5.626L19.8,10.3,14.044,9.8,11.8,4.5,9.55,9.8,3.8,10.3l4.364,3.783L6.853,19.708Z" transform="translate(-3.797 -4.5)" fill="#fff"/>
              </svg>
              <span>気になる</span>
            </a>
          </li>
          <?php if(auth()->guard()->guest()): ?>
            <?php if(Route::has('login')): ?>
              <li>
                <a href="<?php echo e(route('login')); ?>">
                  <span>会員登録 / ログイン</span>
                </a>
              </li>
            <?php endif; ?>
          <?php endif; ?>

          <?php if(auth()->guard()->check()): ?>
            <li>
              <a href="">
                <span>マイページ</span>
              </a>
            </li>
            <li>
              <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <span>ログアウト</span>
              </a>
              <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
              </form>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </div>
</header>

<div id="mobile_nav">
  <div class="nav_body">
    <nav class="mobile_nav_menu_container">
      <ul class="mobile_nav_menu">
        <?php if(auth()->guard()->check()): ?>
          <?php if (Auth::check() && Auth::user()->hasRole('admin')): ?>
          <li>
            <a href="<?php echo e(route('users')); ?>">
              <span>ユーザー管理</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('laravelroles::roles.index')); ?>">
              <span>役割管理</span>
            </a>
          </li>
          <?php endif; ?>
        <?php endif; ?>
        <li>
          <a href="<?php echo e(route('guide')); ?>">
            <span>ご利用方法</span>
          </a>
        </li>
        <li>
          <a href="">
            <span>譲りたいアイテムを登録する</span>
          </a>
        </li>
        <li>
          <a href="">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="15.208" viewBox="0 0 16 15.208">
              <path id="Icon_ionic-md-star" data-name="Icon ionic-md-star" d="M11.8,16.725l4.944,2.983-1.308-5.626L19.8,10.3,14.044,9.8,11.8,4.5,9.55,9.8,3.8,10.3l4.364,3.783L6.853,19.708Z" transform="translate(-3.797 -4.5)" fill="#fff"/>
            </svg>
            <span>気になる</span>
          </a>
        </li>
        <?php if(auth()->guard()->guest()): ?>
          <?php if(Route::has('login')): ?>
            <li>
              <a href="<?php echo e(route('login')); ?>">
                <span>会員登録 / ログイン</span>
              </a>
            </li>
          <?php endif; ?>
        <?php endif; ?>

        <?php if(auth()->guard()->check()): ?>
          <li>
            <a href="">
              <span>マイページ</span>
            </a>
          </li>
          <li>
            <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form-nav').submit();">
              <span>ログアウト</span>
            </a>
            <form id="logout-form-nav" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
              <?php echo csrf_field(); ?>
            </form>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</div><?php /**PATH E:\WORK(2022)\SuzukiWork\11-3(Laravel)\WORK\laravel-auth\resources\views/layouts/partials/navbar.blade.php ENDPATH**/ ?>