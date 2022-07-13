@extends('layouts.app')

@section('title', 'Поиск')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">Поиск</h1>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Название</th>
                    <th>Дата</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                {{--            @if(empty($organizations))--}}
                @foreach($data as $org)
                    <tr>
                        <td>{{ $org->id }}</td>
                        <td>{{ $org->title }}</td>
                        <td>{{ $org->Date }}</td>
                        <td class="">
                            <a href="/outputDocs/{{ $url }}/{{ $org->id }}" class="btn btn-info">Подробнее</a>
                            <a href="/outputDocs/{{ $org->id }}/edit" class="btn btn-success">Редактировать</a>
                            <a href="/outputDocs/{{ $org->id }}/remove" class="btn btn-danger">Удалить</a>
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
