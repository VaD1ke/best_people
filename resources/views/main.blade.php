@extends('master')

@section('content')
    <div align="right">
        <a>Войти</a> <br>
        <a href="/registration">Зарегистрироваться</a>
    </div>
    @if(isset($users) && count($users))

        @foreach($users as $user)

            <section class="user">
                <img class="user-avatar" src="../{{ $user->image_path }}" alt="{{ $user->login }}">
                <a href="/user/{{ $user->id }}"><p>{{ $user->login }}</p></a>
                <p>{{ $user->mark_sum }}</p>
                <section style="clear: both"></section>
            </section>
        @endforeach
    @else
        <p>Нет зарегистрированных пользователей на сайте :(</p>
    @endif


@stop