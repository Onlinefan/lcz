@extends('layouts.app')
@section('page-title')
    Список проектов
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @if (!$projects->isEmpty())
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">ID</th>
                                    <th data-hide="phone">Код</th>
                                    <th data-hide="phone">Статус</th>
                                    <th data-hide="phone">Наименование</th>
                                    <th data-hide="phone">Текущий РП</th>
                                    <th data-hide="phone">РП реализации</th>
                                    <th data-hide="phone">РП эксплуатации</th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>{{$project->id}}</td>
                                        <td>{{$project->code}}</td>
                                        <td>{{$project->status}}</td>
                                        <td>{{$project->name}}</td>
                                        <td>@if (isset($project->head)){{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}@endif</td>
                                        <td>@if (isset($project->realizationHead)){{$project->realizationHead->second_name . ' ' . $project->realizationHead->first_name . ' ' . $project->realizationHead->patronymic}}@endif</td>
                                        <td>@if (isset($project->exploitationHead)){{$project->exploitationHead->second_name . ' ' . $project->exploitationHead->first_name . ' ' . $project->exploitationHead->patronymic}}@endif</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="/edit-project/{{$project->id}}"><i class="fa fa-edit" style="color:blue; font-size:20px;"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right"><a href="/delete-project/{{$project->id}}"><i class="fa fa-times-circle" style="color:red; font-size:20px;"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @endif
                        <a class="btn btn-primary btn-sm" href="/create-project">Добавить</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Page-Level Scripts -->
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            $(document).ready(function () {
                $('.footable').footable();
            });
        });
    </script>

    <script>

    </script>

@endsection
