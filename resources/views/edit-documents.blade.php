@extends('layouts.app')
@section('page-title')
    Добавление/редактирование документов
@endsection
@section('content')
    <form method="POST" action="/create-documents" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="complex_id" value="{{$documents->complex_id}}">
        <input type="hidden" name="id" value="{{$documents->id}}">
        <input type="hidden" name="table" value="App\Document">
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="panel-body">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Обследование</label>
                        @if (isset($documents->examinationFile))<label class="col-sm-2 col-form-label">{{$documents->examinationFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="examination">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Проектная документация</label>
                        @if (isset($documents->projectDocumentationFile))<label class="col-sm-2 col-form-label">{{$documents->projectDocumentationFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="project_documentation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Исполнительная документация</label>
                        @if (isset($documents->executiveDocumentationFile))<label class="col-sm-2 col-form-label">{{$documents->executiveDocumentationFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="executive_documentation">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Поверка</label>
                        @if (isset($documents->verificationFile))<label class="col-sm-2 col-form-label">{{$documents->verificationFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="verification">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Формуляры</label>
                        @if (isset($documents->formsFile))<label class="col-sm-2 col-form-label">{{$documents->formsFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="forms">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Паспорта</label>
                        @if (isset($documents->passportsFile))<label class="col-sm-2 col-form-label">{{$documents->passportsFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="passports">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ТУ-220</label>
                        @if (isset($documents->tu220File))<label class="col-sm-2 col-form-label">{{$documents->tu220File->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="tu_220">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Договор 220</label>
                        @if (isset($documents->contract220File))<label class="col-sm-2 col-form-label">{{$documents->contract220File->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="contract_220">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">ТУ на опору</label>
                        @if (isset($documents->tuFootingFile))<label class="col-sm-2 col-form-label">{{$documents->tuFootingFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="tu_footing">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Договор на опоры</label>
                        @if (isset($documents->contractFootingFile))<label class="col-sm-2 col-form-label">{{$documents->contractFootingFile->file_name}}</label>@endif
                        <div class="col-sm-8">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="contract_footing">
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
