@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Информация о роли</h1>

        <div class="row mt-2">
            <p class="col-4">Название</p>
            <p class="col-8">{{ $role->name }}</p>
        </div>

        <div class="row mt-2">
            <p class="col-4">Права доступа:</p>
            <div class="col-8">
                @if(!empty($rolePermissions))
                    @foreach($rolePermissions as $v)
                        <label class="label label-success">{{ $v->name }},</label>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
