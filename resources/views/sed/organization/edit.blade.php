@extends('layouts.app')

@section('title', 'Редактированик организации')

@section('content')
    <div class="container">
        <h1>Редактирование организации</h1>
        <form action="/organizations/{{ $data->id }}/save_changes" method="post">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="LastName" required placeholder="Фамилия" value="{{ $data->LastName }}">
                    <label for="">Фамилия</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="FirstName" required placeholder="Имя" value="{{ $data->FirstName }}">
                    <label for="">Имя</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="MiddleName" required placeholder="Отчество" value="{{ $data->MiddleName }}">
                    <label for="">Отчество</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="PositionAtWork" class="form-control" required placeholder="Должность" value="{{ $data->PositionAtWork }}">
                    <label for="">Должность</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-6 form-floating">
                    <input type="text" name="OrganizationName" class="form-control" required placeholder="Полное название организации" value="{{ $data->OrganizationName }}">
                    <label for="">Полное название организации</label>
                </div>
                <div class="col-5 form-floating">
                    <input type="text" name="OrganizationAbbreviatedName" class="form-control" required placeholder="Краткое название" value="{{ $data->OrganizationAbbreviatedName }}">
                    <label for="">Сокращенное название</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-6 form-floating">
                    <input type="text" name="OrganizationAddress" class="form-control" required placeholder="Адресс"  value="{{ $data->OrganizationAddress }}">
                    <label for="">Адресс организации</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="Phone" class="form-control" placeholder="Телефон" value="{{ $data->Phone }}">
                    <label for="">Телефон(необязательно)</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="email" name="Email" class="form-control" placeholder="Почта" value="{{ $data->Email }}">
                    <label for="">Почта(необязательно)</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" name="Fax" class="form-control" placeholder="Факс" value="{{ $data->Fax }}">
                    <label for="">Факс(необязательно)</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <input type="submit" name="Save" class="col-auto btn btn-success" value="Сохранить">
            </div>
        </form>
    </div>
@endsection
