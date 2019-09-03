@extends('layouts.app')
@section('page-title')
    Создать план производства
@endsection
@section('content')
    <form method="POST" action="/add_production_plan_to_table">
        {{csrf_field()}}
        <div class="wrapper wrapper-content animated fadeInRight ecommerce">
            <div class="ibox-content m-b-sm border-bottom">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="project_id">Проект</label>
                            <select name="project_id" id="project_id" class="form-control">
                                <option value="0" selected>Не выбрано</option>
                                @foreach ($projects as $project)
                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="month">Месяц</label>
                            <select name="month" id="month" class="form-control">
                                <option value="Январь" selected>Январь</option>
                                <option value="Февраль">Февраль</option>
                                <option value="Март">Март</option>
                                <option value="Апрель">Апрель</option>
                                <option value="Май">Май</option>
                                <option value="Июнь">Июнь</option>
                                <option value="Июль">Июль</option>
                                <option value="Август">Август</option>
                                <option value="Сентябрь">Сентябрь</option>
                                <option value="Октябрь">Октябрь</option>
                                <option value="Ноябрь">Ноябрь</option>
                                <option value="Декабрь">Декабрь</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="region_id">Регион</label>
                            <select name="region_id" id="region_id" class="form-control">
                                <option value="0" selected>Не выбрано</option>
                                @foreach ($regions as $region)
                                    <option value="{{$region->id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="product_id">Оборудование</label>
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="0" selected>Не выбрано</option>
                                @foreach ($products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label" for="rk_count">Количество РК</label>
                            <input type="number" id="rk_count" name="rk_count" value="" placeholder="Количество РК" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label" for="date_shipping">Дата отгрузки</label>
                            <input type="text" name="date_shipping" id="date_shipping" class="form-control" data-mask="99.99.9999" placeholder="Дата отгрузки">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-sm-2 col-form-label" for="priority">Приоритет</label>
                            <input type="text" name="priority" id="priority" class="form-control" placeholder="Приоритет">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <button type="submit" class="form-control" id="search">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
