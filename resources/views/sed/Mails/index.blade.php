@extends('layouts.app')

@section('title', 'Данные почты')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-between bg-light">
            <h1 class="col-auto">Данные с почты</h1>
            <div class="col-2 d-flex justify-content-center">
                <div>
                    <a href="{{ route('mails.update') }}" class="btn btn-success">Обновить</a>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                <h4 class="alert-heading">Успешно</h4>
                <p>Данные с почты успешно обновлены и добавлены в базу</p>
            </div>
        @endif
        <div class="row">
            <table class="table">
                <thead>
                <tr>
                    <th>Тема</th>
                    <th>От кого</th>
                    <th>Количество файлов</th>
                    <th>Тело сообщения</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($messages as $f)
                        <tr>
                            <td>{{ $f->Subject }}</td>
                            <td>{{ $f->From }}</td>
                            <td>{{ $f->Count }}</td>
                            <td>{{ $f->Body }}</td>
                            <td>
                                <a href="{{ route('mails.info', ['id' => $f->id]) }}" class="btn btn-info mb-2">Подробнее</a>
                                <a href="{{ route('mails.pushInDocs', ['id' => $f->id]) }}" class="btn btn-info">Сохранить в документы</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {!! $messages->render() !!}
    </div>
    <script>
        $(document).ready(function () {
            window.sessionStorage.clear();
        })
    </script>
@endsection
