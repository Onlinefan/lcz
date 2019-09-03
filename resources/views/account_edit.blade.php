@extends('layouts.app')
@section('page-title')
    Редактирование аккаунта
@endsection
@section('content')
    <form method="POST">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="second_name">Фамилия</label>
                            <input type="text" id="second_name" name="second_name" value="{{$user->second_name}}" placeholder="Фамилия пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="first_name">Имя</label>
                            <input type="text" id="first_name" name="first_name" value="{{$user->first_name}}" placeholder="Имя пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="patronymic">Отчество</label>
                            <input type="text" id="patronymic" name="patronymic" value="{{$user->patronymic}}" placeholder="Отчество пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="login">Логин</label>
                            <input type="text" id="login" name="login" value="{{$user->login}}" placeholder="Логин пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="role">Роль</label>
                            <select name="role" id="role" class="form-control">
                                <option value="Оператор" {{$user->role === 'Оператор' ? 'selected' : ''}}>Оператор</option>
                                <option value="Администратор" {{$user->role === 'Администратор' ? 'selected' : ''}}>Администратор</option>
                                <option value="Суперпользователь" {{$user->role === 'Суперпользователь' ? 'selected' : ''}}>Суперпользователь</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option value="Активен" {{$user->status === 'Активен' ? 'selected' : ''}}>Активен</option>
                                <option value="Заблокирован" {{$user->status === 'Заблокирован' ? 'selected' : ''}}>Заблокирован</option>
                                <option value="Ожидает модерации" {{$user->status === 'Ожидает модерации' ? 'selected' : ''}}>Ожидает модерации</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="form-control" id="search">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
