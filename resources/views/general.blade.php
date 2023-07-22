@php
    use App\Models\Cliente;
    use App\Models\Convenios;
@endphp
@extends('layouts.app')

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
                    <div class="card-header">
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Convenio</th>
										<th>Monto Total</th>
										<th>Plazo</th>
										<th>Retenciones</th>
										<th>Cobertura de riesgo</th>
                                        <th>Pago quincenal</th>
										<th>Monto a recibir</th>
										<th>Estado</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitude)
                                    @php
                                        $cliente = Cliente::find($solicitude->idcliente);
                                        $convenio = Convenios::find($cliente->convenio);
                                    @endphp
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $convenio->nombreCorto }}</td>
											<td>{{ $solicitude->prestamosolicitado }}</td>
											<td>{{ $solicitude->plazo }}</td>
											<td>{{ $solicitude->montoretenido }}</td>
											<td>{{ $solicitude->coberturariesgo }}</td>
											<td>{{ $solicitude->pagoplazo }}</td>
											<td>{{ $solicitude->montorecibido }}</td>
											<td>{{ $solicitude->estado }}</td>

                                            <td>
                                                <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST">
                                                    <!--
                                                    <a class="btn btn-sm btn-primary " href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    -->
                                                    @php
                                                        $clase = "";
                                                        if($solicitude->estado=="En integracion") $clase="disabled";
                                                    @endphp
                                                    <a class="btn btn-sm btn-primary" href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalle') }}</a>
                                                    <a class="btn btn-sm btn-success {{$clase}}" href="{{ route('clientes.create') }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm {{$clase}}"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
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
