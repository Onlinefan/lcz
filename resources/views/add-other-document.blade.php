@extends('layouts.app')
@section('page-title')
    Добавить документ
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/create-other-document" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Проект</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="project_id">
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_contract">Дата договора</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_contract" name="date_contract" value="" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="type">Тип договора</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type">
                                <option value="Доп.соглашение к договору">Доп.соглашение к договору</option>
                                <option value="Договор (расходный)">Договор (расходный)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="number">Номер договора</label>
                        <div class="col-sm-10">
                            <input type="text" id="number" name="number" value="" placeholder="Введите номер договора" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="base">Основание</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="base">
                                <option value="Электричество">Электричество</option>
                                <option value="Опоры">Опоры</option>
                                <option value="Канал связи">Канал связи</option>
                                <option value="Логистика (грузчики)">Логистика (грузчики)</option>
                                <option value="Аренда склада">Аренда склада</option>
                                <option value="Транспорт">Транспорт</option>
                                <option value="Субподряд">Субподряд</option>
                                <option value="Доп.соглашение к договору">Доп.соглашение к договору</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="contractor">Контрагент</label>
                        <div class="col-sm-10">
                            <input type="text" id="contractor" name="contractor" value="" placeholder="Введите контрагента" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="contract">Контракт</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" id="contract" class="custom-file-input" name="contract">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            $(document).ready(function () {


                $.getScript('/js/datetimepicker/jquery.datetimepicker.js', function () {

                    $.datetimepicker.setLocale('ru');


                    $('.fromto__datetime-input').datetimepicker({
                        locale: 'ru',
                        timepicker: false,
                        format: 'Y-m-d',
                        formatDate: 'Y-m-d',
                        allowTimes: [
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
            });
        });
    </script>
@endsection
