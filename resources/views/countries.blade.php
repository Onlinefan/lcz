@extends('layouts.app')
@section('page-title')
    Страны/округа
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @if (!$countries->isEmpty())
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">ID</th>
                                    <th data-hide="phone">Название</th>
                                    <th data-hide="phone">Цвет на графике</th>
                                    <th data-hide="phone">Код на карте</th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{$country->id}}</td>
                                        <td>{{$country->name}}</td>
                                        <td>{{$country->color}}</td>
                                        <td>{{$country->code}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a class="btn-white btn btn-xs" href="/edit-country/{{$country->id}}">Редактировать</a>
                                            </div>
                                        </td>
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
                        <a class="btn btn-primary btn-sm" href="/add-country">Добавить</a>
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
