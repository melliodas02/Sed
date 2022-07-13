@extends('layouts.app')

@section('title', 'Добавление организации')

@section('content')
    <div class="container">
        <h1>Добавление организации</h1>
        <form action="{{ route('organization.create') }}" method="post">
            @csrf

            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="INN" id="INN" class="form-control" required placeholder="ИНН">
                    <label for="">ИНН</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" name="OrganizationName" id="OrganizationName" class="form-control" required placeholder="Полное название организации">
                    <label for="">Полное название организации</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" name="OrganizationAbbreviatedName" class="form-control" required placeholder="Краткое название">
                    <label for="">Сокращенное название</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-6 form-floating">
                    <input type="text" name="OrganizationAddress" class="form-control" required placeholder="Адресс">
                    <label for="">Адресс организации</label>
                </div>
            </div>

            <div class="mt-3 row d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="LastName" required placeholder="Фамилия">
                    <label for="">Фамилия</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="FirstName" required placeholder="Имя">
                    <label for="">Имя</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" class="form-control" name="MiddleName" required placeholder="Отчество">
                    <label for="">Отчество</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="PositionAtWork" class="form-control" required placeholder="Должность">
                    <label for="">Должность</label>
                </div>
            </div>

            <div class="row mt-3 d-flex justify-content-center">
                <div class="col-4 form-floating">
                    <input type="text" name="Phone" class="form-control" placeholder="Телефон">
                    <label for="">Телефон(необязательно)</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="email" name="Email" class="form-control" placeholder="Почта">
                    <label for="">Почта(необязательно)</label>
                </div>
                <div class="col-4 form-floating">
                    <input type="text" name="Fax" class="form-control" placeholder="Факс">
                    <label for="">Факс(необязательно)</label>
                </div>
            </div>
            <div class="row mt-3 d-flex justify-content-center">
                <input type="submit" name="Save" class="col-auto btn btn-success" value="Добавить">
            </div>
        </form>
    </div>

    <script>
        $("#INN").suggestions({
            token: "f904fe93299d45f292cbc9191cf90d9ce97b7ce0",
            type: "PARTY",
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function(suggestion) {
                console.log(suggestion.data.inn);
                var res = suggestion;
                document.getElementsByName('INN')[0].value = res.data.inn;
                document.getElementsByName('OrganizationName')[0].value = res.data.name['full_with_opf'];
                document.getElementsByName('OrganizationAbbreviatedName')[0].value = res.data.name['short_with_opf'];
                document.getElementsByName('OrganizationAddress')[0].value = res.data.address.unrestricted_value;
                document.getElementsByName('PositionAtWork')[0].value = res.data.management.post;
                let fio = res.data.management.name.split(' ');
                document.getElementsByName('LastName')[0].value = fio[0];
                document.getElementsByName('FirstName')[0].value = fio[1];
                document.getElementsByName('MiddleName')[0].value = fio[2];
            }
        });
        $("#OrganizationName").suggestions({
            token: "f904fe93299d45f292cbc9191cf90d9ce97b7ce0",
            type: "PARTY",
            /* Вызывается, когда пользователь выбирает одну из подсказок */
            onSelect: function (suggestion) {
                console.log(suggestion.data.inn);
                var res = suggestion;
                document.getElementsByName('INN')[0].value = res.data.inn;
                document.getElementsByName('OrganizationName')[0].value = res.data.name['full_with_opf'];
                document.getElementsByName('OrganizationAbbreviatedName')[0].value = res.data.name['short_with_opf'];
                document.getElementsByName('OrganizationAddress')[0].value = res.data.address.unrestricted_value;
                document.getElementsByName('PositionAtWork')[0].value = res.data.management.post;
                let fio = res.data.management.name.split(' ');
                document.getElementsByName('LastName')[0].value = fio[0];
                document.getElementsByName('FirstName')[0].value = fio[1];
                document.getElementsByName('MiddleName')[0].value = fio[2];
            }
        });
    </script>
@endsection
