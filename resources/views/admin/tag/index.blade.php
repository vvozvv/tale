@extends('admin.layouts.master')

@section('content')



<div class="container-fluid">


    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Теги <span class="badge badge-dark">{{ $tags->count() }}</span></h1>

            <a href="{{ route('tags.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i>
                Создать тег
            </a>
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
                        <th>Изображение</th>
                        <th>Название</th>
                        <th>Псевдоним</th>
                        <th>Действия</th>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->id }}</td>
                                <td><img src="{{ ($tag->icon()) }}" alt="" class="" width="40" height="auto"></td>
                                <td>{{ $tag->name }}</td>
                                <td>{{ $tag->id }}</td>
                                <td class="d-sm-flex align-items-center">
                                    <a href="" class="list-admin__link btn btn-success">Открыть</a>
                                    <a href="" class="list-admin__link btn btn-warning">Сохранить</a>
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST">
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
