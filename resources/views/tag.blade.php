@extends('layouts.master')

@section('content')

    <div class="tag">
        <div class="feed__row">
            <h1 class="page-title">{{ $tag->name }}</h1>

            @auth
                @if($auth_user->isSubscribeTag($auth_user->id, $tag->id))
                    <a href="{{ route('tag.unsubscribe', $tag->id) }}" class="icon icon--subscribe" title="Вы подписаны на тег {{ $tag->name }}">
                        <span>Вы подписаны</span>
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke="#70C3A7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M22 4L12 14.01l-3-3" stroke="#70C3A7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>

                @else
                    <a href="{{ route('tag.subscribe', $tag->id) }}" title="Подписаться на {{ $tag->name }}" class="icon icon--unsubscribe">
                        <span>Подписаться</span>
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z" stroke="#242629" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M12 8v8" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8 12h8" stroke="#242629" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                @endif
            @endauth
        </div>

        <tags-articles :tag_id='{{$tag->id}}'></tags-articles>

    </div>

@endsection

