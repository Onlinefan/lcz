@extends('layouts.app')
@section('page-title')
    Добавление/редактирование производства
@endsection
@section('content')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/jquery.datetimepicker.min.css')}}"/>
    <form method="POST" action="/create-data">
        {{csrf_field()}}
        <input type="hidden" name="complex_id" value="{{$production->complex_id}}">
        <input type="hidden" name="id" value="{{$production->id}}">
        <input type="hidden" name="table" value="App\Production">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="shipment_status">Статус отгрузки</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="shipment_status" id="shipment_status">
                                @foreach ($shipmentStatuses as $status)
                                    <option value="{{$status->id}}" {{isset($production->shipment_status) && $production->shipment_status === $status->id ? 'selected' : ''}}>{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_equipment_shipment">Дата отгрузки оборудования</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_equipment_shipment" name="date_equipment_shipment" value="{{isset($production->date_equipment_shipment) ? $production->date_equipment_shipment : ''}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="number_sim_internet">№ сим Internet (БУ)</label>
                        <div class="col-sm-10">
                            <input type="text" id="number_sim_internet" name="number_sim_internet" value="{{isset($production->number_sim_internet) ? $production->number_sim_internet : ''}}" placeholder="Введите номер" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="number_sim_ssu">№ сим SSU</label>
                        <div class="col-sm-10">
                            <input type="text" id="number_sim_ssu" name="number_sim_ssu" value="{{isset($production->number_sim_ssu) ? $production->number_sim_ssu : ''}}" placeholder="Введите номер" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="number_verification">№ поверки</label>
                        <div class="col-sm-10">
                            <input type="text" id="number_verification" name="number_verification" value="{{isset($production->number_verification) ? $production->number_verification : ''}}" placeholder="Введите номер" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="date_verification_end">Дата окончания поверки</label>
                        <div class="col-sm-10">
                            <input type="text" id="date_verification_end" name="date_verification_end" value="{{isset($production->date_verification_end) ? $production->date_verification_end : ''}}" placeholder="Введите дату" class="form-control fromto__datetime-input">
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
        })
    });
    </script>
@endsection
