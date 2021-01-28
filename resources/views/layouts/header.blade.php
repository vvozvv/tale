<header class="header">
    <a href="{{ route('home') }}" class="logo"><svg width="117" height="42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30.243 12.983h7.793V34h5.32V12.983h7.792V8.545H30.243v4.438zM55.834 34l1.89-5.804h9.184L68.798 34h5.767L65.79 8.545h-6.936L50.067 34h5.767zm3.257-10.005l3.132-9.633h.199l3.132 9.633H59.09zM77.628 34h16.295v-4.437H83.01V8.545h-5.382V34zm19.859 0h17.201v-4.437h-11.819v-6.078h10.887v-4.437h-10.887v-6.065h11.77V8.545H97.487V34z" fill="#2D303A"/><path d="M3.66 25.514C5.92 23.344 9.04 22 12.5 22 19.4 22 25 27.376 25 34h-6.66c0-3.091-2.62-5.606-5.84-5.606-1.6 0-3.06.633-4.12 1.632a5.462 5.462 0 00-1.7 3.955H0c0-3.303 1.4-6.298 3.66-8.467zM25 9L12.5 22 0 9h25z" fill="#3060F8"/></svg></a>
    <div class="mm">
        <svg width="34" height="34" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4.25 17h25.5M4.25 8.5h25.5M4.25 25.5h25.5" stroke="#3060F8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </div>
    <div class="header__auth">
        @if (Route::has('login'))
            @auth
                <a href="{{ route('dashboard') }}" class="">{{ Auth::user()->name }}</a>
                <a href="{{ url('/logout') }}" class="btn"> Выйти </a>
            @else
                <a href="{{ route('login') }}" class="btn btn--border">Войти</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn">Регистрация</a>
                @endif
            @endif
        @endif
    </div>
</header>
