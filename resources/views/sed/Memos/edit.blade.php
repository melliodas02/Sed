@extends('layouts.app')

@section('title', 'Редактирование служебных записок')

@section('content')
    <div class="container">
        <h1>Редактирование документа</h1>
        <form action="/memos/{{ $data->id }}/put" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-7 form-floating">
                    <input type="text" name="title" class="form-control" required placeholder="Название" value="{{ $data->title }}">
                    <label for="">Название</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <textarea name="description" style="min-height: 250px;" class="form-control">{{ $data->Description }}</textarea>
                    <label for="">Описание</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <input type="date" class="form-control" name="Date" required placeholder="" value="{{ $data->Date }}">
                    <label for="">Выберите дату</label>
                </div>
            </div>
            <input type="text" name="Category" style="display: none;" value="1">
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Signatory" class="form-select" id="">
                        @foreach($organizations as $org)
                            <option value="{{ $org->id }}"  @if($org->id == $data->Signatory) selected @endif>{{ $org->OrganizationAbbreviatedName }} - {{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }} - {{ $org->PositionAtWork }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите организацию</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <div class="col-7 form-floating">
                    <select name="Sender" class="form-select" id="">
                        @foreach($users as $org)
                            <option value="{{ $org->id }}" @if($org->id == $data->Sender) selected @endif>{{ $org->LastName }} {{ $org->FirstName }} {{ $org->MiddleName }} - {{ $org->Position }}</option>
                        @endforeach
                    </select>
                    <label for="">Выберите ответсвтенного</label>
                </div>
            </div>
            <div class="row d-flex justify-content-center mt-2">
                <input type="submit" class="btn btn-success col-auto" name="save" value="Сохранить">
            </div>
        </form>
    </div>
@endsection
