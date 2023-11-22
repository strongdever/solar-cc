    <header id="header">
        <div class="container">
            <div class="header-wrapper clearfix">
                <h1 class="header-logo scrollto">
                    <a href="{{ url('/home') }}">
                        <img src="{!! asset('assets/img/logo.svg') !!}" alt="">
                    </a>
                </h1>
                <div class="collapse header-collapse navbar-collapse show" id="admin-collapse">
                    @role('admin')
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                    <span class="hidden-md">{!! trans('titles.adminDropdownNav') !!} </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('laravelroles::roles.index') }}">権限管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/stores') }}">販売店管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/contract_types') }}">契約形態管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/logs') }}">ログファイル</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/activity') }}">履歴管理</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/phpinfo') }}">PHP情報</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ url('/active-users') }}">オンライン販売店</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('laravelblocker::blocker.index') }}">ブロッカー管理</a>
                                </div>
                            </li>
                        </ul>
                    @endrole
                    <ul class="navbar-nav pc">
                        @guest
                            <li>
                                <ul class="block-menu">
                                    <li>
                                        <a class="nav-link" href="{{ route('login') }}">{{ trans('titles.login') }}</a>
                                    </li>
                                    @if (Route::has('register'))
                                        <li>
                                            <a class="nav-link" href="{{ route('register') }}">{{ trans('titles.register') }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="icon-building" aria-hidden="true"></i> {{ Auth::user()->uuid }}様
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item {{ Request::is('store/'.Auth::user()->uuid, 'store/'.Auth::user()->uuid . '/edit') ? 'active' : null }}" href="{{ url('/store/'.Auth::user()->uuid) }}">
                                        {!! trans('titles.profile') !!}
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </div>
        @auth
            <nav class="header-nav">
                <div class="container">
                    <ul class="nav-menu">
                        <li>
                            <a href="{{ url('/home') }}" class="menu-link{{ Request::is('home') ? ' active' : '' }}">ホーム</a>
                        </li>
                        <li>
                            <a href="{{ url('/power-register') }}" class="menu-link{{ Request::is('power-register') ? ' active' : '' }}">電力データ登録</a>
                        </li>
                        <li>
                            <a href="{{ url('/invoice') }}" class="menu-link{{ Request::is('invoice') ? ' active' : '' }}">請求一覧</a>
                        </li>
                        <li>
                            <a href="{{ url('/carport') }}" class="menu-link{{ Request::is('carport') ? ' active' : '' }}">カーポート一覧</a>
                        </li>
                        <li>
                            <a href="{{ url('/store/'.Auth::user()->uuid) }}" class="menu-link{{ Request::is('store/'.Auth::user()->uuid, 'store/'.Auth::user()->uuid . '/edit') ? ' active' : '' }}">販売店情報</a>
                        </li>
                    </ul>
                </div>
            </nav>
        @endauth
    </header>

    @auth
        <div id="mobile-nav">
            <nav class="mobile-nav-container">
                <div class="mobile-user">
                    <p class="user-name"><i class="icon-building" aria-hidden="true"></i>{{ Auth::user()->uuid }}様</p>
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
    @endauth