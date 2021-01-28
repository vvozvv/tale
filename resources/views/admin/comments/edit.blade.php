@extends('admin.layouts.master')

@section('content')
    <div class="list-admin">
        <div class="container">
            <h1>Добавить тег</h1>
            <form action="{{ route('comments.update', $comment) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h2>Автор: {{ $comment->author($comment->user_id)->name }}</h2>
                <div class="form-group">
                    <label for="exampleInputEmail1">Текст комментария</label>
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control">
                        {{$comment->body}}
                    </textarea>
                </div>


                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
