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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th colspan="7" style="text-align: center;">Реестр доходных договоров</th>
                                    <th colspan="9" style="text-align: center;">Договор</th>
                                    <th colspan="5" style="text-align: center;">Статус выставленных документов</th>
                                    <th colspan="5" style="text-align: center;">Статус обслуживания</th>
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

                                    <th>Платежный документ</th>
                                    <th>№ платежного документа</th>
                                    <th>Дата платежного документа</th>
                                    <th>Сумма платежного документа</th>
                                    <th>Скан платежного документа</th>

                                    <th>Платежный документ</th>
                                    <th>№ платежного документа</th>
                                    <th>Дата платежного документа</th>
                                    <th>Сумма платежного документа</th>
                                    <th>Скан платежного документа</th>

                                    <th>Сумма по договору</th>
                                    <th>Объём выполненных обязательств ВСЕГО, руб.</th>
                                    <th>Объём оплаченных  работ ВСЕГО, руб.</th>
                                    <th>Сумма будущих поступлений по договору, руб.</th>
                                    <th>Затраты по проекту</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{$project->id}}</td>
                                        <td>{{$project->code}}</td>
                                        <td>
                                            @foreach ($project->countries as $country)
                                                <span class="label label-secondary">{{$country->country->name}}</span>
                                            @endforeach
                                        </td>
                                        <td>{{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}</td>
                                        <td>
                                            @foreach ($project->regions as $region)
                                                {{$region->region->name}}<br>
                                            @endforeach
                                        </td>
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

                                        @if ($project->contract->documentStatus)
                                            <td>{{$project->contract->documentStatus->payment_document}}</td>
                                            <td>{{$project->contract->documentStatus->number_payment_document}}</td>
                                            <td>{{$project->contract->documentStatus->date_payment_document}}</td>
                                            <td>{{$project->contract->documentStatus->count_payment_document}}</td>
                                            <td><span class="hidden-url">http://vk.com/ </span><a href="/download?path={{substr($project->contract->documentStatus->scan->path, strripos($project->contract->documentStatus->scan->path, 'Projects_files/')) . $project->contract->documentStatus->scan->file_name}}">{{$project->contract->documentStatus->scan->file_name}}</a></td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif

                                        @if ($project->contract->serviceStatus)
                                            <td>{{$project->contract->serviceStatus->payment_document}}</td>
                                            <td>{{$project->contract->serviceStatus->number_payment_document}}</td>
                                            <td>{{$project->contract->serviceStatus->date_payment_document}}</td>
                                            <td>{{$project->contract->serviceStatus->count_payment_document}}</td>
                                            <td><a href="/download?path={{substr($project->contract->serviceStatus->scan->path, strripos($project->contract->serviceStatus->scan->path, 'Projects_files/')) . $project->contract->serviceStatus->scan->file_name}}">{{$project->contract->serviceStatus->scan->file_name}}</a></td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif

                                        @if ($project->contract->financialStatus)
                                            <td>{{$project->contract->financialStatus->contract_amount}}</td>
                                            <td>{{$project->contract->financialStatus->fulfilled_obligations}}</td>
                                            <td>{{$project->contract->financialStatus->amount_of_paid_work}}</td>
                                            <td>{{$project->contract->financialStatus->amount_revenue_contract}}</td>
                                            <td>{{$project->contract->financialStatus->project_costs}}</td>
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
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
            <div class="col-sm-7 col-sm-offset-2">
                <a class="btn btn-primary btn-sm" href="/add-document-status">Добавить статус документов</a>
                <a class="btn btn-danger btn-sm" href="/add-service-status">Добавить статус обслуживания</a>
                <a class="btn btn-white btn-sm" href="/add-financial-status">Добавить финансовый статус</a>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function() {
                $('.dataTables-example').DataTable({
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json'
                    },
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Contracts'},
                        //{extend: 'pdf', title: 'Contracts'},

                        {extend: 'print',
                            customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]
                });
            });
        });
    </script>

@endsection
