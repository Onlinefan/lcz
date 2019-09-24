@extends('layouts.app')
@section('page-title')
    Реестр ЛОП
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
                                    <th>Руководитель проекта</th>
                                    <th>Проект</th>
                                    <th>Регион</th>
                                    <th>Тип услуги</th>
                                    <th>Роль ЛЦЗ</th>
                                    <th>Тип оборудования</th>
                                    <th>Сумма договора</th>
                                    <th>Статус проекта</th>
                                    <th>Бюджет проекта</th>
                                    <th>ЛПП</th>
                                    <th>Ссылки на конкурс</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}</td>
                                        <td>{{$project->name}}</td>
                                        <td>
                                            @foreach ($project->regions as $region)
                                                {{$region->region->name}}<br>
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach ($project->serviceType as $serviceType)
                                                {{$serviceType->serviceType->name}}<br>
                                            @endforeach
                                        </td>
                                        <td>{{$project->contract->lcz_role}}</td>
                                        <td>
                                            @foreach ($project->products as $product)
                                                @if (intval($product->count) !== 0)
                                                    {{$product->product->name}}<br>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{$project->contract->amount}}</td>
                                        <td>{{$project->status}}</td>
                                        <td><a href="/download?path={{substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/')) . $project->contract->lopFile->file_name}}">{{$project->contract->lopFile->file_name}}</a></td>
                                        <td><a href="/download?path={{substr($project->contract->lppFile->path, strripos($project->contract->lppFile->path, 'Projects_files/')) . $project->contract->lppFile->file_name}}">{{$project->contract->lppFile->file_name}}</a></td>
                                        <td><a href="{{$project->contract->purchase_reference}}" target="_blank">Ссылка на закупку</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){
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
                        {extend: 'excel', title: 'Openings'},
                        //{extend: 'pdf', title: 'Openings'},

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
