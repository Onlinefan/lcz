@extends('layouts.app')
@section('page-title')
    Главная
@endsection
@section('content')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <h4>
                            <img src="{{ asset('storage/img/logo_rus_g.png') }}" alt="">
                            <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="64px" />
                            Кочкин Павел
                        </h4>
                    </div>
                </div>
            </div>
        </div>

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
                        <p class="small"><i class="fa fa-hand-o-up"></i> Менять статус проекта можно перетаскиванием</p>

                        <div class="input-group">
                            <input type="text" placeholder="Новый проект" class="input form-control-sm form-control">
                            <span class="input-group-btn">
                                        <button type="button" class="btn btn-sm btn-white"> <i class="fa fa-plus"></i> Добавить проект</button>
                                </span>
                        </div>

                        <ul class="sortable-list connectList agile-list" id="todo">
                            <li class="success-element" id="task1" style="background: #FFFFFF;">
                                <h4>
                                    <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="32px">
                                    Кочкин Павел
                                    <span class="label badge-info pull-right">Реализация</span>
                                </h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>
                                            Алтай
                                        </h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="prix-full"><span class="prix-post">8 500 250</span></div>
                                        <div class="prix-done"><small>Поступления </small><span class="prix-post">500 250</span></div>
                                    </div>
                                </div>
                                <div class="flex-row">
                                    <div class="progress progress-mini" style="    width: calc(100% - 50px);">
                                        <div style="width: 58%;" class="progress-bar progress-bar-danger"></div>
                                    </div>
                                    <div class="stat-percent font-bold text-info">58% <i class="fa fa-level-up"></i></div>
                                </div>
                                <div class="agile-detail">
                                    <div>
                                        Ввод в эксплуатацию
                                    </div>
                                    <div>
                                        <i class="fa fa-clock-o"></i> 05.04.2015
                                        <div class="text-right pull-right">
                                            Дедлайн - 5 дней
                                            <a href="#" class="btn btn-xs btn-primary" style="margin-left: 20px;">Просмотр</a>
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
                                                <div class="left">
                                                    <div class="author-name">
                                                        Monica Jackson <small class="chat-date">
                                                            10:02 am
                                                        </small>
                                                    </div>
                                                    <div class="chat-message active">
                                                        Lorem Ipsum is simply dummy text input.
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <div class="author-name">
                                                        Mick Smith
                                                        <small class="chat-date">
                                                            11:24 am
                                                        </small>
                                                    </div>
                                                    <div class="chat-message">
                                                        Lorem Ipsum is simpl.
                                                    </div>
                                                </div>
                                                <div class="left">
                                                    <div class="author-name">
                                                        Alice Novak
                                                        <small class="chat-date">
                                                            08:45 pm
                                                        </small>
                                                    </div>
                                                    <div class="chat-message active">
                                                        Check this stock char.
                                                    </div>
                                                </div>
                                                <div class="right">
                                                    <div class="author-name">
                                                        Anna Lamson
                                                        <small class="chat-date">
                                                            11:24 am
                                                        </small>
                                                    </div>
                                                    <div class="chat-message">
                                                        The standard chunk of Lorem Ipsum
                                                    </div>
                                                </div>
                                                <div class="left">
                                                    <div class="author-name">
                                                        Mick Lane
                                                        <small class="chat-date">
                                                            08:45 pm
                                                        </small>
                                                    </div>
                                                    <div class="chat-message active">
                                                        I belive that. Lorem Ipsum is simply dummy text.
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="form-chat">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" class="form-control">
                                                    <span class="input-group-btn">
                                                <button class="btn btn-primary" type="button">Отправить</button>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="warning-element" id="task2">
                                Simply dummy text of the printing and typesetting industry.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                </div>
                            </li>
                            <li class="info-element" id="task3">
                                Sometimes by accident, sometimes on purpose (injected humour and the like).
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 16.11.2015
                                </div>
                            </li>
                            <li class="danger-element" id="task4">
                                All the Lorem Ipsum generators
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-primary">Done</a>
                                    <i class="fa fa-clock-o"></i> 06.10.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task5">
                                Which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                    <i class="fa fa-clock-o"></i> 09.12.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task6">
                                Packages and web page editors now use Lorem Ipsum as
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-primary">Done</a>
                                    <i class="fa fa-clock-o"></i> 08.04.2015
                                </div>
                            </li>
                            <li class="success-element" id="task7">
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 05.04.2015
                                </div>
                            </li>
                            <li class="info-element" id="task8">
                                Sometimes by accident, sometimes on purpose (injected humour and the like).
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 16.11.2015
                                </div>
                            </li>
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
                        <p class="small"><i class="fa fa-hand-o-up"></i> Менять статус проекта можно перетаскиванием</p>
                        <ul class="sortable-list connectList agile-list" id="completed">
                            <li class="info-element" id="task16">
                                <h4>
                                    <img alt="image" class="img-circle" src="http://webapplayers.com/inspinia_admin-v2.9.2/img/a4.jpg" width="32px">
                                    Кочкин Павел
                                    <span class="label badge-info pull-right">Завершен</span>
                                </h4>
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 16.11.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task17">
                                Ut porttitor augue non sapien mollis accumsan.
                                Nulla non elit eget lacus elementum viverra.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                    <i class="fa fa-clock-o"></i> 09.12.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task18">
                                Which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                    <i class="fa fa-clock-o"></i> 09.12.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task19">
                                Packages and web page editors now use Lorem Ipsum as
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-primary">Done</a>
                                    <i class="fa fa-clock-o"></i> 08.04.2015
                                </div>
                            </li>
                            <li class="success-element" id="task20">
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 05.04.2015
                                </div>
                            </li>
                            <li class="info-element" id="task21">
                                Sometimes by accident, sometimes on purpose (injected humour and the like).
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 16.11.2015
                                </div>
                            </li>
                            <li class="warning-element" id="task22">
                                Simply dummy text of the printing and typesetting industry.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Tag</a>
                                    <i class="fa fa-clock-o"></i> 12.10.2015
                                </div>
                            </li>
                            <li class="success-element" id="task23">
                                Many desktop publishing packages and web page editors now use Lorem Ipsum as their default.
                                <div class="agile-detail">
                                    <a href="#" class="pull-right btn btn-xs btn-white">Mark</a>
                                    <i class="fa fa-clock-o"></i> 05.04.2015
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">

                <h4>
                    Serialised Output
                </h4>
                <p>
                    Serializes the sortable's item id's into an array of string.
                </p>

                <div class="output p-m m white-bg"></div>


            </div>
        </div>


    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function(){
            $(document).ready(function(){

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
