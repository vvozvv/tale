@extends('layouts.master')

@section('content')


    @auth
        @if($auth_user->subscribe_count() == 0)
            <div class="feed" id="articles">
                <div class="feed-sort" style="background-image: url({{ asset('images/banner-main.png') }})">
                    <h2 class="feed-sort__title">Формируйте свою ленту новостей</h2>
                    <a href="{{ route('login') }}" class="feed-sort__btn">
                        <span>Начать</span>
                        <svg width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.9585 12.0417l7.0833-7.08333M4.9585 4.95837h7.0833v7.08333" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </a>
                </div>
            </div>

        @endif
    @else
        <div class="feed" id="articles">
            <div class="feed-sort" style="background-image: url({{ asset('images/banner-main.png') }})">
                <h2 class="feed-sort__title">Формируйте свою ленту новостей</h2>
                <a href="{{ route('login') }}" class="feed-sort__btn">
                    <span>Начать</span>
                    <svg width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.9585 12.0417l7.0833-7.08333M4.9585 4.95837h7.0833v7.08333" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
            </div>
        </div>

    @endauth


    <feed></feed>
    <section class="digest" style="background-image: url({{asset('images/background-email.png')}})">
        <div class="digest__col">
            <h2 class="digest__title">Дайджест новостей</h2>
            <p class="digest__text">Подпишитесь на новостнйю рассылку от портала tellme  и получайте каждую неделю подборку самых популряных статей</p>
            <subscribe></subscribe>
        </div>
        <div class="digest__col big">
            <actual-articles></actual-articles>
        </div>
    </section>

    <div class="tag">
        <tags></tags>
    </div>
@endsection

<script>
    import ActualArticles from "../js/components/Slider/ActualArticles";
    import Subcribe from "../js/components/Form/Subscribe";
    import Subscribe from "../js/components/Form/Subscribe";
    export default {
        components: {Subscribe, Subcribe, ActualArticles}
    }
</script>
