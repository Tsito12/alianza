@extends('layouts.app')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/input-styles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sacialianza.css') }}" rel="stylesheet">
    <title>SaciAlianza</title>
</head>
<body>
    <!-- LOGO -->
    @section('content')
    <header>
        <div class="logo-contenedor">
            <img src="{{ asset('img/sacimex.png') }}">
        </div>
    </header>
    <section>
        <div class="titulo-contenedor">
            <p id="titulo-paso" class="titulo">Paso 1. Ingrese sus datos personales.</p>
            <div id="contenedor-form" class="form-contenedor">
                <form id="formulario" action="{{route('clientes.store')}}" method="POST" autocomplete="off">
                    @csrf
                    <div class="pasos-contenedor">
                        <!-- PASO 1 -->
                        <div class="paso">
                            {{Form::hidden('user_id',$usuario)}}
                            {{Form::hidden('ajuste', "0")}}
                            {{Form::hidden('convenio', $convenio->id)}}
                            {{Form::hidden('confirmaciontelefono', rand(1,1000000))}}
                            <p class="d-none" id="paso"></p>
                            <div class="inp-contenedor">
                                <input type="text" id="nombre" name="nombre" value="{{ $cliente->nombre }}" class="inp sa" tabindex="-1" required>
                                <label for="nombre" class="etq">Nombre completo</label>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="bar sa"></span>
                                <p id="alerta-nombre" class="alerta"></p>   
                            </div> 
                            <div class="inp-contenedor">
                                <input type="number" id="telefono" value="{{ $cliente->telefono }}" name="telefono" class="inp sa" maxlength="10" tabindex="-1" required>
                                <label for="telefono" class="etq">WhatsApp</label>
                                @error('telefono')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="bar sa"></span>
                                <p id="alerta-telefono" class="alerta"></p> 
                            </div>   
                            @error('error')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                                    
                        </div>
                        <!-- PASO 2 -->
                        <div class="paso">
                            <div class="inp-contenedor">
                                <input type="number" id="ingresoquincenal" value="{{ $cliente->ingresoquincenal }}" name="ingresoquincenal" class="inp sa" tabindex="-1" required>
                                <label for="ingresoquincenal" class="etq">Ingresos quincenales</label>
                                @error('ingresoquincenal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="bar sa"></span>
                                <span class="quincena-span">$</span>
                                <p id="alerta-quincena" class="alerta"></p> 
                            </div>
                            <div class="inp-contenedor">
                                <input type="number" id="disponiblequincenal" value="{{ $cliente->disponiblequincenal }}" name="disponiblequincenal" class="inp sa" tabindex="-1" required>
                                <label for="disponiblequincenal" class="etq">¿Cuánto te queda disponible?</label>
                                @error('disponiblequincenal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="bar sa"></span>
                                <span class="quincena-span">$</span>
                                <p id="alerta-disponible" class="alerta"></p> 
                            </div>           
                        </div>
                        <!--
                    </form>  -->
                        <!-- PASO 3 -->
                        <!--
                        <form action="{{route('solicitudes.store')}}" method="POST">
                            @csrf -->
                            {{ Form::hidden('idcliente', $cliente->id) }} 
                        <div class="paso">
                            <div class="pagos-contenedor">
                                <div class="pagos-subcontenedor">
                                    <label for="pagominimo" class="pagos-etiqueta">Pago mínimo (quincenal)</label>
                                    <div class="pagos-ssc">
                                        <span class="pagos-span">$</span>
                                        <input type="number" name="pagominimo" id="pagominimo" class="pagos-input" tabindex="-1" required readonly>
                                    </div>
                                </div>
                                <div class="pagos-subcontenedor">
                                    <label for="pagomaximo" class="pagos-etiqueta">Pago máximo (quincenal)</label>
                                    <div class="pagos-ssc">
                                        <span class="pagos-span">$</span>
                                        <input type="number" name="pagomaximo" id="pagomaximo" class="pagos-input" tabindex="-1" required readonly>
                                    </div>
                                </div>                           
                            </div>
                            <div class="range-contenedor">
                                <label for="range" class="pagos-etiqueta">Pago quincenal deseado</label>
                                <input type="range" name="range" id="range" step="50" tabindex="-1">
                                <div class="pagos-ssc">
                                    <span class="pagos-span">$</span>
                                    <input type="number" name="pagodeseado" id="pagodeseado" class="pagos-input" tabindex="-1" readonly required>
                                </div>
                            </div>
                            <div>
                                <label for="plazo" class="pagos-etiqueta">¿A cuántos meses?</label>
                                <div class="meses-contenedor">
                                    <div id="boton-menos" class="meses-boton gris">-</div>
                                    <p id="plazoMinimo" class="d-none">{{$convenio->plazoMinimo}}</p>
                                    <p id="plazoMaximo" class="d-none">{{$convenio->plazoMaximo}}</p>
                                    <p id="fechaTermino" class="d-none">{{$convenio->fechaTermino}}</p>
                                    <p id="montoMinimo" class="d-none">{{$convenio->montoMinimo}}</p>
                                    <p id="montoMaximo" class="d-none">{{$convenio->montoMaximo}}</p>
                                    <p id="tasa" class="d-none">{{$convenio->tasa}}</p>
                                    <input type="number" name="plazo" id="plazo" min="{{$convenio->plazoMinimo}}" max="{{$convenio->plazoMaximo}}" class="meses-input" value="12" tabindex="-1" required readonly>
                                    <div id="boton-mas" class="meses-boton">+</div>
                                    <span> meses</span>                                
                                </div>
                            </div>           
                        </div>
                        <!-- PASO 4 -->
                        <div class="paso">
                            <div class="pagos-subcontenedor">
                                <label for="creditomaximo" class="pagos-etiqueta">Crédito máximo</label>
                                <div class="pagos-ssc">
                                    <span class="pagos-span">$</span>
                                    <input type="number" name="creditomaximo" id="creditomaximo" class="pagos-input" tabindex="-1" required readonly>
                                </div>
                                <p id="meses-etq" class="pagos-etiqueta"></p>
                            </div>
                            <div class="inp-contenedor">
                                <input type="number" id="prestamosolicitado" name="prestamosolicitado" class="inp sa" tabindex="-1" required>
                                <label for="prestamosolicitado" class="etq">Prestamo solicitado:</label>
                                <span class="bar sa"></span>
                                <span class="quincena-span">$</span>
                                <p id="alerta-solicitado" class="alerta"></p> 
                            </div>
                            <div class="meses-contenedor d-none">
                                <span>Pagando el día</span>  
                                <div id="boton-menos-dias" class="meses-boton dias gris">-</div>
                                <input type="number" name="días-mes" id="días-mes" min="1" max="30" class="meses-input" value="1" tabindex="-1" required readonly>
                                <div id="boton-mas-dias" class="meses-boton">+</div>
                                <span>de cada mes.</span>                                
                            </div>    
                            {{Form::hidden('estado','En proceso')}}              
                        </div>      
                    </div>
                </form>        
            </div>
            <button id="btn-desp-atr" class="button oculto" tabindex="-1">Volver</button>
            <button id="btn-desp-sig" class="button der" tabindex="-1">Siguiente</button>
        </div>
    </section>
    
    <script src="{{asset('js/validarDatos.js')}}"></script>
    <script src="{{asset('js/desplazarForm.js')}}"></script>
    <script src="{{asset('js/calcularMontos.js')}}"></script>
    <script src="{{asset('js/calcularTotal.js')}}"></script>
    @endsection