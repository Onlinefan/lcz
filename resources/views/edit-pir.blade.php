@extends('layouts.app')
@section('page-title')
    Добавление/редактирование ПИР
@endsection
@section('content')
    <form method="POST" action="/create-data">
        {{csrf_field()}}
        <input type="hidden" name="project_id" value="{{$projectId}}">
        <input type="hidden" name="region_id" value="{{$regionId}}">
        <input type="hidden" name="table" value="App\Pir">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="survey_status">Статус обследования</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="survey_status" id="survey_status">
                                @foreach ($surveyStatuses as $status)
                                    <option value="{{$status->id}}" {{isset($pir->survey_status) && intval($pir->survey_status) === intval($status->id) ? 'selected' : ''}}>{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="survey_comment">Комментарий к обследованию</label>
                        <div class="col-sm-10">
                            <input type="text" id="survey_comment" name="survey_comment" value="{{isset($pir->survey_comment) ? $pir->survey_comment : ''}}" placeholder="Введите комментарий" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="design_documentation">Проектная документация</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="design_documentation" id="design_documentation">
                                @foreach ($projectDocuments as $document)
                                    <option value="{{$document->id}}" {{isset($pir->design_documentation) && intval($pir->design_documentation) === intval($document->id) ? 'selected' : ''}}>{{$document->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="new_footing_fvf">Количество новых опор под ФВФ</label>
                        <div class="col-sm-10">
                            <input type="text" id="new_footing_fvf" name="new_footing_fvf" value="{{isset($pir->new_footing_fvf) ? $pir->new_footing_fvf : ''}}" placeholder="Введите ФВФ" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="new_footing_lep">Количество новых опор под ЛЭП</label>
                        <div class="col-sm-10">
                            <input type="text" id="new_footing_lep" name="new_footing_lep" value="{{isset($pir->new_footing_lep) ? $pir->new_footing_lep : ''}}" placeholder="Введите ЛЭП" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="rk_count">Кол-во РК</label>
                        <div class="col-sm-10">
                            <input type="text" id="rk_count" name="rk_count" value="{{isset($pir->rk_count) ? $pir->rk_count : ''}}" placeholder="Введите кол-во РК" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="ok_count">Кол-во ОК</label>
                        <div class="col-sm-10">
                            <input type="text" id="ok_count" name="ok_count" value="{{isset($pir->ok_count) ? $pir->ok_count : ''}}" placeholder="Введите кол-во ОК" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="equipment_power">Суммарная мощность оборудования</label>
                        <div class="col-sm-10">
                            <input type="text" id="equipment_power" name="equipment_power" value="{{isset($pir->equipment_power) ? $pir->equipment_power : ''}}" placeholder="Введите суммарную мощность оборудования" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="request_tu">Запрос ТУ на 220</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="request_tu" id="request_tu">
                                @foreach ($tuRequests as $tu)
                                    <option value="{{$tu->id}}" {{isset($pir->request_tu) && intval($pir->request_tu) === intval($tu->id) ? 'selected' : ''}}>{{$tu->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="request_footing">Запрос на опоры</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="request_footing" id="request_footing">
                                @foreach ($footingRequests as $footing)
                                    <option value="{{$footing->id}}" {{isset($pir->request_tu) && intval($pir->request_tu) === intval($footing->id) ? 'selected' : ''}}>{{$footing->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
