@extends('layouts.app')
@section('page-title')
    Главная
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-6">
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
                        <div class="input-group">
                            <span class="input-group-btn">
                                <a class="btn btn-sm btn-white" href="/create-project"> <i class="fa fa-plus"></i> Добавить проект</a>
                            </span>
                        </div>
                        <ul class="sortable-list connectList agile-list" id="todo">
                            @foreach ($projectsRealization as $realization)
                                <li class="{{$realization->deadline() <= 10 ? 'warning-element' : 'success-element'}}" id="task1" style="background: #FFFFFF;">
                                    <h4>
                                        @if ($realization->deadline() <= 10)
                                            <i class="fa fa-exclamation-circle" style="color:#f8ac59; font-size: 28px;"></i>
                                        @endif
                                        @if (isset (auth()->user()->avatarFile))<img alt="image" class="img-circle" src="{{stristr(auth()->user()->avatarFile->path, 'Пользовательские файлы') . auth()->user()->avatarFile->file_name}}" width="32px"> @endif
                                        {{auth()->user()->second_name . ' ' . auth()->user()->first_name . ' ' . auth()->user()->patronymic}}
                                        <span class="label badge-info pull-right">{{$realization->status}}</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                {{$realization->name}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="prix-full"><span class="prix-post">{{number_format($realization->contract->amount, 2, '.', ' ')}}</span></div>
                                            <div class="prix-done"><small>Поступления </small><span class="prix-post">{{number_format($realization->incomeSum(), 2, '.', ' ')}}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-row">
                                        <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                            <div style="width: @if ($realization->contract->amount){{round($realization->incomeSum()/$realization->contract->amount*100)}} @else 0 @endif%;" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                        <div class="stat-percent font-bold text-info">@if ($realization->contract->amount){{round($realization->incomeSum()/$realization->contract->amount*100)}} @else 0 @endif% <i class="fa fa-level-up"></i></div>
                                    </div>
                                    <div class="agile-detail">
                                        <div>
                                            Ввод в эксплуатацию
                                        </div>
                                        <div>
                                            <i class="fa fa-clock-o"></i> {{$realization->contract->date_end}}
                                            <div class="text-right pull-right">
                                                Дедлайн - {{$realization->deadline()}} дней
                                                <a href="/progress/{{$realization->id}}" class="btn btn-xs btn-white" style="margin-left: 20px;">Просмотр</a>
                                                <a href="/edit-project/{{$realization->id}}" class="btn btn-xs btn-primary" style="margin-left: 10px;">Редактировать</a>
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
                                                        <input type="text" class="form-control" id="{{$realization->id}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary send-message" type="button" data-user="{{auth()->user()->id}}" data-project="{{$realization->id}}">Отправить</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="content">
                                                    @foreach ($realization->messages as $message)
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
            <div class="col-lg-6">
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
                            @foreach ($projectsFinished as $project)
                                <li class="info-element" id="task16">
                                    <h4>
                                        @if (isset (auth()->user()->avatarFile))<img alt="image" class="img-circle" src="{{stristr(auth()->user()->avatarFile->path, 'Пользовательские файлы') . auth()->user()->avatarFile->file_name}}" width="32px">@endif
                                        {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="col-md-6">
                                        <h3>
                                            {{$project->name}}
                                        </h3>
                                    </div>
                                    <div class="agile-detail">
                                        <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
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
                            location.reload();
                            console.log(data);
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
