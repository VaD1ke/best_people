@extends('master')

@section('content')

    <a href="/">&#8592; на главную</a>
    <div class="user-info-auth">
        <div style="float: right;">Привет, <a href="/user/ {{ Auth::user()->id }}">{{ Auth::user()->login }}</a></div>
        <img class="user-avatar" src="../{{ Auth::user()->image_path }}" alt="{{ Auth::user()->login }}"><br>
        <a class="anchor-to-logout" href="/logout">Выйти</a>
    </div>

    <h2 class="page-name-header">Редактирование профиля</h2>

    <section class="reg">
        <form method="POST" action="/edit" accept-charset="UTF-8" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label class="edit-field-info">Мой логин </label>
            <label class="user-info-login">{{ Auth::user()->login }}</label><br>
            <br>
            <label class="edit-field-info">Аватар (50x50, макс. 5мб)</label><br>
            <input class="edit-field" type="file" name="avatar" accept="image/gif, image/png, image/jpeg">
            @if ($errors->has('avatar')) <p class="error">{{ $errors->first('avatar') }}</p> @endif
            <br>
            <label class="edit-field-info">Пол</label><br>
            @if (Auth::user()->sex === '1')
                <select class="edit-field" name="sex" >
                    <option selected value="1">Мужской</option>
                    <option value="2">Женский</option>
                </select>
            @elseif (Auth::user()->sex === '2')
                <select class="edit-field" name="sex" >
                    <option value="1">Мужской</option>
                    <option selected value="2">Женский</option>
                </select>
            @endif
            <br><br>
            <input class="reg-button" type="submit" value="Подтвердить">
        </form>
    </section>

@stop
