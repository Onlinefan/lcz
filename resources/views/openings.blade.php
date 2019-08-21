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
                                <tr>
                                    <td>Никифоров Иван</td>
                                    <td>Текст 1</td>
                                    <td>Центральный</td>
                                    <td>Обслуживание</td>
                                    <td>Положительная</td>
                                    <td>Автоматическое</td>
                                    <td>7657.00</td>
                                    <td>Проектирование</td>
                                    <td><a href="#">Ссылка 1</a></td>
                                    <td><a href="#">Ссылка 2</a></td>
                                    <td><a href="#">Ссылка 3</a></td>
                                </tr>
                                <tr>
                                    <td>Абрамов Михаил</td>
                                    <td>Текст 2</td>
                                    <td>Северо-Западный</td>
                                    <td>Обслуживание</td>
                                    <td>Положительная</td>
                                    <td>Автоматическое</td>
                                    <td>34243.00</td>
                                    <td>Проектирование</td>
                                    <td><a href="#">Ссылка 4</a></td>
                                    <td><a href="#">Ссылка 5</a></td>
                                    <td><a href="#">Ссылка 6</a></td>
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
