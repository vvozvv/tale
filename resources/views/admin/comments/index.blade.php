@extends('admin.layouts.master')

@section('content')


    <div class="container-fluid">


        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Комментарии <sup>{{ $comments->count() }}</sup> </h1>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Автор</th>
                            <th>Комментарий</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </thead>
                        <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td>{{ $comment->id }}</td>
                                <td><a href="{{ route('profile', $comment->user_id) }}" class="" target="_blank">{{ is_null($comment->author($comment->user_id)) ?: $comment->author($comment->user_id)->name }}</a></td>
                                <td>{{ $comment->body }}</td>
                                <td>{{ $comment->created_at->format('d-m-Y в H:i') }}</td>
                                <td>
                                    <form action="{{ route('comments.update', $comment) }}" method="POST" class="comments-status" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <select name="status" aria-controls="dataTable" class=" custom-select custom-select-sm form-control form-control-sm" >
                                            <option value="0"  @if($comment->status == 0) selected @endif>На модерации</option>
                                            <option value="1" @if($comment->status == 1) selected @endif>Опубликован</option>
                                        </select>
                                    </form>

                                </td>

                                <td class="d-sm-flex align-items-center">
{{--                                    <a href="{{ route('article', $comment->article_id) }}" class="list-admin__link btn btn-success">Открыть</a>--}}
                                    <a href="{{ route('comments.edit', $comment->id) }}" class="list-admin__link btn btn-warning">Редактировать</a>
                                    <form action="{{  route('comments.destroy', $comment->id) }}" class="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-circle"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

@endsection
