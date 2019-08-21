@extends('layouts.app')
@section('page-title')
    Аккаунты
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="second_name">Фамилия</label>
                        <input type="text" id="second_name" name="second_name" value="" placeholder="Фамилия пользователя" class="form-control">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label class="col-form-label" for="status">Статус</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" selected>Enabled</option>
                            <option value="0">Disabled</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                            <thead>
                            <tr>
                                <th data-toggle="true">Фамилия</th>
                                <th data-hide="phone">Имя</th>
                                <th data-hide="phone">Отчество</th>
                                <th data-hide="phone">Логин</th>
                                <th data-hide="phone">Роль</th>
                                <th data-hide="phone">Статус</th>
                                <th class="text-right" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <td>Иванов</td>
                                <td>Иван</td>
                                <td>Иванович</td>
                                <td>ivanov</td>
                                <td>Оператор</td>
                                <td><span class="label label-primary">Enable</span></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Петров</td>
                                <td>Петр</td>
                                <td>Петрович</td>
                                <td>petrov</td>
                                <td>Оператор</td>
                                <td><span class="label label-danger">Disabled</span></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Егоров</td>
                                <td>Егор</td>
                                <td>Егорович</td>
                                <td>egorov</td>
                                <td>Администратор</td>
                                <td><span class="label label-primary">Enable</span></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>Алексеев</td>
                                <td>Алексей</td>
                                <td>Алексеевич</td>
                                <td>alekseev</td>
                                <td>Суперпользователь</td>
                                <td><span class="label label-primary">Enable</span></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button class="btn-white btn btn-xs">View</button>
                                        <button class="btn-white btn btn-xs">Edit</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>

                            <tfoot>
                            <tr>
                                <td colspan="7">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function() {
                $('.footable').footable();
            });
        });
    </script>

@endsection
