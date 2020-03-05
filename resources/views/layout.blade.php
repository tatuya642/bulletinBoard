<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel BBS</title>

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
                Laravel BBS
            </a>
            <div class="float-right">
            @if(Auth::check())
                {{\Auth::user()->name}}さん<br/>
                <a href='/auth/logout'>ログアウト</a>
                <a href='/auth/destroy'>退会</a>
            @else
                <span class="navbar-sbrand">ゲストさん</span><br />
                <a href="/auth/register">会員登録</a>
                <a href='/auth/login'>ログイン</a>
            @endif
            </div>
        </div>
        
    </header>

    <div>
        @yield('content')
    </div>
</body>
</html>