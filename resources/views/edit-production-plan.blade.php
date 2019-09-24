@extends('layouts.app')
@section('page-title')
    Создать план производства
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/edit-production-plan-submit" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$productionPlan->id}}">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="project_id">Проект</label>
                    <div class="col-sm-10">
                        <select name="project_id" id="project_id" class="form-control">
                            @foreach ($projects as $project)
                                <option value="{{$project->id}}" {{(int)$productionPlan->project_id === (int)$project->id ? 'selected' : ''}}>{{$project->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="month">Месяц</label>
                    <div class="col-sm-10">
                        <select name="month" id="month" class="form-control">
                            <option value="Январь" {{$productionPlan->month === 'Январь' ? 'selected' : ''}}>Январь</option>
                            <option value="Февраль" {{$productionPlan->month === 'Февраль' ? 'selected' : ''}}>Февраль</option>
                            <option value="Март" {{$productionPlan->month === 'Март' ? 'selected' : ''}}>Март</option>
                            <option value="Апрель" {{$productionPlan->month === 'Апрель' ? 'selected' : ''}}>Апрель</option>
                            <option value="Май" {{$productionPlan->month === 'Май' ? 'selected' : ''}}>Май</option>
                            <option value="Июнь" {{$productionPlan->month === 'Июнь' ? 'selected' : ''}}>Июнь</option>
                            <option value="Июль" {{$productionPlan->month === 'Июль' ? 'selected' : ''}}>Июль</option>
                            <option value="Август" {{$productionPlan->month === 'Август' ? 'selected' : ''}}>Август</option>
                            <option value="Сентябрь" {{$productionPlan->month === 'Сентябрь' ? 'selected' : ''}}>Сентябрь</option>
                            <option value="Октябрь" {{$productionPlan->month === 'Октябрь' ? 'selected' : ''}}>Октябрь</option>
                            <option value="Ноябрь" {{$productionPlan->month === 'Ноябрь' ? 'selected' : ''}}>Ноябрь</option>
                            <option value="Декабрь" {{$productionPlan->month === 'Декабрь' ? 'selected' : ''}}>Декабрь</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="region_id">Регион</label>
                    <div class="col-sm-10">
                        <select name="region_id" id="region_id" class="form-control">
                            @foreach ($regions as $region)
                                <option value="{{$region->id}}" {{(int)$productionPlan->region_id === (int)$region->id ? 'selected' : ''}}>{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="product_id">Оборудование</label>
                    <div class="col-sm-10">
                        <select name="product_id" id="product_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{$product->id}}" {{(int)$productionPlan->product_id === (int)$product->id ? 'selected' : ''}}>{{$product->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="rk_count">Количество РК</label>
                    <div class="col-sm-10">
                        <input type="number" id="rk_count" name="rk_count" value="{{$productionPlan->rk_count}}" placeholder="Количество РК"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="date_shipping">Дата отгрузки</label>
                    <div class="col-sm-10">
                        <input type="text" name="date_shipping" id="date_shipping" class="form-control fromto__datetime-input" value="{{$productionPlan->date_shipping}}" placeholder="Дата отгрузки">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="priority">Приоритет</label>
                    <div class="col-sm-10">
                        <select name="priority" id="priority" class="form-control">
                            <option value="Низкий" {{$productionPlan->priority === 'Низкий' ? 'selected' : ''}}>Низкий</option>
                            <option value="Средний" {{$productionPlan->priority === 'Средний' ? 'selected' : ''}}>Средний</option>
                            <option value="Высокий" {{$productionPlan->priority === 'Высокий' ? 'selected' : ''}}>Высокий</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Предварительный расчет оборудования</label>
                    @if (isset($productionPlan->preliminaryCalculation))<label class="col-sm-2 col-form-label">{{$productionPlan->preliminaryCalculation->file_name}}</label>@endif
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="preliminary_calculation_equipment">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Окончательный расчет оборудования</label>
                    @if (isset($productionPlan->finalCalculation))<label class="col-sm-2 col-form-label">{{$productionPlan->finalCalculation->file_name}}</label>@endif
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="final_calculation_equipment">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button type="submit" class="form-control" id="search">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
            });
        });
    </script>
@endsection
