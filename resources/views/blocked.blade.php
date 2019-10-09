@extends('inspinia::layouts.auth')

@section('content')
    <div class="middle-box text-center animated fadeInDown">
        <h2>Ваш аккаунт заблокирован!</h2>
        <h3 class="font-bold">Для разблокировки свяжитесь с администратором</h3>
    </div>
    <div class="col-sm-6" style="text-align:right; padding-top:10px">
        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
        <a class="btn btn-white" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>Выйти
        </a>
    </div>
@endsection
