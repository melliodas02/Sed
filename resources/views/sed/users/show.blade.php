@extends('layouts.app')

@section('title', 'Информация о пользователе')

@section('content')
    <div class="container">
        <h1>Инормация об организации</h1>
        <div class="row">
            <p class="col-4">ФИО</p>
            <p class="col-8">{{ $user->LastName }} {{ $user->FirstName }} {{ $user->MiddleName }}</p>
        </div>
        <div class="row">
            <p class="col-4">Должность</p>
            <p class="col-8">{{ $user->Position }}</p>
        </div>
        <div class="row">
            <p class="col-4">Почта</p>
            <p class="col-8">{{ $user->email }}</p>
        </div>
        <div class="row">
            <p class="col-4">Роли</p>
            <div class="col-8">
                @if(!empty($user->getRoleNames()))
                    @foreach($user->getRoleNames() as $v)
                        <label class="">{{ $v }}</label>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="row">
            <a class="col-auto me-1 btn btn-primary" href="{{ route('users.edit',$user->id) }}">Редактировать</a>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', 'class' => 'col-auto']) !!}
            {!! Form::submit('Удалить', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
