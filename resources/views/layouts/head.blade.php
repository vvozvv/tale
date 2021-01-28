<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="csrf-token" content="{{ @csrf_token() }}">
@if (Auth::check())
    <meta name="user_id" content="{{ Auth::user()->id }}" />
@endif
<link rel="icon" href="../../images/favicon.ico" type="image/x-icon">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

{{--<script src="{{ asset('js/main.js') }}"></script>--}}
{{--<script src="{{ asset('js/fancybox.js') }}"></script>--}}
{{--<script src="{{ asset('js/select2.js') }}"></script>--}}
<script src="{{ asset('js/common.js') }}"></script>


<title>
    @isset($title)
        {{ $title }} | StoryTel
    @endisset
    {{ config('app.name') }}
</title>

<!-- Fonts -->


