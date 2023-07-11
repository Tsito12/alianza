<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/input-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
    <title>Iniciar sesión</title>
</head>
<body>
    <header>
        <div class="logo-contenedor">
            <img src="{{ asset('img/sacimex.png') }}">
        </div>
        <h2>Tu crédito de confianza.</h2>
    </header>
    <section>
    <form action="{{ route('login') }}" method="post" id="form-login" autocomplete="off" class="form">
        @csrf
        <h1 class="titulo">Te damos la bienvenida a Sacimex</h1>
        <div class="inp-contenedor">
            <input type="text" id="email" name="email" class="inp" required>
            <label for="email" class="etq">Correo electrónico</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="bar"></span>
            <p id="alerta-correo" class="alerta"></p>
        </div>
        <div class="inp-contenedor">
            <input type="password" id="password" name="password" class="inp" required>
            <label for="email" class="etq">Contraseña</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="bar"></span>
            <input id="checkbox" name="checkbox" type="checkbox">
            <label for="checkbox" class="label-checkbox"><img id="ojo" src="{{ asset('img/view.png')}}"></label>
            <p id="alerta-correo" class="alerta"></p>
        </div>
        <div class="inp-contenedor">
            <input type="text" id="convenio" name="convenio" class="inp" oninput="this.value = this.value.toUpperCase()" required>
            <label for="convenio" class="etq">Convenio</label>
            @error('convenio')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="bar"></span>
            <p id="alerta-convenio" class="alerta"></p>
        </div>

        <button id="boton-login" class="btn">Iniciar sesión</button>

        <div class="lnk-contenedor">
            <p class="par">¿No tienes una cuenta?</p>
            <a href="  {{ route('register') }}  " class="lnk">Regístrate</a>
        </div>
    </form>
    <div id="bot-ayuda" class="bot-ayuda">
        <img id="img-bot" src="{{asset('img/BotAyuda1.png')}}" alt="Bot de ayuda"/>
    </div>
    </section>
</body>
<script src="{{asset('js/validarLogin.js')}}"></script>

<script>
    document.getElementById('bot-ayuda').addEventListener('click', () => {
        document.getElementById('img-bot').src = "{{asset('img/BotAyuda2.png')}}";
        document.getElementById('bot-ayuda').style.cursor = "auto";
    });
</script>
<script>
    document.getElementById('checkbox').addEventListener("change", function () {
        document.getElementById('ojo').src = this.checked ? "{{ asset('img/hide.png')}}" : "{{ asset('img/view.png')}}";
        document.getElementById('password').type = this.checked ? "text" : "password";
    });
</script>
</html>