@extends('layouts.app')
@section('page-title')
    Редактировать поступление
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/submit-income" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$income->id}}">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="plan_id">План поступлений</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="plan_id" id="plan_id">
                                @foreach ($incomePlans as $plan)
                                    <option value="{{$plan->id}}" {{(int)$income->plan_id === (int)$plan->id ? 'selected' : ''}}>{{$plan->project->name}}/{{$plan->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="document_number">Номер счета</label>
                        <div class="col-sm-10">
                            <input type="text" id="document_number" name="document_number" value="{{$income->document_number}}" placeholder="Введите номер счета" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_document">Дата счета</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_document" name="date_document" value="{{$income->date_document}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_payment">Дата оплаты</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_payment" name="date_payment" value="{{$income->date_payment}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="count">Сумма</label>
                        <div class="col-sm-10">
                            <input type="number" id="count" name="count" value="{{$income->count}}" placeholder="Введите сумму" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="payment_status">Статус</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="payment_status" id="payment_status">
                                <option value="Не выставлен" {{$income->payment_status === 'Не выставлен' ? 'selected' : ''}}>Не выставлен</option>
                                <option value="Выставлен" {{$income->payment_status === 'Выставлен' ? 'selected' : ''}}>Выставлен</option>
                                <option value="Оплачен" {{$income->payment_status === 'Оплачен' ? 'selected' : ''}}>Оплачен</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="document">Скан счета</label>
                        @if (isset($income->documentFile))
                            <label class="col-sm-2 col-form-label" for="document">{{$income->documentFile->file_name}}</label>
                        @endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" id="document" class="custom-file-input" name="document">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="closed_document">Закрывающий документ</label>
                        @if (isset($income->closedDocumentFile))
                            <label class="col-sm-2 col-form-label" for="closed_document">{{$income->closedDocumentFile->file_name}}</label>
                        @endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" id="closed_document" class="custom-file-input" name="closed_document">
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
