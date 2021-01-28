@extends('admin.layouts.master')

@section('content')
    <div class="list-admin">
        <div class="container">
            <h1>Добавить тег</h1>
            <form action="{{ route('tags.store') }}" method="POST" class="admin-form" enctype='multipart/form-data'>
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Название тега</label>
                    <input type="name" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Название теги (Например: Тревел)">
                </div>

                <div class="admin-form__box">
                    <label for="preview" class="admin-form__label">Иконка категории</label>
                    <input type="file" name="preview" id="preview">
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
