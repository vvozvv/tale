@extends('auth.layouts.master')

@section('content')
@section('title', 'Статьи')
    <div class="dashboard-article">
        @foreach($articles as $article)
            <a href="" class="dashboard-article__item favorite">
                <span class="dashboard-article__cat">{{ $article->title }}</span>
                <h2 class="dashboard-article__title">{{ $article->title }}</h2>

                <span class="dashboard-article__footer">
                <div class="dashboard-article__box">
                    <span class="dashboard-article__subtitle">Рейтинг</span>
                    <div class="dashboard-rate">
                        <div class="dashboard-rate__list">
                            <div class="dashboard-rate__item"><svg width="19" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.70589 1.75l2.38021 5.4775 5.3229.88375-3.8516 4.26125.909 6.02-4.76051-2.8438-4.76051 2.8438.90897-6.02-3.85154-4.26125 5.32283-.88375L9.70589 1.75z" fill="#fff" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                            <div class="dashboard-rate__item"><svg width="19" height="21" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.70589 1.75l2.38021 5.4775 5.3229.88375-3.8516 4.26125.909 6.02-4.76051-2.8438-4.76051 2.8438.90897-6.02-3.85154-4.26125 5.32283-.88375L9.70589 1.75z" fill="#fff" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                        </div>
                        <span class="dashboard-rate__rate">3.4</span>
                    </div>
                </div>
                <div class="dashboard-article__box">
                    <span class="dashboard-article__subtitle">Комментариев</span>
                    <div class="dashboard-comment">
                        <svg width="22" height="22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.25 10.5417c.0032 1.2099-.2795 2.4034-.825 3.4833-.6468 1.2941-1.6411 2.3826-2.8715 3.1435-1.2304.761-2.6484 1.1643-4.0952 1.1649-1.2098.0031-2.40336-.2796-3.4833-.825L2.75 19.25l1.74167-5.225c-.54548-1.0799-.82816-2.2734-.825-3.4833.00056-1.44673.40389-2.86473 1.16482-4.09517C5.59242 5.21609 6.6809 4.2218 7.975 3.57503c1.07994-.54548 2.2735-.82816 3.4833-.825h.4584c1.9106.10541 3.7153.91186 5.0683 2.26495 1.3531 1.35309 2.1596 3.15773 2.265 5.06842v.4583z" stroke="#fff" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <span>32</span>
                    </div>
                </div>
            </span>
            </a>
        @endforeach
    </div>
@endsection
