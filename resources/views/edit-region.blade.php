@extends('layouts.app')
@section('page-title')
    Редактирование региона
@endsection
@section('content')
    <form method="POST" action="/submit-region/{{$region->id}}">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" value="{{$region->name}}" placeholder="Введите название"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="country_id">Страна/округ</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="country_id" id="country_id">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{intval($region->country_id) === $country->id ? 'selected' : ''}}>{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="code">Код</label>
                    <div class="col-sm-10">
                        <select id="code" name="code" class="form-control">
                            @foreach ($countryCodes as $code)
                                <option value="{{$code->code}}" {{$code->code === $region->code ? 'selected' : ''}}>{{$code->code}}/{{$code->name}}</option>
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
