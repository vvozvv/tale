@extends('layouts.master')
@section('title', $article->title)
@section('content')
    <div class="article">
        <div class="article__header">
            <div class="author">
                <img src="{{ $author->imageUser() }}" alt="" class="author__image">
                <a href="{{ route('profile', $author->id) }}" class="author__named">{{ $author->name }}</a>
            </div>
            <time datetime="{{ $article->created_at }}"> {{ $article->created_at->format('d-m-Y в H:i') }} </time>
        </div>
        <h1>{{ $article->title }}</h1>
        <div class="article__box">
            <div class="article__item">
                <a href="{{ route('tags.show.front', $article->tagKey->id) }}" class="article__link">
                   <img src="{{ $article->tagKey->icon() }}" alt="" class="article__tag-image">
                    <span class="article__tagname">{{ $article->tagKey->name }}</span>
                </a>
            </div>
            @auth
                <a href="{{ route('get.like', $article->id) }}" class="article__item">
                    @if(\Illuminate\Support\Facades\Auth::user()->isLike($article))
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.9741 8.29996V4.69998c0-.71608-.289-1.40283-.8035-1.90917C11.6561 2.28446 10.9582 2 10.2306 2l-3.65804 8.0999v9.9H16.8882c.4411.0049.8692-.1472 1.2053-.4284.3361-.2812.5576-.6724.6238-1.1016l1.262-8.1c.0398-.2579.0221-.52134-.0518-.77192-.074-.25059-.2024-.48236-.3763-.67926-.174-.1969-.3894-.35422-.6313-.46107-.2419-.10684-.5045-.16064-.7696-.15769h-5.1762zM6.57256 19.9999H3.82902c-.48508 0-.9503-.1897-1.29331-.5272C2.1927 19.1351 2 18.6773 2 18.1999v-6.3c0-.4773.1927-.9352.53571-1.2727.34301-.3376.80823-.5273 1.29331-.5273h2.74354" fill="#FF4838"/><path d="M6.57256 19.9999H3.82902c-.48508 0-.9503-.1897-1.29331-.5272C2.1927 19.1351 2 18.6773 2 18.1999v-6.3c0-.4773.1927-.9352.53571-1.2727.34301-.3376.80823-.5273 1.29331-.5273h2.74354m6.40154-1.79994V4.69998c0-.71608-.289-1.40283-.8035-1.90917C11.6561 2.28446 10.9582 2 10.2306 2l-3.65804 8.0999v9.9H16.8882c.4411.0049.8692-.1472 1.2053-.4284.3361-.2812.5576-.6724.6238-1.1016l1.262-8.1c.0398-.2579.0221-.52134-.0518-.77192-.074-.25059-.2024-.48236-.3763-.67926-.174-.1969-.3894-.35422-.6313-.46107-.2419-.10684-.5045-.16064-.7696-.15769h-5.1762z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    @else
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3m7-2V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a1.999 1.999 0 00-2-2.3H14z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    @endif

                    <span>{{ $article->likes->count()  }}</span>
                </a>
            @else
                <div class="article__item">
                    <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3m7-2V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 002-1.7l1.38-9a1.999 1.999 0 00-2-2.3H14z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span>{{ $article->likes->count()  }}</span>
                </div>
            @endauth

            <div class="article__item">
                <svg width="18" height="18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17 8.55557c.003 1.17321-.2711 2.33053-.8 3.37773-.6272 1.2549-1.5914 2.3104-2.7845 3.0483-1.1932.7379-2.5682 1.129-3.97107 1.1295-1.17321.0031-2.33056-.271-3.37777-.8L1 17l1.68889-5.0667c-.52895-1.0472-.80306-2.20452-.8-3.37773.00054-1.40288.39165-2.77791 1.12952-3.97106.73788-1.19316 1.79337-2.15732 3.04825-2.78449 1.04721-.52895 2.20456-.803054 3.37777-.79999h.44444c1.85273.10221 3.60273.88423 4.91483 2.19631C16.1157 4.50843 16.8978 6.25837 17 8.11113v.44444z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>{{ $article->comments->count() }}</span>
            </div>
            @auth
                @if(\Illuminate\Support\Facades\Auth::user()->isFavorite())
                    <form action="{{ route('delete.favorite', $article->id) }}" class="article__item" method="POST">
                        @csrf
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12.444 1.778l3.296 7.021 7.37 1.133-5.333 5.462 1.259 7.717-6.592-3.645-6.592 3.645 1.259-7.717-5.334-5.462L9.148 8.8l3.296-7.021z" stroke="#FBD443" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <button type="submit" class="">Удалить из избранного</button>
                    </form>
                @else
                    <a href="{{ route('get.favorite', $article->id) }}" class="article__item">
                        <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>В избранное</span>
                    </a>
                @endif
            @endauth


            <div class="article__item">
                <svg width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 8c1.6569 0 3-1.34315 3-3s-1.3431-3-3-3-3 1.34315-3 3 1.3431 3 3 3zM6 15c1.65685 0 3-1.3431 3-3S7.65685 9 6 9s-3 1.3431-3 3 1.34315 3 3 3zM18 22c1.6569 0 3-1.3431 3-3s-1.3431-3-3-3-3 1.3431-3 3 1.3431 3 3 3zM8.58984 13.51l6.82996 3.98M15.4098 6.51001L8.58984 10.49" stroke="#2D303A" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span>Поделится</span>
            </div>
        </div>
        <img src="{{ $article->getMedia('articles')->first()->getUrl()  }}" alt="" class="article__image" width="100%">
        <div class="article__desc">
            {!!  $article->article_text !!}
        </div>


        <div class="article-author">
            <div class="article-author__box">
                <img src="{{ $author->imageUser() }}" alt="" class="article-author__img">
                <div class="article-author__info">
                    <a href="" class="article-author__name">{{$author->name }}</a>
                    <span>{{ $author->subscribes->count()  }} Подписчика</span>
                </div>
            </div>
            <ul class="article-author__social">
                <li class="article-author__item"><a href="" class="article-author__link"><svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path d="M19.822 14.473c-.054-.09-.386-.813-1.987-2.298-1.675-1.555-1.45-1.303.568-3.991 1.229-1.638 1.72-2.638 1.566-3.066-.146-.407-1.05-.3-1.05-.3l-3.005.018s-.223-.03-.389.069c-.161.097-.265.322-.265.322s-.476 1.268-1.111 2.345c-1.339 2.274-1.875 2.394-2.094 2.253-.509-.329-.381-1.323-.381-2.028 0-2.204.333-3.122-.652-3.36-.327-.079-.567-.131-1.404-.14-1.072-.011-1.98.004-2.495.255-.342.168-.606.541-.445.563.199.026.65.12.888.446.309.419.297 1.361.297 1.361s.178 2.594-.413 2.917c-.407.221-.963-.23-2.157-2.294C4.682 6.488 4.22 5.32 4.22 5.32s-.088-.218-.247-.334a1.246 1.246 0 00-.463-.186l-2.857.017s-.43.013-.587.199c-.14.166-.011.509-.011.509s2.238 5.234 4.77 7.873c2.324 2.419 4.962 2.26 4.962 2.26h1.195s.361-.04.545-.239c.17-.182.164-.525.164-.525s-.024-1.604.721-1.84c.734-.233 1.677 1.55 2.675 2.236.755.52 1.33.405 1.33.405l2.67-.037s1.398-.086.736-1.185z" fill="#2D303A"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"/></clipPath></defs></svg></a></li>
                <li class="article-author__item"><a href="" class="article-author__link"><svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path d="M19.822 14.473c-.054-.09-.386-.813-1.987-2.298-1.675-1.555-1.45-1.303.568-3.991 1.229-1.638 1.72-2.638 1.566-3.066-.146-.407-1.05-.3-1.05-.3l-3.005.018s-.223-.03-.389.069c-.161.097-.265.322-.265.322s-.476 1.268-1.111 2.345c-1.339 2.274-1.875 2.394-2.094 2.253-.509-.329-.381-1.323-.381-2.028 0-2.204.333-3.122-.652-3.36-.327-.079-.567-.131-1.404-.14-1.072-.011-1.98.004-2.495.255-.342.168-.606.541-.445.563.199.026.65.12.888.446.309.419.297 1.361.297 1.361s.178 2.594-.413 2.917c-.407.221-.963-.23-2.157-2.294C4.682 6.488 4.22 5.32 4.22 5.32s-.088-.218-.247-.334a1.246 1.246 0 00-.463-.186l-2.857.017s-.43.013-.587.199c-.14.166-.011.509-.011.509s2.238 5.234 4.77 7.873c2.324 2.419 4.962 2.26 4.962 2.26h1.195s.361-.04.545-.239c.17-.182.164-.525.164-.525s-.024-1.604.721-1.84c.734-.233 1.677 1.55 2.675 2.236.755.52 1.33.405 1.33.405l2.67-.037s1.398-.086.736-1.185z" fill="#2D303A"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"/></clipPath></defs></svg></a></li>
                <li class="article-author__item"><a href="" class="article-author__link"><svg width="20" height="20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0)"><path d="M19.822 14.473c-.054-.09-.386-.813-1.987-2.298-1.675-1.555-1.45-1.303.568-3.991 1.229-1.638 1.72-2.638 1.566-3.066-.146-.407-1.05-.3-1.05-.3l-3.005.018s-.223-.03-.389.069c-.161.097-.265.322-.265.322s-.476 1.268-1.111 2.345c-1.339 2.274-1.875 2.394-2.094 2.253-.509-.329-.381-1.323-.381-2.028 0-2.204.333-3.122-.652-3.36-.327-.079-.567-.131-1.404-.14-1.072-.011-1.98.004-2.495.255-.342.168-.606.541-.445.563.199.026.65.12.888.446.309.419.297 1.361.297 1.361s.178 2.594-.413 2.917c-.407.221-.963-.23-2.157-2.294C4.682 6.488 4.22 5.32 4.22 5.32s-.088-.218-.247-.334a1.246 1.246 0 00-.463-.186l-2.857.017s-.43.013-.587.199c-.14.166-.011.509-.011.509s2.238 5.234 4.77 7.873c2.324 2.419 4.962 2.26 4.962 2.26h1.195s.361-.04.545-.239c.17-.182.164-.525.164-.525s-.024-1.604.721-1.84c.734-.233 1.677 1.55 2.675 2.236.755.52 1.33.405 1.33.405l2.67-.037s1.398-.086.736-1.185z" fill="#2D303A"/></g><defs><clipPath id="clip0"><path fill="#fff" d="M0 0h20v20H0z"/></clipPath></defs></svg></a></li>
            </ul>
        </div>

        <div class="comments">
            <div class="comments__counts">{{ $article->comments->count() }} комментариев к записи </div>
        </div>
        @if (\Auth::check())
            <div class="comments-send">
                <div class="comments-send__photo">
                    <img src="{{ \Illuminate\Support\Facades\Auth::user()->imageUser() }}" alt="">
                </div>
                <form action="{{ route('send.comment', $article->slug) }}" class="form-comment comments-send__form" method="POST">
                    @csrf
                    <textarea type="text" class="form-control form-comment__textarea" placeholder="Оставьте свой комментарий..." name="body" id="body"></textarea>
                    <button class="btn form-comment__btn" type="submit">Отправить</button>
                </form>
            </div>
        @else
            <p>Чтобы оставить комментарий. <a href="{{ route('login') }}">Зарегистрируйтесь</a> или <a href="{{ route('login') }}">Зарегистрируйтесь</a> </p>
        @endif

        <div class="comments">
            <ul class="comments__list">
                @foreach($comments as $comment)
                    <li class="comments__item">
                        <a href="{{ route('profile', $comment->user_id) }}" class="comments__photo">
                            <img src="{{ $comment->author($comment->user_id)->imageUser() }}" alt="" class="comments__image">
                            <p class="comments__author">
                                {{ $comment->author($comment->user_id)->name }}
                            <div class="comments__date">{{ $comment->created_at->format('d-m-Y в H:i') }}</div>
                            </p>
                        </a>
                        <div class="comments__description">
                            {!! $comment->body !!}
                        </div>
                        <div class="comments__footer">

                        </div>

                    </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
