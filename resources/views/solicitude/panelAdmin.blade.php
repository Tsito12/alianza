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
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Solicitudes NO atendidas') }}
                            </span>

                             
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
                                        
										<th>Cliente</th>
										<th>Convenio</th>
										<th>Prestamo solicitado</th>
										<th>Monto recibido</th>
                                        <th>Plazo</th>
										<th>Estado</th>
										<th>Ultimo movimiento</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitudes as $solicitude)
                                        @php
                                            $cliente = Cliente::find($solicitude->idcliente);
                                            $convenio = Convenios::find($cliente->convenio);
                                        @endphp
                                        @if ($convenio->id!=10)
                                            <tr>
                                                
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $cliente->nombre }}</td>
                                                <td>{{ $convenio->nombreCorto }}</td>
                                                <td>{{ $solicitude->prestamosolicitado }}</td>
                                                <td>{{ $solicitude->montorecibido }}</td>
                                                <td>{{ $solicitude->plazo }}</td>
                                                <td>{{ $solicitude->estado }}</td>
                                                <td>{{ $solicitude->updated_at }}</td>
                                                
                                                

                                                <td>
                                                    <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalle') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('solicitudes.edit',$solicitude->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                        
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
               
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Solicitudes RECHAZADAS') }}
                            </span>

                             
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
                                        
										<th>Cliente</th>
										<th>Convenio</th>
										<th>Prestamo solicitado</th>
										<th>Monto recibido</th>
                                        <th>Plazo</th>
										<th>Estado</th>
										<th>Ultimo movimiento</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($solicitudesRechazadas as $solicitude)
                                        @php
                                            $cliente = Cliente::find($solicitude->idcliente);
                                            $convenio = Convenios::find($cliente->convenio);
                                        @endphp
                                        @if ($convenio->id!=10)
                                            
                                            <tr>
                                                
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $cliente->nombre }}</td>
                                                <td>{{ $convenio->nombreCorto }}</td>
                                                <td>{{ $solicitude->prestamosolicitado }}</td>
                                                <td>{{ $solicitude->montorecibido }}</td>
                                                <td>{{ $solicitude->plazo }}</td>
                                                <td>{{ $solicitude->estado }}</td>
                                                <td>{{ $solicitude->updated_at }}</td>
                                                
                                                

                                                <td>
                                                    <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST">
                                                        <a class="btn btn-sm btn-primary " href="{{ route('solicitudes.show',$solicitude->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Detalle') }}</a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('solicitudes.edit',$solicitude->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            
                                        @endif
                                        
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
