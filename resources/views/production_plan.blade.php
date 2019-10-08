@extends('layouts.app')
@section('page-title')
    План производства
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
                                    <th>Проект</th>
                                    <th>Месяц</th>
                                    <th>Регион</th>
                                    <th>Оборудование</th>
                                    <th>Количество РК</th>
                                    <th>Дата отгрузки</th>
                                    <th>Приоритет</th>
                                    <th>Предварительный расчет оборудования</th>
                                    <th>Окончательный расчет оборудования</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($productionPlan as $plan)
                                    <tr>
                                        <td>{{$plan->project->name}}</td>
                                        <td>{{$plan->month}}</td>
                                        <td>{{$plan->region->name}}</td>
                                        <td>{{$plan->product->name}}</td>
                                        <td>{{$plan->rk_count}}</td>
                                        <td>{{$plan->date_shipping}}</td>
                                        <td>{{$plan->priority}}</td>
                                        <td>@if (isset($plan->preliminaryCalculation))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($plan->preliminaryCalculation->path, strripos($plan->preliminaryCalculation->path, 'Projects_files/'))}}</span><a href="/download?path={{substr($plan->preliminaryCalculation->path, strripos($plan->preliminaryCalculation->path, 'Projects_files/')) . $plan->preliminaryCalculation->file_name}}">{{$plan->preliminaryCalculation->file_name}}</a>@endif</td>
                                        <td>@if (isset($plan->finalCalculation))<span class="hidden-url">http://{{$_SERVER['SERVER_NAME'] . '/download?path=' . substr($plan->finalCalculation->path, strripos($plan->finalCalculation->path, 'Projects_files/'))}}</span><a href="/download?path={{substr($plan->finalCalculation->path, strripos($plan->finalCalculation->path, 'Projects_files/')) . $plan->finalCalculation->file_name}}">{{$plan->finalCalculation->file_name}}</a>@endif</td>
                                        <td>@if ((int)$plan->project->head_id === (int)auth()->user()->id || auth()->user()->role !== 'Оператор')<a href="/edit-production-plan/{{$plan->id}}"><i class="fa fa-edit" style="color:blue; font-size:20px;"></i></a>@endif</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 col-sm-offset-2">
                                <a class="btn btn-primary btn-sm" href="/add_production_plan">Добавить</a>
                            </div>
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
                        {extend: 'excel', title: 'Contacts'},
                        //{extend: 'pdf', title: 'Contacts'},

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
