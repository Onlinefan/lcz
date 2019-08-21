@extends('layouts.app')
@section('page-title')
    ДДС по контракту
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Поступления</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Загрузить план затрат</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Загрузить иные договоры</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-4">Добавить платежный документ</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Зафиксировать затраты</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">

                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">

                    </div>
                </div>
                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">

                    </div>
                </div>
                <div role="tabpanel" id="tab-4" class="tab-pane">
                    <div class="panel-body">

                    </div>
                </div>
                <div role="tabpanel" id="tab-5" class="tab-pane">
                    <div class="panel-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
