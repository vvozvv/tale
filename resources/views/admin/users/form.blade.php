@extends('admin.layouts.master')

@section('content')
    <div class="list-admin">
        <div class="container">
            <h1>Добавить пользователя</h1>
            <form

                @isset($user)
                    action="{{ route('users.update', $user) }}"
                @else
                    action="{{ route('users.store') }}"
                @endif
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="name" class="form-control" id="name" name="name" aria-describedby="emailHelp" placeholder="Имя" value="{{ (isset($user)) ? $user->name : ''}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="email" value="{{ (isset($user)) ? $user->email : '' }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Роли</label>
                    <select name="permiss" id="permiss" multiple class="">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Права</label>
                    <select name="permiss" id="permiss" multiple class="">
                        @isset($user)
                            @foreach($user->getPermissionNames() as $permission)
                                <option value="">{{ $permission }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
