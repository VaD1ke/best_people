@extends('master')

@section('content')

    <script src="/js/password.js"></script>

    <a href="/">&lt;--на главную</a>
    <a href="" class="anchor-toauth">Войти</a>

    <section class="reg">
        {!! Form::open() !!}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="reg-field-info">Логин*</div>
        <input class="reg-field" type="text" name="login" autofocus required="required" size="15" maxlength="15">
        <br>
        <div class="reg-field-info">Пароль*</div>
        <input class="reg-field" type="password" style="float: left;" id="pword" required="required" size="15" maxlength="25">
        <div class="reg-field-info"><input type="checkbox" id="showpword">Показать пароль</div>
        <br>
        <div class="reg-field-info">Аватар</div>
        <input class="reg-field" type="file" name="avatar" accept="image/gif, image/png, image/jpeg, ">
        <br>
        <div class="reg-field-info">Пол*</div>
        <select class="reg-field">
            <option>Мужской</option>
            <option>Женский</option>
        </select>
        <br>
        <div class="reg-field-info">* - обязательные поля</div>
        <br>
        <input class="reg-button" type="submit" value="Подтвердить">
        {!! Form::close() !!}
    </section>

@stop