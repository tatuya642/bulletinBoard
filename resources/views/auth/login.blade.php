@extends('layout')
@section('content')
        {{--
        <h1>ログインフォーム</h1>
        
        @isset( $errors )
            message:
            <p class="text-danger">{{ $errors }}</p>
        @endisset
        --}}

        <form name="loginform" action="/auth/login" method="post" class="form-signin">
            {{csrf_field()}}

            <h1 class="h3 mb-3 font-weight-normal"></h1>
            <label for="inputEmail" class="sr-only">Emailアドレス</label>
            <input type="email" name='email' id="inputEmail" class="form-control" value="{{old('email')}}" placeholder="Emailアドレス" required autofocus>
            <span class="text-danger">{{$errors->first('email')}}</span>

            <label for="inputPassword" class="sr-only">パスワード</label>
            <input type="password" name='password' id="inputPassword" class="form-control" placeholder="パスワード" required>
            <span class="text-danger">{{$errors->first('password')}}</span>
            <br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name='action' value='send'>ログイン</button>
            
        </form>
        
        @endsection
