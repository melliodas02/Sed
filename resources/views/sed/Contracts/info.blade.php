@extends('layouts.app')

@section('title')
    {{ $data->title }}
@endsection

@section('content')
    <div class="container">
        <h1>Информация о документе</h1>

        <div class="row mt-2">
            <p class="col-4">Название</p>
            <p class="col-8">{{ $data->title }}</p>
        </div>

        <div class="row mt-2">
            <p class="col-4">Описание </p>
            <p class="col-8">{{ $data->Description }}</p>
        </div>

        <div class="row mt-2">
            <p class="col-4">Подписант</p>
            <div class="col-8 ps-4">
                <p class="row">{{ $org->OrganizationName }}</p>
                <p class="row">{{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }}</p>
            </div>
        </div>

        <div class="row mt-2">
            <p class="col-4">Адресант</p>
            <p class="col-8">{{ $user->LastName }} {{ $user->FirstName }} {{ $user->MiddleName }}</p>
        </div>

        <div class="row mt-2">
            <p class="row">Прикрепленные документы</p>
            <div class="row">
                <p class="col-8">{{ $doc->name }}</p>
                <div class="col-4">
                    <a href="#" class="btn btn-success">Посмотреть</a>
                    <a href="{{ route('contracts.download', ['id' => $doc->id]) }}" class="btn btn-success">Скачать</a>
                </div>
            </div>
        </div>
    </div>
@endsection
