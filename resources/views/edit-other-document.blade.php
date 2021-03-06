@extends('layouts.app')
@section('page-title')
    Добавить документ
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/submit-other-document" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$document->id}}">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Проект</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="project_id">
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}" {{(int)$document->project_id === (int)$project->id ? 'selected' : ''}}>{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_contract">Дата договора</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_contract" name="date_contract" value="{{$document->date_contract}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="type">Тип договора</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="type">
                                <option value="Доп.соглашение к договору" {{$document->type === 'Доп.соглашение к договору' ? 'selected' : ''}}>Доп.соглашение к договору</option>
                                <option value="Договор (расходный)" {{$document->type === 'Договор (расходный)' ? 'selected' : ''}}>Договор (расходный)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="number">Номер договора</label>
                        <div class="col-sm-10">
                            <input type="text" id="number" name="number" value="{{$document->number}}" placeholder="Введите номер договора" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="base">Основание</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="base">
                                <option value="Электричество" {{$document->base === 'Электричество' ? 'selected' : ''}}>Электричество</option>
                                <option value="Опоры" {{$document->base === 'Опоры' ? 'selected' : ''}}>Опоры</option>
                                <option value="Канал связи" {{$document->base === 'Канал связи' ? 'selected' : ''}}>Канал связи</option>
                                <option value="Логистика (грузчики)" {{$document->base === 'Логистика (грузчики)' ? 'selected' : ''}}>Логистика (грузчики)</option>
                                <option value="Аренда склада" {{$document->base === 'Аренда склада' ? 'selected' : ''}}>Аренда склада</option>
                                <option value="Транспорт" {{$document->base === 'Транспорт' ? 'selected' : ''}}>Транспорт</option>
                                <option value="Субподряд" {{$document->base === 'Субподряд' ? 'selected' : ''}}>Субподряд</option>
                                <option value="Доп.соглашение к договору" {{$document->base === 'Доп.соглашение к договору' ? 'selected' : ''}}>Доп.соглашение к договору</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="contractor">Контрагент</label>
                        <div class="col-sm-10">
                            <input type="text" id="contractor" name="contractor" value="{{$document->contractor}}" placeholder="Введите контрагента" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="contract">Контракт</label>
                        @if (isset($document->contractFile))
                            <label class="col-sm-2 col-form-label" for="contract">{{$document->contractFile->file_name}}</label>
                        @endif
                        <div class="col-sm-8">
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
