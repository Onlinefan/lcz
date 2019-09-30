@extends('layouts.app')
@section('page-title')
    Главная
@endsection
@section('content')
    {{csrf_field()}}
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>
                        Контракты
                    </h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format((int)$contracts->contract_sum, 2, '.', ' ')}}</h1>
                    <div class="progress progress-mini">
                        <div style="width: @if ($contracts->contract_count){{($signPercent->count/$contracts->contract_count)*100}} @else 0 @endif%;" class="progress-bar"></div>
                    </div>
                    <div class="stat-percent font-bold text-success">{{$contracts->contract_count}} <i class="fa fa-bolt"></i></div>
                    <small>Количество контрактов</small>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Поступления</h5>
                </div>
                <div class="ibox-content">
                    <h1 class="no-margins">{{number_format((int)$incomes->income_sum, 2, '.', ' ')}}</h1>
                    <div class="progress progress-mini">
                        <div style="width: @if ((int)$contracts->contract_sum){{(int)$incomes->income_sum/(int)$contracts->contract_sum*100}} @else 0 @endif%;" class="progress-bar progress-bar-danger"></div>
                    </div>
                    <div class="stat-percent font-bold text-info">{{$incomes->income_count}} <i class="fa fa-level-up"></i></div>
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
                        <div class="stat-percent font-bold text-navy">{{$contractCount}} <i class="fa fa-level-up"></i></div>
                        <small>По контракту</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">{{$pilotCount}} <i class="fa fa-level-up"></i></div>
                        <small>Пилотный проект</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">{{$exploitationCount}} <i class="fa fa-level-up"></i></div>
                        <small>Передано в эксплуатацию</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">{{$finishCount}} <i class="fa fa-level-up"></i></div>
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
                        <div class="stat-percent font-bold text-navy">{{$garantCount}} <i class="fa fa-level-up"></i></div>
                        <small>По гарантии</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">{{$rentCount}} <i class="fa fa-level-up"></i></div>
                        <small>Аренда (долгосрочные)</small>
                    </div>
                    <div class="txssd">
                        <div class="stat-percent font-bold text-navy">{{$techCount}} <i class="fa fa-level-up"></i></div>
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
                                    @foreach ($regionsTable as $country)
                                        <th class="text-center">{{$country->name}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="text-nowrap" scope="row">Контрактов на сумму</th>
                                    @foreach ($regionsTable as $amount)
                                        <td style="text-align:right" class="text-right">{{number_format($amount->amount, 2, '.', ' ')}}</td>
                                    @endforeach
                                </tr>
                                <tr>
                                    <th class="text-nowrap" scope="row">Регионов</th>
                                    @foreach ($regionsTable as $regions)
                                        <td class="text-right">{{$regions->regions_count}}</td>
                                    @endforeach
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

                                    $.ajax({
                                        url: '/get-month',
                                        type: 'POST',
                                        data: {},
                                        headers: {
                                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function (data) {
                                            var result = JSON.parse(data);
                                            data = result['data'];
                                            var keys = result['keys'];
                                            var colors = {};
                                            var columns = [];
                                            var row = ['x'];
                                            for (var key in keys) {
                                                row.push(keys[key] + '-01');
                                            }

                                            columns.push(row);
                                            for (var i in data) {
                                                colors[data[i]['name']] = data[i]['color'] ? data[i]['color'] : '#00008b';
                                                row = [data[i]['name']];
                                                for (key in keys) {
                                                    row.push(data[i][keys[key]] ? data[i][keys[key]] : 0);
                                                }

                                                columns.push(row);
                                            }

                                            c3.generate({
                                                bindto: '#lineChart',
                                                data: {
                                                    x: 'x',
                                                    columns: columns,
                                                    colors: colors
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
                                        },
                                        error : function (msg) {
                                            console.log(msg);
                                        },
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
                            <a class="btn btn-success btn-facebook btn-outline" href="/summary"><i class="fa fa-rss"></i>&nbsp;&nbsp;Сводная по проектам</a>
                            <a class="btn btn-warning " href="/projects"><i class="fa fa-shield"></i>&nbsp;Проекты</a>
                            <a class="btn btn-success " href="statuses"><i class="fa fa-user"></i>&nbsp;Проекты на РП</a>
                            <a class="btn btn-danger " href="/contracts"><i class="fa fa-bell"></i>&nbsp;Реестр договоров</a>
                            <a class="btn btn-info " href="/contacts"><i class="fa fa-phone"></i>&nbsp;Контакты</a>
                            <a class="btn btn-primary " href="/production"><i class="fa fa-warning"></i>&nbsp;План производства</a>
                            <a class="btn btn-white" href="/openings"> Реестр ЛОП</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
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
                            <th class="text-nowrap" scope="row">Округ/страна</th>
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
                        @foreach ($rkTable as $row)
                            <tr>
                                @foreach ($row as $key => $cell)
                                    @if ($key === 0)
                                    <th class="text-nowrap" scope="row">
                                        {{$cell}}
                                    </th>
                                    @else
                                        <td class="text-center">{{number_format(floatval($cell), 0, '.', ' ')}}</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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

                                $.ajax({
                                    url: '/get-map',
                                    type: 'POST',
                                    data: {},
                                    headers: {
                                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function (data) {
                                        var mapData = JSON.parse(data);

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
                                    },
                                    error : function (msg) {
                                        console.log(msg);
                                    },
                                });

                            });

                        });

                    </script>
                </div>

            </div>

        </div>
    </div>
@endsection
