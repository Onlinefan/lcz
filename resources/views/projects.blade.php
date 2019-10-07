@extends('layouts.app')
@section('page-title')
    Проекты
@endsection
@section('content')
    <div class="wrapper wrapper-content  animated fadeInRight">
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Проекты в реализации</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <span class="input-group-btn">
                            <a class="btn btn-sm btn-white" href="/create-project"> <i class="fa fa-plus"></i> Добавить проект</a>
                        </span>

                        <ul class="sortable-list connectList agile-list" id="todo">
                            @foreach ($realization as $project)
                                @php
                                    $arPercents = $project->projectPercent();
                                    $datePercent = 0;

                                    foreach ($arPercents as $region) {
                                        $datePercent += ($region['dataCount'] / 7 + $region['initialDataCount'] / 5 + $region['pirCount'] / 10 + $region['productionCount'] / 6 + $region['smrCount'] / 6 +
                                            $region['pnrCount'] / 6 + $region['documentsCount'] / 10) / 7 * 100;
                                    }

                                    $datePercent = count($arPercents) ? $datePercent/count($arPercents) : 0;
                                @endphp
                                <li class="{{$project->deadline() <= 10 ? 'warning-element' : 'success-element'}}" id="task1" style="background: #FFFFFF;">
                                    <h4>
                                        @if ($project->deadline() <= 10)
                                        <i class="fa fa-exclamation-circle" style="color:#f8ac59; font-size: 28px;"></i>
                                        @endif
                                        @if (isset($project->head))
                                                @if (isset ($project->head->avatarFile))<img alt="image" class="img-circle" src="{{stristr($project->head->avatarFile->path, 'Пользовательские файлы') . $project->head->avatarFile->file_name}}" width="32px">@endif
                                            {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        @endif
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                {{$project->name}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="prix-full"><span class="prix-post">{{number_format($project->contract->amount, 2, '.', ' ')}}</span></div>
                                            <div class="prix-done"><small>Поступления </small><span class="prix-post">{{number_format($project->incomeSum(), 2, '.', ' ')}}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-row">
                                        <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                            <div style="width: {{$datePercent}}%;" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                        <div class="stat-percent font-bold text-info">@if ($project->contract->amount > 0){{round($project->incomeSum()/$project->contract->amount*100)}} @else 0 @endif% <i class="fa fa-level-up"></i></div>
                                    </div>
                                    <div class="agile-detail">
                                        <div>
                                            Ввод в эксплуатацию
                                        </div>
                                        <div>
                                            <i class="fa fa-clock-o"></i> {{$project->contract->date_end}}
                                            <div class="text-right pull-right">
                                                Дедлайн - {{$project->deadline()}} дней
                                                <a href="/progress/{{$project->id}}" class="btn btn-xs btn-white" style="margin-left: 20px;">Просмотр</a>
                                                <a href="/edit-project/{{$project->id}}" class="btn btn-xs btn-primary" style="margin-left: 10px;">Редактировать</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear" style="clear: both; height: 20px;"></div>
                                    <div class="ibox" style="border: 0; margin-bottom: 0; border-top: 1px solid #e7eaec;">
                                        <div class="ibox-title" style="cursor: inherit; border: 0">
                                            <a class="collapse-link unexpand">
                                                <h5><span class="fa fa-comments"></span> Чат проекта</h5>
                                                <div class="ibox-tools">
                                                    <i class="fa fa-chevron-up"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="ibox-content" style="border: 0; margin-bottom: 0; border-bottom: 1px solid #e7eaec;">

                                            <div class="small-chat-box fadeInTop animated" style="position: static; width: 100%; display: block;">
                                                <div class="form-chat">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="{{$project->id}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary send-message" type="button" data-user="{{auth()->user()->id}}" data-project="{{$project->id}}">Отправить</button>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="content">
                                                    @foreach ($project->messages as $message)
                                                        <div class="{{intval($message->user->id) === intval(auth()->user()->id) ? 'right' : 'left'}}">
                                                            <div class="author-name">
                                                                {{$message->user->first_name . ' ' . $message->user->second_name}} <small class="chat-date">
                                                                    {{$message->created_at}}
                                                                </small>
                                                            </div>
                                                            <div class="chat-message {{intval($message->user->id) === intval(auth()->user()->id) ? 'active' : ''}}">
                                                                {{$message->message}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>В эксплуатации</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <ul class="sortable-list connectList agile-list" id="inprogress">
                            @foreach ($exploitation as $project)
                                @php
                                    $arPercents = $project->projectPercent();
                                    $datePercent = 0;

                                    foreach ($arPercents as $region) {
                                        $datePercent += ($region['dataCount'] / 7 + $region['initialDataCount'] / 5 + $region['pirCount'] / 10 + $region['productionCount'] / 6 + $region['smrCount'] / 6 +
                                            $region['pnrCount'] / 6 + $region['documentsCount'] / 10) / 7 * 100;
                                    }

                                    $datePercent = count($arPercents) ? $datePercent/count($arPercents) : 0;
                                @endphp
                                <li class="{{$project->deadline() <= 10 ? 'warning-element' : 'success-element'}}" id="task1" style="background: #FFFFFF;">
                                    <h4>
                                        @if ($project->deadline() <= 10)
                                            <i class="fa fa-exclamation-circle" style="color:#f8ac59; font-size: 28px;"></i>
                                        @endif
                                        @if (isset($project->head))
                                                @if (isset ($project->head->avatarFile))<img alt="image" class="img-circle" src="{{stristr($project->head->avatarFile->path, 'Пользовательские файлы') . $project->head->avatarFile->file_name}}" width="32px">@endif
                                            {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        @endif
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                {{$project->name}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="prix-full"><span class="prix-post">{{number_format($project->contract->amount, 2, '.', ' ')}}</span></div>
                                            <div class="prix-done"><small>Поступления </small><span class="prix-post">{{number_format($project->incomeSum(), 2, '.', ' ')}}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-row">
                                        <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                            <div style="width: {{$datePercent}}" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                        <div class="stat-percent font-bold text-info">@if ($project->contract->amount > 0){{round($project->incomeSum()/$project->contract->amount*100)}} @else 0 @endif% <i class="fa fa-level-up"></i></div>
                                    </div>
                                    <div class="agile-detail">
                                        <div>
                                            Дата завершения договора
                                        </div>
                                        <div>
                                            <i class="fa fa-clock-o"></i> {{$project->contract->date_end}}
                                            <div class="text-right pull-right">
                                                Дедлайн - {{$project->deadline()}} дней
                                                <a href="/progress/{{$project->id}}" class="btn btn-xs btn-white" style="margin-left: 20px;">Просмотр</a>
                                                <a href="/edit-project/{{$project->id}}" class="btn btn-xs btn-primary" style="margin-left: 10px;">Редактировать</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clear" style="clear: both; height: 20px;"></div>
                                    <div class="ibox" style="border: 0; margin-bottom: 0; border-top: 1px solid #e7eaec;">
                                        <div class="ibox-title" style="cursor: inherit; border: 0">
                                            <a class="collapse-link unexpand">
                                                <h5><span class="fa fa-comments"></span> Чат проекта</h5>
                                                <div class="ibox-tools">
                                                    <i class="fa fa-chevron-up"></i>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="ibox-content" style="border: 0; margin-bottom: 0; border-bottom: 1px solid #e7eaec;">

                                            <div class="small-chat-box fadeInTop animated" style="position: static; width: 100%; display: block;">
                                                <div class="form-chat">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="{{$project->id}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary send-message" data-user="{{auth()->user()->id}}" data-project="{{$project->id}}" type="button">Отправить</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    @foreach ($project->messages as $message)
                                                        <div class="{{intval($message->user->id) === intval(auth()->user()->id) ? 'right' : 'left'}}">
                                                            <div class="author-name">
                                                                {{$message->user->first_name . ' ' . $message->user->second_name}} <small class="chat-date">
                                                                    {{$message->created_at}}
                                                                </small>
                                                            </div>
                                                            <div class="chat-message {{intval($message->user->id) === intval(auth()->user()->id) ? 'active' : ''}}">
                                                                {{$message->message}}
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Завершенные проекты</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <ul class="sortable-list connectList agile-list" id="completed">
                            @foreach ($finished as $project)
                                <li class="info-element" id="task16">
                                    <h4>
                                        @if (isset($project->head))
                                            @if (isset ($project->head->avatarFile))<img alt="image" class="img-circle" src="{{stristr($project->head->avatarFile->path, 'Пользовательские файлы') . $project->head->avatarFile->file_name}}" width="32px">@endif
                                        {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        @endif
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="col-md-6">
                                        <h3>
                                            {{$project->name}}
                                        </h3>
                                    </div>
                                    <div class="agile-detail">
                                        <a href="/progress/{{$project->id}}" class="pull-right btn btn-xs btn-white">Просмотр</a>
                                        <i class="fa fa-clock-o"></i> {{$project->contract->date_end}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){

                $('button.send-message').on('click', function () {
                    var input = $('#' + $(this).data('project'));
                    var userId = $(this).data('user');
                    $.ajax({
                        url: '/send-message',
                        type: "POST",
                        data: {
                            message: $(input).val(),
                            project_id: $(input).attr('id'),
                            user_id: userId
                        },
                        headers: {
                            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            console.log(data);
                            location.reload();
                        },
                        error : function (msg) {
                            console.log(msg);
                        },
                    });
                });
            });
        });

    </script>
@endsection
