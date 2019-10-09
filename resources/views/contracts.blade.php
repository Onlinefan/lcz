@extends('layouts.app')
@section('page-title')
    Реестр договоров
@endsection
@section('content')

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
                                    <th colspan="7" style="text-align: center;">Реестр доходных договоров</th>
                                    <th colspan="9" style="text-align: center;">Договор</th>
                                    <th colspan="5" style="text-align: center;">Статус выставленных документов</th>
                                    <th colspan="5" style="text-align: center;">Финансовый статус</th>
                                </tr>
                                <tr>
                                    <th>№</th>
                                    <th>Код проекта</th>
                                    <th>Федеральный округ</th>
                                    <th>Менеджер проекта</th>
                                    <th>Регион</th>
                                    <th>Проект</th>
                                    <th>Контрагент</th>

                                    <th>Тип договора</th>
                                    <th>Статья договора</th>
                                    <th>№ договора</th>
                                    <th>Дата договора</th>
                                    <th>Дата окончания договора</th>
                                    <th>Статус подписания</th>
                                    <th>Статус оригинала</th>
                                    <th>Наличие оригинала</th>
                                    <th>Обслуживание</th>

                                    <th>Номер счета</th>
                                    <th>Дата счета</th>
                                    <th>Сумма</th>
                                    <th>Скан счета</th>
                                    <th>Закрывающий документ</th>

                                    <th>Сумма по договору</th>
                                    <th>Объём выполненных обязательств ВСЕГО, руб.</th>
                                    <th>Объём оплаченных  работ ВСЕГО, руб.</th>
                                    <th>Сумма будущих поступлений по договору, руб.</th>
                                    <th>Затраты по проекту</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($projects as $project)
                                    @if ($project->incomes()->count())
                                        @foreach ($project->incomes() as $key => $income)
                                            <tr>
                                                @if ($key === 0)
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->id}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->code}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">@foreach ($project->countries as $key => $country) @if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span>@endif<span class="label label-secondary">{{$country->country->name}}; </span><br>@endforeach</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">@if (isset($project->head)){{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}@endif</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">@foreach ($project->regions as $key => $region)@if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span>@endif{{$region->region->name}}; <br>@endforeach</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->name}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->customer}}</td>

                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}"><span class="label label-secondary">{{$project->type}}</span></td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->article}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->number}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->date_start}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->date_end}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->sign_status}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}"><span class="label label-secondary">{{$project->contract->original_status}}</span></td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->original_status === 'Отсутствует' ? 'Отсутствует' : 'Есть'}}</td>
                                                    <td rowspan="{{$project->incomes()->count() ?: 1}}">{{$project->contract->service_terms}}</td>
                                                @endif

                                                <td>{{$income->document_number}}</td>
                                                <td>{{$income->created_at}}</td>
                                                <td style="text-align:right">{{number_format($income->count, 2, '.', ' ')}}</td>
                                                <td>@if (isset($income->documentFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($income->documentFile->path, strripos($income->documentFile->path, 'Projects_files/')) . $income->documentFile->file_name}}">{{$income->documentFile->file_name}}</a>@endif</td>
                                                <td>@if (isset($income->closedDocumentFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($income->closedDocumentFile->path, strripos($income->closedDocumentFile->path, 'Projects_files/')) . $income->closedDocumentFile->file_name}}">{{$income->closedDocumentFile->file_name}}</a>@endif</td>

                                                @if ($key === 0)
                                                    <td style="text-align:right" rowspan="{{$project->incomes()->count() ?: 1}}">{{number_format($project->contract->amount, 2, '.', ' ')}}</td>
                                                    <td style="text-align:right" rowspan="{{$project->incomes()->count() ?: 1}}">{{number_format($project->fulfilledObligations(), 2, '.', ' ')}}</td>
                                                    <td style="text-align:right" rowspan="{{$project->incomes()->count() ?: 1}}">{{number_format($project->paidWork(), 2, '.', ' ')}}</td>
                                                    <td style="text-align:right" rowspan="{{$project->incomes()->count() ?: 1}}">{{number_format($project->futurePay(), 2, '.', ' ')}}</td>
                                                    <td style="text-align:right" rowspan="{{$project->incomes()->count() ?: 1}}">{{number_format($project->costs(), 2, '.', ' ')}}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td>{{$project->id}}</td>
                                            <td>{{$project->code}}</td>
                                            <td>@foreach ($project->countries as $key => $country) @if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span>@endif<span class="label label-secondary">{{$country->country->name}}; </span><br>@endforeach</td>
                                            <td>{{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}</td>
                                            <td>@foreach ($project->regions as $key => $region)@if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span>@endif{{$region->region->name}}; <br>@endforeach</td>
                                            <td>{{$project->name}}</td>
                                            <td>{{$project->contract->customer}}</td>

                                            <td><span class="label label-secondary">{{$project->type}}</span></td>
                                            <td>{{$project->contract->article}}</td>
                                            <td>{{$project->contract->number}}</td>
                                            <td>{{$project->contract->date_start}}</td>
                                            <td>{{$project->contract->date_end}}</td>
                                            <td>{{$project->contract->sign_status}}</td>
                                            <td><span class="label label-secondary">{{$project->contract->original_status}}</span></td>
                                            <td>{{$project->contract->original_status === 'Отсутствует' ? 'Отсутствует' : 'Есть'}}</td>
                                            <td>{{$project->contract->service_terms}}</td>

                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>

                                            <td style="text-align:right">{{number_format($project->contract->amount, 2, '.', ' ')}}</td>
                                            <td style="text-align:right">{{number_format($project->fulfilledObligations(), 2, '.', ' ')}}</td>
                                            <td style="text-align:right">{{number_format($project->paidWork(), 2, '.', ' ')}}</td>
                                            <td style="text-align:right">{{number_format($project->futurePay(), 2, '.', ' ')}}</td>
                                            <td style="text-align:right">{{number_format($project->costs(), 2, '.', ' ')}}</td>
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
    </div>
@endsection
