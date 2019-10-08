@extends('layouts.app')
@section('page-title')
    Редактировать затраты
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/submit-cost" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$cost->id}}">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="plan_id">План затрат</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="plan_id" id="plan_id">
                                @foreach ($costPlans as $costPlan)
                                    <option value="{{$costPlan->id}}" {{(int)$costPlan->id === (int)$cost->plan_id ? 'selected' : ''}}>{{$costPlan->project->name}}/{{$costPlan->article}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_payment">Дата</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_payment" name="date_payment" value="{{$cost->date_payment}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="count">Сумма</label>
                        <div class="col-sm-10">
                            <input type="number" id="count" name="count" value="{{$cost->count}}" placeholder="Введите сумму" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="comment">Комментарий</label>
                        <div class="col-sm-10">
                            <input type="text" id="comment" name="comment" value="{{$cost->comment}}" placeholder="Введите комментарий" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="payment_method">Способ оплаты</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="payment_method" id="payment_method">
                                <option value="Наличный" {{$cost->payment_method === 'Наличный' ? 'selected' : ''}}>Наличный</option>
                                <option value="Безналичный" {{$cost->payment_method === 'Безналичный' ? 'selected' : ''}}>Безналичный</option>
                            </select>
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
