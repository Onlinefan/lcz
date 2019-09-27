@extends('layouts.app')
@section('page-title')
    Редактирование ПО ЦАФАП
@endsection
@section('content')
    <form method="POST" action="/submit-po-cafap/{{$poCafap->id}}">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Название</label>
                    <div class="col-sm-10">
                        <input type="text" id="name" name="name" value="{{$poCafap->name}}" placeholder="Введите название"
                               class="form-control">
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
