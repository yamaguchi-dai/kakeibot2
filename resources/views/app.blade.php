<html lang="{{ app()->getLocale() }}">
    <head>
        <title>@yield('title')&nbsp;|&nbsp;KakeiBot</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=yes">
        <!-- CSS  -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="/css/common.css" type="text/css" rel="stylesheet" >
        @stack('css')

    </head>
    <body>
        <nav class="orange header" role="navigation">
            <div class="nav-wrapper">
                <a href="/" class="brand-logo center">KakeiBot</a>
                <ul class="left hide-on-med-and-down">
                    <li class="side-open" style="margin-left:100px"><i class="material-icons">menu</i></li>
                </ul>
                <ul id="nav-mobile" class="left">
                    <li> <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a></li>
                </ul>
            </div>
        </nav>
        <!-- -->
        <ul id="slide-out" class="sidenav" style="">

            <li><a href="home">ダッシュボード</a></li>
            <li><a href="budget">予算</a></li>
            <li><a href="payment">支払い一覧</a></li>
            <hr>
            @isLogin()
            <li><a href="logout">ログアウト</a></li>
            @else
            <li><a href="login">ログイン</a></li>
            @endif
        </ul>
        <!-- -->
        @if ($errors->any())
        <div class="errors center">
            <ul>
                @foreach ($errors->all() as $error)
                <li class="red-text">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- メインコンテンツエリア -->
        <div class="container"  style="margin-top: 30px;">
            @yield('content')
        </div>
        <!--  Scripts-->
        <script src="/js/jquery-3.3.1.js"></script>
        <script src="/js/materialize.js"></script>
        <script src="/js/common.js?date={{now()}}"></script>
        @stack('scripts')
    </body>
</html>