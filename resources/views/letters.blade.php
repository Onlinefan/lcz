@extends('layouts.app')
@section('page-title')
    Письма
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Добавить письмо</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Реестр писем по проекту</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <form>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тип письма</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Входящие</option>
                                        <option>Исходящие</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Номер</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Дата</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" data-mask="99.99.9999">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Тема</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Статус письма</label>
                                <div class="col-sm-10">
                                    <select class="form-control">
                                        <option>Отправлено</option>
                                        <option>Получено</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Адресат</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control">
                                </div>
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group row">
                                <div class="col-sm-4 col-sm-offset-2">
                                    <button class="btn btn-primary btn-sm" type="submit">Сохранить</button>
                                    <button class="btn btn-white btn-sm" type="button">Отмена</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                                <thead>
                                <tr>
                                    <th>Дата</th>
                                    <th>Тип</th>
                                    <th>Тема</th>
                                    <th>Номер</th>
                                    <th>Адресат</th>
                                    <th>Статус</th>
                                </tr>
                                </thead>

                                <tbody>
                                <tr>
                                    <td>01.02.2019</td>
                                    <td><span class="label label-primary">Входящие</span></td>
                                    <td>Текст 1</td>
                                    <td>12345</td>
                                    <td>Текст 2</td>
                                    <td><span class="label label-primary">Получено</span></td>
                                </tr>
                                <tr>
                                    <td>12.03.2019</td>
                                    <td><span class="label label-info">Исходящие</span></td>
                                    <td>Текст 3</td>
                                    <td>23456</td>
                                    <td>Текст 4</td>
                                    <td><span class="label label-warning">Направлено</span></td>
                                </tr>
                                <tr>
                                    <td>18.03.2019</td>
                                    <td><span class="label label-info">Исходящие</span></td>
                                    <td>Текст 5</td>
                                    <td>34567</td>
                                    <td>Текст 6</td>
                                    <td><span class="label label-primary">Получено</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){
                $('.dataTables-example').DataTable({
                    pageLength: 25,
                    responsive: true,
                    dom: '<"html5buttons"B>lTfgitp',
                    buttons: [
                        { extend: 'copy'},
                        {extend: 'csv'},
                        {extend: 'excel', title: 'Contacts'},
                        //{extend: 'pdf', title: 'Contacts'},

                        {extend: 'print',
                            customize: function (win){
                                $(win.document.body).addClass('white-bg');
                                $(win.document.body).css('font-size', '10px');

                                $(win.document.body).find('table')
                                    .addClass('compact')
                                    .css('font-size', 'inherit');
                            }
                        }
                    ]
                });
            });
        });
    </script>

@endsection
