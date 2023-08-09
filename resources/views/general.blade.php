@php
    use App\Models\Cliente;
    use App\Models\Convenios;
@endphp
<link href="{{asset('css/estatus.css')}}" rel="stylesheet">
@extends('layouts.app')
<link href="{{asset('css/tablasAsesor.css')}}" rel="stylesheet">
<script src="https://kit.fontawesome.com/56eee1d2a7.js" crossorigin="anonymous"></script>
@section('template_title')
    Solicitudes
@endsection

@section('content')

<style>
    @font-face {
        font-family: 'Presidencia Fina';
        src: url('fonts/PresidenciaFina.otf') format('opentype');
    }

    @font-face {
        font-family: 'Presidencia Firme';
        src: url('fonts/PresidenciaFirme.otf') format('opentype');
    }
</style>

<section>
    @php
        $solicitud = $solicitudes->first();
        $terminacion = '';
        $cliente = Cliente::find($solicitud->idcliente);
        $convenio = Convenios::find($cliente->convenio);
        $totalFormato="";
        $recibidoFormato="";
        $stringTotal = strval($solicitud->prestamosolicitado);
        for ($i=0; $i < strlen($stringTotal); $i++) { 
            $totalFormato.=substr($stringTotal,$i);
            if($i%3==0)
            {
                $totalFormato.=',';
            }
        }
    @endphp
    <h2>Estado de las solicitudes.</h2>
    <div class="row">
        <div class="float-left">
            <a href="{{ route('file-upload') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
              {{ __('Subir archivos') }} 
            </a>
          </div>
    </div>
    <div class="tabla-contenedor">
        <div class="solicitud-contenedor">
            <div class="info-contenedor">
                <div class="seccion-info">
                    <h3 name="monto-total">$ {{number_format($solicitud->prestamosolicitado,2,'.',',')}}</h3>
                    <span>
                        <p name="plazo">{{$solicitud->plazo}} meses de</p>
                        <p name="pagos">$ {{number_format($solicitud->pagoplazo*2, 2 , '.' , ',')}}</p>
                    </span>
                </div>
                <div class="seccion-info medio">
                    <button id="botonDetalles">Más detalle</button>
                </div>
                <div class="seccion-info final">
                    <p name="convenio">{{$convenio->nombreCorto}}</p>
                    <h4 name="estado-solicitud">{{$solicitud->estado}}</h4>
                </div>
            </div>
            <div id="detalle-contenedor" class="detalle-contenedor">
                <div class="detalle-subcontenedor">
                    <div class="contenedor-doble">
                        <p>Pagos retenidos</p>
                        <p name="pagos-retenidos" class="verde-texto">$ {{number_format($solicitud->montoretenido, 2 , '.', '.')}}</p>
                    </div>
                    <div class="contenedor-doble">
                        <p>Cobertura de riesgo</p>
                        <p name="cobertura-riesgo" class="verde-texto">$ {{number_format($solicitud->coberturariesgo, 2 , '.', ',')}}</p>
                    </div>
                    <h3 name="total-recibido">$ {{number_format($solicitud->montorecibido,2,'.',',')}}</h3>
                </div>
            </div>
        </div>
    </div>
    @php
        $clase = "";
        if($solicitud->estado=="En integracion") $clase="disabled";
    @endphp
    <a class="boton verde {{$clase}}" href="{{ route('clientes.create') }}"><i class="fa fa-fw fa-edit"></i> </a>
    <form action="{{ route('solicitudes.destroy',$solicitud->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="boton rojo{{$clase}}"><i class="fa fa-fw fa-trash"></i> </button>
    </form>
</section>
<script type="text/javascript">
    const botonDetalles = document.getElementById('botonDetalles');
    const detalleContenedor = document.getElementById('detalle-contenedor');

    botonDetalles.addEventListener('click', () => {
        detalleContenedor.classList.add('mostrar');
        botonDetalles.classList.add('no-mostrar');
    });
</script>
@endsection
