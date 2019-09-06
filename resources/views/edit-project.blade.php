@extends('layouts.app')
@section('page-title')
    @if (isset($_GET['id']))
        Редактирование проекта
    @else
        Создание проекта
    @endif
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <form enctype="multipart/form-data" method="post" action="/add-project">
                {{csrf_field()}}
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a class="nav-link active" data-toggle="tab" data-tab="1" href="#tab-1">Исходные данные по контракту</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="2" href="#tab-2">Продукт/Услуга</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="3" href="#tab-3">Исходные данные ЦАФАП</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="4" href="#tab-4">План производства</a></li>
                    <li><a class="nav-link" data-toggle="tab" data-tab="5" href="#tab-5">Контакты</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер приказа</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[decree_number]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скан приказа</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[decree_scan]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус проекта</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[status]">
                                        <option value="Реализация">Реализация</option>
                                        <option value="Эксплуатация">Эксплуатация</option>
                                        <option value="Завершен">Завершен</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_start]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата завершения контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_end]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата подписания актов ввода в эксплуатацию</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[date_sign_acts]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[number]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Руководитель проекта</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[head_id]">
                                        @foreach ($users as $user)
                                            <option value="{{$user->id}}" {{auth()->user()->id === $user->id ? 'selected' : ''}}>{{$user->second_name . ' ' . $user->first_name . ' ' . $user->patronymic}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Контрагент</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[customer]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Наименование проекта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Project[name]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Округ</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Country[]">
                                        @foreach ($countries as $country)
                                            <option value="{{$country->id}}">{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="button" id="countyButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="countyButtonDelete" class="btn btn-white btn-sm hidden">Удалить</button>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Region[]">
                                        @foreach ($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="button" id="regionButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="regionButtonDelete" class="btn btn-white btn-sm hidden">Удалить</button>

                            <div class="hr-line-dashed"></div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип услуги</label>
                                <div class="col-sm-10">
                                    @foreach ($serviceTypes as $serviceType)
                                        <div><label><input type="checkbox" name="ProjectServiceTypes[]" value="{{$serviceType->id}}"> {{$serviceType->name}}</label></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ссылка на закупку</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[purchase_reference]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Условия обслуживания</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[service_terms]">
                                        <option value="Гарантийное">Гарантийное</option>
                                        <option value="Аренда">Аренда</option>
                                        <option value="Тех. обслуживание">Тех. обслуживание</option>
                                        <option value="От постановлений">От постановлений</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Роль ЛЦЗ по контракту</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[lcz_role]">
                                        <option value="Генподряд">Генподряд</option>
                                        <option value="Субподряд">Субподряд</option>
                                        <option value="Заказчик">Заказчик</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Project[type]">
                                        <option value="Гос. контракт">Гос. контракт</option>
                                        <option value="Договор">Договор</option>
                                        <option value="ДС">ДС</option>
                                        <option value="Рамочный">Рамочный</option>
                                        <option value="Пилот">Пилот</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статья договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[article]">
                                        <option value="Доходный">Доходный</option>
                                        <option value="Расходный">Расходный</option>
                                        <option value="Нулевой">Нулевой</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Сумма договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="Contract[amount]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус подписания договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[sign_status]">
                                        <option value="Подписан от ЛЦЗ">Подписан от ЛЦЗ</option>
                                        <option value="Подписан от Заказчика">Подписан от Заказчика</option>
                                        <option value="Подписан с обеих сторон">Подписан с обеих сторон</option>
                                        <option value="Не подписан">Не подписан</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус оригинала</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="Contract[original_status]">
                                        <option value="Отсутствует">Отсутствует</option>
                                        <option value="Передан в бухгалтерию">Передан в бухгалтерию</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Устав проекта</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[project_charter]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">План-график</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[plan_chart]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛОП</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[lop]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛПП</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[lpp]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛПП - Лист решений</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[decision_sheet]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Контракт</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[file]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тех. задание</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Contract[technical_task]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Анализ и управление рисками</label>
                                <div class="col-sm-10">
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
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[equipment_produce]">
                                </div>

                                <label class="col-sm-2 col-form-label">Крайняя дата поставки</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[equipment_supply]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[smr_start]">
                                </div>

                                <label class="col-sm-2 col-form-label">СМР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[smr_end]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[installation_start]">
                                </div>

                                <label class="col-sm-2 col-form-label">Монтаж завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[installation_end]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[pnr_start]">
                                </div>

                                <label class="col-sm-2 col-form-label">ПНР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control fromto__datetime-input" name="Contract[pnr_end]">
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

                            <div class="form-group row" id="road-group1">
                                <label class="col-sm-2 col-form-label">Тип дороги</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectRoad[road_id][]">
                                        @foreach ($roadTypes as $roadType)
                                            <option value="{{$roadType->id}}">{{$roadType->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Количество</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="ProjectRoad[count][]">
                                </div>
                            </div>

                            <button type="button" id="roadButtonAdd" class="btn btn-white btn-sm col-sm-offset-2">Добавить еще</button>
                            <button type="button" id="roadButtonDelete" class="btn btn-white btn-sm col-sm-offset-2 hidden">Удалить</button>

                            <div class="hr-line-dashed"></div>
                            <h2>Оборудование на РК</h2>
                            <div class="hr-line-dashed"></div>

                            @foreach ($products as $product)
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">{{$product->name}}</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ProjectProduct[count][]" value="0">
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
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[examination_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[smr_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                     </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[smr_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[installation_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[installation_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[pnr_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[pnr_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Разрешение на опору</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[support_permission_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[support_permission_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - 220 В</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[tu_220_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[tu_220_other]">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - связь</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="ProjectResponsibility[tu_communication_main]">
                                        <option value="ЛЦЗ">ЛЦЗ</option>
                                        <option value="Гос.заказчик">Гос.заказчик</option>
                                        <option value="Партнер (Ген.подрядчик)">Партнер (Ген.подрядчик)</option>
                                        <option value="Подрядчик ЛЦЗ">Подрядчик ЛЦЗ</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="ProjectResponsibility[tu_communication_other]">
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
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Cafap[data_transfer_scheme]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дислокация и направления</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="Cafap[location_directions]">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скоростной режим</label>
                                <div class="col-sm-10">
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
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" multiple name="CafapCollage[]">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>ПО в ЦАФАП</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="CafapRegion[]">
                                        @foreach ($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="button" id="cafap-region" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="cafap-regionDelete" class="btn btn-white btn-sm hidden">Удалить</button>

                            <div class="hr-line-dashed"></div>
                            <h2>Наличие Андромеды</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="CafapAndromedaExist[region_id][]">
                                        @foreach ($regions as $region)
                                            <option value="{{$region->id}}">{{$region->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <label class="col-sm-2 col-form-label">Наличие</label>
                                <div class="col-sm-4">
                                    <select class="form-control" name="CafapAndromedaExist[exist][]">
                                        <option value="0">Отсутствует</option>
                                        <option value="1">Имеется</option>
                                    </select>
                                </div>
                            </div>
                            <button type="button" id="andromeda-region" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="andromeda-regionDelete" class="btn btn-white btn-sm hidden">Удалить</button>

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
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Месяц</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ProductionPlan[month][]">
                                            <option>Январь</option>
                                            <option>Февраль</option>
                                            <option>Март</option>
                                            <option>Апрель</option>
                                            <option>Май</option>
                                            <option>Июнь</option>
                                            <option>Июль</option>
                                            <option>Август</option>
                                            <option>Сентябрь</option>
                                            <option>Октябрь</option>
                                            <option>Ноябрь</option>
                                            <option>Декабрь</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Регион</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ProductionPlan[region_id][]">
                                            @foreach ($regions as $region)
                                                <option value="{{$region->id}}">{{$region->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Оборудование</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ProductionPlan[product_id][]">
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Количество РК</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="ProductionPlan[rk_count][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Дата отгрузки</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control fromto__datetime-input" name="ProductionPlan[date_shipping][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Приоритет</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="ProductionPlan[priority][]">
                                            @for ($priority = 1; $priority <= 10; $priority++)
                                                <option value="{{$priority}}">{{$priority}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Загрузить предварительный расчет оборудования </label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="ProductionPlan[preliminary_calculation_equipment][]">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Загрузить окончательный расчет оборудования</label>
                                    <div class="col-sm-10">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="ProductionPlan[final_equipment_calculation][]">
                                        </div>
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                            </div>

                            <button type="button" id="production-plan" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="production-planDelete" class="btn btn-white btn-sm hidden">Удалить</button>

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
                            <div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">ФИО</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[fio][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Должность</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[position][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Мобильный телефон</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" data-mask="+9(999)999-99-99" name="Contacts[mobile_number][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Рабочий телефон</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[work_number][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[email][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Адрес</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[address][]">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Организация</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="Contacts[company][]">
                                    </div>
                                </div>

                                <div class="hr-line-dashed"></div>
                            </div>
                            <button type="button" id="contacts" class="btn btn-white btn-sm">Добавить еще</button>
                            <button type="button" id="contactsDelete" class="btn btn-white btn-sm hidden">Удалить</button>

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
        window.addEventListener('DOMContentLoaded', function(){;
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
                    if (countryEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#regionButtonDelete').on('click', function () {
                    $(regionEl[regionEl.length-1]).remove();
                    regionEl.pop();
                    if (regionEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#cafap-regionDelete').on('click', function () {
                    $(cafapEl[cafapEl.length-1]).remove();
                    cafapEl.pop();
                    if (cafapEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#andromeda-regionDelete').on('click', function () {
                    $(andromedaEl[andromedaEl.length-1]).remove();
                    andromedaEl.pop();
                    if (andromedaEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#roadButtonDelete').on('click', function () {
                    $(roadEl[roadEl.length-1]).remove();
                    roadEl.pop();
                    if (roadEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#production-planDelete').on('click', function () {
                    $(productionEl[productionEl.length-1]).remove();
                    productionEl.pop();
                    if (productionEl.length === 0) {
                        $(this).addClass('hidden');
                    }
                });
                $('#contactsDelete').on('click', function () {
                    $(contactsEl[contactsEl.length-1]).remove();
                    contactsEl.pop();
                    if (contactsEl.length === 0) {
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
