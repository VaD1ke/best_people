@extends('master')

@section('content')

    <script src="/js/password.js"></script>

    <a href="/">&#8592; на главную</a>
    @if (Auth::check())
        <a class="anchor-to-logout" href="/logout">Выйти</a>
    @else
        <a class="anchor-to-auth" href="/login">Войти</a>
    @endif

    <h2 class="page-name-header">Регистрация</h2>

    <section class="reg">
        <form method="POST" action="/registration" accept-charset="UTF-8" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <label class="reg-field-info">Логин*</label><br>
        <input class="reg-field"  type="text" name="login" autofocus  size="15" maxlength="15">
            @if ($errors->has('login')) <p class="error">{{ $errors->first('login') }}</p> @endif
        <br>
        <label class="reg-field-info">Пароль*</label><br>
        <input class="reg-field"  type="password" name="password" style="float: left;" id="pword"  size="15" maxlength="25">
        <div class="reg-field-info"><input type="checkbox" id="showpword">Показать пароль</div>
            @if ($errors->has('password')) <p class="error">{{ $errors->first('password') }}</p> @endif
        <br>
        <label class="reg-field-info">Аватар (50x50, макс. 5мб)</label><br>
        <input class="reg-field" type="file" name="avatar" accept="image/gif, image/png, image/jpeg">
            @if ($errors->has('avatar')) <p class="error">{{ $errors->first('avatar') }}</p> @endif
        <br>
        <label class="reg-field-info">Пол*</label><br>
        <select class="reg-field" name="sex" >
            <option selected value="1">Мужской</option>
            <option value="2">Женский</option>
        </select>
        <br>
        <label class="reg-field-info">* - обязательные поля</label>
        <br>
        <input class="reg-button" type="submit" value="Подтвердить">
        </form>
    </section>

@stop
