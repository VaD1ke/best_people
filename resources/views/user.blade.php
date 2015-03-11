@extends('master')

@section('content')

    <input name="csrf_token" type="hidden" value="{{ csrf_token() }}" id="csrfToken"/>

    <div>
        <a class="anchor-to-main" href="/">&#8592; на главную</a>
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

    <section id="main">
        <section id="inner">
            <section class="user-info button-container" data-user-id="{{ $user->id }}">
                @if (Auth::check() && Auth::user()->id  != $user->id)
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
                <label class="user-info-login">{{ $user->login }}</label><br>
                @if (Auth::check() && Auth::user()->id === $user->id) <a href="/edit">редактировать профиль</a> @endif
                <p align="center" class="user-rating">{{ $user->mark_sum }}</p>
                <hr class="user-info-line">
            </section>



            @if(isset($votes) && count($votes))
                @foreach($votes as $vote)

                    @if ($vote->mark == '1')
                        <section class="user-vote-plus">
                            <p>
                                {{ $vote->updated_at }}
                                <a href="/user/{{ $vote->userVoted->id }}">{{ $vote->userVoted->login }}</a>
                                @if ($vote->userVoted->sex == '1')
                                    поставил +
                                @elseif ($vote->userVoted->sex == '2')
                                    поставила +
                                @endif
                            </p>

                        </section>
                    @elseif ($vote->mark == '-1')
                        <section class="user-vote-minus">
                            {{ $vote->updated_at }}
                            <a href="/user/{{ $vote->userVoted->id }}">{{ $vote->userVoted->login }}</a>
                            @if ($vote->userVoted->sex == '1')
                                поставил -
                            @elseif ($vote->userVoted->sex == '2')
                                поставила -
                            @endif
                        </section>
                    @endif
                @endforeach
            @endif

        </section>

    </section>

    @if(isset($comments) && count($comments))
        <br><label class="user-comment-label">Комментарии</label>
        @foreach($comments as $comment)
            <section class="user-comment">
                <div>{{ $comment->comment_text }}</div>
                <div class="user-comment-footer">
                    @if ($comment->userLeft->sex == '1')
                        Написал
                    @elseif ($comment->userLeft->sex == '2')
                        Написала
                    @endif
                    <a href="/user/{{ $comment->userLeft->id }}">{{ $comment->userLeft->login }}</a>
                    {{ $comment->updated_at }}
                </div>
            </section>
        @endforeach
    @endif

    {!! Form::open() !!}
    @if (Auth::check())
        <div>
            <textarea class="user-comment-write" name="comment_text"  cols="60" maxlength="1000"
                      placeholder="Написать комментарий(макс. 1000 символов)" rows="6" wrap="soft"></textarea>
            @if ($errors->has('comment_text')) <p class="error" style="margin-left: 5%;">{{ $errors->first('comment_text') }}</p> @endif
            <br><input class="user-comment-write-button" type="submit" value="Добавить">
        </div>
    @endif
    {!! Form::close() !!}

@stop
