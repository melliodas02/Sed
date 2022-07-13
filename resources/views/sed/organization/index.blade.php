@extends('layouts.app')

@section('title', 'Организации')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">Органиациии</h1>
            <div class="col-2">
                <a href="{{ route('organization.add') }}" class="pt-2 pb-2 ps-5 pe-5 btn btn-success">Добавить</a>
            </div>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Должность</th>
                    <th>ФИО</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
{{--            @if(empty($organizations))--}}
                @foreach($organizations as $org)
                    <tr>
                        <td>{{ $org['id'] }}</td>
                        <td>{{ $org['OrganizationAbbreviatedName'] }}</td>
                        <td>{{ $org['PositionAtWork'] }}</td>
                        <td>{{ $org['LastName'] }} {{ $org['FirstName'] }}  {{ $org['MiddleName'] }}</td>
                        <td class="">
                            <a href="/organizations/{{ $org->id }}" class="btn btn-info">Подробнее</a>
                            <a href="/organizations/{{ $org->id }}/edit" class="btn btn-success">Редактировать</a>
                            <a href="/organizations/{{ $org->id }}/remove" class="btn btn-danger">Удалить</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                </table>
{{--            @else--}}
{{--                </table>--}}
{{--                <h3>Организации отсутствуют</h3>--}}
{{--            @endif--}}
        </div>
    </div>
    <script>
        $(document).ready(function () {
            window.sessionStorage.clear();
        })
    </script>
@endsection
