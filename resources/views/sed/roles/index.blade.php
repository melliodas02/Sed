@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">Управление ролями</h1>
            @can('role-create')
                <div class="col-2 d-flex justify-content-center">
                    <div>
                        <a href="{{ route('roles.create') }}" class="btn btn-success">Добавить</a>
                    </div>
                </div>
            @endcan
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $key => $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td class="">
                            <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Подробнее</a>
                            @can('role-edit')
                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Редактировать</a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {!! $roles->render() !!}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            window.sessionStorage.clear();
        })
    </script>
@endsection
