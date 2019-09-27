@extends('layouts.app')
@section('page-title')
    Редактирование контакта
@endsection
@section('content')
    <form method="POST" action="/submit-contact/{{$contact->id}}">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="fio">ФИО</label>
                    <div class="col-sm-10">
                        <input type="text" id="fio" name="fio" value="{{$contact->name}}" placeholder="Введите ФИО"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="position">Должность</label>
                    <div class="col-sm-10">
                        <input type="text" id="position" name="position" value="{{$contact->position}}" placeholder="Введите должность"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="mobile_number">Мобильный телефон</label>
                    <div class="col-sm-10">
                        <input type="text" data-mask="+9(999)999-99-99" id="mobile_number" name="mobile_number" value="{{$contact->mobile_number}}" placeholder="Введите мобильный телефон"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="work_number">Рабочий телефон</label>
                    <div class="col-sm-10">
                        <input type="text" id="work_number" name="work_number" value="{{$contact->work_number}}" placeholder="Введите рабочий телефон"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="email">E-mail</label>
                    <div class="col-sm-10">
                        <input type="text" id="email" name="email" value="{{$contact->email}}" placeholder="Введите email"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="address">Адрес</label>
                    <div class="col-sm-10">
                        <input type="text" id="address" name="address" value="{{$contact->address}}" placeholder="Введите адрес"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="company">Организация</label>
                    <div class="col-sm-10">
                        <input type="text" id="company" name="company" value="{{$contact->company}}" placeholder="Введите организацию"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button type="submit" class="form-control btn btn-primary" id="search">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
