@extends('layouts.app')

@section('title', 'Информации о сообщении')

@section('content')
    <div class="container">
        <h1>Информация сообщении</h1>

        <div class="row mt-2">
            <p class="col-4">От</p>
            <p class="col-8">{{ $mail->From }}</p>
        </div>

        <div class="row mt-2">
            <p class="col-4">Тема </p>
            <p class="col-8">{{ $mail->Subject }}</p>
        </div>

        <div class="row mt-2">
            <p class="col-4">Сообщение</p>
                <p class="col-8">{{ $mail->Body }}</p>
        </div>

        @if(!empty($docs))
            <div class="row mt-2">
                <p class="row">Прикрепленные документы</p>
                @foreach($docs as $doc)
                    <div class="row">
                        <p class="col-8">{{ $doc->name }}</p>
                        <div class="col-4">
                            <a href="#" class="btn btn-success">Посмотреть</a>
                            <a href="{{ route('mails.download', ['id' => $doc->id]) }}" class="btn btn-success">Скачать</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
