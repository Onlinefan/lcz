@extends('layouts.app')
@section('page-title')
    Сводная таблица по проектам
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
{{--        <div class="row">--}}
{{--            <div class="col-lg-12">--}}
{{--                <div class="ibox">--}}
{{--                    <div class="ibox-content">--}}
{{--                        <div class="table-responsive">--}}
{{--                            <table class="table table-striped table-bordered table-hover dataTables-example">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th>Округ/Страна</th>--}}
{{--                                    <th>Количество</th>--}}
{{--                                    <th>Активных</th>--}}
{{--                                    <th>Завершенных</th>--}}
{{--                                    <th>Приостановленных</th>--}}
{{--                                    <th>Прочее</th>--}}
{{--                                    <th>Эксплуатация</th>--}}
{{--                                    <th>Количество адресов</th>--}}
{{--                                    <th>Лин. (тип 1)</th>--}}
{{--                                    <th>Пер. (тип 2)</th>--}}
{{--                                    <th>Пеш. (тип 3)</th>--}}
{{--                                    <th>Коперник (передвижка)</th>--}}
{{--                                    <th>Коперник (стационар)</th>--}}
{{--                                    <th>ВГК</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}

{{--                                <tbody>--}}
{{--                                @foreach ($tableData as $row)--}}
{{--                                    <tr>--}}
{{--                                        @foreach ($row as $column)--}}
{{--                                            <td>{{$column ?: 0}}</td>--}}
{{--                                        @endforeach--}}
{{--                                    </tr>--}}
{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <a href="javascript:" class="btn_style1 excel" onclick="doExcel1()"><span>Экспорт в <i class="fa fa-file-excel-o"></i> Excel</span></a>
                        <p>&nbsp;</p>
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
                                    <th colspan="5" style="text-align: center;">СМР</th>
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
                                    @foreach ($projects as $project)
                                        @if ($project->regions->count())
                                            @foreach ($project->regions as $key => $region)
                                                <tr>
                                                    @if ($key === 0)
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->code}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->planChart))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->planChart->path, strripos($project->contract->planChart->path, 'Projects_files/')) . $project->contract->planChart->file_name}}">{{$project->contract->planChart->file_name}}</a>@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->head)){{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->customer}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->name}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if ($project->countries->count()) @foreach($project->countries as $country) @if (isset($country->country)){{$country->country->name}}; <br>@endif @endforeach @endif</td>
                                                    @endif
                                                    <td>@if (isset($region->region)){{$region->region->name}}@endif</td>
                                                    @if ($key === 0)
                                                        <td rowspan="{{$project->regions->count()}}">@if ($project->serviceType->count()) @foreach ($project->serviceType as $serviceType) @if (isset($serviceType->serviceType)) {{$serviceType->serviceType->name}}; <br> @endif @endforeach @endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)) {{$project->contract->service_terms}} @endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)) {{$project->contract->lcz_role}} @endif</td>
                                                    @endif
                                                    <td>{{$region->address_count}}</td>
                                                    @if ($key === 0)
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->linearCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->perekrestokCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->peshehodCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->pereezdCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->koppCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->kopsCount()}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->arhimedCount()}}</td>
                                                        <td style="text-align:right" rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{number_format($project->contract->amount, 2, '.', ' ')}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">{{$project->status}}</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->examination}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->smr}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->installation}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->pnr}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->support_permission}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->tu_220}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->responsibilityArea)){{$project->responsibilityArea->tu_communication}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->date_start}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->date_end}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->smr_start}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->smr_end}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->installation_start}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->installation_end}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->pnr_start}}@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract)){{$project->contract->pnr_end}}@endif</td>
                                                    @endif
                                                    <td>{{$project->surveyPercent($region->region_id)}}</td>
                                                    <td>{{$project->documentPercent($region->region_id)}}</td>
                                                    <td>{{$project->tuPercent($region->region_id)}}</td>
                                                    <td>{{$project->footingPercent($region->region_id)}}</td>
                                                    <td>{{$project->shipmentPercent($region->region_id)}}</td>
                                                    @if ($key === 0)
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->cafap))@if (isset($project->cafap->dataTransfer)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->dataTransfer->path, strripos($project->cafap->dataTransfer->path, 'Projects_files/')) . $project->cafap->dataTransfer->file_name}}">{{$project->cafap->dataTransfer->file_name}}</a> @endif @endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->cafap))@if ($project->cafap->cafapCollage->count()) @foreach ($project->cafap->cafapCollage as $collage) @if (isset($collage->collageFile)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($collage->collageFile->path, strripos($collage->collageFile->path, 'Projects_files/')) . $collage->collageFile->file_name}}">{{$collage->collageFile->file_name}}</a> @endif @endforeach @endif @endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->cafap))@if (isset($project->cafap->locationDirections)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->locationDirections->path, strripos($project->cafap->locationDirections->path, 'Projects_files/')) . $project->cafap->locationDirections->file_name}}">{{$project->cafap->locationDirections->file_name}}</a> @endif @endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->cafap))@if (isset($project->cafap->speedMode)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->speedMode->path, strripos($project->cafap->speedMode->path, 'Projects_files/')) . $project->cafap->speedMode->file_name}}">{{$project->cafap->speedMode->file_name}}</a> @endif @endif</td>
                                                    @endif
                                                    <td>{{$region->cafapPo()}}</td>
                                                    <td>{{(int)$region->cafapAndromeda() ? 'Да' : 'Нет'}}</td>
                                                    <td>{{$project->checkPercent($region->region_id)}}</td>
                                                    <td>{{$project->tuFootingPercent($region->region_id)}}</td>
                                                    <td>{{$project->tu220Percent($region->region_id)}}</td>
                                                    <td>{{$project->installPercent($region->region_id)}}</td>
                                                    <td>{{$project->vu220Percent($region->region_id)}}</td>
                                                    <td>{{$project->transferredPnrPercent($region->region_id)}}</td>
                                                    <td>{{$project->kpPercent($region->region_id)}}</td>
                                                    <td>{{$project->analysisPercent($region->region_id)}}</td>
                                                    <td>{{$project->monitoringPercent($region->region_id)}}</td>
                                                    <td>{{$project->inCafapPercent($region->region_id)}}</td>
                                                    @if ($key === 0)
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->decreeScan))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->decreeScan->path, strripos($project->contract->decreeScan->path, 'Projects_files/')) . $project->contract->decreeScan->file_name}}">{{$project->contract->decreeScan->file_name}}</a>@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->lopFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/')) . $project->contract->lopFile->file_name}}">{{$project->contract->lopFile->file_name}}</a>@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->contractFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->contractFile->path, strripos($project->contract->contractFile->path, 'Projects_files/')) . $project->contract->contractFile->file_name}}">{{$project->contract->contractFile->file_name}}</a>@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->technicalTask))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->technicalTask->path, strripos($project->contract->technicalTask->path, 'Projects_files/')) . $project->contract->technicalTask->file_name}}">{{$project->contract->technicalTask->file_name}}</a>@endif</td>
                                                        <td rowspan="{{$project->regions->count()}}">@if (isset($project->contract->projectCharter))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->projectCharter->path, strripos($project->contract->projectCharter->path, 'Projects_files/')) . $project->contract->projectCharter->file_name}}">{{$project->contract->projectCharter->file_name}}</a>@endif</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>{{$project->code}}</td>
                                                <td>@if (isset($project->contract->planChart))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->planChart->path, strripos($project->contract->planChart->path, 'Projects_files/')) . $project->contract->planChart->file_name}}">{{$project->contract->planChart->file_name}}</a>@endif</td>
                                                <td>@if (isset($project->head)){{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->customer}}@endif</td>
                                                <td>{{$project->name}}</td>
                                                <td>@if ($project->countries->count()) @foreach($project->countries as $country){{$country->name}}; <br>@endforeach @endif</td>
                                                <td></td>
                                                <td>@if ($project->serviceType->count()) @foreach ($project->serviceType as $serviceType) @if (isset($serviceType->serviceType)) {{$serviceType->serviceType->name}}; <br> @endif @endforeach @endif</td>
                                                <td>@if (isset($project->contract)) {{$project->contract->service_terms}} @endif</td>
                                                <td>@if (isset($project->contract)) {{$project->contract->lcz_role}} @endif</td>
                                                <td></td>
                                                <td>{{$project->linearCount()}}</td>
                                                <td>{{$project->perekrestokCount()}}</td>
                                                <td>{{$project->peshehodCount()}}</td>
                                                <td>{{$project->pereezdCount()}}</td>
                                                <td>{{$project->koppCount()}}</td>
                                                <td>{{$project->kopsCount()}}</td>
                                                <td>{{$project->arhimedCount()}}</td>
                                                <td style="text-align:right">@if (isset($project->contract)){{number_format($project->contract->amount, 2, '.', ' ')}}@endif</td>
                                                <td>{{$project->status}}</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->examination}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->smr}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->installation}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->pnr}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->support_permission}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->tu_220}}@endif</td>
                                                <td>@if (isset($project->responsibilityArea)){{$project->responsibilityArea->tu_communication}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->date_start}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->date_end}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->smr_start}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->smr_end}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->installation_start}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->installation_end}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->pnr_start}}@endif</td>
                                                <td>@if (isset($project->contract)){{$project->contract->pnr_end}}@endif</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>@if (isset($project->cafap))@if (isset($project->cafap->dataTransfer)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->dataTransfer->path, strripos($project->cafap->dataTransfer->path, 'Projects_files/')) . $project->cafap->dataTransfer->file_name}}">{{$project->cafap->dataTransfer->file_name}}</a> @endif @endif</td>
                                                <td>@if (isset($project->cafap))@if ($project->cafap->cafapCollage->count()) @foreach ($project->cafap->cafapCollage as $collage) @if (isset($collage->collageFile)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($collage->collageFile->path, strripos($collage->collageFile->path, 'Projects_files/')) . $collage->collageFile->file_name}}">{{$collage->collageFile->file_name}}</a> @endif @endforeach @endif @endif</td>
                                                <td>@if (isset($project->cafap))@if (isset($project->cafap->locationDirections)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->locationDirections->path, strripos($project->cafap->locationDirections->path, 'Projects_files/')) . $project->cafap->locationDirections->file_name}}">{{$project->cafap->locationDirections->file_name}}</a> @endif @endif</td>
                                                <td>@if (isset($project->cafap))@if (isset($project->cafap->speedMode)) <a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->cafap->speedMode->path, strripos($project->cafap->speedMode->path, 'Projects_files/')) . $project->cafap->speedMode->file_name}}">{{$project->cafap->speedMode->file_name}}</a> @endif @endif</td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>@if (isset($project->contract->decreeScan))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->decreeScan->path, strripos($project->contract->decreeScan->path, 'Projects_files/')) . $project->contract->decreeScan->file_name}}">{{$project->contract->decreeScan->file_name}}</a>@endif</td>
                                                <td>@if (isset($project->contract->lopFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/')) . $project->contract->lopFile->file_name}}">{{$project->contract->lopFile->file_name}}</a>@endif</td>
                                                <td>@if (isset($project->contract->contractFile))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->contractFile->path, strripos($project->contract->contractFile->path, 'Projects_files/')) . $project->contract->contractFile->file_name}}">{{$project->contract->contractFile->file_name}}</a>@endif</td>
                                                <td>@if (isset($project->contract->technicalTask))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->technicalTask->path, strripos($project->contract->technicalTask->path, 'Projects_files/')) . $project->contract->technicalTask->file_name}}">{{$project->contract->technicalTask->file_name}}</a>@endif</td>
                                                <td>@if (isset($project->contract->projectCharter))<a href="http://{{$_SERVER['SERVER_NAME']}}/download?path={{substr($project->contract->projectCharter->path, strripos($project->contract->projectCharter->path, 'Projects_files/')) . $project->contract->projectCharter->file_name}}">{{$project->contract->projectCharter->file_name}}</a>@endif</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
