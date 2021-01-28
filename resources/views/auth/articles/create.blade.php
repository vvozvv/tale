@extends('auth.layouts.master')

@section('content')


@isset($article)
    @section('title', 'Изменить статью '. ($article->status = 0) ? 'Не опубликована' : 'Опубликована')
@else
    @section('title', 'Создать статью')
@endisset


{{--    <form action="{{ route('articles.store') }}" class="form-dashboard" method="POST" enctype='multipart/form-data'>--}}
{{--        @method('POST')--}}
{{--        @csrf--}}
{{--        <input type="text" class="form-dashboard__input" id="title" name="title" placeholder="Введите заголовок" value="@isset($article){{$article->title}}@endisset">--}}
{{--        @if($errors->has('title'))--}}
{{--            <p class="help-block">--}}
{{--                {{ $errors->first('title') }}--}}
{{--            </p>--}}
{{--        @endif--}}
{{--        <textarea name="article_text" id="article_text" cols="30" rows="10" class="form-dashboard__input description" value="@isset($article){{$article->article_text}}@endisset"></textarea>--}}
{{--        @if($errors->has('article_text'))--}}
{{--            <p class="help-block">--}}
{{--                {{ $errors->first('article_text') }}--}}
{{--            </p>--}}
{{--        @endif--}}

{{--        <select name="tag" id="selectall-tag" class="select2" multiple="multiple">--}}
{{--            @foreach($tags as $tag)--}}
{{--                <option value="{{ $tag->id }}">{{ $tag->id }} - {{ $tag->name }}</option>--}}
{{--            @endforeach--}}
{{--        </select>--}}
{{--        <input id="article_image" type="file" class="form-control" name="article_image">--}}

{{--        <button type="submit" class="btn">Опубликовать</button>--}}
{{--    </form>--}}
    <edit-article @isset($article) :data='@json($article)'  @endisset></edit-article>
@endsection
