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
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-content">
                                            <form type="get">
                                                <div class="form-group row">
                                                    <label class="col-sm-2">Наименование</label>
                                                    <div class="cols-sm-2">
                                                        <input type="text" class="form-control" name="IncomePlan[name]" value="@if(isset($_GET['IncomePlan'])){{$_GET['IncomePlan']['name']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary btn-sm">Найти</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="javascript:" class="btn_style1 excel" onclick="doExcel1()"><span>Экспорт в <i class="fa fa-file-excel-o"></i> Excel</span></a>
                                            <p>&nbsp;</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th rowspan="2">Код проекта</th>
                                                        <th rowspan="2">Наименование проекта</th>
                                                        <th rowspan="2">Дата</th>
                                                        <th rowspan="2">Сумма</th>
                                                        <th rowspan="2">Наименование</th>
                                                        <th colspan="7" style="text-align:center">Фактические поступления</th>
                                                        <th rowspan="2">Остаток</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Номер счета</th>
                                                        <th>Дата счета</th>
                                                        <th>Дата оплаты</th>
                                                        <th>Скан счета</th>
                                                        <th>Закрывающий документ</th>
                                                        <th>Сумма</th>
                                                        <th>Статус</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($incomePlans as $plan)
                                                            @if ($plan->incomes->count())
                                                                @foreach ($plan->incomes as $k => $income)
                                                                    <tr>
                                                                        @if ($k === 0)
                                                                            <td rowspan="{{$plan->incomes->count() ?: 1}}">@if (isset($plan->project)){{$plan->project->code}}@endif</td>
                                                                            <td rowspan="{{$plan->incomes->count() ?: 1}}">@if (isset($plan->project)){{$plan->project->name}}@endif</td>
                                                                            <td rowspan="{{$plan->incomes->count() ?: 1}}">@if ($plan->balance() > 0 && $plan->dateDiff() <= 5)<i class="fa fa-exclamation-circle" style="color:#f8ac59; font-size: 28px;"></i>   @endif{{$plan->income_date}}</td>
                                                                            <td style="text-align:right" rowspan="{{$plan->incomes->count() ?: 1}}">{{number_format($plan->plan, 2, '.', ' ')}}</td>
                                                                            <td rowspan="{{$plan->incomes->count() ?: 1}}">{{$plan->name}}</td>
                                                                        @endif
                                                                        <td>{{$income->document_number}}</td>
                                                                        <td>{{$income->created_at}}</td>
                                                                        <td>{{$income->date_payment}}</td>
                                                                        <td>@if (isset($income->documentFile))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($income->documentFile->path, strripos($income->documentFile->path, 'Projects_files/'))}}</span><a href="/download?path={{substr($income->documentFile->path, strripos($income->documentFile->path, 'Projects_files/')) . $income->documentFile->file_name}}">{{$income->documentFile->file_name}}</a>@endif</td>
                                                                        <td>@if (isset($income->closedDocumentFile))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($income->closedDocumentFile->path, strripos($income->closedDocumentFile->path, 'Projects_files/'))}}</span><a href="/download?path={{substr($income->closedDocumentFile->path, strripos($income->closedDocumentFile->path, 'Projects_files/')) . $income->closedDocumentFile->file_name}}">{{$income->closedDocumentFile->file_name}}</a>@endif</td>
                                                                        <td style="text-align:right">{{number_format($income->count, 2, '.', ' ')}}</td>
                                                                        <td>{{$income->payment_status}}</td>
                                                                        @if ($k === 0)
                                                                                <td style="text-align:right" rowspan="{{$plan->incomes->count() ?: 1}}">{{number_format($plan->balance(), 2, '.', ' ')}}</td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td>@if (isset($plan->project)){{$plan->project->code}}@endif</td>
                                                                    <td>@if (isset($plan->project)){{$plan->project->name}}@endif</td>
                                                                    <td>{{$plan->income_date}}</td>
                                                                    <td style="text-align:right">{{number_format($plan->plan, 2, '.', ' ')}}</td>
                                                                    <td>{{$plan->name}}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right">{{number_format($plan->balance(), 2, '.', ' ')}}</td>
                                                                </tr>
                                                            @endif
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
                                    <a class="btn btn-primary btn-sm" href="/add-income">Добавить поступление</a>
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
                                            <form type="get">
                                                <div class="form-group row">
                                                    <label class="col-sm-2">Статья расходов</label>
                                                    <div class="cols-sm-2">
                                                        <input type="text" class="form-control" name="CostPlan[article]" value="@if (isset($_GET['CostPlan'])){{$_GET['CostPlan']['article']}}@endif">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-2">
                                                        <button type="submit" class="btn btn-primary btn-sm">Найти</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <a href="javascript:" class="btn_style1 excel" onclick="doExcel1()"><span>Экспорт в <i class="fa fa-file-excel-o"></i> Excel</span></a>
                                            <p>&nbsp;</p>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <th rowspan="2">Код проекта</th>
                                                        <th rowspan="2">Наименование</th>
                                                        <th rowspan="2">Руководитель проекта</th>
                                                        <th rowspan="2">Номер договора</th>
                                                        <th rowspan="2">План затрат</th>
                                                        <th rowspan="2">Статья расходов</th>
                                                        <th colspan="4" style="text-align:center">Фактические затраты</th>
                                                        <th rowspan="2">Остаток</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Дата оплаты</th>
                                                        <th>Сумма</th>
                                                        <th>Комментарий</th>
                                                        <th>Тип платежа</th>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                        @foreach ($costPlans as $plan)
                                                            @if ($plan->costs->count())
                                                                @foreach ($plan->costs as $key => $cost)
                                                                    <tr>
                                                                        @if ($key === 0)
                                                                            <td rowspan="{{$plan->costs->count() ?: 1}}">{{$plan->project->code}}</td>
                                                                            <td rowspan="{{$plan->costs->count() ?: 1}}">{{$plan->project->name}}</td>
                                                                            <td rowspan="{{$plan->costs->count() ?: 1}}">@if(isset($plan->project->head)){{$plan->project->head->second_name . ' ' . $plan->project->head->first_name . ' ' . $plan->project->head->patronymic}}@endif</td>
                                                                            <td rowspan="{{$plan->costs->count() ?: 1}}">{{$plan->project->contract->number}}</td>
                                                                            <td style="text-align:right" rowspan="{{$plan->costs->count() ?: 1}}">{{number_format($plan->plan, 2, '.', ' ')}}</td>
                                                                            <td rowspan="{{$plan->costs->count() ?: 1}}">{{$plan->article}}</td>
                                                                        @endif
                                                                        <td>{{$cost->date_payment}}</td>
                                                                        <td style="text-align:right">{{number_format($cost->count, 2, '.', ' ')}}</td>
                                                                        <td>{{$cost->comment}}</td>
                                                                        <td>{{$cost->payment_method}}</td>
                                                                        @if ($key === 0)
                                                                            <td style="text-align:right @if ($plan->balance() < 0) color:red;@endif" rowspan="{{$plan->costs->count() ?: 1}}">{{number_format($plan->balance(), 2, '.', ' ')}}</td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            @else
                                                                <tr>
                                                                    <td>{{$plan->project->code}}</td>
                                                                    <td>{{$plan->project->name}}</td>
                                                                    <td>{{$plan->project->head->second_name . ' ' . $plan->project->head->first_name . ' ' . $plan->project->head->patronymic}}</td>
                                                                    <td>{{$plan->project->contract->number}}</td>
                                                                    <td style="text-align:right">{{number_format($plan->plan, 2, '.', ' ')}}</td>
                                                                    <td>{{$plan->article}}</td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td></td>
                                                                    <td style="text-align:right; @if ($plan->balance() < 0) color:red;@endif">{{number_format($plan->balance(), 2, '.', ' ')}}</td>
                                                                </tr>
                                                            @endif
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
                                    <a class="btn btn-primary btn-sm" href="/add-cost">Добавить затраты</a>
                                    <a class="btn btn-primary btn-sm" href="/add-cost-file">Загрузить файл затрат</a>
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
                                            <a href="javascript:" class="btn_style1 excel" onclick="doExcel1()"><span>Экспорт в <i class="fa fa-file-excel-o"></i> Excel</span></a>
                                            <p>&nbsp;</p>
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
            </div>
        </div>
    </div>
@endsection
