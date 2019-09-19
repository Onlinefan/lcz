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
                        <p class="small"><i class="fa fa-hand-o-up"></i> Менять статус проекта можно перетаскиванием</p>

                        <form action="/projects2" class="input-group">
                            <input type="text" name="project_name" placeholder="Новый проект" class="input form-control-sm form-control">
                            <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Добавить проект</button>
                                </span>
                        </form>

                        <ul class="sortable-list connectList agile-list" id="todo">
                            @foreach ($realization as $project)
                                <li class="success-element" id="task1" style="background: #FFFFFF;">
                                    <h4>
                                        <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="32px">
                                        {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                {{$project->name}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="prix-full"><span class="prix-post">{{$project->contract->amount}}</span></div>
                                            <div class="prix-done"><small>Поступления </small><span class="prix-post">{{$project->incomeSum()}}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-row">
                                        <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                            <div style="width: {{round($project->incomeSum()/$project->contract->amount*100)}}%;" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                        <div class="stat-percent font-bold text-info">{{round($project->incomeSum()/$project->contract->amount*100)}}% <i class="fa fa-level-up"></i></div>
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

                                                <div class="form-chat">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="{{$project->id}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary send-message" type="button" data-user="{{auth()->user()->id}}" data-project="{{$project->id}}">Отправить</button>
                                                        </span>
                                                    </div>
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
                        <p class="small"><i class="fa fa-hand-o-up"></i> Менять статус проекта можно перетаскиванием</p>
                        <ul class="sortable-list connectList agile-list" id="inprogress">
                            @foreach ($exploitation as $project)
                                <li class="success-element" id="task1" style="background: #FFFFFF;">
                                    <h4>
                                        <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="32px">
                                        {{$project->head->second_name . ' ' . $project->head->first_name . ' ' . $project->head->patronymic}}
                                        <span class="label badge-info pull-right">{{$project->status}}</span>
                                    </h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3>
                                                {{$project->name}}
                                            </h3>
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <div class="prix-full"><span class="prix-post">{{$project->contract->amount}}</span></div>
                                            <div class="prix-done"><small>Поступления </small><span class="prix-post">{{$project->incomeSum()}}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-row">
                                        <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                            <div style="width: {{round($project->incomeSum()/$project->contract->amount*100)}}%;" class="progress-bar progress-bar-danger"></div>
                                        </div>
                                        <div class="stat-percent font-bold text-info">{{round($project->incomeSum()/$project->contract->amount*100)}}% <i class="fa fa-level-up"></i></div>
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

                                                <div class="form-chat">
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" class="form-control" id="{{$project->id}}">
                                                        <span class="input-group-btn">
                                                            <button class="btn btn-primary send-message" data-user="{{auth()->user()->id}}" data-project="{{$project->id}}" type="button">Отправить</button>
                                                        </span>
                                                    </div>
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
                        <p class="small"><i class="fa fa-hand-o-up"></i> Менять статус проекта можно перетаскиванием</p>
                        <ul class="sortable-list connectList agile-list" id="completed">
                            @foreach ($finished as $project)
                                <li class="info-element" id="task16">
                                    <h4>
                                        <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="32px">
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
                            console.log(data);
                        },
                        error : function (msg) {
                            console.log(msg);
                        },
                    });
                });

                $("#todo, #inprogress, #completed").sortable({
                    connectWith: ".connectList",
                    update: function( event, ui ) {

                        var todo = $( "#todo" ).sortable( "toArray" );
                        var inprogress = $( "#inprogress" ).sortable( "toArray" );
                        var completed = $( "#completed" ).sortable( "toArray" );
                        $('.output').html("ToDo: " + window.JSON.stringify(todo) + "<br/>" + "In Progress: " + window.JSON.stringify(inprogress) + "<br/>" + "Completed: " + window.JSON.stringify(completed));
                    }
                }).disableSelection();

            });
        });

    </script>
@endsection
