<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="{{asset('css/resultados.css')}}" rel="stylesheet">
   <title>Resultados de crédito</title>



    <!-- Styles -->
</head>

<body>
    @php
        use App\Models\User;
        use Illuminate\Support\Facades\Auth;
        use App\Models\Cliente;
    @endphp
   <header>
      <div class="logo-contenedor">
          <img src="{{asset('img/sacimex.png')}}">
      </div>
   </header>
   
   <section>
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
                       <p>{{ $datos['retenciones'] }} pagos retenidos:</p>
                       <h3>$ {{ number_format($datos['montoRetenciones'], 2, '.', ',') }}</h3>
                   </div>
                   <div class="info-contenedor-doble">
                       <div class="tooltip1">
                           <span class="question-mark"><img src="{{asset('img/QuestionMark.png')}}"/></span>
                           <span class="tooltip-text">La cobertura de riesgo es una medida de seguridad por parte de la empresa en caso de situaciones inesperadas.</span>
                       </div>
                       <p>Cobertura de riesgo:</p>
                       <h3>$ {{ number_format($datos['MontoSeguro'], 2, '.', ',') }}</h3>
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

           <button class="text-right">
               <a  class="btn btn-default btn-outline"  href="{{ ''.$solicitude->id.'?opcion=imprimir' }}"><i
                     class='fa fa-print'></i> IMPRIMIR</a>
            </button>

            @php
                $user = User::find(Auth::id());
            @endphp
            @if ($user->tipo=="Admin")
                <form action="{{ route('solicitudes.update',$solicitude->id) }}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
                    <input name="estado" type="hidden"  value="Pre aprobado" />
                    <button type="submit" class="btn btn-danger btn-sm"> {{ __('Pre Aprobar') }}</button>
                </form>
                <form action="{{ route('solicitudes.update',$solicitude->id) }}" method="POST">
                    {{ method_field('PATCH') }}
                    @csrf
                    <input name="estado" type="hidden"  value="Rechazada" />
                    <button type="submit" class="btn btn-danger btn-sm"> {{ __('Rechazar') }}</button>
                </form>
            @endif
            <button class="text-right">
                <a  class="btn btn-default btn-outline"  
                @if ($user->tipo=="Admin")
                    href="{{ route('home') }}"
                @else
                    href="{{ '/clientes/create' }}"
                @endif
                
                ><i class='fa fa-print'></i> Regresar</a>
             </button>
     
            @php
                    //$cliente = Cliente::where('user_id',Auth::id())->first();
            @endphp 
            @if ($cliente->convenio!=10&&$user->tipo=="Cliente")
                <button  class="float-right">
                    <a  class="btn btn-default btn-outline" 
                    
                    @if ($cliente->convenio==10)
                        href="{{ '/clientes/create' }}"
                    @else
                        href="{{ route('contacto') }}"
                    @endif
                    
                    ><iclass='fa fa-print'></iclass=> Aceptar y continuar</a>
                </button>
            @endif
            
   </section>
   
</body>
