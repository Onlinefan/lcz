@extends('layouts.app')
@section('page-title')
Добавление/редактирование СМР
@endsection
@section('content')
<form method="POST" action="/create-data">
    {{csrf_field()}}
    <input type="hidden" name="complex_id" value="{{$smr->complex_id}}">
    <input type="hidden" name="id" value="{{$smr->id}}">
    <input type="hidden" name="table" value="App\SmrInstallation">
    <div class="wrapper wrapper-content animated fadeInRight ecommerce">
        <div class="ibox-content m-b-sm border-bottom">
            <div class="panel-body">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="link_root_task">Ссылка на корневую задачу</label>
                    <div class="col-sm-10">
                        <input type="text" id="link_root_task" name="link_root_task" value="{{isset($smr->link_root_task) ? $smr->link_root_task : ''}}" placeholder="Введите ссылку" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="220_vu">Наличие 220 на ВУ</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="220_vu" id="220_vu">
                            @foreach ($vu220 as $vu)
                                <option value="{{$vu->id}}" {{isset($smr->$vuTable) && $smr->$vuTable === $vu->id ? 'selected' : ''}}>{{$vu->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="link_contract">Канал связи (договор)</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="link_contract" id="link_contract">
                            @foreach ($linkContract as $contract)
                                <option value="{{$contract->id}}" {{isset($smr->link_contract) && $smr->link_contract === $contract->id ? 'selected' : ''}}>{{$contract->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="dislocation_strapping">Обвязка дислокации</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="dislocation_strapping" id="dislocation_strapping">
                            @foreach ($dislocationStrapping as $strapping)
                                <option value="{{$strapping->id}}" {{isset($smr->dislocation_strapping) && $smr->dislocation_strapping === $strapping->id ? 'selected' : ''}}>{{$strapping->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="installation_status">Статус монтажа</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="installation_status" id="installation_status">
                            @foreach ($installationStatus as $installation)
                                <option value="{{$installation->id}}" {{isset($smr->installation_status) && $smr->installation_status === $installation->id ? 'selected' : ''}}>{{$installation->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="transferred_pnr">Передано в ПНР</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="transferred_pnr" id="transferred_pnr">
                            @foreach ($transferredPnr as $transferred)
                                <option value="{{$transferred->id}}" {{isset($smr->transferred_pnr) && $smr->transferred_pnr === $transferred->id ? 'selected' : ''}}>{{$transferred->name}}</option>
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
