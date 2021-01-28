@extends('layouts.master')
@section('title', 'Избранное')
@section('content')

    <div class="feed">
        <div class="container">
            <div class="feed__row">
                <h1>Моя лента</h1>
                <a href="{{ route('profile.edit') }}" title="Редактировать подписки" class="icon icon--gray">
                    <svg width="19" height="19" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3.167 16.625v-5.541M3.167 7.917V2.375M9.5 16.625V9.5M9.5 6.333V2.375M15.833 16.625v-3.959M15.833 9.5V2.375M.792 11.084h4.75M7.125 6.333h4.75M13.458 12.666h4.75" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>

{{--            @dd($feed)--}}
            <feed :data='@json($feed)'></feed>

        </div>
    </div>

@endsection
