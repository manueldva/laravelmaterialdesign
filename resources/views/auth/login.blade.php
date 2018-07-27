@extends('auth.app')

@section('content')

<form id="sign_in" role="form" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}
    <div class="msg">Inicia sesión para comenzar tu sesión</div>
    <div class="input-group">
        <span class="input-group-addon">
        <i class="material-icons">person</i>
        </span>
        <div class="form-line {{ $errors->has('login') ? ' error' : '' }}">
            <input type="text" class="form-control" name="login" value="{{old('login')}}" placeholder="Email o  Usuario" required autofocus>
        </div>
        @if ($errors->has('login'))
        <label id="name-error" class="error" for="login">{{ $errors->first('login') }}</label>
        @endif
    </div>
    
    <div class="input-group">
        <span class="input-group-addon">
        <i class="material-icons">lock</i>
        </span>
        <div class="form-line {{ $errors->has('password') ? ' error' : '' }}">
            <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
        </div>
        @if ($errors->has('password'))
        <label id="name-error" class="error" for="name">{{ $errors->first('password') }}</label>
        @endif
    </div>
    <div class="row">
        <div class="col-xs-8 p-t-5">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="filled-in chk-col-pink">
            <label for="rememberme">Recuérdame</label>
        </div>
        <div class="col-xs-4">
            <button class="btn btn-block bg-pink waves-effect" type="submit">Ingresar</button>
        </div>
    </div>
    <div class="row m-t-15 m-b--20">
        <div class="col-xs-6">
            <a href="#">¡Regístrate ahora!</a>
        </div>
        <div class="col-xs-6 align-right">
            <a href="#">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</form>
@endsection
