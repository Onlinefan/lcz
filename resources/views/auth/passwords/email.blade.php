@extends('inspinia::layouts.auth')

@section('content')
  <div class="row">
    <div class="col-md-6"><img src="{{ asset('storage/img/logo_rus_g.png') }}" alt=""></div>
    <div class="col-md-6"></div>
  </div>
<div class="passwordBox animated fadeInDown">
  <div class="row">
    <div class="col-md-12">
      <div class="ibox-content">
        <h2 class="font-bold">Восстановление пароля</h2>
        <p>Введите Ваш email и ждите дельнейших инструкций.</p>
        <div class="row">
          <div class="col-lg-12">
            <form class="m-t" role="form" method="POST" action="{{ route('password.email') }}">
              {{ csrf_field() }}
              <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email адрес" required>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary block full-width m-b">Отправить новый пароль</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr/>
  <div class="row">
    <div class="col-md-7">
      Лаборатория цифрового зрения
    </div>
    <div class="col-md-5 text-right">
       <small>© {{  DATE('Y') }}</small>
    </div>
  </div>
</div>
@endsection
