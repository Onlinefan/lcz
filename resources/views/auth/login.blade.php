@extends('inspinia::layouts.auth')

@section('content')
    <div class="row">
        <div class="col-md-6"><img src="{{ asset('storage/img/logo_rus_g.png') }}" alt=""></div>
        <div class="col-md-6"></div>
    </div>
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
      <form class="m-t" role="form" method="POST" action="{{ route('login') }}">
       {{ csrf_field() }}
       <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <input type="email" class="form-control" placeholder="Введите email" name="email" value="{{ old('email') }}" required autofocus>
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
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
         <div class="checkbox i-checks">
           <label> <input type="checkbox" name="remember" value="1" {{ old('remember') ? 'checked' : '' }}><i></i> Запомнить? </label>
         </div>
       </div>
       <button type="submit" class="btn btn-primary block full-width m-b">Войти</button>

       <a href="{{ route('password.request') }}"><small>Забыли пароль?</small></a>
          <hr />
       <p class="text-muted text-center"><small>Нет аккаунта?</small></p>
       <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Зарегистрироваться</a>
      </form>
      <p class="m-t"> <small>Лаборатория цифрового зрения &copy; {{ date('Y') }}</small> </p>
    </div>
</div>
@endsection
