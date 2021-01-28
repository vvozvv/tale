@extends('admin.layouts.master')

@section('content')

    <div class="col-lg-6">
        <div class="card mb-12">
            <div class="card-header">
                <p>Редактирование:</p>
                <h1>{{ $article->title }} <p class="badge badge-danger">{{ (!is_null($article->deleted_at)) ? 'Удаленно' : '' }}</p></h1>
            </div>
            <div class="card-body">
                <form action="{{ route('article.update', $article) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputEmail1">Название статьи</label>
                        <input class="form-control" id="title" name="title" placeholder="{!! Request::old('title', $article->title) !!}" value="{!! Request::old('title', $article->title) !!}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Псевдоним</label>
                        <input class="form-control" id="slug" name="slug" placeholder="{!! Request::old('title', $article->slug) !!}" value="{!! Request::old('title', $article->slug) !!}">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Количество просмотров</label>
                        <input class="form-control" id="view_count" name="view_count" placeholder="{!! Request::old('title', $article->view_count) !!}" value="{!! Request::old('title', $article->view_count) !!}">
                    </div>
                    <div class="form-group">
                        <label style="display: block;">Название статьи</label>
                        <textarea name="article_text" id="article_text" cols="30" rows="10" class="form-dashboard__input description" value="{!! Request::old('title', $article->article_text) !!}">
                        {!! Request::old('title', $article->article_text) !!}
                    </textarea>
                        @if($errors->has('article_text'))
                            <p class="help-block">
                                {{ $errors->first('article_text') }}
                            </p>
                        @endif
                    </div>
                    <select aria-controls="dataTable" name="tag" class=" custom-select custom-select-sm form-control form-control-sm" >
                        <option @if(!is_null($article->tag->first())) selected @endif>--- Не выбранно ---</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" @if(!is_null($article->tag->first())) @if($tag->id == $article->tag->first()->id) selected @endif @endif>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </form>
            </div>
        </div>
    </div>


@endsection
