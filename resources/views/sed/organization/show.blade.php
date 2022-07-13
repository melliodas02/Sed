@extends('layouts.app')

@section('title')
    {{ $data->OrganizationName }}
@endsection

@section('content')
    <div class="container">
        <h1>Инормация об организации</h1>
        <div class="row">
            <p class="col-4">Название организации</p>
            <p class="col-8">{{ $data->OrganizationName }}</p>
        </div>
        <div class="row">
            <p class="col-4">Сокращенное название</p>
            <p class="col-8">{{ $data->OrganizationAbbreviatedName }}</p>
        </div>
        <div class="row">
            <p class="col-4">Адресс организации</p>
            <p class="col-8">{{ $data->OrganizationAddress }}</p>
        </div>
        <div class="row">
            <p class="col-4">Инн</p>
            <p class="col-8">{{ $data->INN }}</p>
        </div>
        <div class="row">
            <p class="col-4">Должность представителя</p>
            <p class="col-8">{{ $data->PositionAtWork }}</p>
        </div>
        <div class="row">
            <p class="col-4">ФИО</p>
            <p class="col-8">{{ $data->LastName }} {{ $data->FirstName }} {{ $data->MiddleName }}</p>
        </div>
        @if ($data->Phone != "")
            <div class="row">
                <p class="col-4">Телефон</p>
                <p class="col-8">{{ $data->Phone }}</p>
            </div>
        @endif
        @if ($data->Email != "")
            <div class="row">
                <p class="col-4">Почта</p>
                <p class="col-8">{{ $data->Email }}</p>
            </div>
        @endif
        @if ($data->Fax != "")
            <div class="row">
                <p class="col-4">Факс</p>
                <p class="col-8">{{ $data->Fax }}</p>
            </div>
        @endif
        <div class="row">
            <a href="/organizations/{{ $data->id }}/edit" class="col-auto btn btn-success me-1">Редактировать</a>
            <a href="/organizations/{{ $data->id }}/remove" class="col-auto btn btn-danger">Удалить</a>
        </div>
    </div>
@endsection
