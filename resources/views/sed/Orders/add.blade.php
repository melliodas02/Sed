@extends('layouts.app')

@section('title', 'Добавление приказов')

@section('content')
    <div class="container">
        <h1>Добавление приказов</h1>
        <form action="{{ route('orders.save') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-7 form-floating">
                    <input type="text" name="title" class="form-control" required placeholder="Название">
                    <label for="">Название</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <input type="text" name="doc_number" class="form-control" required placeholder="Номер документа" value="{{ $doc_number }}">
                    <label for="">Номер документа</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <textarea name="description" style="min-height: 250px;" class="form-control"></textarea>
                    <label for="">Описание</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <input type="date" class="form-control" name="Date" id="Date" required placeholder="" value="">
                    <label for="">Выберите дату</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Category" id="" class="form-select">
                        @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите тип документа</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7">
                    <label for="">Выберите организацию</label>
                    <div class="row">
                        <div class="col-11">
                            <select name="Signatory" class="form-select col-11" id="Signatory">
                                @foreach($organizations as $org)
                                    <option value="{{ $org->id }}"> {{ $org->OrganizationAbbreviatedName }}
                                        - {{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }}
                                        - {{ $org->PositionAtWork }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-1">
                            <button type="button" class="border-0" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                <div class="circle"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7">
                    <label for="">Вебирте отвественного</label>
                    <select name="Sender" class="form-select" style="height: 50rem;" id="Sender">
                        @foreach($users as $org)
                            <option
                                value="{{ $org->id }}">{{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }}
                                - {{ $org->Position }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <script>
                $("#Signatory").select2();
                $("#Sender").select2();
            </script>

            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <input type="file" class="form-control" name="Document" required placeholder="Документ">
                    <label for="" class="">Выберите документ</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <input type="submit" class="btn btn-success col-auto" name="save" value="Сохранить">
            </div>
        </form>

        <!-- Модальное окно -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Добавление организации</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addOrg">
                            <div class="row mt-3 d-flex justify-content-center">
                                <div class="col-4 form-floating">
                                    <input type="text" name="INN" id="INN"
                                           class="form-control" required placeholder="ИНН">
                                    <label for="">ИНН</label>
                                </div>
                                <div class="col-4 form-floating">
                                    <input type="text" name="OrganizationName" id="OrganizationName" class="form-control" required
                                           placeholder="Полное название организации">
                                    <label for="">Полное название организации</label>
                                </div>
                                <div class="col-4 form-floating">
                                    <input type="text" name="OrganizationAbbreviatedName" class="form-control"
                                           required placeholder="Краткое название">
                                    <label for="">Сокращенное название</label>
                                </div>
                            </div>
                            <div class="row mt-3 d-flex justify-content-center">
                                <div class="col-6 form-floating">
                                    <input type="text" name="OrganizationAddress" class="form-control" required
                                           placeholder="Адресс">
                                    <label for="">Адресс организации</label>
                                </div>
                            </div>

                            <div class="mt-3 row d-flex justify-content-center">
                                <div class="col-4 form-floating">
                                    <input type="text" class="form-control" name="LastName" required
                                           placeholder="Фамилия">
                                    <label for="">Фамилия</label>
                                </div>
                                <div class="col-4 form-floating">
                                    <input type="text" class="form-control" name="FirstName" required
                                           placeholder="Имя">
                                    <label for="">Имя</label>
                                </div>
                                <div class="col-4 form-floating">
                                    <input type="text" class="form-control" name="MiddleName" required
                                           placeholder="Отчество">
                                    <label for="">Отчество</label>
                                </div>
                            </div>
                            <div class="row mt-3 d-flex justify-content-center">
                                <div class="col-4 form-floating">
                                    <input type="text" name="PositionAtWork" class="form-control" required
                                           placeholder="Должность">
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
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){dd='0'+dd}
        if(mm<10){mm='0'+mm}
        today = yyyy+'-'+mm+'-'+dd;

        $('#Date').val(today)

        document.addEventListener("DOMContentLoaded", function() { // событие загрузки страницы

            // выбираем на странице все элементы типа textarea и input
            document.querySelectorAll('textarea, input').forEach(function(e) {
                // если данные значения уже записаны в sessionStorage, то вставляем их в поля формы
                // путём этого мы как раз берём данные из памяти браузера, если страница была случайно перезагружена
                if(e.value === '') e.value = window.sessionStorage.getItem(e.name, e.value);
                // на событие ввода данных (включая вставку с помощью мыши) вешаем обработчик
                e.addEventListener('input', function() {
                    // и записываем в sessionStorage данные, в качестве имени используя атрибут name поля элемента ввода
                    window.sessionStorage.setItem(e.name, e.value);
                })
            })

        });
        $('#addOrg').submit(function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var form = {
                'INN': $('#INN').val(),
                'OrganizationName': $('input[name="OrganizationName"]').val(),
                'OrganizationAbbreviatedName': $('input[name="OrganizationAbbreviatedName"]').val(),
                'OrganizationAddress': $('input[name="OrganizationAddress"]').val(),
                'LastName': $('input[name="LastName"]').val(),
                'FirstName': $('input[name="FirstName"]').val(),
                'MiddleName': $('input[name="MiddleName"]').val(),
                'PositionAtWork': $('input[name="PositionAtWork"]').val(),
                'Phone': $('input[name="Phone"]').val(),
                'Email': $('input[name="Email"]').val(),
                'Fax': $('input[name="Fax"]').val(),
            };
            $.ajax({
                url: '{{ route('organization.create') }}',
                type: 'post',
                data: $(this).serialize(),
                success: function () {
                    console.log('Успешно');
                }
            });
            location.reload();
        })

        $("#INN").suggestions({
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
