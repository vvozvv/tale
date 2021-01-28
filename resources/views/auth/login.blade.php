<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>
<body>
<div class="auth">
    <div class="auth__col">
        <a href="/" class="auth__logo">
            <svg width="117" height="42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M30.243 12.983h7.793V34h5.32V12.983h7.792V8.545H30.243v4.438zM55.834 34l1.89-5.804h9.184L68.798 34h5.767L65.79 8.545h-6.936L50.067 34h5.767zm3.257-10.005l3.132-9.633h.199l3.132 9.633H59.09zM77.628 34h16.295v-4.437H83.01V8.545h-5.382V34zm19.859 0h17.201v-4.437h-11.819v-6.078h10.887v-4.437h-10.887v-6.065h11.77V8.545H97.487V34z" fill="#2D303A"/><path d="M3.66 25.514C5.92 23.344 9.04 22 12.5 22 19.4 22 25 27.376 25 34h-6.66c0-3.091-2.62-5.606-5.84-5.606-1.6 0-3.06.633-4.12 1.632a5.462 5.462 0 00-1.7 3.955H0c0-3.303 1.4-6.298 3.66-8.467zM25 9L12.5 22 0 9h25z" fill="#3060F8"/></svg>
        </a>

        <div class="auth__content">
            <a href="" class="auth__back">Вернуться на главную</a>
            <h2 class="auth__title">Вход в личный кабинет</h2>
            <form method="POST" action="{{ route('login') }}" class="form-auth">
                @csrf

                <div class="form-auth__box">

                    <label for="email" class="form-auth__label">Введите логин или email</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control form-auth__input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-auth__box">
                    <label for="password" class="form-auth__label">Введите пароль</label>
                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control form-auth__input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-auth__row">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Запомнить меня') }}
                    </label>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn form-auth__btn">
                            {{ __('Войти') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="form-auth__reset">
                                {{ __('Забыли пароль?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

    </div>
    <div class="auth__col auth__col_pattern">

    </div>
</div>
</body>
</html>

