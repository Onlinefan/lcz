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
                            <img alt="image" class="img-circle" src="{{'/' . stristr($project->head->avatarFile->path, 'User_files') . $project->head->avatarFile->file_name}}" width="64px" />
                            {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
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
                        <h1 class="no-margins">{{$countPlan}}</h1>
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
                                        data-toggle="tab" data-tab="{{$region->region_id}}" href="#tab-{{$region->region_id}}">{{$region->region_name}}</a>
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
                                                    <div style="width: {{round($arPercents[$key]['dataCount']/7*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Начальные данные</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['initialDataCount']/6*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Исходные данные</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['pirCount']/10*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">ПИР</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['productionCount']/6*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Производство</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['smrCount']/6*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">СМР/Монтаж</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['pnrCount']/7*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">ПНР</h5>
                                            </div>

                                            <div class="col-lg-1">
                                                <div class="progress progress-mini">
                                                    <div style="width: {{round($arPercents[$key]['documentsCount']/14*100)}}%;" class="progress-bar progress-bar-warning"></div>
                                                </div>
                                                <h5 class="no-margins">Документы</h5>
                                            </div>
                                        </div>
                                        <br>

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

                                                    <th>Калибровка 2000 проездов</th>
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
                                                        <td>{{$region->system_number}}</td>
                                                        <td>{{$region->system_id}}</td>
                                                        <td>{{$region->complex_id}}</td>
                                                        <td>{{$region->city}}</td>
                                                        <td><span class="label label-secondary">{{$region->affiliation_of_the_road}}</span></td>
                                                        <td>{{$region->address_contract}}</td>
                                                        <td>{{$region->address_gibdd}}</td>

                                                        <td><span class="label label-secondary">{{$region->equipment_type}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->road_type}}</span></td>
                                                        <td>{{$region->speed_mode}}</td>
                                                        <td>{{$region->borders_number}}</td>
                                                        <td>{{$region->koap}}</td>

                                                        <td><span class="label {{$region->survey_status === 'В работе' ? 'label-warning' : ($region->survey_status === 'Не обследовано' ? 'label-danger' : 'label-primary')}}">{{$region->survey_status}}</span></td>
                                                        <td>{{$region->survey_comment}}</td>
                                                        <td><span class="label label-secondary">{{$region->design_documentation}}</span></td>
                                                        <td>{{$region->new_footing_fvf}}</td>
                                                        <td>{{$region->new_footing_lep}}</td>
                                                        <td>{{$region->rk_count}}</td>
                                                        <td>{{$region->ok_count}}</td>
                                                        <td>{{$region->equipment_power}}</td>
                                                        <td><span class="label {{($region->request_tu === 'Заявка подана' || $region->request_tu === 'ТУ получено') ? 'label-primary' : ($region->request_tu === 'Отсутствует' ? 'label-danger' : 'label-secondary')}}">{{$region->request_tu}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->request_footing}}</span></td>

                                                        <td><span class="label label-secondary">{{$region->shipment_status}}</span></td>
                                                        <td>{{$region->date_equipment_shipment}}</td>
                                                        <td>{{$region->number_sim_internet}}</td>
                                                        <td>{{$region->number_sim_ssu}}</td>
                                                        <td>{{$region->number_verification}}</td>
                                                        <td>{{$region->date_verification_end}}</td>

                                                        <td><a href="#">{{$region->link_root_task}}</a></td>
                                                        <td><span class="label label-secondary">{{$region->$vu220}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->link_contract}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->dislocation_strapping}}</span></td>
                                                        <td><span class="label {{($region->installation_status === 'Нет' || $region->installation_status === 'Украден') ? 'label-danger' : ($region->installation_status === 'В работе' ? 'label-warning' : 'label-primary')}}">{{$region->installation_status}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->transferred_pnr}}</span></td>

                                                        <td><span class="label {{$region->calibration_2000 === 'В работе' ? 'label-warning' : 'label-danger'}}">{{$region->calibration_2000}}</span></td>
                                                        <td><span class="label {{$region->kp === 'Нет водителя' ? 'label-danger' : ($region->kp === 'В работе' ? 'label-warning' : 'label-secondary')}}">{{$region->kp}}</span></td>
                                                        <td><span class="label {{$region->analysis_result === 'Неудовлетворительно' ? 'label-danger' : 'label-secondary'}}">{{$region->analysis_result}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->complex_to_monitoring}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->andromeda_unloading}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->unloading}}</span></td>
                                                        <td><span class="label label-secondary">{{$region->in_cafap}}</span></td>

                                                        <td><span class="label label-secondary">@if (isset($region->examination))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Obsledovanie/{{$region->examination}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->project_documentation))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Proektnaya documentaciya/{{$region->project_documentation}}">Загрузить</a> @else Не требуется @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->executive_documentation))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Ispolnitelnaya documentaciya/{{$region->executive_documentation}}">Загрузить</a> @else Не требуется @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->verification))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Poverka/{{$region->verification}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->forms))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Formulyary/{{$region->forms}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->passports))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Pasporta/{{$region->passports}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->tu_220))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/TU-220/{{$region->tu_220}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->contract_220))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Dogovor 220/{{$region->contract_220}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->tu_footing))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/TU na oporu/{{$region->tu_footing}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->contract_footing))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Dogovor na opory/{{$region->contract_footing}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->address_plan_agreed_cafap))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Adresnyi plan/{{$region->address_plan_agreed_cafap}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->data_transfer_scheme))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Shema peredachi dannyh/{{$region->data_transfer_scheme}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->inbox))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Vhodyashie/{{$region->inbox}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                        <td><span class="label label-secondary">@if (isset($region->outgoing))<a href="/download?path=Projects_files/{{$project->code}}/Upravleniye proektom/Ishodyashie/{{$region->outgoing}}">Загрузить</a> @else Отсутствует @endif</span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row">
                                            <a class="btn btn-outline btn-info" href="/edit-data/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать данные</a>
                                            <a class="btn btn-outline btn-info" href="/edit-initial-data/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать исходные данные</a>
                                            <a class="btn btn-outline btn-info" href="/edit-pir/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать ПИР</a>
                                            <a class="btn btn-outline btn-info" href="/edit-production/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать производство</a>
                                            <a class="btn btn-outline btn-info" href="/edit-smr/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать СМР</a>
                                            <a class="btn btn-outline btn-info" href="/edit-pnr/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать ПНР</a>
                                            <a class="btn btn-outline btn-info" href="/edit-documents/{{$project->id}}-{{$region->region_id}}">Добавить/редактировать документы</a>
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
                    <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Эксплуатация'}}">Передать в эксплуатацию</a>
                </div>
                <div class="row">
                    @if ($project->status !== 'Завершен')
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Завершен'}}">Завершить проект</a>
                    @else
                        <a class="btn btn-outline btn-info" href="/change-status/{{$project->id . '-Реализация'}}">Возобновить</a>
                    @endif
                </div>
                <br>
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/summary">Сводная по проектам</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/contracts">Реестр договоров</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/contacts">Контакты</a>
                </div>
                <div class="row">
                    <a class="btn btn-outline btn-info" href="/production_plan">План производства</a>
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
