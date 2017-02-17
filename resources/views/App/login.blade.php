@extends('index')
@section('title', 'Iniciar Sesión')
@section('content')
<form action="/login" method="POST">
    {{ csrf_field() }}
    <h1 class="text-light">Iniciar Sesión</h1>
    <hr class="thin"/>
    <div class="input-control modern text iconic full-size" data-role="input">
        <input type="text" name="user" value="{{old('l_user')}}" required>
        <span class="label">Usuario</span>
        <span class="icon mif-user"></span>
        <button class="button helper-button clear"><span class="mif-cross"></span></button>
    </div>
    <div class="input-control modern password iconic full-size" data-role="input">
        <input type="password" name="password" required>
        <span class="label">Contraseña</span>
        <span class="icon mif-lock"></span>
        <button class="button helper-button reveal"><span class="mif-looks"></span></button>
    </div>
    <br>
    <br>
    <div class="form-actions align-center">
        <button type="submit" class="button primary">Iniciar Sesión</button>
        @if (session('error'))
        <a href="/Application/retrieve" class="button wbg-pink"><span class="mif-key"></span> Recuperar Contraseña</a>
        @endif
    </div>
</form>
<script>
    $(function () {
        var form = $(".login-form");
        form.css({
            opacity: 1,
            "-webkit-transform": "scale(1)",
            "transform": "scale(1)",
            "-webkit-transition": ".5s",
            "transition": ".5s"
        });
    });
</script>
@stop