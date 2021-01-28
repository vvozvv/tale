@extends('admin.layouts.master')

@section('content')

    <div class="container-fluid">
        <div class="container-fluid">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Пользователи</h1>
                <a href="{{ route('users.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-download fa-sm text-white-50"></i>
                    Создать пользователя
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
                            <td scope="col">ID</td>
                            <td scope="col">Имя</td>
                            <td scope="col">Роль</td>
                            <td scope="col">Права</td>
                            <td scope="col">Количество статей</td>
                            <td scope="col">Действия</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>@foreach($user->roles as $role) <p class="badge badge-primary">{{ $role->name }}</p> @endforeach</td>
                                <td>@foreach($user->getPermissionNames() as $permission) <p class="badge badge-primary">{{ $permission }}</p> @endforeach</td>
                                <td>{{ $user->articles->count() }}</td>
                                <td class="list-admin__row">
                                    <a href="" class="list-admin__link btn btn-success">Открыть</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="list-admin__link btn btn-warning">Изменить</a>
                                    <form action="{{  route('users.destroy', $user->id) }}" class="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="list-admin__link btn btn-danger">Удалить</button>
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
