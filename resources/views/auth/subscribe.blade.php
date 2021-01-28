@extends('auth.layouts.master')

@section('content')
@section('title', 'Подписки')


@if(\Illuminate\Support\Facades\Auth::user()->isVerify())
    <form action="{{ route('profile.send.confirm', \Illuminate\Support\Facades\Auth::user()) }}" method="post" class="verify">
        @csrf
        <p class="verify__title">Ваш адрес электронной почты не подтвержденю. Для того, чтобы написать свою первую статью, необходимо подтвердить свою учетную запись,
            <button class="verify__link"> перейдя по ссылке</button>
        </p>
        <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" name="email">
    </form>
@endif

    <subscribe-list></subscribe-list>

@endsection


<script>
    import SubscribeList from "../../js/components/SubscribeList";
    export default {
        components: {SubscribeList}
    }
</script>
