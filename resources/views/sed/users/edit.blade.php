@extends('layouts.app')

@section('title', 'Редактрование пользователя')

@section('content')
    <div class="container">
        <h1>Редактирование пользователей</h1>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
        <div class="mt-3 row d-flex justify-content-center">
            <div class="col-4 form-floating">
                {!! Form::text('LastName', null, array('placeholder' => 'Фамилия', 'class' => 'form-control')) !!}
                <label for="">Фамилия</label>
            </div>
            <div class="col-4 form-floating">
                {!! Form::text('FirstName', null, array('placeholder' => 'Имя', 'class' => 'form-control')) !!}
                <label for="">Имя</label>
            </div>
            <div class="col-4 form-floating">
                {!! Form::text('MiddleName', null, array('placeholder' => 'Отчество', 'class' => 'form-control')) !!}
                <label for="">Отчество</label>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-6 form-floating">
                {!! Form::text('Position', null, array('placeholder' => 'Должность', 'class' => 'form-control')) !!}
                <label for="">Должность</label>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-6 form-floating">
                {!! Form::text('email', null, array('placeholder' => 'Почта', 'class' => 'form-control')) !!}
                <label for="">Почта</label>
            </div>
        </div>
        <div class="row mt-3 d-flex justify-content-center">
            <div class="col-6 form-floating">
                {!! Form::password('password', array('placeholder' => 'Пароль', 'class' => 'form-control')) !!}
                <label for="">Пароль</label>
            </div>
            <div class="col-6 form-floating">
                {!! Form::password('confirm-password', array('placeholder' => 'Повторите пароль', 'class' => 'form-control')) !!}
                <label for="">Повторите пароль</label>
            </div>
        </div>
        <div class="mt-3 col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                {!! Form::select('roles[]', $roles, $userRole, array('class' => 'form-control','multiple')) !!}
            </div>
        </div>
        <div class="mt-3 col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-success">Создать</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
