@extends('layouts.app')
@section('page-title')
    Добавление/редактирование документов
@endsection
@section('content')
    <form method="POST" action="/create-documents" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="project_id" value="{{$projectId}}">
        <input type="hidden" name="region_id" value="{{$regionId}}">
        <input type="hidden" name="table" value="App\Document">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Обследование</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="examination">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Проектная документация</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="project_documentation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Исполнительная документация</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="executive_documentation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Поверка</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="verification">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Формуляры</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="forms">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Паспорта</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="passports">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ТУ-220</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="tu_220">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Договор 220</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="contract_220">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ТУ на опору</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="tu_footing">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Договор на опоры</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="contract_footing">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Адресный план согласованный с ЦАФАП</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="address_plan_agreed_cafap">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Схема передачи данныз</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="data_transfer_scheme">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Входящие</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="inbox">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Исходящие</label>
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="outgoing">
                            </div>
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
