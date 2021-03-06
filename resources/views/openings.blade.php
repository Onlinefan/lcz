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
                                        <td>@if (isset($project->head)){{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}@endif</td>
                                        <td>{{$project->name}}</td>
                                        <td>@foreach ($project->regions as $key => $region) @if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span> @endif @if (isset($region->region)){{$region->region->name}}; <br>@endif @endforeach</td>
                                        <td>@foreach ($project->serviceType as $key => $serviceType) @if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span> @endif @if (isset($serviceType->serviceType)){{$serviceType->serviceType->name}}; <br>@endif @endforeach</td>
                                        <td>{{$project->contract->lcz_role}}</td>
                                        <td>@foreach ($project->products as $key => $product) @if ($key !== 0)<span style="display:block;margin: 10px -9px 5px;border-bottom: 1px solid #e7e7e7;"></span> @endif @if (isset($product->product)){{$product->product->name}}; <br>@endif @endforeach</td>
                                        <td>{{number_format($project->contract->amount, 2, '.', ' ')}}</td>
                                        <td>{{$project->status}}</td>
                                        <td>@if (isset($project->contract->lopFile))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/'))}}</span><a style="word-break: break-all;" href="/download?path={{substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/')) . $project->contract->lopFile->file_name}}">{{$project->contract->lopFile->file_name}}</a>@endif</td>
                                        <td>@if (isset($project->contract->lppListFile))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($project->contract->lppListFile->path, strripos($project->contract->lppListFile->path, 'Projects_files/'))}}</span><a style="word-break: break-all;" href="/download?path={{substr($project->contract->lppListFile->path, strripos($project->contract->lppListFile->path, 'Projects_files/')) . $project->contract->lppListFile->file_name}}">{{$project->contract->lppListFile->file_name}}</a>@endif</td>
                                        <td><a style="word-break: break-all;" href="{{$project->contract->purchase_reference}}" target="_blank">{{$project->contract->purchase_reference}}</a></td>
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
