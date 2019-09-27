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
                        @if (isset($project->head))
                            <h4>
                                <img alt="image" class="img-circle" src="{{'/' . stristr($project->head->avatarFile->path, 'User_files') . $project->head->avatarFile->file_name}}" width="64px" />
                                {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                            </h4>
                        @endif
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
                        <h1 class="no-margins">{{number_format($project->contract->amount, 2, '.', ' ')}}</h1>
                        <div class="progress progress-mini">
                            <div style="width: {{round($income/$project->contract->amount*100)}}%;" class="progress-bar"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">{{round($income/$project->contract->amount*100)}}%</div>
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
                        <h1 class="no-margins">{{number_format($countPlan, 2, '.', ' ')}}</h1>
                        <div class="progress progress-mini">
                            <div style="width: {{$countPlan ? round($cost/$countPlan*100) : 0}}%;" class="progress-bar progress-bar-danger"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">{{$countPlan ? round($cost/$countPlan*100) : 0}}%</div>
                        <small>Затраты</small>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="ibox ">
                    <div class="ibox-title">

                        <h5>@if ($dateDiff <= 10)
                                <i class="fa fa-exclamation-circle" style="color:#f8ac59; font-size: 20px;"></i>
                            @endifДедлайн</h5>
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
                        <h1 class="no-margins">{{$realizationCount}}</h1>
                        <div class="progress progress-mini">
                            <div style="width: {{$realizationCount ? round($finishCount/$realizationCount*100) : 0}}%;" class="progress-bar progress-bar-info"></div>
                        </div>
                        <div class="stat-percent font-bold text-success">{{$finishCount}}</div>
                        <small>Завершено</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-10">
                <div class="ibox">
                    <div class="ibox-content">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach ($projectRegions as $key => $region)
                                <li class="{{intval($key) === 0 ? 'active' : ''}}">
                                    <a class="nav-link {{intval($key) === 0 ? 'active' : ''}}"
                                        data-toggle="tab" data-tab="{{$region->region_id}}" href="#tab-{{$region->region_id}}">{{$region->region->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content">
                            @foreach ($projectRegions as $key => $region)
                                <div role="tabpanel" id="tab-{{$region->region_id}}" class="tab-pane {{intval($key) === 0 ? 'active' : ''}}">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['dataCount']/(7 * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1)) * 100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Начальные данные</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['initialDataCount']/(5 * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1)) * 100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Исходные данные</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['pirCount']/(10  * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1))*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">ПИР</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['productionCount']/(6  * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1))*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Производство</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['smrCount']/(6 * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1))*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">СМР/Монтаж</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['pnrCount']/(7 * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1))*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">ПНР</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['documentsCount']/(14 * ($region->projectStatus()->count() > 0 ? $region->projectStatus()->count() : 1))*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Документы</h5>
                                            </div>
                                        </div>
                                        <br>

                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                                <thead>
                                                <tr>
                                                    <th colspan="8" style="text-align: center;"></th>
                                                    <th colspan="6" style="text-align: center;">Исходные данные</th>
                                                    <th colspan="11" style="text-align: center;">ПИР</th>
                                                    <th colspan="7" style="text-align: center;">Производство</th>
                                                    <th colspan="7" style="text-align: center;">СМР/Монтаж</th>
                                                    <th colspan="8" style="text-align: center;">ПНР</th>
                                                    <th colspan="15" style="text-align: center;">Документы</th>
                                                </tr>
                                                <tr>
                                                    <th>№</th>
                                                    <th>ID системы</th>
                                                    <th>ID комплекса</th>
                                                    <th>Город</th>
                                                    <th>Принадлежность дороги</th>
                                                    <th>Адрес по контракту</th>
                                                    <th>Адрес по ГИБДД</th>
                                                    <th></th>

                                                    <th>Тип оборудования</th>
                                                    <th>Тип контролируемого участка дороги</th>
                                                    <th>Скоростной режим, км/ч</th>
                                                    <th>Кол-во рубежей</th>
                                                    <th>КоАП</th>
                                                    <th></th>

                                                    <th>Статус обследования</th>
                                                    <th>Комментарий к обследованию</th>
                                                    <th>Проектная документация</th>
                                                    <th>Количество новых опор под ФВФ</th>
                                                    <th>Количество новых опор под ЛЭП</th>
                                                    <th>Количество РК</th>
                                                    <th>Количество ОК</th>
                                                    <th>Суммарная мощность оборудования</th>
                                                    <th>Запрос ТУ на 220</th>
                                                    <th>Запрос на опоры</th>
                                                    <th></th>

                                                    <th>Статус отгрузки</th>
                                                    <th>Дата отгрузки оборудования</th>
                                                    <th>№ сим Internet (БУ)</th>
                                                    <th>№ сим SSU</th>
                                                    <th>№ поверки</th>
                                                    <th>Дата окончания поверки</th>
                                                    <th></th>

                                                    <th>Ссылка на корневую задачу</th>
                                                    <th>Наличие 220 на ВУ</th>
                                                    <th>Канал связи (договор)</th>
                                                    <th>Обвязка дислокации</th>
                                                    <th>Статус монтажа</th>
                                                    <th>Передано в ПНР</th>
                                                    <th></th>

                                                    <th>Калибровка 2000 проездов</th>
                                                    <th>КП</th>
                                                    <th>Результаты анализа</th>
                                                    <th>Передача комплекса в мониторинг</th>
                                                    <th>Выгрузка в Андромеду</th>
                                                    <th>Выгрузка</th>
                                                    <th>в ЦАФАП</th>
                                                    <th></th>

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
                                                    <th></th>
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach ($region->projectStatus() as $row)
                                                    <tr>
                                                        <td>{{$row->id}}</td>
                                                        <td>{{$row->system_id}}</td>
                                                        <td>{{$row->complex_id}}</td>
                                                        <td>{{$row->city}}</td>
                                                        <td>@if (isset($row->affiliationRoad))<span class="label label-secondary">{{$row->affiliationRoad->name}}</span>@endif</td>
                                                        <td>{{$row->address_contract}}</td>
                                                        <td>{{$row->address_gibdd}}</td>
                                                        <td><a href="/edit-data/{{$row->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td>@if (isset($row->initialData->equipmentType))<span class="label label-secondary">{{$row->initialData->equipmentType->name}}</span>@endif</td>
                                                        <td>@if (isset($row->initialData->roadType))<span class="label label-secondary">{{$row->initialData->roadType->name}}</span>@endif</td>
                                                        <td>{{$row->initialData->speed_mode}}</td>
                                                        <td>{{$row->initialData->borders_number}}</td>
                                                        <td>{{$row->initialData->koap}}</td>
                                                        <td><a href="/edit-initial-data/{{$row->initialData->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td>@if (isset($row->pir->surveyStatus))<span class="label {{$row->pir->surveyStatus->name === 'В работе' ? 'label-warning' : ($row->pir->surveyStatus->name === 'Не обследовано' ? 'label-danger' : 'label-primary')}}">{{$row->pir->surveyStatus->name}}</span>@endif</td>
                                                        <td>{{$row->pir->survey_comment}}</td>
                                                        <td>@if (isset($row->pir->designDocumentation))<span class="label label-secondary">{{$row->pir->designDocumentation->name}}</span>@endif</td>
                                                        <td>{{$row->pir->new_footing_fvf}}</td>
                                                        <td>{{$row->pir->new_footing_lep}}</td>
                                                        <td>{{$row->pir->rk_count}}</td>
                                                        <td>{{$row->pir->ok_count}}</td>
                                                        <td>{{$row->pir->equipment_power}}</td>
                                                        <td>@if (isset($row->pir->requestTu))<span class="label {{($row->pir->requestTu->name === 'Заявка подана' || $row->pir->requestTu->name === 'ТУ получено') ? 'label-primary' : ($row->pir->requestTu->name === 'Отсутствует' ? 'label-danger' : 'label-secondary')}}">{{$row->pir->requestTu->name}}</span>@endif</td>
                                                        <td>@if (isset($row->pir->requestFooting))<span class="label label-secondary">{{$row->pir->requestFooting->name}}</span>@endif</td>
                                                        <td><a href="/edit-pir/{{$row->pir->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td>@if (isset($row->production->shipmentStatus))<span class="label label-secondary">{{$row->production->shipmentStatus->name}}</span>@endif</td>
                                                        <td>{{$row->production->date_equipment_shipment}}</td>
                                                        <td>{{$row->production->number_sim_internet}}</td>
                                                        <td>{{$row->production->number_sim_ssu}}</td>
                                                        <td>{{$row->production->number_verification}}</td>
                                                        <td>{{$row->production->date_verification_end}}</td>
                                                        <td><a href="/edit-production/{{$row->production->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td><a href="#">{{$row->smr->link_root_task}}</a></td>
                                                        <td>@if (isset($row->smr->vu220))<span class="label label-secondary">{{$row->smr->vu220->name}}</span>@endif</td>
                                                        <td>@if (isset($row->smr->linkContract))<span class="label label-secondary">{{$row->smr->linkContract->name}}</span>@endif</td>
                                                        <td>@if (isset($row->smr->dislocationStrapping))<span class="label label-secondary">{{$row->smr->dislocationStrapping->name}}</span>@endif</td>
                                                        <td>@if (isset($row->smr->installationStatus))<span class="label {{($row->smr->installationStatus->name === 'Нет' || $row->smr->installationStatus->name === 'Украден') ? 'label-danger' : ($row->smr->installationStatus->name === 'В работе' ? 'label-warning' : 'label-primary')}}">{{$row->smr->installationStatus->name}}</span>@endif</td>
                                                        <td>@if (isset($row->smr->transferredPnr))<span class="label label-secondary">{{$row->smr->transferredPnr->name}}</span>@endif</td>
                                                        <td><a href="/edit-smr/{{$row->smr->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td>@if (isset($row->pnr->calibration2000))<span class="label {{$row->pnr->calibration2000->name === 'В работе' ? 'label-warning' : 'label-danger'}}">{{$row->pnr->calibration2000->name}}</span>@endif</td>
                                                        <td>@if (isset($row->pnr->kpLink))<span class="label {{$row->pnr->kpLink->name === 'Нет водителя' ? 'label-danger' : ($row->pnr->kpLink->name === 'В работе' ? 'label-warning' : 'label-secondary')}}">{{$row->pnr->kpLink->name}}</span>@endif</td>
                                                        <td>@if (isset($row->pnr->analysisResult))<span class="label {{$row->pnr->analysisResult->name === 'Неудовлетворительно' ? 'label-danger' : 'label-secondary'}}">{{$row->pnr->analysisResult->name}}</span>@endif</td>
                                                        <td>@if (isset($row->pnr->complexToMonitoring))<span class="label label-secondary">{{$row->pnr->complexToMonitoring->name}}</span>@endif</td>
                                                        <td>@if (isset($row->pnr->andromedaUnloading))<span class="label label-secondary">{{$row->pnr->andromedaUnloading->name}}</span>@endif</td>
                                                        <td><span class="label label-secondary">{{$row->pnr->unloading}}</span></td>
                                                        <td>@if (isset($row->pnr->inCafap))<span class="label label-secondary">{{$row->pnr->inCafap->name}}</span>@endif</td>
                                                        <td><a href="/edit-pnr/{{$row->pnr->id}}" class="btn-white btn btn-xs">Редактировать</a></td>

                                                        <td><span class="label label-secondary">@if (isset($row->document->examinationFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Obsledovanie/{{$row->document->examinationFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->projectDocumentationFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Proektnaya documentaciya/{{$row->document->projectDocumentationFile->file_name}}">Загрузить</a> @else Не требуется @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->executiveDocumentationFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Ispolnitelnaya documentaciya/{{$row->document->executiveDocumentationFile->file_name}}">Загрузить</a> @else Не требуется @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->verificationFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Poverka/{{$row->document->verificationFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->formsFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Formulyary/{{$row->document->formsFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->passportsFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Pasporta/{{$row->document->passportsFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->tu220File))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/TU-220/{{$row->document->tu220File->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->contract220File))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Dogovor 220/{{$row->document->contract220File->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->tuFootingFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/TU na oporu/{{$row->document->tuFootingFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->contractFootingFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Dogovor na opory/{{$row->document->contractFootingFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->addressPlanAgreedCafapFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Adresnyi plan/{{$row->document->addressPlanAgreedCafapFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->dataTransferSchemeFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Shema peredachi dannyh/{{$row->document->dataTransferSchemeFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->inboxFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Vhodyashie/{{$row->document->inboxFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($row->document->outgoingFile))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Ishodyashie/{{$row->document->outgoingFile->file_name}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><a href="/edit-documents/{{$row->document->id}}" class="btn-white btn btn-xs">Редактировать</a></td>
                                                        <td><a href="/delete-data-row/{{$row->id}}"><i class="fa fa-times-circle" style="color:red; font-size:20px;"></i></a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <a class="btn btn-outline btn-info" href="/add-data-row/{{$region->project_id}}-{{$region->region_id}}">Добавить строку</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <br>
                        <div class="row">
                            @if (isset($project->cafap->dataTransfer))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->cafap->dataTransfer->path, strripos($project->cafap->dataTransfer->path, 'Projects_files/')) . $project->cafap->dataTransfer->file_name}}">Схема передачи данных</a>
                            @endif
                            @if (isset($project->cafap->locationDirections))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->cafap->locationDirections->path, strripos($project->cafap->locationDirections->path, 'Projects_files/')) . $project->cafap->locationDirections->file_name}}">Дислокации и направления</a>
                            @endif
                            @if (isset($project->cafap->speedMode))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->cafap->speedMode->path, strripos($project->cafap->speedMode->path, 'Projects_files/')) . $project->cafap->speedMode->file_name}}">Скоростной режим</a>
                            @endif
                        </div>
                        <div class="row">
                            <a class="btn btn-outline btn-info" href="{{$project->contract->purchase_reference}}">Ссылка на закупку</a>
                            @if (isset($project->contract->planChart))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->contract->planChart->path, strripos($project->contract->planChart->path, 'Projects_files/')) . $project->contract->planChart->file_name}}">План-график</a>
                            @endif
                            @if (isset($project->contract->lopFile))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->contract->lopFile->path, strripos($project->contract->lopFile->path, 'Projects_files/')) . $project->contract->lopFile->file_name}}">ЛОП (бюджет проекта)</a>
                            @endif
                            @if (isset($project->contract->projectCharter))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->contract->projectCharter->path, strripos($project->contract->projectCharter->path, 'Projects_files/')) . $project->contract->projectCharter->file_name}}">Устав проекта</a>
                            @endif
                            @if (isset($project->contract->contractFile))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->contract->contractFile->path, strripos($project->contract->contractFile->path, 'Projects_files/')) . $project->contract->contractFile->file_name}}">Контракт</a>
                            @endif
                            @if (isset($project->contract->technicalTask))
                                <a class="btn btn-outline btn-info" href="/download?path={{substr($project->contract->technicalTask->path, strripos($project->contract->technicalTask->path, 'Projects_files/')) . $project->contract->technicalTask->file_name}}">Тех. задание</a>
                            @endif
                            <a class="btn btn-outline btn-info" href="/files">Документы по проекту</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/funds">ДДС по контракту</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/letters">Письма</a>
                </div>
                <div class="row">
                    @if ($project->status === 'Реализация')
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Эксплуатация'}}">Передать в эксплуатацию</a>
                    @elseif($project->status === 'Эксплуатация')
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Реализация'}}">Вернуть в реализацию</a>
                    @endif
                </div>
                <div class="row">
                    @if ($project->status !== 'Завершен')
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Завершен'}}">Завершить проект</a>
                    @else
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Реализация'}}">Возобновить</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
