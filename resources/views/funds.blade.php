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
    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
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
