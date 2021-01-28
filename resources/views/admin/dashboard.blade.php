@extends('admin.layouts.master')

@section('content')
    <div class="list-admin">
        <div class="container">
            <h1>Статьи {{ $articles->count() }}</h1>
            <div class="list-admin__list">

                    <table class="table table-hover">
                       <thead>
                           <tr>
                               <td scope="col">Название запси</td>
                               <td scope="col">Ссылка</td>
                               <td scope="col">Псевдоним</td>
                               <td scope="col">Коментарии</td>
                               <td scope="col">Автор</td>
                               <td scope="col">Действия</td>
                           </tr>
                       </thead>
                       <tbody>
                            @foreach ($articles as $article)
                                <tr class="@if (!is_null($article->deleted_at)) {{ 'alert alert-danger' }} @endif">
                                    <td>{{ $article->title }}</td>
                                    <td><a href="{{ route('article', $article->id ) }}"><svg width="25" height="25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.4575 13.1999c.4295.5741.9774 1.0492 1.6066 1.393.6292.3437 1.3249.5481 2.0401.5994.7151.0512 1.4329-.052 2.1047-.3026.6717-.2506 1.2817-.6427 1.7886-1.1498l3-3c.9108-.94299 1.4148-2.20601 1.4034-3.51699-.0114-1.31098-.5372-2.56505-1.4643-3.49209-.927-.92704-2.1811-1.45288-3.4921-1.46427-1.311-.0114-2.574.49258-3.517 1.40337l-1.72 1.71" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M14.4577 11.1999c-.4294-.5741-.9773-1.0492-1.6065-1.39291-.6292-.34375-1.325-.54817-2.0401-.59939-.7152-.05122-1.43297.05197-2.10473.30255-.67175.25059-1.28176.64275-1.78865 1.14975l-3 3c-.91079.943-1.41476 2.2061-1.40337 3.517.01139 1.311.53724 2.5651 1.46428 3.4921.92704.9271 2.1811 1.4529 3.49208 1.4643 1.31099.0114 2.57399-.4926 3.51699-1.4034l1.71-1.71" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a></td>
                                    <td>{{ $article->id }}</td>
                                    <td>{{ $article->comments->count() }}</td>
                                    <td><a href="{{ route('users', $article->user_id) }}" class="">{{ is_null($article->getAuthor($article->user_id)) ?: $article->getAuthor($article->user_id)->name }}</a></td>
                                    <td>
                                        <a href="{{ route('article.show', $article->id) }}" class="list-admin__link btn btn-success">Открыть</a>
                                        <a href="{{ route('article.edit', $article->id) }}" class="list-admin__link btn btn-warning">Редактировать</a>
                                        <form action="{{ route('article.destroy', $article->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="list-admin__link btn btn-danger">Удалить</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                       </tbody>

                    </table>
                {{ $articles->links() }}
            </div>
        </div>
    </div>

@endsection
