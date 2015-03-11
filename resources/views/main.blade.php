@extends('master')

@section('content')

    <input name="csrf_token" type="hidden" value="{{ csrf_token() }}" id="csrfToken"/>

    <div align="right">
        @if (Auth::check())
            <div class="user-info-auth">
                <div style="float: right;">Привет, <a href="/user/ {{ Auth::user()->id }}">{{ Auth::user()->login }}</a></div>
                <img class="user-avatar" src="../{{ Auth::user()->image_path }}" alt="{{ Auth::user()->login }}">
                <br><label class="user-rating-head">{{ Auth::user()->mark_sum }}</label>
                <a class="anchor-to-edit"  href="/edit">(ред.) </a><br>
                <a class="anchor-to-logout" href="/logout">Выйти</a>
            </div>
        @else
            <a class="anchor-to-auth" href="/login">Войти</a> <br>
            <a class="anchor-to-reg" href="/registration">Зарегистрироваться</a>
        @endif
    </div>

    <h2 class="page-name-header">Главная</h2>

    <section id="main">
        <section id="inner">
        @if(isset($users) && count($users))

            @foreach($users as $user)

                <section id="users" class="user button-container" data-user-id="{{ $user->id }}">
                    @if (Auth::check() && Auth::user()->id != $user->id)
                        <div style="float: right">
                            @if (Auth::user()->isVotedFor($user) == '1')
                                <input class="user-button-up" type="submit" name="plus" value="+" disabled>
                                <input class="user-button-down" type="submit" name="minus" value="-">
                            @elseif (Auth::user()->isVotedFor($user) == '-1')
                                <input class="user-button-up" type="submit" name="plus" value="+">
                                <input class="user-button-down" type="submit" name="minus" value="-" disabled>
                            @else
                                <input class="user-button-up" type="submit" name="plus" value="+">
                                <input class="user-button-down" type="submit" name="minus" value="-">
                            @endif
                        </div>
                    @endif
                    <img class="user-avatar" src="../{{ $user->image_path }}" alt="{{ $user->login }}">
                    <a href="/user/{{ $user->id }}">{{ $user->login }}</a>
                    <p align="center">{{ $user->mark_sum }}</p>

                </section>
            @endforeach
        @else
            <p>Нет зарегистрированных пользователей на сайте :(</p>
        @endif

        </section>
    </section>

@stop
