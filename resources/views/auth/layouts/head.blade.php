<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ @csrf_token() }}">
@if (Auth::check())
    <meta name="user_id" content="{{ Auth::user()->id }}" />
@endif

<title>Stori-s | Панель администратора</title>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>--}}

<!-- Fonts -->
<link rel="stylesheet" href="{{ asset('font/stylesheet.css') }}">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin/medium-editor.css') }}">
