@extends('auth.layouts.master')

@section('content')
@section('title', 'Панель администрирования')


    @if(\Illuminate\Support\Facades\Auth::user()->isVerify())
        <form action="{{ route('profile.send.confirm', \Illuminate\Support\Facades\Auth::user()) }}" method="post" class="verify">
            @csrf
            <p class="verify__title">Ваш адрес электронной почты не подтвержденю. Для того, чтобы написать свою первую статью, необходимо подтвердить свою учетную запись,
                <button class="verify__link"> перейдя по ссылке</button>
            </p>
            <input type="hidden" value="{{ \Illuminate\Support\Facades\Auth::user()->email }}" name="email">
        </form>
    @endif
    @include('auth.analytics')

    @if($aticles->count() <= 0 && \Illuminate\Support\Facades\Auth::user()->isVerify())
        <span>Подтвердите почту!</span>
    @elseif($aticles->count() <= 0)
        <p>Напишите свою первую статью!</p>
    @else
        <div class="dashboard-article">
            <div class="section-title">Топ статей</div>
            <div class="dashboard-article__list">
                @foreach($aticles as $article)
                    <a href="" class="dashboard-article__item favorite">
                        <span class="dashboard-article__cat">{{ $article->tag }}</span>
                        <h2 class="dashboard-article__title">{{ $article->title }}</h2>

                        <span class="dashboard-article__footer">
{{--                    <div class="dashboard-article__box">--}}
                            {{--                        <span class="dashboard-article__subtitle">Рейтинг</span>--}}
                            {{--                        <div class="dashboard-rate">--}}
                            {{--                            <div class="dashboard-rate__list">--}}
                            {{--                                <div class="dashboard-rate__item"><svg width="19" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.70589 1.75l2.38021 5.4775 5.3229.88375-3.8516 4.26125.909 6.02-4.76051-2.8438-4.76051 2.8438.90897-6.02-3.85154-4.26125 5.32283-.88375L9.70589 1.75z" fill="#fff" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></div>--}}
                            {{--                                <div class="dashboard-rate__item"><svg width="19" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.70589 1.75l2.38021 5.4775 5.3229.88375-3.8516 4.26125.909 6.02-4.76051-2.8438-4.76051 2.8438.90897-6.02-3.85154-4.26125 5.32283-.88375L9.70589 1.75z" fill="#fff" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></div>--}}
                            {{--                            </div>--}}
                            {{--                            <span class="dashboard-rate__rate">3.4</span>--}}
                            {{--                        </div>--}}
                            {{--                    </div>--}}
                    <span class="dashboard-article__box">
                        <div class="dashboard-comment">
                            <svg width="22" height="22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.25 10.5417c.0032 1.2099-.2795 2.4034-.825 3.4833-.6468 1.2941-1.6411 2.3826-2.8715 3.1435-1.2304.761-2.6484 1.1643-4.0952 1.1649-1.2098.0031-2.40336-.2796-3.4833-.825L2.75 19.25l1.74167-5.225c-.54548-1.0799-.82816-2.2734-.825-3.4833.00056-1.44673.40389-2.86473 1.16482-4.09517C5.59242 5.21609 6.6809 4.2218 7.975 3.57503c1.07994-.54548 2.2735-.82816 3.4833-.825h.4584c1.9106.10541 3.7153.91186 5.0683 2.26495 1.3531 1.35309 2.1596 3.15773 2.265 5.06842v.4583z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>{{ $article->comments->count() }}</span>
                        </div>
                        <div class="dashboard-comment">
                            <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M20.8401 4.60999c-.5107-.51099-1.1172-.91635-1.7846-1.19291-.6675-.27656-1.3829-.41891-2.1054-.41891-.7225 0-1.4379.14235-2.1053.41891-.6675.27656-1.2739.68192-1.7847 1.19291l-1.06 1.06-1.06-1.06C9.90843 3.5783 8.50915 2.9987 7.05012 2.9987c-1.45903 0-2.85831.5796-3.89 1.61129-1.03169 1.0317-1.61129 2.43097-1.61129 3.89 0 1.45904.5796 2.85831 1.61129 3.89001l1.06 1.06 7.77998 7.78 7.78-7.78 1.06-1.06c.511-.5108.9164-1.1172 1.1929-1.7847.2766-.66741.4189-1.38282.4189-2.10531 0-.72248-.1423-1.43789-.4189-2.10535-.2765-.66746-.6819-1.27389-1.1929-1.78465v0z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span>{{ $article->likes->count() }}</span>
                        </div>
                    </span>
                </span>
                    </a>
                @endforeach
            </div>
        </div>
    @endif



    <table-data></table-data>


@endsection



