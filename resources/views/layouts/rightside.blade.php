<div class="content-box content-box--bg">
    <h3 class="content-box__title">Популярные категории</h3>
    {{--    @dd($categories)--}}
    @foreach($categories as $cat)
        <a href="{{ route('tags'), $cat->id }}" class="sidebar__link">
            <span class="sidebar__count">{{ $cat->articles->count() }}</span>
            <p class="sidebar__name">{{ $cat->name }}</p>
        </a>
    @endforeach
</div>
<div class="content-box">
    <h3 class="content-box__title">Топ пользователей</h3>
{{--    {{ $users }}--}}
    @foreach($users as $key => $user)
        <a href="{{ route('profile', $user->id) }}" class="top-user-card">
            @if($key == 0)
                <span class="top-user-card__place"><svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 15c3.866 0 7-3.134 7-7 0-3.86599-3.134-7-7-7-3.86599 0-7 3.13401-7 7 0 3.866 3.13401 7 7 7z" stroke="#FF4838" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M8.21 13.89L7 23l5-3 5 3-1.21-9.12" stroke="#FF4838" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
            @endif
            {{--                                @dd($user->getMedia('avatars'))--}}
            <div class="top-user-card__box">
                <div class="top-user-card__photo" style="background-image: url({{ $user->getMedia('avatars')->first() ?  $user->getMedia('avatars')->first()->getUrl() : '' }})"></div>
                <div class="top-user-card__col">
                    <h2 class="top-user-card__named">{{ $user->name }}</h2>
                    <div class="top-user-card__row">
                        <span class="top-user-card__count">{{ $user->articles->count() }} @php echo Lang::choice('запись|записей|записей', $user->articles->count(), [], 'ru'); @endphp</span>
                        <div class="top-user-card__rate">
                            <svg width="19" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.5 0l2.9355 5.92429L19 6.88013 14.25 11.489 15.371 18 9.5 14.9243 3.629 18l1.121-6.511L0 6.88013l6.5645-.95584L9.5 0z" fill="#FBD443"/></svg>
                            <span>3.55</span>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    @endforeach

</div>

