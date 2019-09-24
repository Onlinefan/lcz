@extends('layouts.app')
@section('page-title')
    Добавление/редактирование исходных данных
@endsection
@section('content')
    <form method="POST" action="/create-data">
        {{csrf_field()}}
        <input type="hidden" name="project_id" value="{{$projectId}}">
        <input type="hidden" name="region_id" value="{{$regionId}}">
        <input type="hidden" name="table" value="App\InitialData">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="equipment_type">Тип оборудования</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="equipment_type" id="equipment_type">
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}" {{isset($initialData->equipment_type) && $initialData->equipment_type === $product->id ? 'selected' : ''}}>{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="road_type">Тип контролируемого участка дороги</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="road_type" id="road_type">
                                @foreach ($roadTypes as $road)
                                    <option value="{{$road->id}}" {{isset($initialData->road_type) && $initialData->road_type === $road->id ? 'selected' : ''}}>{{$road->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="speed_mode">Скоростной режим</label>
                        <div class="col-sm-10">
                            <input type="text" id="speed_mode" name="speed_mode" value="{{isset($initialData->speed_mode) ? $initialData->speed_mode : ''}}" placeholder="Введите скоростной режим" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="borders_number">Кол-во рубежей</label>
                        <div class="col-sm-10">
                            <input type="text" id="borders_number" name="borders_number" value="{{isset($initialData->borders_number) ? $initialData->borders_number : ''}}" placeholder="Введите кол-во рубежей" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="koap">КоАП</label>
                        <div class="col-sm-10">
                            <input type="text" id="koap" name="koap" value="{{isset($initialData->koap) ? $initialData->koap : ''}}" placeholder="Введите КоАП" class="form-control">
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
