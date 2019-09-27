@extends('layouts.app')
@section('page-title')
    Редактирование страны/округа
@endsection
@section('content')
    <form method="POST" action="/submit-country/{{$country->id}}">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" value="{{$country->name}}" placeholder="Введите название"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="color">Цвет</label>
                    <div class="col-sm-10">
                        <input type="text" id="color" name="color" value="{{$country->color}}"
                               placeholder="Цвет в формате #ffffff" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="code">Код</label>
                    <div class="col-sm-10">
                        <select id="code" name="code" class="form-control">
                            @foreach ($countryCodes as $code)
                                <option value="{{$code->code}}" {{$code->code === $country->code ? 'selected' : ''}}>{{$code->code}}/{{$code->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button type="submit" class="form-control btn btn-primary" id="search">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
