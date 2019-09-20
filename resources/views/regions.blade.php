@extends('layouts.app')
@section('page-title')
    Регионы
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @if (!$regions->isEmpty())
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">ID</th>
                                    <th data-hide="phone">Название</th>
                                    <th data-hide="phone">Страна/округ</th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($regions as $region)
                                    <tr>
                                        <td>{{$region->id}}</td>
                                        <td>{{$region->name}}</td>
                                        <td>{{$region->country->name}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a class="btn-white btn btn-xs" href="/edit-region/{{$region->id}}">Редактировать</a>
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
                        <a class="btn btn-primary btn-sm" href="/add-region">Добавить</a>
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
