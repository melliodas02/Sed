@extends('layouts.app')

@section('title', 'Главная страница')

@section('content')
    <div class="container">


        <div class="container">
            <div class="row mb-2">
                <div class="col-5">
                    <div>
                        <a href="{{ route('inputDocs.add') }}" class="button-nvr d-flex justify-content-center pt-4">
                            <div class="row text-center">
                                <h1>
                                    <ion-icon name="document"></ion-icon>
                                </h1>
                                <p>Добавить входящий документ</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-5">
                    <div>
                        <a href="{{ route('OutputDocs.add') }}" class="button-nvr d-flex justify-content-center pt-4">
                            <div class="row text-center">
                                <h1>
                                    <ion-icon name="document"></ion-icon>
                                </h1>
                                <p>Добавить исходящий документ</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <div>
                        <a href="{{ route('orders.add') }}" class="button-nvr d-flex justify-content-center pt-4">
                            <div class="row text-center">
                                <h1>
                                    <ion-icon name="document"></ion-icon>
                                </h1>
                                <p>Добавить приказ</p>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-5">
                    <div>
                        <a href="{{ route('memos.add') }}" class="button-nvr d-flex justify-content-center pt-4">
                            <div class="row text-center">
                                <h1>
                                    <ion-icon name="document"></ion-icon>
                                </h1>
                                <p>Добавить служебную записку</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-5">
                    <div>
                        <a href="{{ route('contracts.add') }}" class="button-nvr d-flex justify-content-center pt-4">
                            <div class="row text-center">
                                <h1>
                                    <ion-icon name="document"></ion-icon>
                                </h1>
                                <p>Добавить договора</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            window.sessionStorage.clear();
        })
    </script>
@endsection
