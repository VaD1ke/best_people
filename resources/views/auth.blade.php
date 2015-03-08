@extends('master')

@section('content')

    <script src="/js/password.js"></script>
    <div>
        <a class="anchor-to-main" href="/">&#8592; на главную</a>
        <a class="anchor-to-reg" href="/registration">Зарегистрироваться</a>
    </div><br>

    <h2 class="page-name-header">Авторизация</h2>

    <form method="POST" action="/login" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"><br>
        <label class="auth-field-info">Логин</label><br>
        <input class="auth-field" required="required" type="text" name="login" value="{{ Request::old('login') }}" autofocus  size="15" maxlength="15">
        @if ($errors->has('login')) <p class="error">{{ $errors->first('login') }}</p> @endif
        <br>
        <label class="auth-field-info">Пароль</label><br>
        <input class="auth-field" required="required" type="password"  name="password" style="float: left;" id="pword"  size="15" maxlength="25">
        <div class="auth-field-info"><input type="checkbox" id="showpword">Показать пароль</div> <br>
        @if ($errors->has('password')) <p class="error">{{ $errors->first('password') }}</p> @endif
        {!! app('captcha')->display(); !!}
        @if ($errors->has('g-recaptcha-response')) <p class="error">{{ $errors->first('g-recaptcha-response') }}</p> @endif
        <br><p><input class="auth-button" type="submit" value="Войти"></p>
    </form>

@stop
