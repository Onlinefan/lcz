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
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th colspan="11" style="text-align: center;">Информация по контракту</th>
                                    <th colspan="7" style="text-align: center;">РК по контракту</th>
                                    <th colspan="2" style="text-align: center;"></th>
                                    <th colspan="7" style="text-align: center;">Зона ответственности по контракту</th>
                                    <th colspan="8" style="text-align: center;">Информация по проекту</th>
                                    <th colspan="5" style="text-align: center;">ПИР</th>
                                    <th colspan="6" style="text-align: center;">ЦАФАП</th>
                                    <th colspan="1" style="text-align: center;">Поверки</th>
                                    <th colspan="6" style="text-align: center;">СМР</th>
                                    <th colspan="4" style="text-align: center;">ПНР</th>
                                    <th colspan="5" style="text-align: center;"></th>
                                </tr>
                                <tr>
                                    <th>Код проекта</th>
                                    <th>План-график</th>
                                    <th>Ответственный</th>
                                    <th>Заказчик</th>
                                    <th>Проект</th>
                                    <th>Округ/страна</th>
                                    <th>Регион</th>
                                    <th>Тип услуги</th>
                                    <th>Обслуживание</th>
                                    <th>Роль ЛЦЗ</th>
                                    <th>Кол-во адресов</th>
                                    <th>Линейный</th>
                                    <th>Перекресток</th>
                                    <th>Пешеход</th>
                                    <th>ЖД переезд</th>
                                    <th>Коперник-П</th>
                                    <th>Коперник-С</th>
                                    <th>Архимед</th>
                                    <th>Сумма договора</th>
                                    <th>Статус проекта</th>
                                    <th>Обследование</th>
                                    <th>СМР</th>
                                    <th>Монтаж</th>
                                    <th>ПНР</th>
                                    <th>Разрешение на опору</th>
                                    <th>Получение ТУ на 220</th>
                                    <th>Получение ТУ связь</th>
                                    <th>Дата подписания контракта</th>
                                    <th>Дата завершения контракта</th>
                                    <th>СМР начать (не позднее)</th>
                                    <th>СМР завершить (не позднее)</th>
                                    <th>Монтаж начать (не позднее)</th>
                                    <th>Монтаж завершить (не позднее)</th>
                                    <th>ПНР начать (не позднее)</th>
                                    <th>ПНР завершить (не позднее)</th>
                                    <th>Обследовано</th>
                                    <th>Разработано проектов</th>
                                    <th>Запрос ТУ на 220</th>
                                    <th>Запрос на опоры</th>
                                    <th>Поставка</th>
                                    <th>Схема передачи данных</th>
                                    <th>Коллаж</th>
                                    <th>Дислокации и направления</th>
                                    <th>Скоростной режим</th>
                                    <th>ПО в ЦАФАП</th>
                                    <th>Наличие Андромеды у Заказчика</th>
                                    <th>Поверки</th>
                                    <th>ТУ на размещение</th>
                                    <th>ТУ на 220</th>
                                    <th>Смонтировано</th>
                                    <th>Наличие 220</th>
                                    <th>Опоры</th>
                                    <th>Передано в ПНР</th>
                                    <th>КП</th>
                                    <th>Анализ проездов</th>
                                    <th>Передано в мониторинг</th>
                                    <th>Выгрузка в ЦАФАП</th>
                                    <th>Приказ на РП</th>
                                    <th>ЛОП</th>
                                    <th>Контракт</th>
                                    <th>Тех. задание</th>
                                    <th>Устав проекта</th>
                                </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td></td>
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
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.10.19/i18n/Russian.json'
                    },
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
