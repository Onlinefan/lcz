@extends('layouts.app')
@section('page-title')
    Редактирование аккаунта
@endsection
@section('content')
    <form method="POST">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="second_name">Фамилия</label>
                    <div class="col-sm-10">
                        <input type="text" id="second_name" name="second_name" value="{{$user->second_name}}" placeholder="Фамилия пользователя" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="first_name">Имя</label>
                    <div class="col-sm-10">
                        <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="Имя пользователя" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="patronymic">Отчество</label>
                    <div class="col-sm-10">
                        <input type="text" id="patronymic" name="patronymic" value="{{$user->patronymic}}" placeholder="Отчество пользователя" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="login">Логин</label>
                    <div class="col-sm-10">
                        <input type="text" id="login" name="login" value="{{$user->login}}" placeholder="Логин пользователя" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="role">Роль</label>
                    <div class="col-sm-10">
                        <select name="role" id="role" class="form-control">
                            <option value="Оператор" {{$user->role === 'Оператор' ? 'selected' : ''}}>Оператор</option>
                            <option value="Администратор" {{$user->role === 'Администратор' ? 'selected' : ''}}>Администратор</option>
                            <option value="Суперпользователь" {{$user->role === 'Суперпользователь' ? 'selected' : ''}}>Суперпользователь</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-sm-2" for="status">Статус</label>
                    <div class="col-sm-10">
                        <select name="status" id="status" class="form-control">
                            <option value="Активен" {{$user->status === 'Активен' ? 'selected' : ''}}>Активен</option>
                            <option value="Заблокирован" {{$user->status === 'Заблокирован' ? 'selected' : ''}}>Заблокирован</option>
                            <option value="Ожидает модерации" {{$user->status === 'Ожидает модерации' ? 'selected' : ''}}>Ожидает модерации</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">
                        <button type="submit" class="form-control" id="search">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
