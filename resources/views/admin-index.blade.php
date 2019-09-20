@extends('layouts.app')
@section('page-title')
    Администрирование
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="panel-body">
                <div class="form-group row">
                    <a href="/countries"><label class="col-sm-2 col-form-label" for="system_id">Страны/округа</label></a>
                </div>
                <div class="form-group row">
                    <a href="/regions"><label class="col-sm-2 col-form-label" for="system_id">Регионы</label></a>
                </div>
            </div>
        </div>
    </div>
@endsection
