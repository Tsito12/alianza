<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/input-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Registro</title>
</head>
<body class="reg">
    <header>
        <div class="logo-contenedor">
            <img src="{{ asset('img/sacimex.png') }}">
        </div>
    </header>
    <section>
    <form  action="{{ route('register') }}" method="POST" autocomplete="off" class="form no-border">
        @csrf
        <h1 class="titulo">Regístrate y obtén tu pre-aprobación en minutos.</h1>
        <div class="inp-contenedor">
            <input type="text" id="email" name="email" class="inp" required>
            <label for="email" class="etq">Correo electrónico</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="bar"></span>
            <p id="alerta-email" class="alerta"></p>
        </div>
        <div class="inp-contenedor">
            <input type="password" id="password" name="password" class="inp" required>
            <label for="password" class="etq">Contraseña</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="bar"></span>
                <input id="checkbox" name="checkbox" type="checkbox">
                <label for="checkbox" class="label-checkbox"><img id="ojo" src="{{ asset('img/view.png')}}"></label>
            <p id="alerta-contrasena" class="alerta"></p>
        </div>
        <div class="inp-contenedor">
            <input type="password" id="password-confirm" name="password_confirmation" class="inp" required>
            <label for="password-confirm" class="etq">Confirmar contraseña</label>
            <span class="bar"></span>
            <p id="alerta-confirmar" class="alerta"></p>
        </div>
        @error('error')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        <button id="boton-registrar" type="submit"  class="btn">Registrarme</button>

        <p class="privacidad">Al dar clic en "Registrarme" aceptas los <a href="#" class="terminos">términos y condiciones</a> y que has leído el <a href="#" class="terminos">Aviso de Privacidad de sacimex</a></p>

        <div class="lnk-contenedor">
            <p class="par">¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}" class="lnk">Inicia sesión</a>
        </div>
    </form>
</section>
</body>
<script src="{{asset('js/validarRegistro.js')}}"></script>

<script>
    checkbox.addEventListener("change", function () {
    ojoImagen.src = this.checked ? "{{ asset('img/hide.png')}}" : "{{ asset('img/view.png')}}";
    contrasenaInput.type = this.checked ? "text" : "password";
    confirmacionInput.type = this.checked ? "text" : "password";
});
</script>
</html>