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

            <button class="text-right">
                <a  class="btn btn-default btn-outline"  href="{{ '/clientes/create' }}"><i
                      class='fa fa-print'></i> Regresar</a>
             </button>
     
            <button  class="float-right">
               <a  class="btn btn-default btn-outline"  href="{{ route('contacto') }}"><i
                     class='fa fa-print'></i> Aceptar y continuar</a>
            </button>
   </section>
   
</body>
