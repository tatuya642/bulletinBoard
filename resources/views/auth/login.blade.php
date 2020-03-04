@extends('layout')
@section('content')
        <h1>ログインフォーム</h1>
        @isset( $message )
            message:
            <p style="color:red">{{ $message }}</p>
        @endisset
        <form name="loginform" action="/auth/login" method="post">
            {{csrf_field()}}
            アドレス：<input type="text" name='email' value="{{old('email')}}"><br />
            password：<input type="password" name='password' ><br />
            <button type='submit' name='action' value='send'>送信</button>
        </form>
        @endsection
