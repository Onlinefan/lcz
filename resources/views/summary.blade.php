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
                                <tr>
                                    <td>ЦФО</td>
                                    <td>25</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>15</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td>СЗФО</td>
                                    <td>55</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>7</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <td>ЮФО</td>
                                    <td>5</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td>ПФО</td>
                                    <td>43</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>2</td>
                                    <td>6</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                </tr>
                                <tr>
                                    <td>Казахстан</td>
                                    <td>14</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>8</td>
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                </tr>
                                <tr>
                                    <td>Индия</td>
                                    <td>23</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>1</td>
                                    <td>11</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>1</td>
                                </tr>
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
