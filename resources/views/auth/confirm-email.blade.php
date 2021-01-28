@extends('auth.layouts.master')

@section('content')
@section('title', 'Подтверждение email')

<div class="dashboard-article">
    <h2>Подверждение почты</h2>


    <form action="{{ route('profile.send.confirm', $user) }}" method="post">
        @csrf
        <input type="hidden" value="{{ $user->email }}" name="email">
        <input type="submit" class="btn" value="SEND!">
    </form>
</div>

@endsection
