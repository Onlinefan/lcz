@extends('layouts.app')
@section('page-title')
    Добавление/редактирование ПНР
@endsection
@section('content')
    <form method="POST" action="/create-data">
        {{csrf_field()}}
        <input type="hidden" name="complex_id" value="{{$pnr->complex_id}}">
        <input type="hidden" name="id" value="{{$pnr->id}}">
        <input type="hidden" name="table" value="App\Pnr">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="calibration_2000">Калибровка 2000 проездов</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="calibration_2000" id="calibration_2000">
                                @foreach ($calibration2000 as $calibration)
                                    <option value="{{$calibration->id}}" {{isset($pnr->calibration_2000) && $pnr->calibration_2000 === $calibration->id ? 'selected' : ''}}>{{$calibration->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="kp">КП</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="kp" id="kp">
                                @foreach ($kps as $kp)
                                    <option value="{{$kp->id}}" {{isset($pnr->kp) && $pnr->kp === $kp->id ? 'selected' : ''}}>{{$kp->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="analysis_result">Результаты анализа</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="analysis_result" id="analysis_result">
                                @foreach ($analysisResult as $result)
                                    <option value="{{$result->id}}" {{isset($pnr->analysis_result) && $pnr->analysis_result === $result->id ? 'selected' : ''}}>{{$result->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="complex_to_monitoring">Передача комплекса в мониторинг</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="complex_to_monitoring" id="complex_to_monitoring">
                                @foreach ($complexToMonitoring as $monitoring)
                                    <option value="{{$monitoring->id}}" {{isset($pnr->complex_to_monitoring) && $pnr->complex_to_monitoring === $monitoring->id ? 'selected' : ''}}>{{$monitoring->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="andromeda_unloading">Выгрузка в Андромеду</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="andromeda_unloading" id="andromeda_unloading">
                                @foreach ($andromedaUnloading as $unloading)
                                    <option value="{{$unloading->id}}" {{isset($pnr->andromeda_unloading) && $pnr->andromeda_unloading === $unloading->id ? 'selected' : ''}}>{{$unloading->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="unloading">Выгрузка</label>
                        <div class="col-sm-10">
                            <input type="text" id="unloading" name="unloading" value="{{isset($pnr->unloading) ? $pnr->unloading : ''}}" placeholder="Введите выгрузку" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="in_cafap">В ЦАФАП</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="in_cafap" id="in_cafap">
                                @foreach ($inCafap as $cafap)
                                    <option value="{{$cafap->id}}" {{isset($pnr->in_cafap) && $pnr->in_cafap === $cafap->id ? 'selected' : ''}}>{{$cafap->name}}</option>
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
