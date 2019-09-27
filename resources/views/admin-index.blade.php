@extends('layouts.app')
@section('page-title')
    Администрирование
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="panel-body">
                <div class="form-group row">
                    <a href="/countries"><label class="col-sm-2 col-form-label" for="system_id">Страны/округа</label></a>
                </div>
                <div class="form-group row">
                    <a href="/regions"><label class="col-sm-2 col-form-label" for="system_id">Регионы</label></a>
                </div>
                <div class="form-group row">
                    <a href="/products"><label class="col-sm-2 col-form-label" for="system_id">Продукты</label></a>
                </div>
                <div class="form-group row">
                    <a href="/po-cafap"><label class="col-sm-2 col-form-label" for="system_id">ПО в ЦАФАП</label></a>
                </div>
            </div>

            @if (!$projects->isEmpty())
                <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                    <thead>
                    <tr>
                        <th data-toggle="true">Код</th>
                        <th data-hide="phone">Название</th>
                        <th data-hide="phone">Статус</th>
                        <th class="text-right" data-sort-ignore="true"></th>
                    </tr>
                    </thead>

                    <h3>Проекты без РП</h3>
                    <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <td>{{$project->code}}</td>
                            <td>{{$project->name}}</td>
                            <td>{{$project->status}}</td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <a class="btn-white btn btn-xs" href="/edit-project/{{$project->id}}">Редактировать</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>

                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <ul class="pagination pull-right"></ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            @endif
        </div>
    </div>
@endsection
