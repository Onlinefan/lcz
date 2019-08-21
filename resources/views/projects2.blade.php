@extends('layouts.app')
@section('page-title')
    Создание/редактирование проекта
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Исходные данные по контракту</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Исходные данные Продукт/Услуга</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Исходные данные ЦАФАП</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-4">План производства</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Контакты</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <form enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер приказа</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скан приказа</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус проекта</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Реализация</option>
                                        <option>Эксплуатация</option>
                                        <option>Завершен</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата завершения контракта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата подписания актов ввода в эксплуатацию</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Руководитель проекта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Заказчик по контракту</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Наименование проекта</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Округ</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control m-b">
                                    <button type="button" id="countyButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control m-b">
                                    <button type="button" id="regionButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип услуги</label>
                                <div class="col-sm-10">
                                    <div><label><input type="checkbox"> Поставка</label></div>
                                    <div><label><input type="checkbox"> СМР</label></div>
                                    <div><label><input type="checkbox"> ПНР</label></div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Ссылка на закупку</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Условия обслуживания</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Гарантийное</option>
                                        <option>Аренда</option>
                                        <option>Тех. обслуживание</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Роль ЛЦЗ по контракту</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Генподряд</option>
                                        <option>Субподряд</option>
                                        <option>Заказчик</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Гос. контракт</option>
                                        <option>Договор</option>
                                        <option>ДС</option>
                                        <option>Рамочный</option>
                                        <option>Пилот</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статья договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Доходный</option>
                                        <option>Расходный</option>
                                        <option>Нулевой</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Сумма договора</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус подписания договора</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Подписан от ЛЦЗ</option>
                                        <option>Подписан от Заказчика</option>
                                        <option>Подписан с обеих сторон</option>
                                        <option>Не подписан</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус оригинала</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Отсутствует</option>
                                        <option>Передан в бухгалтерию</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Устав проекта</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">План-график</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛОП</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ЛПП</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Контракт</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тех. задание</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Риски</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Контрольные сроки по этапам</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Произвести оборудование до</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>

                                <label class="col-sm-2 col-form-label">Крайняя дата поставки</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>

                                <label class="col-sm-2 col-form-label">СМР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>

                                <label class="col-sm-2 col-form-label">Монтаж завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР начать не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>

                                <label class="col-sm-2 col-form-label">ПНР завершить не позднее</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <form>
                            <h2>Тип работ по контракту</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Оборудование<br>
                                    <small class="text-navy">Ctrl для множественного выбора</small>
                                </label>
                                <div class="col-sm-10">
                                    <div class="col-lg-5">
                                        <select class="form-control" multiple="" size="7">
                                            <option>Птолемей</option>
                                            <option>Декарт</option>
                                            <option>Коперник-С</option>
                                            <option>Коперник-П</option>
                                            <option>Архимед</option>
                                            <option>Лобачевский</option>
                                            <option>Иное</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Тип дорог и количество</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип дороги</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>Линейный</option>
                                        <option>Перекресток</option>
                                        <option>Пешеход</option>
                                        <option>ЖД переезд</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Количество</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <button type="button" id="roadButtonAdd" class="btn btn-white btn-sm col-sm-offset-2">Добавить еще</button>

                            <div class="hr-line-dashed"></div>
                            <h2>Тип продукта и количество оборудования</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Птолемей (РК)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Декарт (РК)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Копернеик (стационар)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Коперник (пережвижной)</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Лобачевский</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Архимед</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Андромеда</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Зона ответственности</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Обследование</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">СМР</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Монтаж</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ПНР</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Разрешение на опору</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - 220 В</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Получение ТУ - связь</label>
                                <div class="col-sm-4">
                                    <select class="form-control">
                                        <option>ЛЦЗ</option>
                                        <option>Гос.заказчик</option>
                                        <option>Партнер (Ген.подрядчик)</option>
                                        <option>Подрядчик ЛЦЗ</option>
                                        <option>Иное</option>
                                    </select>
                                </div>

                                <label class="col-sm-2 col-form-label">Иное</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <form enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Схема передачи данных</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дислокация и направления</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Скоростной режим</label>
                                <div class="col-sm-10">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input">
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
                                        <input type="file" class="custom-file-input" multiple>
                                    </div>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>ЦО в ЦАФАП</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control m-b">
                                    <button type="button" id="region2ButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>
                            <h2>Наличие Андромеды</h2>
                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Регион</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control m-b">
                                    <button type="button" id="region3ButtonAdd" class="btn btn-white btn-sm">Добавить еще</button>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" id="tab-4" class="tab-pane">
                    <div class="panel-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Месяц</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
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
                                    <select class="form-control">
                                        <option>Регион 1</option>
                                        <option>Регион 2</option>
                                        <option>Регион 3</option>
                                        <option>Регион 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Оборудование</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Оборудование 1</option>
                                        <option>Оборудование 2</option>
                                        <option>Оборудование 3</option>
                                        <option>Оборудование 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Количество РК</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата отгрузки</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Приоритет</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Приоритет 1</option>
                                        <option>Приоритет 2</option>
                                        <option>Приоритет 3</option>
                                        <option>Приоритет 4</option>
                                    </select>
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div role="tabpanel" id="tab-5" class="tab-pane">
                    <div class="panel-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">ФИО</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Должность</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Мобильный телефон</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="+9(999)999-99-99">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Рабочий телефон</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">E-mail</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Адрес</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Организация</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function() {
                $('#countyButtonAdd, #regionButtonAdd, #region2ButtonAdd, #region3ButtonAdd, #roadButtonAdd').on('click', function () {
                    $(this).prev().clone().val('').insertBefore($(this));
                });
            });
        });
    </script>

@endsection
