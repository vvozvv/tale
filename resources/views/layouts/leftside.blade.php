<div class="content-box">
    <nav class="menu">
        <ul class="menu__list">
            <li class="menu__item">
                <a href="{{ route('home') }}" class="menu__link">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M9 22V12h6v10" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Главная</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="{{ route('articles') }}" class="menu__link">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Статьи</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="{{ route('tags') }}" class="menu__link">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8l-6-6z" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Теги</span>
                </a>
            </li>
            <li class="menu__item">
                <a href="{{ route('search') }}" class="menu__link">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 19a8 8 0 100-16 8 8 0 000 16zM21 21l-4.35-4.35" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>Поиск</span>
                </a>
            </li>
            @auth
                <li class="menu__item">
                    <a href="{{ route('feed') }}" class="menu__link">
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>Моя лента</span>
                    </a>
                </li>
                <li class="menu__item">
                    <a href="{{ route('favorite') }}" class="menu__link">
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#212121" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>Избранное</span>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>
</div>
@if($user_category->count() > 0)
    <div class="content-box">
        <h3 class="content-box__title">
            Ваши подписки
            <a href="{{ route('dashboard') }}" class="content-box__settings">
                <svg width="17" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.833 14.875V9.916M2.833 7.083V2.125M8.5 14.875V8.5M8.5 5.667V2.125M14.167 14.875v-3.541M14.167 8.5V2.125M.708 9.916h4.25M6.375 5.667h4.25M12.042 11.334h4.25" stroke="#242629" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </a>
        </h3>
        <ul class="content-box__list">
            @foreach($user_category as $cat)
                <li class="content-box__item">
                    <a href="{{ route('tags.show.front', $cat->id) }}" class="content-box__link">{{ $cat->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
@endif


