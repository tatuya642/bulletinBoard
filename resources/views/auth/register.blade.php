@extends('layout')
@section('content')
        {{--
        <h1>ユーザー登録</h1>
        <form name="registform" action="/auth/register" method="post">
            {{csrf_field()}}
            名前：<input type="text" name='name' ><span>{{$errors->first('name')}}</span><br />
            アドレス：<input type="text" name='email' ><span>{{$errors->first('email')}}</span><br />
            password：<input type="password" name='password' ><span>{{$errors->first('password')}}</span><br />
            password(確認)：<input type="password" name='password_confirmation' ><span>{{$errors->first('password_confirmation')}}</span><br />
            <button type='submit' name='action' value='send'>送信</button>
        </form>
        --}}

        <form name="registform"　action="/auth/login" method="post" class="form-signin">
            {{csrf_field()}}

            <h1 class="h3 mb-3 font-weight-normal">ユーザー登録</h1>

            <label for="inputEmail" class="sr-only">名前</label>
            <input type="text" name='name' id="inputEmail" class="form-control" value="{{old('name')}}" placeholder="名前" required autofocus>

            <label for="inputEmail" class="sr-only">Emailアドレス</label>
            <input type="email" name='email' id="inputEmail" class="form-control" value="{{old('email')}}" placeholder="Emailアドレス" required autofocus>
            
            <label for="inputPassword" class="sr-only">パスワード</label>
            <input type="password" name='password' id="inputPassword" class="form-control" placeholder="パスワード" required>
            
            <label for="inputPassword" class="sr-only">パスワード(確認)</label>
            <input type="password" name='password_confirmation' id="inputPassword" class="form-control" placeholder="パスワード(確認)" required>

            <br/>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name='action' value='send'>登録</button>
            
        </form>
        @endsection

