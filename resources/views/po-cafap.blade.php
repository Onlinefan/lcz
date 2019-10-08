@extends('layouts.app')
@section('page-title')
    ПО в ЦАФАП
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        @if (!$poCafap->isEmpty())
                            <table class="footable table table-stripped toggle-arrow-tiny" data-page-size="15">
                                <thead>
                                <tr>
                                    <th data-toggle="true">ID</th>
                                    <th data-hide="phone">Название</th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                    <th class="text-right" data-sort-ignore="true"></th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($poCafap as $po)
                                    <tr>
                                        <td>{{$po->id}}</td>
                                        <td>{{$po->name}}</td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="/edit-po-cafap/{{$po->id}}"><i class="fa fa-edit" style="color:blue; font-size:20px;"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right"><a href="/delete-po-cafap/{{$po->id}}"><i class="fa fa-times-circle" style="color:red; font-size:20px;"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td colspan="3">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @endif
                        <a class="btn btn-primary btn-sm" href="/add-po-cafap">Добавить</a>
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
@endsection
