@extends('master')

@section('content')
    <div align="right">
        <a href="/"><-на главную</a>
        <a href="/registration" align="left">Зарегистрироваться</a>
    </div>

    <section class="user">

        <p>{{ $user->login }}</p>
        <p>{{ $user->image_path }}</p>
        <p>{{ $rating }}</p>
        <section style="clear: both"></section>
    </section>

@stop