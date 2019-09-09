@extends('layouts.app')
@section('page-title')
    Статус реализации проекта
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <h4>
                            <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="64px" />
                            {{auth()->user()->second_name . ' ' . auth()->user()->first_name . ' ' . auth()->user()->patronymic}}
                        </h4>
                        <h4>Код проекта: {{$project->code}}</h4>
                        <h1>{{$project->name}}</h1>
                        <h4>Статус проекта: {{$project->status}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Сумма контракта</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$project->contract->amount}}</h1>
                        <div class="progress progress-mini">
                            <div style="width: 83%;" class="progress-bar"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">83%</div>
                        <small>Поступления</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Выставлено счетов</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">120 654 000</h1>
                        <div class="progress progress-mini">
                            <div style="width: 56%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">56%</div>
                        <small>Затраты</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Дедлайн</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{$dateDiff}} дней</h1>
                        <div class="progress progress-mini">
                            <div style="width: {{round($datePercent)}}%;" class="progress-bar progress-bar-warning"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">{{round($datePercent)}}%</div>
                        <small>{{$project->contract->date_start}} - {{$project->contract->date_end}}</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Проектов в реализации</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">3</h1>
                        <div class="progress progress-mini">
                            <div style="width: 66%;" class="progress-bar progress-bar-info"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">2</div>
                        <small>Завершено</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @foreach ($projectRegions as $region)
                            <button class="btn btn-outline btn-default">{{$region->region->name}}</button>
                        @endForeach

                        <p>Здесь должен быть прогресс-лайн "Статус реализации".</p>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th colspan="7" style="text-align: center;"></th>
                                    <th colspan="6" style="text-align: center;">Исходные данные</th>
                                    <th colspan="10" style="text-align: center;">ПИР</th>
                                    <th colspan="6" style="text-align: center;">Производство</th>
                                    <th colspan="6" style="text-align: center;">СМР/Монтаж</th>
                                    <th colspan="7" style="text-align: center;">ПНР</th>
                                    <th colspan="14" style="text-align: center;">Документы</th>
                                </tr>
                                <tr>
                                    <th>№</th>
                                    <th>ID системы</th>
                                    <th>ID комплекса</th>
                                    <th>Город</th>
                                    <th>Принадлежность дороги</th>
                                    <th>Адрес по контракту</th>
                                    <th>Адрес по ГИБДД</th>

                                    <th>Тип оборудования</th>
                                    <th>Тип контролируемого участка дороги</th>
                                    <th>Скоростной режим, км/ч</th>
                                    <th>Кол-во рубежей</th>
                                    <th>КоАП</th>
                                    <th>Кол-во стоп-линий полос</th>

                                    <th>Статус обследования</th>
                                    <th>Комментарий к обследованию</th>
                                    <th>Проектная документация</th>
                                    <th>Новая опора под ФВФ</th>
                                    <th>Новая опора под ЛЭП</th>
                                    <th>Количество РК</th>
                                    <th>Количество ОК</th>
                                    <th>Суммарная мощность оборудования</th>
                                    <th>Запрос ТУ на 220</th>
                                    <th>Запрос на опоры</th>

                                    <th>Статус отгрузки</th>
                                    <th>Дата отгрузки оборудования</th>
                                    <th>№ сим Internet (БУ)</th>
                                    <th>№ сим SSU</th>
                                    <th>№ поверки</th>
                                    <th>Дата окончания поверки</th>

                                    <th>Ссылка на корневую задачу</th>
                                    <th>Наличие 220 на ВУ</th>
                                    <th>Канал связи (договор)</th>
                                    <th>Обвязка дислокации</th>
                                    <th>Статус монтажа</th>
                                    <th>Передано в ПНР</th>

                                    <th>Колибровка 2000 проездов</th>
                                    <th>КП</th>
                                    <th>Результаты анализа</th>
                                    <th>Передача комплекса в мониторинг</th>
                                    <th>Выгрузка в Андромеду</th>
                                    <th>Выгрузка</th>
                                    <th>в ЦАФАП</th>

                                    <th>Обследование</th>
                                    <th>Проектная документация</th>
                                    <th>Исполнительная документация</th>
                                    <th>Поверка</th>
                                    <th>Формуляры</th>
                                    <th>Паспорта</th>
                                    <th>ТУ - 220</th>
                                    <th>Договор 220</th>
                                    <th>ТУ на опору</th>
                                    <th>Договор на опоры</th>
                                    <th>Адресный план согласованный с ЦАФАП</th>
                                    <th>Схема передачи данных</th>
                                    <th>Входящие</th>
                                    <th>Исходящие</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1234</td>
                                    <td>1234</td>
                                    <td>Москва</td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td>Адрес 1</td>
                                    <td>Адрес 2</td>

                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td>120</td>
                                    <td>12</td>
                                    <td>1234</td>
                                    <td>3</td>

                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td></td>
                                    <td></td>
                                    <td>7</td>
                                    <td>4</td>
                                    <td>12000</td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>

                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td>01.01.2019</td>
                                    <td>1234</td>
                                    <td>1234</td>
                                    <td>1234</td>
                                    <td>01.01.2019</td>

                                    <td><a href="#">Ссылка</a></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>

                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-secondary">Эл-т списка</span></td>
                                    <td><span class="label label-primary">Да</span></td>
                                    <td><span class="label label-danger">Нет</span></td>
                                    <td><span class="label label-primary">Да</span></td>

                                    <td><span class="label label-danger">Отсутствует</span></td>
                                    <td><span class="label label-danger">Не требуется</span></td>
                                    <td><span class="label label-danger">Не требуется</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-warning">Заказчик</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-warning">Заказчик</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-danger">Отсутствует</span></td>
                                    <td><span class="label label-danger">Отсутствует</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                    <td><span class="label label-primary">Загрузить</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <a class="btn btn-outline btn-info" href="/funds">ДДС по контракту</a>
                        <a class="btn btn-outline btn-info" href="/letters">Письма</a>
                        <button class="btn btn-outline btn-info">Передать в эксплуатацию</button>
                        @if ($project->status !== 'Завершен')
                            <a class="btn btn-outline btn-info">Завершить проект</a>
                        @else
                                <a class="btn btn-outline btn-info">Возобновить</a>
                        @endif
                        <a class="btn btn-outline btn-info" href="/summary">Сводная по проектам</a>
                        <a class="btn btn-outline btn-info" href="/contracts">Реестр договоров</a>
                        <a class="btn btn-outline btn-info" href="/contacts">Контакты</a>
                        <a class="btn btn-outline btn-info" href="/production_plan">План производства</a>
                        <button class="btn btn-outline btn-info">Схема передачи данных</button>
                        <button class="btn btn-outline btn-info">Дислокации и направления</button>
                        <button class="btn btn-outline btn-info">Коллажи</button>
                        <button class="btn btn-outline btn-info">Скоростной режим</button>
                        <button class="btn btn-outline btn-info">Ссылка на закупку</button>
                        <button class="btn btn-outline btn-info">План-график</button>
                        <button class="btn btn-outline btn-info">ЛОП (бюджет проекта)</button>
                        <button class="btn btn-outline btn-info">Устав проекта</button>
                        <button class="btn btn-outline btn-info">Контракт</button>
                        <button class="btn btn-outline btn-info">Тех. задание</button>
                        <a class="btn btn-outline btn-info" href="#">Документы по проекту</a>
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
                        {extend: 'excel', title: 'Progress'},
                        //{extend: 'pdf', title: 'Progress'},

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
