@extends('layouts.app')

@section('title')
    {{ $data_title }}
@endsection

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">{{ $data_title }}</h1>
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
                            <a href="/orders/{{ $url }}/{{ $org->id }}" class="btn btn-info">Подробнее</a>
                            <a href="{{ route('contracts.edit', ['id' => $org->id]) }}" class="btn btn-success">Редактировать</a>
                            @if (auth()->user()->hasrole('Администратор-делопроизводитель'))
                                <a href="{{ route('contracts.delete', ['id' => $org->id]) }}" class="btn btn-danger">Удалить</a>
                            @endif
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
