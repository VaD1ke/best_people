@extends('master')

@section('content')
    <div align="right">
        <a class="anchor-tomain" href="/">&lt;--на главную</a>
        <a>Войти</a> <br>
        <a href="/registration">Зарегистрироваться</a>
    </div>

    <section class="user">
        <img class="user-avatar" src="../{{ $user->image_path }}" alt="{{ $user->login }}">
        <p>{{ $user->login }}</p>
        <p>{{ $user->mark_sum }}</p>
        <section class="user-bottom"></section>
    </section>

    {!! Form::open() !!}
        <ul class="user-comment">
            <li><textarea  cols="40" maxlength="500" placeholder="Комментарий" rows="6" wrap="soft"></textarea></li>
            <li> <input  type="submit" value="Добавить"></li>
        </ul>
    {!! Form::close() !!}

@stop