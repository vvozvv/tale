<!doctype html>
<html lang="ru">
    <head>
        @include('layouts.head')
    </head>
<body>
    @include('layouts.header')
    <main class="content" id="app">
        <div class="content__sidebar mobile-board">
            @include('layouts.leftside')
        </div>
        <div class="content__content">
            @yield('content')
        </div>
        <div class="content__sidebar">
            @include('layouts.rightside')
        </div>

    </main>
    @include('layouts.footer')

</body>
</html>
