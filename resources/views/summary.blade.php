@extends('layouts.app')
@section('page-title')
    Сводная таблица по проектам
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
                                    <th>Округ/Страна</th>
                                    <th>Количество</th>
                                    <th>Активных</th>
                                    <th>Завершенных</th>
                                    <th>Приостановленных</th>
                                    <th>Прочее</th>
                                    <th>Эксплуатация</th>
                                    <th>Количество адресов</th>
                                    <th>Лин. (тип 1)</th>
                                    <th>Пер. (тип 2)</th>
                                    <th>Пеш. (тип 3)</th>
                                    <th>Коперник (передвижка)</th>
                                    <th>Коперник (стационар)</th>
                                    <th>ВГК</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($tableData as $row)
                                    <tr>
                                        @foreach ($row as $column)
                                            <td>{{$column ?: 0}}</td>
                                        @endforeach
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
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'ProjectsSummary'},
                        //{extend: 'pdf', title: 'ProjectsSummary'},

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
