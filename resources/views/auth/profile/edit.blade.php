@extends('auth.layouts.master')

@section('content')
@section('title', 'Редактировать профиль')
    <form action="{{ route('profile.update') }}" class="form-dashboard" method="POST" enctype='multipart/form-data'>
        @csrf
        @method('PUT')

        <input type="text" class="form-dashboard__input" id="name" name="name" placeholder="Ваше имя" value="@isset($user){{$user->name}}@endisset">
        @if($errors->has('name'))
            <p class="help-block">
                {{ $errors->first('name') }}
            </p>
        @endif

        <input type="text" class="form-dashboard__input" id="surname" name="surname" placeholder="Ваша фамилия" value="@isset($user){{$user->surname}}@endisset">
        @if($errors->has('surname'))
            <p class="help-block">
                {{ $errors->first('surname') }}
            </p>
        @endif

        <input type="text" class="form-dashboard__input" id="username" name="username" placeholder="Никнейм (Например: superkrut)" value="@isset($user){{$user->username}}@endisset">
        @if($errors->has('surname'))
            <p class="help-block">
                {{ $errors->first('surname') }}
            </p>
        @endif

        <input type="email" class="form-dashboard__input" id="email" name="email" placeholder="Введите вашу почту" value="@isset($user){{$user->email}}@endisset">
        @if($errors->has('email'))
            <p class="help-block">
                {{ $errors->first('email') }}
            </p>
        @endif

        <textarea name="about" id="about" cols="30" rows="10" placeholder="Расскажите о себеф">
            @isset($user){{$user->about}}@endisset
        </textarea>
        @if($errors->has('about'))
            <p class="help-block">
                {{ $errors->first('about') }}
            </p>
        @endif

        <span>Соц Сети</span>
        <input type="text" class="form-dashboard__input" id="instagram" name="instagram" placeholder="Никнейм в инстаграме" value="@isset($user){{$user->instagram}}@endisset">
        @if($errors->has('instagram'))
            <p class="help-block">
                {{ $errors->first('instagram') }}
            </p>
        @endif

        <input type="text" class="form-dashboard__input" id="vk" name="vk" placeholder="Никнейм в vk" value="@isset($user){{$user->vk}}@endisset">
        @if($errors->has('vk'))
            <p class="help-block">
                {{ $errors->first('vk') }}
            </p>
        @endif

        <div class="form-dashboard__imag-box">
            @if($user->getMedia('avatars')->first())
                <img src="{{ $user->getMedia('avatars')->first()->getUrl()  }}" alt="">
            @else
                <p>Вы еще не Добавили изображение</p>
            @endif
                <input id="avatar" type="file" class="form-control" name="avatar">
        </div>

        <button type="submit" class="btn">Опубликовать</button>
    </form>
@endsection
