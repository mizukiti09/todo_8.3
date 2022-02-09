<header>
    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>

    <nav class="globalMenuSp">
        <ul class="navbar-nav ms-auto">
            <!-- Authentication Links -->
            @guest @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @endif @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif @else

            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <!-- <a class="dropdown-item" href="{{ route('home') }}">Home</a> -->
                    <a class="dropdown-item" href="{{ route('myTasks') }}">myTasks</a>
                    <a class="dropdown-item" href="{{ route('userEdit') }}">ユーザー情報編集</a>
                    <a class="dropdown-item" href="{{ route('result') }}">完了一覧</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>


            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('group_register') }}">グループ登録</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('group_login') }}">グループログイン</a>
            </li>

            @php $groupData = Session::get('groupData', []) @endphp @if ( $groupData )
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    現在のグループ
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @foreach ($groupData as $data) @if ( Auth::id() == $data['user_id'] )
                    <a class="dropdown-item" href="{{ route('owner') }}">Owner</a> @endif
                    <a class="dropdown-item" href="{{ route('home_group') }}">Home：{{$data['group_name']}}</a> @endforeach
                    <a class="dropdown-item" href="{{ route('group_myTasks') }}">myTasks：{{$data['group_name']}}</a>
                    <a class="dropdown-item" href="{{ route('group_result') }}">グループ完了一覧</a>
                </div>
            </li>
            @endif @endguest
        </ul>
    </nav>
</header>