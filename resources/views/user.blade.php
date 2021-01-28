@extends('layouts.master')
@section('title', $user->name)
@section('content')
    <div class="profile">
        <div class="profile__list">
            <div class="profile__col">

                <div class="profile-user">
                    <a class="profile-user__imageblock fancybox" rel="group" href="{{ $user->imageUser() }}"><img src="{{ $user->imageUser()  }}" alt="" width="200"></a>
                    <div class="profile-user__col">
                        <h1 class="profile-user__name">
                            {{ $user->name }} {{ $user->surname }}
                            @if((\Illuminate\Support\Facades\Auth::id() == $user->id))
                                <a href="{{ route('profile.edit') }}" title="Редактировать профиль" class="profile-user__edit"><svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 14.166h6M11 2.48c.265-.283.625-.44 1-.44.186 0 .37.038.541.113.172.076.328.187.459.326.131.14.236.305.307.488a1.586 1.586 0 010 1.15 1.513 1.513 0 01-.307.487l-8.333 8.854L2 14.167l.667-2.834L11 2.48z" stroke="#242629" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                            @endif
                        </h1>
                        <p class="profile-user__direction">{{ $user->about }}</p>
                        <div class="profile-user__btns">

                            @if(Auth::user() != null)
                                @if($user->isSubscribeUser(Auth::id(), $user->id, 'User'))
                                    <form action="{{ route('user.unsubscribe', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn--unsubscribe" type="submit">Отписаться</button>
                                    </form>
                                @else
                                    <form action="{{ route('user.subscribe', $user) }}" method="POST">
                                        @csrf
                                        @method('POST')
                                        <button class="btn btn--subscribe" type="submit">Подписаться</button>
                                    </form>
                                @endif
                                @if((\Illuminate\Support\Facades\Auth::id() == $user->id))
                                    <a href="{{ route('profile.edit') }}" title="Редактировать мой профиль" class="profile-user__edit"><svg width="16" height="17" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8 14.166h6M11 2.48c.265-.283.625-.44 1-.44.186 0 .37.038.541.113.172.076.328.187.459.326.131.14.236.305.307.488a1.586 1.586 0 010 1.15 1.513 1.513 0 01-.307.487l-8.333 8.854L2 14.167l.667-2.834L11 2.48z" stroke="#242629" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                                @endif
                            @endif
                            @if(!is_null($user->vk))
                                <a href="https://vk.com/{{ $user->vk }}" target="_blank" class="profile-user__social"><svg width="25" height="25" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path d="M12.651 20.313c3.617 0 2.327-2.29 2.606-2.948-.004-.492-.008-.965.009-1.252.229.064.77.338 1.886 1.424 1.724 1.739 2.165 2.776 3.557 2.776h2.564c.812 0 1.235-.337 1.447-.62.204-.272.404-.751.185-1.497-.572-1.796-3.907-4.897-4.114-5.224.03-.06.08-.14.107-.182h-.002c.658-.87 3.17-4.635 3.54-6.141a.02.02 0 00.003-.008c.2-.688.016-1.134-.173-1.386-.286-.377-.74-.567-1.353-.567h-2.564c-.858 0-1.51.432-1.839 1.22-.55 1.401-2.099 4.283-3.259 5.302a66.863 66.863 0 01.007-3.367c.038-1.6.159-3.155-1.5-3.155h-4.03c-1.04 0-2.034 1.135-.957 2.483.941 1.181.338 1.84.541 5.116-.791-.849-2.2-3.141-3.195-6.071-.28-.793-.702-1.527-1.893-1.527H1.66C.62 4.689 0 5.255 0 6.204c0 2.131 4.718 14.108 12.651 14.108zM4.224 6.25c.226 0 .249 0 .417.476 1.02 3.003 3.307 7.447 4.978 7.447 1.255 0 1.255-1.287 1.255-1.77l-.001-3.857c-.069-1.276-.533-1.912-.839-2.297l3.654.004c.003.018-.02 4.266.011 5.295 0 1.461 1.16 2.299 2.972.466 1.911-2.158 3.233-5.383 3.286-5.514.078-.187.146-.251.392-.251h2.574l-.002.01c-.235 1.093-2.548 4.579-3.322 5.66a.954.954 0 00-.035.053c-.341.556-.618 1.17.046 2.035h.002c.06.073.217.244.446.482.713.735 3.157 3.25 3.373 4.25-.143.023-.3.006-2.722.011-.515 0-.918-.77-2.457-2.323-1.383-1.346-2.281-1.896-3.099-1.896-1.587 0-1.472 1.289-1.457 2.847.005 1.69-.005 1.155.006 1.262-.093.036-.358.109-1.051.109-6.61 0-10.913-10.49-11.08-12.496.058-.005.847-.002 2.653-.003z" fill="#2D303A"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h25v25H0z"/></clipPath></defs></svg></a>
                            @endif
                            @if(!is_null($user->instagram))
                                <a href="https://vk.com/{{ $user->instagram }}" target="_blank" class="profile-user__social"><svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)" fill="#2D303A"><path d="M19.979 5.88c-.047-1.063-.22-1.793-.465-2.426a4.88 4.88 0 00-1.157-1.774 4.922 4.922 0 00-1.77-1.153C15.951.281 15.224.11 14.161.063 13.091.012 12.751 0 10.035 0 7.32 0 6.98.012 5.913.059 4.851.105 4.12.277 3.487.523A4.88 4.88 0 001.713 1.68 4.924 4.924 0 00.561 3.45C.314 4.087.143 4.813.096 5.876c-.051 1.07-.063 1.41-.063 4.126 0 2.715.012 3.055.059 4.122.047 1.063.219 1.793.465 2.426a4.932 4.932 0 001.156 1.774c.5.508 1.106.902 1.77 1.152.637.247 1.364.419 2.426.465 1.067.047 1.407.059 4.122.059 2.716 0 3.056-.012 4.122-.059 1.063-.046 1.793-.218 2.426-.464a5.116 5.116 0 002.927-2.927c.246-.637.418-1.364.465-2.426.047-1.067.058-1.407.058-4.122s-.004-3.055-.05-4.122zm-1.802 8.166c-.043.977-.207 1.504-.343 1.856a3.317 3.317 0 01-1.9 1.898c-.35.137-.882.301-1.855.344-1.055.047-1.371.059-4.04.059-2.668 0-2.989-.012-4.04-.059-.977-.043-1.504-.207-1.856-.344a3.077 3.077 0 01-1.148-.746 3.11 3.11 0 01-.747-1.148c-.136-.352-.3-.883-.343-1.856-.047-1.055-.059-1.372-.059-4.04 0-2.669.012-2.99.059-4.04.043-.977.207-1.504.343-1.856a3.04 3.04 0 01.75-1.149 3.105 3.105 0 011.15-.746c.351-.137.882-.3 1.855-.344 1.055-.046 1.372-.058 4.04-.058 2.672 0 2.989.012 4.04.058.977.043 1.504.207 1.856.344.433.16.828.414 1.148.746.332.325.586.715.747 1.15.136.35.3.882.343 1.855.047 1.055.06 1.371.06 4.04 0 2.668-.013 2.98-.06 4.036z"/><path d="M10.036 4.864a5.139 5.139 0 00-5.138 5.138 5.139 5.139 0 105.138-5.138zm0 8.47a3.333 3.333 0 11.001-6.666 3.333 3.333 0 010 6.667zM16.579 4.661a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0z"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"/></clipPath></defs></svg></a>
                            @endif
                        </div>


                        {{-- @foreach($sub as $s)
                            {{ $s->name }}
                            <img src="{{ asset('/storage/'.$s->id.'/'.$s->file_name)}}" alt="" width="30" height="30">
                        @endforeach --}}
                    </div>
                </div>
            </div>
            <div class="profile__col profile__col--bg">
                <div class="profile__box">
                    <p class="profile__num">{{ $user->subscribes->count() }}</p>
                    <span class="profile__text">Подписчиков</span>
                </div>
                <div class="profile__box">
                    <p class="profile__num">{{ $user->likes->count() }}</p>
                    <span class="profile__text">Лайков</span>
                </div>
                <div class="profile__box">
                    <p class="profile__num">{{ $user->articles->count() }}</p>
                    <span class="profile__text">Публикаций</span>
                </div>
            </div>
        </div>
    </div>
    <user-tabs :username='@json($user->name)' :id='@json($user->id)'></user-tabs>
@endsection
<script>
    import UserTabs from "../js/components/UserTabs";
    export default {
        components: {UserTabs}
    }
</script>
