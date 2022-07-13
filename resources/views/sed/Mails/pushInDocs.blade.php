@extends('layouts.app')

@section('title', 'Перенаправление почты')

@section('content')
    <div class="container">
        <h1>Перенаправление почты</h1>
        <form action="{{ route('mails.save_documents') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-7 form-floating">
                    <input type="text" name="title" class="form-control" required placeholder="Название" value="{{ $mail->Subject }}">
                    <label for="">Название</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <textarea name="description" style="min-height: 250px;" class="form-control">{{ $mail->Body }}</textarea>
                    <label for="">Описание</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <input type="date" class="form-control" name="Date" required placeholder="" value="">
                    <label for="">Выберите дату</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="DocType" id="docType" onchange="changeType()" class="form-select">
                        @foreach($docTypes as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите тип документа</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Category" id="category" class="form-select">
                        @foreach($docCategories as $cat)
                            <option value="{{ $cat->id }}" types="{{ $cat->docType }}">{{ $cat->title }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите тип документа</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Signatory" class="form-select" id="">
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}"> {{ $org->OrganizationAbbreviatedName }} - {{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }} - {{ $org->PositionAtWork }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите организацию</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Sender" class="form-select" id="">
                        @foreach($users as $org)
                            <option value="{{ $org->id }}">{{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }} - {{ $org->Position }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите ответсвтенного</label>
                </div>
            </div>
            @foreach($mail_docs as $docs)
                <input type="text" name="docs[]" style="display: none" value="{{ $docs->MailDoc }}">
            @endforeach
            <div class="row d-flex justify-content-center mt-2">
                <input type="submit" class="btn btn-success col-auto" name="save" value="Сохранить">
            </div>
        </form>
    </div>

    <script>
        function changeType() {
            const el = document.querySelector('select[id="category"]');
            const fac = document.querySelector('select[id="docType"]');
            el.querySelectorAll('option').forEach(opt => {
                var op = opt.getAttribute('types');
                if (op != fac.value) opt.style.display = "none";
                else opt.style.display = "block";
            })
        }
    </script>
@endsection
