@extends('layouts.app')
@section('page-title')
    Проекты на РП
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="tabs-container">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a class="nav-link active" data-toggle="tab" href="#tab-1">Проекты в реализации</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Проекты в эксплуатации</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Завершенные проекты</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" id="tab-1" class="tab-pane active">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example1">
                                <thead>
                                <tr>
                                    @if (isset($tableHead['realization']))
                                        @foreach ($tableHead['realization'] as $head)
                                            <th>{{$head}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>

                                <tbody>
                                    @if (isset($tableBody['realization']))
                                        @for ($project = 0; $project < $maxCountReal; $project++)
                                            <tr>
                                                @foreach ($tableBody['realization'] as $body)
                                                    <td>{{isset($body[$project]) ? $body[$project] : ''}}</td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-2" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example2">
                                <thead>
                                <tr>
                                    @if (isset($tableHead['exploitation']))
                                        @foreach ($tableHead['exploitation'] as $head)
                                            <th>{{$head}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>

                                <tbody>
                                    @if (isset($tableBody['exploitation']))
                                        @for ($project = 0; $project < $maxCountExp; $project++)
                                            <tr>
                                                @foreach ($tableBody['exploitation'] as $body)
                                                    <td>{{isset($body[$project]) ? $body[$project] : ''}}</td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" id="tab-3" class="tab-pane">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example3">
                                <thead>
                                <tr>
                                    @if (isset($tableHead['finished']))
                                        @foreach ($tableHead['finished'] as $head)
                                            <th>{{$head}}</th>
                                        @endforeach
                                    @endif
                                </tr>
                                </thead>

                                <tbody>
                                    @if (isset($tableBody['finished']))
                                        @for ($project = 0; $project < $maxCountFin; $project++)
                                            <tr>
                                                @foreach ($tableBody['finished'] as $body)
                                                    <td>{{isset($body[$project]) ? $body[$project] : ''}}</td>
                                                @endforeach
                                            </tr>
                                        @endfor
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
