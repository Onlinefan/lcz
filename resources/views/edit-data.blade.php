@extends('layouts.app')
@section('page-title')
    Добавление/редактирование данных
@endsection
@section('content')
    <form method="POST" action="/create-data">
        {{csrf_field()}}
        <input type="hidden" name="project_id" value="{{$projectStatus->project_id}}">
        <input type="hidden" name="region_id" value="{{$projectStatus->region_id}}">
        <input type="hidden" name="id" value="{{$projectStatus->id}}">
        <input type="hidden" name="table" value="App\ProjectStatus">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="system_id">ID системы</label>
                        <div class="col-sm-10">
                            <input type="text" id="system_id" name="system_id" value="{{isset($projectStatus->system_id) ? $projectStatus->system_id : ''}}" placeholder="Введите ID" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="complex_id">ID комплекса</label>
                        <div class="col-sm-10">
                            <input type="text" id="complex_id" name="complex_id" value="{{isset($projectStatus->complex_id) ? $projectStatus->complex_id : ''}}" placeholder="Введите ID" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="city">Город</label>
                        <div class="col-sm-10">
                            <input type="text" id="city" name="city" value="{{isset($projectStatus->city) ? $projectStatus->city : ''}}" placeholder="Введите город" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="affiliation_of_the_road">Тип дороги</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="affiliation_of_the_road" id="affiliation_of_the_road">
                                @foreach ($roadTypes as $road)
                                    <option value="{{$road->id}}" {{isset($projectStatus->affiliation_of_the_road) && $projectStatus->affiliation_of_the_road === $road->id ? 'selected' : ''}}>{{$road->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="address_contract">Адрес по контракту</label>
                        <div class="col-sm-10">
                            <input type="text" id="address_contract" name="address_contract" value="{{isset($projectStatus->address_contract) ? $projectStatus->address_contract : ''}}" placeholder="Введите адрес" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="address_gibdd">Адрес по ГИБДД</label>
                        <div class="col-sm-10">
                            <input type="text" id="address_gibdd" name="address_gibdd" value="{{isset($projectStatus->address_gibdd) ? $projectStatus->address_gibdd : ''}}" placeholder="Введите адрес" class="form-control">
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
