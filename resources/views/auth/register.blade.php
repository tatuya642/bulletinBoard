@extends('layout')
@section('content')

        <h1>ユーザー登録</h1>
        <form name="registform" action="/auth/register" method="post">
            {{csrf_field()}}
            名前：<input type="text" name='name' ><span>{{$errors->first('name')}}</span><br />
            アドレス：<input type="text" name='email' ><span>{{$errors->first('email')}}</span><br />
            password：<input type="password" name='password' ><span>{{$errors->first('password')}}</span><br />
            password(確認)：<input type="password" name='password_confirmation' ><span>{{$errors->first('password_confirmation')}}</span><br />
            <button type='submit' name='action' value='send'>送信</button>
        </form>
        @endsection

