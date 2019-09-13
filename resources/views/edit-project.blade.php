@extends('layouts.app')
@section('page-title')
    Редактирование проекта
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <form enctype="multipart/form-data" method="post" action="/edit-project-id">
                {{csrf_field()}}
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a class="nav-link active" data-toggle="tab" data-tab="1" href="#tab-1">Исходные данные по контракту</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="2" href="#tab-2">Продукт/Услуга</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="3" href="#tab-3">Исходные данные ЦАФАП</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="4" href="#tab-4">План производства</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="5" href="#tab-5">Контакты</a></li>
                </ul>
                <input type="hidden" name="Project[id]" value="{{$project->id}}">
                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер приказа</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[decree_number]" value="{{$project->contract->decree_number}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скан приказа</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->decreeScan->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[decree_scan]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус проекта</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[status]">
                                        <option value="Реализация" {{$project->status === 'Реализация' ? 'selected' : ''}}>Реализация</option>
                                        <option value="Эксплуатация" {{$project->status === 'Эксплуатация' ? 'selected' : ''}}>Эксплуатация</option>
                                        <option value="Завершен" {{$project->status === 'Завершен' ? 'selected' : ''}}>Завершен</option>
                                        <option value="Приостановлен" {{$project->status === 'Приостановлен' ? 'selected' : ''}}>Приостановлен</option>
                                        <option value="Прочее" {{$project->status === 'Прочее' ? 'selected' : ''}}>Прочее</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_start]" value="{{$project->contract->date_start}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата завершения контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_end]" value="{{$project->contract->date_end}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата подписания актов ввода в эксплуатацию</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_sign_acts]" value="{{$project->contract->date_sign_acts}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[number]" value="{{$project->contract->number}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Руководитель проекта</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[head_id]">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" {{$project->head->id === $user->id ? 'selected' : ''}}>{{$user->second_name . ' ' . $user->first_name . ' ' . $user->patronymic}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Контрагент</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[customer]" value="{{$project->contract->customer}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Наименование проекта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Project[name]" value="{{$project->name}}">
                                </div>
                            </div>

                            @foreach ($projectCountries as $projectCountry)
                                <div class="form-group row" data-block="country">
                                    <label class="col-sm-2 col-form-label">Округ</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="Country[]">
                                            @foreach ($countries as $country)
                                                <option value="{{$country->id}}" {{intval($projectCountry->country_id) === intval($country->id) ? 'selected' : ''}}>{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <button type="button" id="countyButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="countyButtonDelete" class="btn btn-white btn-sm {{$projectCountries->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="hr-line-dashed"></div>

                            @foreach ($projectRegions as $projectRegion)
                                <div class="form-group row" data-block="region">
                                    <label class="col-sm-2 col-form-label">Регион</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="Region[id][]">
                                            @foreach ($regions as $region)
                                                <option value="{{$region->id}}" {{$projectRegion->region_id === $region->id ? 'selected' : ''}}>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Количество адресов</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="Region[address_count][]" value="{{$projectRegion->address_count}}">
                                    </div>
                                </div>
                            @endforeach

                            <button type="button" id="regionButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="regionButtonDelete" class="btn btn-white btn-sm {{$projectRegions->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип услуги</label>
                                <div class="col-sm-10">
                                    @foreach ($serviceTypes as $serviceType)
                                        <div><label><input type="checkbox" name="ProjectServiceTypes[]" value="{{$serviceType->id}}"
                                                @foreach ($projectServiceTypes as $projectServiceType)
                                                    {{intval($projectServiceType->service_type_id) === $serviceType->id ? 'checked' : ''}}
                                                @endforeach> {{$serviceType->name}}</label></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ссылка на закупку</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[purchase_reference]" value="{{$project->contract->purchase_reference}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Условия обслуживания</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[service_terms]">
                                        <option value="Гарантийное" {{$project->contract->service_terms === 'Гарантийное' ? 'selected' : ''}}>Гарантийное</option>
                                        <option value="Аренда" {{$project->contract->service_terms === 'Аренда' ? 'selected' : ''}}>Аренда</option>
                                        <option value="Тех. обслуживание" {{$project->contract->service_terms === 'Тех. обслуживание' ? 'selected' : ''}}>Тех. обслуживание</option>
                                        <option value="От постановлений" {{$project->contract->service_terms === 'От постановлений' ? 'selected' : ''}}>От постановлений</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Роль ЛЦЗ по контракту</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[lcz_role]">
                                        <option value="Генподряд" {{$project->contract->lcz_role === 'Генподряд' ? 'selected' : ''}}>Генподряд</option>
                                        <option value="Субподряд" {{$project->contract->lcz_role === 'Субподряд' ? 'selected' : ''}}>Субподряд</option>
                                        <option value="Заказчик" {{$project->contract->lcz_role === 'Заказчик' ? 'selected' : ''}}>Заказчик</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[type]">
                                        <option value="Гос. контракт" {{$project->type === 'Гос. контракт' ? 'selected' : ''}}>Гос. контракт</option>
                                        <option value="Договор" {{$project->type === 'Договор' ? 'selected' : ''}}>Договор</option>
                                        <option value="ДС" {{$project->type === 'ДС' ? 'selected' : ''}}>ДС</option>
                                        <option value="Рамочный" {{$project->type === 'Рамочный' ? 'selected' : ''}}>Рамочный</option>
                                        <option value="Пилот" {{$project->type === 'Пилот' ? 'selected' : ''}}>Пилот</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статья договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[article]">
                                        <option value="Доходный" {{$project->type === 'Доходный' ? 'selected' : ''}}>Доходный</option>
                                        <option value="Расходный" {{$project->type === 'Расходный' ? 'selected' : ''}}>Расходный</option>
                                        <option value="Нулевой" {{$project->type === 'Нулевой' ? 'selected' : ''}}>Нулевой</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Сумма договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[amount]" value="{{$project->contract->amount}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус подписания договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[sign_status]">
                                        <option value="Подписан от ЛЦЗ" {{$project->contract->sign_status === 'Подписан от ЛЦЗ' ? 'selected' : ''}}>Подписан от ЛЦЗ</option>
                                        <option value="Подписан от Заказчика" {{$project->contract->sign_status === 'Подписан от Заказчика' ? 'selected' : ''}}>Подписан от Заказчика</option>
                                        <option value="Подписан с обеих сторон" {{$project->contract->sign_status === 'Подписан с обеих сторон' ? 'selected' : ''}}>Подписан с обеих сторон</option>
                                        <option value="Не подписан" {{$project->contract->sign_status === 'Не подписан' ? 'selected' : ''}}>Не подписан</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус оригинала</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[original_status]">
                                        <option value="Отсутствует" {{$project->contract->original_status === 'Отсутствует' ? 'selected' : ''}}>Отсутствует</option>
                                        <option value="Передан в бухгалтерию" {{$project->contract->original_status === 'Передан в бухгалтерию' ? 'selected' : ''}}>Передан в бухгалтерию</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Устав проекта</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->projectCharter->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[project_charter]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">План-график</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->planChart->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[plan_chart]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛОП</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->lopFile->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[lop]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛПП</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->lppFile->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[lpp]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛПП - Лист решений</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->lppListFile->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[decision_sheet]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Контракт</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->contractFile->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[file]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тех. задание</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->technicalTask->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[technical_task]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Анализ и управление рисками</label>
                                <label class="col-sm-2 col-form-label">{{$project->contract->riskFile->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[risks]">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Контрольные сроки по этапам</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Произвести оборудование до</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[equipment_produce]" value="{{$project->contract->equipment_produce}}">
                                </div>

                                <label class="col-sm-2 col-form-label">Крайняя дата поставки</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[equipment_supply]" value="{{$project->contract->equipment_supply}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[smr_start]" value="{{$project->contract->smr_start}}">
                                </div>

                                <label class="col-sm-2 col-form-label">СМР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[smr_end]" value="{{$project->contract->smr_end}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[installation_start]" value="{{$project->contract->installation_start}}">
                                </div>

                                <label class="col-sm-2 col-form-label">Монтаж завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[installation_end]" value="{{$project->contract->installation_end}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[pnr_start]" value="{{$project->contract->pnr_start}}">
                                </div>

                                <label class="col-sm-2 col-form-label">ПНР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[pnr_end]" value="{{$project->contract->pnr_end}}">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-2">Далее</a>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="tab-2" class="tab-pane">
                        <div class="panel-body">

                            <div class="hr-line-dashed"></div>
                            <h2>Тип дорог и количество</h2>
                            <div class="hr-line-dashed"></div>

                            @foreach ($projectRoads as $projectRoad)
                                <div class="form-group row" data-block="road">
                                    <label class="col-sm-2 col-form-label">Тип дороги</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="ProjectRoad[road_id][]">
                                            @foreach ($roadTypes as $roadType)
                                                <option value="{{$roadType->id}}" {{intval($projectRoad->road_id) === intval($roadType->id) ? 'selected' : ''}}>{{$roadType->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <label class="col-sm-2 col-form-label">Количество</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control" name="ProjectRoad[count][]" value="{{$projectRoad->count}}"}}>
                                    </div>
                                </div>
                            @endforeach

                            <button type="button" id="roadButtonAdd" class="btn btn-white btn-sm col-sm-offset-2">Добавить еще</button>
                            <button type="button" id="roadButtonDelete" class="btn btn-white btn-sm col-sm-offset-2 {{$projectRoads->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="hr-line-dashed"></div>
                            <h2>Оборудование на РК</h2>
                            <div class="hr-line-dashed"></div>

                            @foreach ($products as $product)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{$product->name}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ProjectProduct[count][]"
                                               @foreach ($projectProducts as $projectProduct)
                                                        @if (intval($projectProduct->product_id) === intval($product->id))
                                                            value="{{$projectProduct->count}}"
                                                        @endif
                                                   @endforeach>
                                        <input type="hidden" name="ProjectProduct[product_id][]" value="{{$product->id}}">
                                    </div>
                                </div>
                            @endforeach

                            <div class="hr-line-dashed"></div>
                            <h2>Зона ответственности</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Обследование</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[examination_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->examination === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->examination === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->examination === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->examination === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[examination_other]"
                                        @if ($project->responsibilityArea->examination !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->examination !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->examination !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->examination !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->examination}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[smr_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->smr === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->smr === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->smr === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->smr === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[smr_other]"
                                        @if ($project->responsibilityArea->smr !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->smr !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->smr !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->smr !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->smr}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[installation_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->installation === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->installation === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->installation === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->installation === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[installation_other]"
                                        @if ($project->responsibilityArea->installation !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->installation !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->installation !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->installation !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->installation}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[pnr_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->pnr === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->pnr === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->pnr === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->pnr === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[pnr_other]"
                                        @if ($project->responsibilityArea->pnr !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->pnr !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->pnr !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->pnr !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->pnr}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Разрешение на опору</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[support_permission_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->support_permission === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->support_permission === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->support_permission === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->support_permission === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[support_permission_other]"
                                        @if ($project->responsibilityArea->support_permission !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->support_permission !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->support_permission !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->support_permission !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->support_permission}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - 220 В</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[tu_220_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->tu_220 === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->tu_220 === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->tu_220 === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->tu_220 === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[tu_220_other]"
                                        @if ($project->responsibilityArea->tu_220 !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->tu_220 !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->tu_220 !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->tu_220 !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->tu_220}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - связь</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[tu_communication_main]">
                                        <option value="ЛЦЗ" {{$project->responsibilityArea->tu_communication === 'ЛЦЗ' ? 'selected' : ''}}>ЛЦЗ</option>
                                        <option value="Гос.заказчик" {{$project->responsibilityArea->tu_communication === 'Гос.заказчик' ? 'selected' : ''}}>Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)" {{$project->responsibilityArea->tu_communication === 'Партнер (Ген.подрядчик)' ? 'selected' : ''}}>Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ" {{$project->responsibilityArea->tu_communication === 'Подрядчик ЛЦЗ' ? 'selected' : ''}}>Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[tu_communication_other]"
                                        @if ($project->responsibilityArea->tu_communication !== 'ЛЦЗ' &&
                                            $project->responsibilityArea->tu_communication !== 'Гос.заказчик' &&
                                            $project->responsibilityArea->tu_communication !== 'Партнер (Ген.подрядчик)' &&
                                            $project->responsibilityArea->tu_communication !== 'Подрядчик ЛЦЗ')
                                            value="{{$project->responsibilityArea->tu_communication}}"
                                        @endif>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-3">Далее</a>
                                    <a class="btn btn-white btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-1">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Схема передачи данных</label>
                                <label class="col-sm-2 col-form-label">{{$project->cafap->dataTransfer->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Cafap[data_transfer_scheme]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дислокация и направления</label>
                                <label class="col-sm-2 col-form-label">{{$project->cafap->locationDirections->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Cafap[location_directions]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скоростной режим</label>
                                <label class="col-sm-2 col-form-label">{{$project->cafap->speedMode->file_name}}</label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Cafap[speed_mode]">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Коллаж</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Согласованный коллаж<br>
                                    <small class="text-navy">Ctrl для множественного выбора</small>
                                </label>

                                <label class="col-sm-2 col-form-label">
                                    @foreach ($project->cafap->cafapCollage as $collage)
                                        <small class="text-navy">{{$collage->collageFile->file_name}}</small>
                                    @endforeach
                                </label>
                                <div class="col-sm-8">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" multiple name="CafapCollage[]">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>ПО в ЦАФАП</h2>
                            <div class="hr-line-dashed"></div>

                            @foreach ($project->cafap->cafapRegions as $cafapRegion)
                                <div class="form-group row" data-block="cafap-region">
                                    <label class="col-sm-2 col-form-label">Регион</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="CafapRegion[]">
                                            @foreach ($regions as $region)
                                                <option value="{{$region->id}}" {{intval($cafapRegion->region_id) === intval($region->id) ? 'selected' : ''}}>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            <button type="button" id="cafap-region" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="cafap-regionDelete" class="btn btn-white btn-sm {{$project->cafap->cafapRegions->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="hr-line-dashed"></div>
                            <h2>Наличие Андромеды</h2>
                            <div class="hr-line-dashed"></div>

                            @foreach ($project->cafap->cafapAndromeda as $andromeda)
                                <div class="form-group row" data-block="cafap-andromeda">
                                    <label class="col-sm-2 col-form-label">Регион</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="CafapAndromedaExist[region_id][]">
                                            @foreach ($regions as $region)
                                                <option value="{{$region->id}}" {{intval($andromeda->region_id) === intval($region->id) ? 'selected' : ''}}>{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <label class="col-sm-2 col-form-label">Наличие</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="CafapAndromedaExist[exist][]">
                                            <option value="0" {{intval($andromeda->exist) === 0 ? 'selected' : ''}}>Отсутствует</option>
                                            <option value="1" {{intval($andromeda->exist) === 1 ? 'selected' : ''}}>Имеется</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                            <button type="button" id="andromeda-region" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="andromeda-regionDelete" class="btn btn-white btn-sm {{$project->cafap->cafapAndromeda->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-4">Далее</a>
                                    <a class="btn btn-white btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-2">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            @foreach ($project->productionPlan as $plan)
                                <div data-block="production-plan">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Месяц</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="ProductionPlan[month][]">
                                                <option {{$plan->month === 'Январь' ? 'selected' : ''}}>Январь</option>
                                                <option {{$plan->month === 'Февраль' ? 'selected' : ''}}>Февраль</option>
                                                <option {{$plan->month === 'Март' ? 'selected' : ''}}>Март</option>
                                                <option {{$plan->month === 'Апрель' ? 'selected' : ''}}>Апрель</option>
                                                <option {{$plan->month === 'Май' ? 'selected' : ''}}>Май</option>
                                                <option {{$plan->month === 'Июнь' ? 'selected' : ''}}>Июнь</option>
                                                <option {{$plan->month === 'Июль' ? 'selected' : ''}}>Июль</option>
                                                <option {{$plan->month === 'Август' ? 'selected' : ''}}>Август</option>
                                                <option {{$plan->month === 'Сентябрь' ? 'selected' : ''}}>Сентябрь</option>
                                                <option {{$plan->month === 'Октябрь' ? 'selected' : ''}}>Октябрь</option>
                                                <option {{$plan->month === 'Ноябрь' ? 'selected' : ''}}>Ноябрь</option>
                                                <option {{$plan->month === 'Декабрь' ? 'selected' : ''}}>Декабрь</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Регион</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="ProductionPlan[region_id][]">
                                                @foreach ($regions as $region)
                                                    <option value="{{$region->id}}" {{intval($plan->region_id) === intval($region->id) ? 'selected' : ''}}>{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Оборудование</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="ProductionPlan[product_id][]">
                                                @foreach ($products as $product)
                                                    <option value="{{$product->id}}" {{intval($plan->product_id) === intval($product->id) ? 'selected' : ''}}>{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Количество РК</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="ProductionPlan[rk_count][]" value="{{$plan->rk_count}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Дата отгрузки</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control fromto__datetime-input" name="ProductionPlan[date_shipping][]" value="{{$plan->date_shipping}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Приоритет</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" name="ProductionPlan[priority][]">
                                                @for ($priority = 1; $priority <= 10; $priority++)
                                                    <option value="{{$priority}}" {{intval($plan->priority) === intval($priority) ? 'selected' : ''}}>{{$priority}}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Загрузить предварительный расчет оборудования </label>
                                        <label class="col-sm-2 col-form-label">{{$plan->preliminaryCalculation->file_name}}</label>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="ProductionPlan[preliminary_calculation_equipment][]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Загрузить окончательный расчет оборудования</label>
                                        <label class="col-sm-2 col-form-label">{{$plan->finalCalculation->file_name}}</label>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="ProductionPlan[final_equipment_calculation][]">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                </div>
                            @endforeach

                            <button type="button" id="production-plan" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="production-planDelete" class="btn btn-white btn-sm {{$project->productionPlan->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btn-primary btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-5">Далее</a>
                                    <a class="btn btn-white btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-3">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div role="tabpanel" id="tab-5" class="tab-pane">
                        <div class="panel-body">
                            @foreach ($project->contacts as $contact)
                                <div data-block="contacts">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">ФИО</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[fio][]" value="{{$contact->contact->fio}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Должность</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[position][]" value="{{$contact->contact->position}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Мобильный телефон</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" data-mask="+9(999)999-99-99" name="Contacts[mobile_number][]" value="{{$contact->contact->mobile_number}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Рабочий телефон</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[work_number][]" value="{{$contact->contact->work_number}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[email][]" value="{{$contact->contact->email}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Адрес</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[address][]" value="{{$contact->contact->address}}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Организация</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="Contacts[company][]" value="{{$contact->contact->company}}">
                                        </div>
                                    </div>

                                    <div class="hr-line-dashed"></div>
                                </div>
                            @endforeach
                            <button type="button" id="contacts" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="contactsDelete" class="btn btn-white btn-sm {{$project->contacts->count() > 1 ? '' : 'hidden'}}">Удалить</button>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <a class="btn btn-white btn-sm" data-toggle="tab" aria-expanded="false" href="#tab-4">Назад</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Page-Level Scripts -->

    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function() {
                $.getScript('/js/datetimepicker/jquery.datetimepicker.js', function () {

                    $.datetimepicker.setLocale('ru');

                    $('.fromto__datetime-input').datetimepicker({
                        locale:'ru',
                        timepicker: false,
                        format:'Y-m-d',
                        formatDate:'Y-m-d',
                        allowTimes:[
                            '00:00',
                            '00:30',
                            '01:00',
                            '01:30',
                            '02:00',
                            '02:30',
                            '03:00',
                            '03:30',
                            '04:00',
                            '04:30',
                            '05:00',
                            '05:30',
                            '06:00',
                            '06:30',
                            '07:00',
                            '07:30',
                            '08:00',
                            '08:30',
                            '09:00',
                            '09:30',
                            '10:00',
                            '10:30',
                            '11:00',
                            '11:30',
                            '12:00',
                            '12:30',
                            '13:00',
                            '13:30',
                            '14:00',
                            '14:30',
                            '15:00',
                            '15:30',
                            '16:00',
                            '16:30',
                            '17:00',
                            '17:30',
                            '18:00',
                            '18:30',
                            '19:00',
                            '19:30',
                            '20:00',
                            '20:30',
                            '21:00',
                            '21:30',
                            '22:00',
                            '22:30',
                            '23:00',
                            '23:30',
                            '23:59',
                        ],

                    });
                });

                var countryEl = [];
                var regionEl = [];
                var cafapEl = [];
                var andromedaEl = [];
                var roadEl = [];
                var productionEl = [];
                var contactsEl = [];

                $('div[data-block="country"]').each(function (elem) {
                    countryEl.push($(this))
                });

                $('div[data-block="region"]').each(function (elem) {
                    regionEl.push($(this))
                });

                $('div[data-block="road"]').each(function (elem) {
                    roadEl.push($(this))
                });

                $('div[data-block="cafap-region"]').each(function (elem) {
                    cafapEl.push($(this))
                });

                $('div[data-block="cafap-andromeda"]').each(function (elem) {
                    andromedaEl.push($(this))
                });

                $('div[data-block="production-plan"]').each(function (elem) {
                    productionEl.push($(this))
                });

                $('div[data-block="contacts"]').each(function (elem) {
                    contactsEl.push($(this))
                });

                $('#countyButtonAdd').on('click', function () {
                    countryEl.push($(this).prev().clone().val(''));
                    countryEl[countryEl.length-1].insertBefore($(this));
                    $('#countyButtonDelete').removeClass('hidden');
                });
                $('#regionButtonAdd').on('click', function () {
                    regionEl.push($(this).prev().clone().val(''));
                    regionEl[regionEl.length-1].insertBefore($(this));
                    $('#regionButtonDelete').removeClass('hidden');
                });
                $('#cafap-region').on('click', function () {
                    cafapEl.push($(this).prev().clone().val(''));
                    cafapEl[cafapEl.length-1].insertBefore($(this));
                    $('#cafap-regionDelete').removeClass('hidden');
                });
                $('#andromeda-region').on('click', function () {
                    andromedaEl.push($(this).prev().clone().val(''));
                    andromedaEl[andromedaEl.length-1].insertBefore($(this));
                    $('#andromeda-regionDelete').removeClass('hidden');
                });
                $('#roadButtonAdd').on('click', function () {
                    roadEl.push($(this).prev().clone().val(''));
                    roadEl[roadEl.length-1].insertBefore($(this));
                    $('#roadButtonDelete').removeClass('hidden');
                });
                $('#production-plan').on('click', function () {
                    productionEl.push($(this).prev().clone().val(''));
                    productionEl[productionEl.length-1].insertBefore($(this));
                    $('#production-planDelete').removeClass('hidden');
                });
                $('#contacts').on('click', function () {
                    contactsEl.push($(this).prev().clone().val(''));
                    contactsEl[contactsEl.length-1].insertBefore($(this));
                    $('#contactsDelete').removeClass('hidden');
                });

                $('#countyButtonDelete').on('click', function () {
                    $(countryEl[countryEl.length-1]).remove();
                    countryEl.pop();
                    if (countryEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#regionButtonDelete').on('click', function () {
                    $(regionEl[regionEl.length-1]).remove();
                    regionEl.pop();
                    if (regionEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#cafap-regionDelete').on('click', function () {
                    $(cafapEl[cafapEl.length-1]).remove();
                    cafapEl.pop();
                    if (cafapEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#andromeda-regionDelete').on('click', function () {
                    $(andromedaEl[andromedaEl.length-1]).remove();
                    andromedaEl.pop();
                    if (andromedaEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#roadButtonDelete').on('click', function () {
                    $(roadEl[roadEl.length-1]).remove();
                    roadEl.pop();
                    if (roadEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#production-planDelete').on('click', function () {
                    $(productionEl[productionEl.length-1]).remove();
                    productionEl.pop();
                    if (productionEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });
                $('#contactsDelete').on('click', function () {
                    $(contactsEl[contactsEl.length-1]).remove();
                    contactsEl.pop();
                    if (contactsEl.length === 1) {
                        $(this).addClass('hidden');
                    }
                });

                $('div.col-sm-4 a.btn.btn-primary.btn-sm').on('click', function () {
                    var tab = $('.nav-tabs').find('li.active');
                    var dataTab = $(tab).children('a.nav-link').attr('data-tab');
                    var nextTab = $($('.nav-tabs li')[dataTab]);
                    $(tab).removeClass('active');
                    $(nextTab).addClass('active');
                });

                $('div.col-sm-4 a.btn.btn-white.btn-sm').on('click', function () {
                    var tab = $('.nav-tabs').find('li.active');
                    var dataTab = $(tab).children('a.nav-link').attr('data-tab');
                    var nextTab = $($('.nav-tabs li')[parseInt(dataTab) - 2]);
                    $(tab).removeClass('active');
                    $(nextTab).addClass('active');
                });
            });
        });
    </script>

@endsection
