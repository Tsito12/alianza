@extends('layouts.app')
@section('content')
<link href="{{asset('css/resultados.css')}}" rel="stylesheet">
<link href="{{ asset('img/SacimexImagotipo.png') }}" rel="icon">
<title>Resultados de crédito</title>
<style>
    @font-face {
        font-family: 'Presidencia Fina';
        src: url('{{asset('fonts/PresidenciaFina.otf')}}') format('opentype');
    }

    @font-face {
        font-family: 'Presidencia Firme';
        src: url('{{asset('fonts/PresidenciaFirme.otf')}}') format('opentype');
    }
</style>
@php
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use App\Models\Cliente;
    use App\Models\Documentoscliente;
@endphp


<section>
    <script src="https://kit.fontawesome.com/56eee1d2a7.js" crossorigin="anonymous"></script>
<a href="#" onclick="window.history.back()" class="kITrbH"><i class="fa-solid fa-arrow-left"></i><span>Volver</span></a>
  <h1>Detalles del crédito.</h1>
       <div class="cuadro-contenedor">
           <div class="info-contenedor">
               <p>Monto total</p>
               <h2>$ {{ number_format($datos['Monto'], 2, '.', ',') }}</h2>
           </div>
           <div class="info-contenedor">
               <p>A un plazo de</p>
               <h3>{{ $datos['cuotasQuincenales'] }} quincenas / {{ $datos['cuotasMensuales'] }} meses</h3>
           </div>
           <div class="border"></div>
               <div class="info-contenedor-doble">
                @php
                    $terminacion = "";
                    if($datos['retenciones']>1) $terminacion="s";
                @endphp
                   <p>{{ $datos['retenciones'] }} pago{{$terminacion}} retenido{{$terminacion}}:</p>
                   <h3>$ {{ number_format($datos['montoRetenciones'], 2, '.', ',') }}</h3>
               </div>
               <div class="info-contenedor-doble">
                   <div class="tooltip">
                       <span class="question-mark"><img src="{{asset('img/QuestionMark.png')}}"/></span>
                       <span class="tooltip-text">La cobertura de riesgo es un seguro de saldo deudor y gasto funerario.</span>
                   </div>
                   <p>Cobertura de riesgo:</p>
                   <h3>$ {{ number_format($datos['MontoSeguro'], 2, '.', ',') }}</h3>
               </div>
               <div class="info-contenedor-doble">
                <p>Consulta de buró de crédito:</p>
                <h3>$ {{ number_format($datos['pagoConsultaBuro'], 2, '.', ',') }}</h3>
            </div>
           <div class="border"></div>
           <div class="info-contenedor">
               <p>Recibes</p>
               <h2>$ {{ number_format($datos['montoRecibir'], 2, '.', ',') }}</h2>
           </div>
           <div class="info-contenedor-doble">
               <p>Pagando quincenalmente</p>
               <h3>$ {{ number_format($datos['MontoCuotaQuincenal'], 2, '.', ',') }}</h3>
           </div>
       </div>


        @php
            $user = User::find(Auth::id());
            $documentos = Documentoscliente::where('idcliente',$solicitude->idcliente)->get();
            $documentosOK = true;

            foreach ($documentos as $documento) {
                if($documento->estado!="Aprobado")
                {
                    $documentosOK = false;
                    break;
                }
            }
        @endphp
        @if ($user->tipo=="Admin")
            @if (($documentosOK))
                <p>Los documentos ya han sido aprobados, puede pasar a la etapa de integración</p>
                <form action="{{ route('solicitudes.update',$solicitude->id) }}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
                    <input name="estado" type="hidden"  value="En integracion" />
                    <button type="submit" class="boton btn btn-danger btn-sm"> {{ __('A integración') }}</button>
                </form>
            @endif
            <a class="boton" href="{{route('file-upload',['idcliente' => $cliente->id])}}">Ver archivos</a>
            
                {{ method_field('PATCH') }}
                @csrf
                
                <a class="boton" href="{{route('clientes.create',['idsolicitud' => $solicitude->id])}}">Modificar</a>
                      
        @endif
        <div class="boton-contenedor">
            <div class="tooltip-left">
                <span class="question-mark"><img src="{{asset('img/QuestionMark.png')}}"/></span>
                <span class="tooltip-text-left">Si lo prefieres, puedes guardar tu solicitud sin enviarla para poder editarla en el futuro.</span>
            </div>

            <a class="boton guardar"  href="{{ route('home') }}">Guardar Solicitud</a>
            <a class="boton"  href="{{ route('clientes.create') }}">Editar</a>
 
        @if ($cliente->convenio!=10&&$user->tipo=="Cliente")
                @if ($solicitude->estado=="Modificada")
                    <form action="{{ route('solicitudes.update',$solicitude->id) }}" method="POST">
                        {{ method_field('PATCH') }}
                        @csrf
                        <input name="estado" type="hidden"  value="En proceso" />
                        <button type="submit" class="boton btn btn-succes btn-sm"> {{ __('Aceptar cambios') }}</button>
                    </form>
                @else


                    @if ($cliente->verificado)
                        <form action="{{ route('solicitudes.update',$solicitude->id) }}" method="POST">
                            {{ method_field('PATCH') }}
                            @csrf
                            <input name="estado" type="hidden"  value="En proceso" />
                            <button type="submit" class="boton btn btn-succes btn-sm"> {{ __('Enviar') }}</button>
                        </form>
                    @else
                        <a class="boton" 
                        
                        @if ($cliente->convenio==10)
                            href="{{ '/clientes/create' }}"
                        @else
                            @if (!$cliente->verificado)
                                href="{{ route('contacto') }}"
                            @endif
                        @endif
                        
                        >Enviar</a>
                    @endif


                @endif
        @endif
        </div>
</section>
@endsection
