@extends('layouts.app')
@section('page-title')
    Главная
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-2">
            <div class="ibox ">

                <div class="ibox-title">
                    &nbsp;
                </div>
                <div class="ibox-content">
                    <img src="{{ asset('storage/img/logo_rus_g.png') }}" alt="">
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                        Контракты
                    </h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">2 520 654 000 </h1>
                    <div class="progress progress-mini">
                        <div style="width: 48%;" class="progress-bar"></div>
                    </div>
                    <div class="stat-percent font-bold text-success">83 <i class="fa fa-bolt"></i></div>
                    <small>Количество контрактов</small>
                </div>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Поступления</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">1 520 654 000</h1>
                    <div class="progress progress-mini">
                        <div style="width: 58%;" class="progress-bar progress-bar-danger"></div>
                    </div>
                    <div class="stat-percent font-bold text-info">2 150 000 <i class="fa fa-level-up"></i></div>
                    <small>Выставлено счетов </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5 style="font-size: 12px; ">Активных проектов (реализация)</h5>
                </div>
                <div class="ibox-content">
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">15 <i class="fa fa-level-up"></i></div>
                        <small>По контракту</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">20 <i class="fa fa-level-up"></i></div>
                        <small>Пилотный проект</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">40 <i class="fa fa-level-up"></i></div>
                        <small>Передано в эксплуатацию</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">10 <i class="fa fa-level-up"></i></div>
                        <small>Завершено проектов</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5 style="font-size: 12px; ">Проекты в эксплуатации</h5>
                </div>
                <div class="ibox-content">

                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">15 <i class="fa fa-level-up"></i></div>
                        <small>По гарантии</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">5 <i class="fa fa-level-up"></i></div>
                        <small>Аренда (долгосрочные)</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">5 <i class="fa fa-level-up"></i></div>
                        <small>Тех.обслуживание</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Распределение по регионам</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        {{--<a class="dropdown-toggle" data-toggle="dropdown" href="#">--}}
                            {{--<i class="fa fa-wrench"></i>--}}
                        {{--</a>--}}
                        {{--<ul class="dropdown-menu dropdown-user">--}}
                            {{--<li><a href="#" class="dropdown-item">Config option 1</a>--}}
                            {{--</li>--}}
                            {{--<li><a href="#" class="dropdown-item">Config option 2</a>--}}
                            {{--</li>--}}
                        {{--</ul>--}}
                        {{--<a class="close-link">--}}
                            {{--<i class="fa fa-times"></i>--}}
                        {{--</a>--}}
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" scope="row">Округ/страна</th>
                                    <th class="text-center">ДВФО</th>
                                    <th class="text-center">СЗФО</th>
                                    <th class="text-center">ПФО</th>
                                    <th class="text-center">УФО</th>
                                    <th class="text-center">ЮФО</th>
                                    <th class="text-center">ЦФО</th>
                                    <th class="text-center">СКФО</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-nowrap" scope="row">Контрактов на сумму</th>
                                    <td class="text-right">120 542 320</td>
                                    <td class="text-right">254 658 123</td>
                                    <td class="text-right">120 542 320</td>
                                    <td class="text-right">254 658 123</td>
                                    <td class="text-right">120 542 320</td>
                                    <td class="text-right">254 658 123</td>
                                    <td class="text-right">120 542 320</td>
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Регионов</th>
                                    <td class="text-right">5</td>
                                    <td class="text-right">6</td>
                                    <td class="text-right">5</td>
                                    <td class="text-right">6</td>
                                    <td class="text-right">5</td>
                                    <td class="text-right">6</td>
                                    <td class="text-right">5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <h2>Динамика суммы контрактов по округам</h2>
                        <div id="lineChart"></div>
                        <script>
                            window.addEventListener('DOMContentLoaded', function(){
                                $(document).ready(function () {

                                    c3.generate({
                                        bindto: '#lineChart',
                                        data: {
                                            x: 'x',
                                            columns: [
                                                ['x', '2019-01-01', '2019-02-01', '2019-03-01', '2019-04-01', '2019-05-01', '2019-06-01', '2019-07-01'],
                                                ['ДВФО', 120542320, 120542320*1.1, 120542320*1.15, 120542320*1.18, 120542320*1.2, 120542320*1.25, 120542320*1.25],
                                                ['СЗФО', 254658123, 254658123*1.1, 254658123*1.25, 254658123*1.38, 254658123*1.4, 254658123*1.5, 254658123*1.5],
                                                ['ПФО',  320542320, 320542320*1.1, 320542320*1.15, 320542320*1.18, 320542320*1.2, 320542320*1.25, 320542320*1.25],
                                                ['УФО',  454658123, 454658123*1.1, 454658123*1.35, 454658123*1.48, 454658123*1.53, 454658123*1.67, 454658123*1.67],
                                                ['ЮФО',  520542320, 520542320*1.1, 520542320*1.15, 520542320*1.18, 520542320*1.2, 520542320*1.25, 520542320*1.25],
                                                ['ЦФО',  654658123, 654658123*1.1, 654658123*1.15, 654658123*1.18, 654658123*1.2, 654658123*1.25, 654658123*1.25],
                                                ['СКФО', 720542320, 720542320*1.1, 720542320*1.15, 720542320*1.18, 720542320*1.2, 720542320*1.25, 720542320*1.25],
                                            ],
                                            colors: {
                                                ДВФО: '#b3a968',
                                                СЗФО: '#b35b7c',
                                                ПФО:  '#5b6eb3',
                                                УФО:  '#46b32b',
                                                ЮФО:  '#b34b3d',
                                                ЦФО:  '#781db3',
                                                СКФО: '#1225b3',
                                            }
                                        },
                                        axis: {
                                            x: {
                                                type: 'timeseries',
                                                tick: {
                                                    format: '%Y-%m'
                                                }
                                            }
                                        }
                                    });

                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>&nbsp;</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div>
                        <p>
                            <button class="btn btn-success btn-facebook btn-outline" type="button"><i class="fa fa-rss"></i>&nbsp;&nbsp;Сводная по проектам</button>
                            <button class="btn btn-warning " type="button"><i class="fa fa-shield"></i>&nbsp;Проекты</button>
                            <button class="btn btn-success " type="button"><i class="fa fa-user"></i>&nbsp;Проекты на РП</button>
                            <button class="btn btn-danger " type="button"><i class="fa fa-bell"></i>&nbsp;Реестр договоров</button>
                            <button class="btn btn-info " type="button"><i class="fa fa-phone"></i>&nbsp;Контакты</button>
                            <button class="btn btn-primary " type="button"><i class="fa fa-warning"></i>&nbsp;План производства</button>

                            <a class="btn btn-white">
                                Реестр ЛОП
                            </a>
                            <a class="btn btn-white">
                                Архив АКТов
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Количество РК</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-nowrap" scope="row">Регион</th>
                                <th class="text-center">Линейники</th>
                                <th class="text-center">Перекресток</th>
                                <th class="text-center">Пешеход</th>
                                <th class="text-center">Коперник (стационар)</th>
                                <th class="text-center">Коперник (передвижка)</th>
                                <th class="text-center">Архимед</th>
                                <th class="text-center">Андромеда</th>
                                <td class="text-center">Всего</td>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Астрахань
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Архангельск
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>

                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Брянск
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Белгород
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Владимир
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Калуга
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Мурманск
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Тамбов
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            <tr>
                                <th class="text-nowrap" scope="row">
                                    Ярославль
                                </th>
                                <td class="text-center">5</td>
                                <td class="text-center">3</td>
                                <td class="text-center">5</td>
                                <td class="text-center">6</td>
                                <td class="text-center">8</td>
                                <td class="text-center">5</td>
                                <td class="text-center">4</td>
                                <th class="text-center">4</th>
                                <td>120 542 320</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
            <div class="ibox">
                <div class="ibox-title">
                    <h5>География бизнеса РФ</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id="world-map" style="height: 400px;"></div>
                    <script>
                        window.addEventListener('DOMContentLoaded', function(){

                            $(document).ready(function () {

                                var mapData = {
                                    "RU-LEN": 498,
                                    "RU-LIP": 200,
                                    "RU-BA": 1300,
                                    "RU-SAM": 220,
                                    "RU-KK": 540,
                                    "RU-MOW": 120,
                                    "RU-RYA": 760,
                                    "RU-VGG": 550,
                                    "RU-DA": 200,
                                    "RU-BRY": 120,
                                    "RU-SMO": 2000
                                };

                                $('#world-map').vectorMap({
                                    map: 'ru_mill',
                                    backgroundColor: "transparent",
                                    regionStyle: {
                                        initial: {
                                            fill: '#e4e4e4',
                                            "fill-opacity": 1,
                                            stroke: 'none',
                                            "stroke-width": 0,
                                            "stroke-opacity": 0
                                        }
                                    },
                                    series: {
                                        regions: [{
                                            values: mapData,
                                            scale: [ "#22d6b1", "#1ab394", ],
                                            normalizeFunction: 'polynomial'
                                        }]
                                    },
                                    onRegionTipShow: function(e, el, code){
                                        el.html(el.html()+(typeof mapData[code] !== 'undefined' ? ' ('+mapData[code]+')' : ''));
                                    }
                                });

                            });

                        });

                    </script>
                </div>

            </div>

        </div>
    </div>
@endsection
