<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Laravel 練習</title>

    <link
        rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    >
</head>
<body>
    <header class="navbar navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('') }}">
                掲示板
            </a>
            <div class="float-right">
            @if(Auth::check())
                <span class="text-white ">{{\Auth::user()->name}}さん</span><br/>
                <a class="text-primary" href='/auth/logout'>ログアウト</a>
                {{--<a href='/auth/destroy'>退会</a>--}}
            @else
                <span class="text-white ">ゲストさん</span><br />
                <a class="text-primary" href="/auth/register">会員登録</a>
                <a class="text-primary" href='/auth/login'>ログイン</a>
            @endif
            </div>
        </div>
        
    </header>

    <div>
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>
</body>
</html>