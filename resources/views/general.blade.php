@php
    use App\Models\Cliente;
    use App\Models\Convenios;
@endphp
@extends('layouts.app')
<link href="{{asset('css/tablasAsesor.css')}}" rel="stylesheet">
<script src="https://kit.fontawesome.com/56eee1d2a7.js" crossorigin="anonymous"></script>

@section('template_title')
    Solicitudes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="float-left">
                <a href="{{ route('file-upload') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                  {{ __('Subir archivos') }}
                </a>
              </div>
        </div>

        <div class="row mt-2">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header tabla-titulo">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Solicitudes') }}
                            </span>

                            @if(sizeof($solicitudes)<1)
                             <div class="float-right">
                                <a href="{{ route('solicitudes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                            @endif
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover tabla">
                                <thead class="thead">
                                    <tr class="fila-cliente titulo">
                                        <th class="columna-titulo">No</th>
                                        <th class="columna-titulo">Convenio</th>
										<th class="columna-titulo">Monto Total</th>
										<th class="columna-titulo">Plazo</th>
										<th class="columna-titulo">Retenciones</th>
										<th class="columna-titulo">Cobertura de riesgo</th>
                                        <th class="columna-titulo">Pago quincenal</th>
										<th class="columna-titulo">Monto a recibir</th>
										<th class="columna-titulo">Estado</th>

                                        <th class="columna-titulo"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitude)
                                    @php
                                        $cliente = Cliente::find($solicitude->idcliente);
                                        $convenio = Convenios::find($cliente->convenio);
                                    @endphp
                                        <tr class="fila-cliente">
                                            <td class="columna">{{ ++$i }}</td>
                                            <td class="columna">{{ $convenio->nombreCorto }}</td>
											<td class="columna">{{ $solicitude->prestamosolicitado }}</td>
											<td class="columna">{{ $solicitude->plazo }}</td>
											<td class="columna">{{ $solicitude->montoretenido }}</td>
											<td class="columna">{{ $solicitude->coberturariesgo }}</td>
											<td class="columna">{{ $solicitude->pagoplazo }}</td>
											<td class="columna">{{ $solicitude->montorecibido }}</td>
											<td class="columna">{{ $solicitude->estado }}</td>

                                            <td class="columna">
                                                <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST">
                                                    <!--
                                                    <a class="btn btn-sm btn-primary " href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    -->
                                                    @php
                                                        $clase = "";
                                                        if($solicitude->estado=="En integracion") $clase="disabled";
                                                    @endphp
                                                    <a class="boton azul" href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa-solid fa-info"></i> </a>
                                                    <a class="boton verde {{$clase}}" href="{{ route('clientes.create') }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="boton rojo{{$clase}}"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
@endsection
