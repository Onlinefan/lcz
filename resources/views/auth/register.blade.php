@extends('inspinia::layouts.auth')

@section('content')
<div class="middle-box text-center loginscreen   animated fadeInDown">
    <div>
        <div> <h1 class="logo-name">ЛЦЗ</h1></div>
        <h3>Регистрация</h3>
        <p>Создайте аккаунт</p>
        <form class="m-t" role="form"  method="POST" enctype="multipart/form-data" action="{{ route('register') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Введите имя" name="first_name" value="{{ old('first_name') }}" required autofocus>
                @if ($errors->has('first_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('second_name') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Введите фамилию" name="second_name" value="{{ old('second_name') }}" required autofocus>
                @if ($errors->has('second_name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('second_name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('patronymic') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Введите отчество" name="patronymic" value="{{ old('patronymic') }}" required autofocus>
                @if ($errors->has('patronymic'))
                    <span class="help-block">
                        <strong>{{ $errors->first('patronymic') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('department') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Введите отдел" name="department" value="{{ old('department') }}" required autofocus>
                @if ($errors->has('department'))
                    <span class="help-block">
                        <strong>{{ $errors->first('department') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type="email" class="form-control" placeholder="Введите email" name="email" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('login') ? ' has-error' : '' }}">
                <input type="text" class="form-control" placeholder="Введите логин" name="login" value="{{ old('login') }}" required>
                @if ($errors->has('login'))
                    <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type="password" class="form-control" placeholder="Введите пароль" name="password" required>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Введите пароль еще раз" name="password_confirmation" required>
            </div>
            <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                <label class="col-sm-2 col-form-label">Аватар</label>
                <input type="file" class="custom-file" name="avatar" required>
                @if ($errors->has('avatar'))
                    <span class="help-block">
                        <strong>{{ $errors->first('avatar') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <div class="checkbox i-checks"><label> <input type="checkbox"><i></i> Согласен с политикой и условиями </label></div>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Зарегистрироваться</button>

            <p class="text-muted text-center"><small>Уже зарегистрированы?</small></p>
            <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Авторизация</a>
        </form>
        <p class="m-t"> <small>Лаборатория цифрового зрения &copy; {{ date('Y') }}</small> </p>
    </div>
</div>
@endsection
