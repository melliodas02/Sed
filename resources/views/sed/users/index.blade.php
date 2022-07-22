@extends('layouts.app')

@section('title', 'Пользователи')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">Пользователи</h1>
            <div class="col-2 d-flex justify-content-center">
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-success">Добавить</a>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ФИО</th>
                    <th>Почта</th>
                    <th>Роли</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $user)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $user->LastName }} {{ $user->FirstName }} {{ $user->MiddleName }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                @foreach($user->getRoleNames() as $v)
                                    <label class="">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Подробнее</a>
                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Редактировать</a>
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {!! $data->render() !!}
    </div>
    <script>
        $(document).ready(function () {
            window.sessionStorage.clear();
        })
    </script>

@endsection
