@extends('layouts.app')
@section('page-title')
    ДДС по контракту
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">План поступлений</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">План затрат</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Иные договоры</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-4">Фактические поступления</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Фактические затраты</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Дата</th>
                                                        <th>Наименование</th>
                                                        <th>Этап</th>
                                                        <th>План (сумма)</th>
                                                        <th>Выставлено (сумма)</th>
                                                        <th>Оплачено (сумма)</th>
                                                        <th>Остаток (сумма)</th>
                                                        <th>Проект</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($incomePlans as $plan)
                                                            <tr>
                                                                <td>{{$plan->income_date}}</td>
                                                                <td>{{$plan->name}}</td>
                                                                <td>{{$plan->stage}}</td>
                                                                <td>{{$plan->plan}}</td>
                                                                <td>{{$plan->count}}</td>
                                                                <td>{{$plan->payed}}</td>
                                                                <td>{{intval($plan->count) - intval($plan->payed)}}</td>
                                                                <td>{{$plan->project->name}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" href="/add-income-plan">Добавить план поступлений</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>План (сумма)</th>
                                                        <th>Статья</th>
                                                        <th>Дата</th>
                                                        <th>Сумма затрат</th>
                                                        <th>Комментарий</th>
                                                        <th>Способ оплаты</th>
                                                        <th>Остаток (сумма)</th>
                                                        <th>Проект</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($costPlans as $plan)
                                                        <tr>
                                                            <td>{{$plan->plan}}</td>
                                                            <td>{{$plan->article}}</td>
                                                            <td>{{$plan->date_cost}}</td>
                                                            <td>{{$plan->count}}</td>
                                                            <td>{{$plan->comment}}</td>
                                                            <td>{{$plan->payment_method}}</td>
                                                            <td>{{intval($plan->plan) - intval($plan->count)}}</td>
                                                            <td>{{$plan->project->name}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" href="/add-cost-plan">Добавить план затрат</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Дата</th>
                                                        <th>Тип договора</th>
                                                        <th>Номер договора</th>
                                                        <th>Основание</th>
                                                        <th>Контрагент</th>
                                                        <th>Договор</th>
                                                        <th>Проект</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($otherDocuments as $document)
                                                        <tr>
                                                            <td>{{$document->date_contract}}</td>
                                                            <td>{{$document->type}}</td>
                                                            <td>{{$document->number}}</td>
                                                            <td>{{$document->base}}</td>
                                                            <td>{{$document->contractor}}</td>
                                                            <td><a href="/download?path={{substr($document->contractFile->path, strripos($document->contractFile->path, 'Projects_files/')) . $document->contractFile->file_name}}">{{$document->contractFile->file_name}}</a></td>
                                                            <td>{{$document->project->name}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" href="/add-other-document">Добавить документ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Платежный документ</th>
                                                        <th>Сумма платежного документа</th>
                                                        <th>№ договора</th>
                                                        <th>№ платежного документа</th>
                                                        <th>Этап, основание платежа</th>
                                                        <th>Дата платежного документа</th>
                                                        <th>Скан</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($incomes as $income)
                                                        <tr>
                                                            <td>{{$income->payment_document}}</td>
                                                            <td>{{$income->count}}</td>
                                                            <td>{{$income->number}}</td>
                                                            <td>{{$income->number_payment}}</td>
                                                            <td>{{$income->plan->name}}/{{$income->plan->stage}}</td>
                                                            <td>{{$income->date_payment}}</td>
                                                            <td><a href="/download?path={{substr($income->documentFile->path, strripos($income->documentFile->path, 'Projects_files/')) . $income->documentFile->file_name}}">{{$income->documentFile->file_name}}</a></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" href="/add-income">Добавить поступление</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-5" class="tab-pane">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th>Платежный документ</th>
                                                        <th>Сумма платежного документа</th>
                                                        <th>№ договора</th>
                                                        <th>№ платежного документа</th>
                                                        <th>Этап, основание платежа</th>
                                                        <th>Дата платежного документа</th>
                                                        <th>Скан</th>
                                                        <th>Способ оплаты</th>
                                                        <th>Комментарий</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach ($costs as $cost)
                                                        <tr>
                                                            <td>{{$cost->payment_document}}</td>
                                                            <td>{{$cost->count}}</td>
                                                            <td>{{$cost->number}}</td>
                                                            <td>{{$cost->number_payment}}</td>
                                                            <td>{{$cost->plan->project->name}}/{{$cost->plan->article}}</td>
                                                            <td>{{$cost->date_payment}}</td>
                                                            <td><a href="/download?path={{substr($cost->documentFile->path, strripos($cost->documentFile->path, 'Projects_files/')) . $cost->documentFile->file_name}}">{{$cost->documentFile->file_name}}</a></td>
                                                            <td>{{$cost->payment_method}}</td>
                                                            <td>{{$cost->comment}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" href="/add-cost">Добавить затраты</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
