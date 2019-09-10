@extends('layouts.app')
@section('page-title')
    Аккаунты
@endsection
@section('content')
    <form method="get" action="/accounts">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="second_name">Фамилия</label>
                            <input type="text" id="second_name" name="second_name" value="{{$request['second_name']}}" placeholder="Фамилия пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="first_name">Имя</label>
                            <input type="text" id="first_name" name="first_name" value="{{$request['first_name']}}" placeholder="Имя пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="patronymic">Отчество</label>
                            <input type="text" id="patronymic" name="patronymic" value="{{$request['patronymic']}}" placeholder="Отчество пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="login">Логин</label>
                            <input type="text" id="login" name="login" value="{{$request['login']}}" placeholder="Логин пользователя" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="role">Роль</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" {{$request['role'] === '' ? 'selected' : ''}}>Не выбрано</option>
                                <option value="Оператор" {{$request['role'] === 'Оператор' ? 'selected' : ''}}>Оператор</option>
                                <option value="Администратор" {{$request['role'] === 'Администратор' ? 'selected' : ''}}>Администратор</option>
                                <option value="Суперпользователь" {{$request['role'] === 'Суперпользователь' ? 'selected' : ''}}>Суперпользователь</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="status">Статус</label>
                            <select name="status" id="status" class="form-control">
                                <option value="" {{$request['status'] === '' ? 'selected' : ''}}>Не выбрано</option>
                                <option value="Активен" {{$request['status'] === 'Активен' ? 'selected' : ''}}>Активен</option>
                                <option value="Заблокирован" {{$request['status'] === 'Заблокирован' ? 'selected' : ''}}>Заблокирован</option>
                                <option value="Ожидает модерации" {{$request['status'] === 'Ожидает модерации' ? 'selected' : ''}}>Ожидает модерации</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="form-control" id="search">Найти</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-content">
                            @if (!$users->isEmpty())
                                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                    <thead>
                                    <tr>
                                        <th data-toggle="true">Фамилия</th>
                                        <th data-hide="phone">Имя</th>
                                        <th data-hide="phone">Отчество</th>
                                        <th data-hide="phone">Логин</th>
                                        <th data-hide="phone">Роль</th>
                                        <th data-hide="phone">Статус</th>
                                        <th class="text-right" data-sort-ignore="true"></th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{$user->second_name}}</td>
                                        <td>{{$user->first_name}}</td>
                                        <td>{{$user->patronymic}}</td>
                                        <td>{{$user->login}}</td>
                                        <td>{{$user->role}}</td>
                                        <td><span class="label {{$user->status === 'Ожидает модерации' ? 'label-default' : ($user->status === 'Активен' ? 'label-primary' : 'label-danger')}}">{{$user->status}}</span></td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a class="btn-white btn btn-xs" href="/account_edit/{{$user->id}}">Редактировать</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                    <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <ul class="pagination pull-right"></ul>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            @else
                                <h1>По вашему запросу ничего не найдено!</h1>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function() {
                $('.footable').footable();
            });
        });
    </script>

    <script>

    </script>

@endsection
