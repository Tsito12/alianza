@php
    use App\Models\Cliente;
    use App\Models\Convenios;
@endphp
@extends('layouts.app')

@section('template_title')
    Solicitudes
@endsection

@section('content')
    <link href="{{asset('css/tablasAsesor.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/56eee1d2a7.js" crossorigin="anonymous"></script>
    
    <p class="d-none" id="fechaServidor"></p>
      <section>
        <div class="botones-contendor">
          <button onclick="cambiarTabla(1)">No atendidas</button>
          <button onclick="cambiarTabla(2)">En integración</button>
          <button onclick="cambiarTabla(3)">Modificadas</button>
        </div>
        <div class="tabla-titulo mostrar"  id="1">
          <h3>Solicitudes no atendidas</h3>
          <div class="tabla">
            <div class="fila titulo">
              <div class="columna-titulo">
                <span>No.</span>
              </div>
              <div class="columna-titulo">
                <span>Cliente</span>
              </div>
              <div class="columna-titulo">
                <span>Convenio</span>
              </div>
              <div class="columna-titulo">
                <span>Préstamo solicitado</span>
              </div>
              <div class="columna-titulo">
                <span>Monto recibido</span>
              </div>
              <div class="columna-titulo">
                <span>Plazo</span>
              </div>
              <div class="columna-titulo">
                <span>Estado</span>
              </div>
              <!--
              <div class="columna-titulo">
                <span>Último movimiento</span>
              </div> -->
              <div class="columna-titulo">
                <span>Tiempo transcurrido</span>
              </div>
              <div class="columna-titulo"></div>
            </div>
            @php
                
            @endphp
            @foreach ($solicitudesPag as $solicitude)
                @php
                    $cliente = Cliente::find($solicitude->idcliente);
                    $convenio = Convenios::find($cliente->convenio);
                @endphp
                <div class="fila">
                    <div class="columna">
                        <td>{{ ++$i }}</td>
                    </div>
                    <div class="columna">
                        <span>{{$cliente->nombre}}</span>
                    </div>
                    <div class="columna">
                        <span>{{$convenio->nombreCorto}}</span>
                    </div>
                    <div class="columna">
                        <span>${{$solicitude->prestamosolicitado}}</span>
                    </div>
                    <div class="columna">
                        <span>${{$solicitude->montorecibido}}</span>
                    </div>
                    <div class="columna">
                        <span>{{$solicitude->plazo}} Meses</span>
                    </div>
                    <div class="columna">
                        <span>{{$solicitude->estado}}</span>
                    </div>
                    <div class="columna d-none">
                        <span>{{$solicitude->updated_at}}</span>
                    </div>
                    <div class="columna">
                        <span></span>
                    </div>
                    <div class="columna d-none">
                      {{date('D M j Y G:i:s')}}
                    </div>
                    <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST" class="columna" style="gap: 10px;">
                        <a href="{{ route('solicitudes.show',$solicitude->id) }}" class="boton azul"><i class="fa-solid fa-info"></i></a>
                        <a href="{{ route('clientes.create',['idsolicitud' => $solicitude->id]) }}" class="boton verde"><i class="fa-solid fa-pen"></i></a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="boton rojo"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            @endforeach
            {!! $solicitudesPag->links() !!}
            </div>
          </div>
        
        <div class="tabla-titulo" id="2">
          <h3>Solicitudes en integración</h3>
          <div class="tabla">
            <div class="fila titulo">
              <div class="columna-titulo">
                <span>No.</span>
              </div>
              <div class="columna-titulo">
                <span>Cliente</span>
              </div>
              <div class="columna-titulo">
                <span>Convenio</span>
              </div>
              <div class="columna-titulo">
                <span>Préstamo solicitado</span>
              </div>
              <div class="columna-titulo">
                <span>Monto recibido</span>
              </div>
              <div class="columna-titulo">
                <span>Plazo</span>
              </div>
              <div class="columna-titulo">
                <span>Estado</span>
              </div>
              <div class="columna-titulo d-none">
                <span>Último movimiento</span>
              </div>
              <div class="columna-titulo">
                <span>Tiempo transcurrido</span>
              </div>
              <div class="columna-titulo"></div>
            </div>
            @php
                //$i=0;
            @endphp
            @foreach ($solicitudesIntegracion as $solicitude)
                @php
                    $cliente = Cliente::find($solicitude->idcliente);
                    $convenio = Convenios::find($cliente->convenio);
                @endphp
            <div class="fila">
                <div class="columna">
                    <span>{{++$j}}</span>
                </div>
                <div class="columna">
                    <span>{{$cliente->nombre}}</span>
                </div>
                <div class="columna">
                    <span>{{$convenio->nombreCorto}}</span>
                </div>
                <div class="columna">
                    <span>${{$solicitude->prestamosolicitado}}</span>
                </div>
                <div class="columna">
                    <span>${{$solicitude->montorecibido}}</span>
                </div>
                <div class="columna">
                    <span>{{$solicitude->plazo}} Meses</span>
                </div>
                <div class="columna">
                    <span>{{$solicitude->estado}}</span>
                </div>
                <div class="columna d-none">
                    <span>{{$solicitude->updated_at}}</span>
                </div>
                <div class="columna">
                    <span></span>
                </div>
                <div class="columna d-none">
                  {{date('D M j Y G:i:s')}}
                </div>
                <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST" class="columna" style="gap: 10px;">
                  <a href="{{ route('solicitudes.show',$solicitude->id) }}" class="boton azul"><i class="fa-solid fa-info"></i></a>
                  <a href="{{ route('clientes.create',['idsolicitud' => $solicitude->id]) }}" class="boton verde"><i class="fa-solid fa-pen"></i></a>
                  @csrf
                  @method('DELETE')
                    <button type="submit" class="boton rojo"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div> 
            @endforeach
            {!! $solicitudesIntegracionPag->links() !!}
          </div>    
        </div>
        <div class="tabla-titulo"  id="3">
          <h3>Solicitudes modificadas</h3>
        <div class="tabla">
          <div class="fila titulo">
            <div class="columna-titulo">
              <span>No.</span>
            </div>
            <div class="columna-titulo">
              <span>Cliente</span>
            </div>
            <div class="columna-titulo">
              <span>Convenio</span>
            </div>
            <div class="columna-titulo">
              <span>Préstamo solicitado</span>
            </div>
            <div class="columna-titulo">
              <span>Monto recibido</span>
            </div>
            <div class="columna-titulo">
              <span>Plazo</span>
            </div>
            <div class="columna-titulo">
              <span>Estado</span>
            </div>
            <div class="columna-titulo d-none">
              <span>Último movimiento</span>
            </div>
            <div class="columna-titulo">
                <span>Tiempo transcurrido</span>
              </div>
            <div class="columna-titulo"></div>
          </div>

          @php
            //$i=0;
        @endphp
        @foreach ($solicitudesRechazadas  as $solicitude)
            @php
                $cliente = Cliente::find($solicitude->idcliente);
                $convenio = Convenios::find($cliente->convenio);
            @endphp
            <div class="fila">
                <div class="columna">
                    <span>{{++$k}}</span>
                </div>
                <div class="columna">
                    <span>{{$cliente->nombre}}</span>
                </div>
                <div class="columna">
                    <span>{{$convenio->nombreCorto}}</span>
                </div>
                <div class="columna">
                    <span>${{$solicitude->prestamosolicitado}}</span>
                </div>
                <div class="columna">
                    <span>${{$solicitude->montorecibido}}</span>
                </div>
                <div class="columna">
                    <span>{{$solicitude->plazo}} Meses</span>
                </div>
                <div class="columna">
                    <span>{{$solicitude->estado}}</span>
                </div>
                <div class="columna d-none">
                    <span>{{$solicitude->updated_at}}</span>
                </div>
                <div class="columna">
                    <span></span>
                </div>
                <div class="columna d-none">
                  {{date('D M j Y G:i:s')}}
                </div>
                <form action="{{ route('solicitudes.destroy',$solicitude->id) }}" method="POST" class="columna" style="gap: 10px;">
                    <a href="{{ route('solicitudes.show',$solicitude->id) }}" class="boton azul"><i class="fa-solid fa-info"></i></a>
                    <a href="{{ route('clientes.create',['idsolicitud' => $solicitude->id]) }}" class="boton verde"><i class="fa-solid fa-pen"></i></a>
                    <button type="submit" class="boton rojo"><i class="fa-solid fa-trash"></i></button>
                </form>
            </div>
        @endforeach
        {!! $solicitudesRechazadasPag->links() !!}
          
        </div>
        </div>
      </section>
    </body>
    <script>
      const cambiarTabla = id => {
        switch(id){
          case 1 :
            document.getElementById('1').classList.add('mostrar');
            document.getElementById('2').classList.remove('mostrar');
            document.getElementById('3').classList.remove('mostrar');
          break;
          case 2 :
            document.getElementById('1').classList.remove('mostrar');
            document.getElementById('2').classList.add('mostrar');
            document.getElementById('3').classList.remove('mostrar');
          break;
          case 3 : 
            document.getElementById('1').classList.remove('mostrar');
            document.getElementById('2').classList.remove('mostrar');
            document.getElementById('3').classList.add('mostrar');
          break;
        };
      };

      let milisegundosActuales=0;
      function calcularTiempo()
      {
        var fechaDelServidor;
        /*
        $.get( "/fechaYHora", function( data ) {
          $("#fechaServidor").html(data);
          fechaDelServidor = data;
          console.log(fechaDelServidor);
        });
        */
        let filas = document.getElementsByClassName("fila");
        for(i = 1; i < filas.length; i++)
        {
            //$(filas[i].children[9]).load("/fechaYHora");
            let fechaMovimiento = new Date(filas[i].children[7].innerText);
            let fechaActual = new Date(filas[i].children[9].innerText);
            if(milisegundosActuales==0)
            {
              milisegundosActuales=fechaActual.getTime();
            }
            let tiempoTranscurrido = milisegundosActuales-fechaMovimiento.getTime();
            let horas = Math.trunc(tiempoTranscurrido/3600000);
            let minutos = Math.trunc(tiempoTranscurrido/60000);
            minutos = minutos%60;
            let segundos = Math.trunc(tiempoTranscurrido/1000);
            segundos = segundos%60;
            if(minutos<10)
            {
                minutos= "0"+minutos;
            }
            if(segundos<10)
            {
                segundos = "0"+segundos;
            }
            if(horas<10)
            {
                horas = "0" + horas;
            }
            if(!isNaN(horas))
            {
              filas[i].children[8].innerText=horas+":"+minutos+":"+segundos;
            }
        }
        milisegundosActuales= milisegundosActuales+1000;
      }
      setInterval(calcularTiempo, 1000);

      function actualizarTiempo(horas, minutos, segundos)
      {
        horas = parseInt(horas);
        minutos = parseInt(minutos);
        segundos = parseInt(segundos);
        if(segundos==59)
        {
            segundos = 0;
            if(minutos==59)
            {
                minutos = 0;
                horas++;
            }else
            {
                minutos++
            }
        }
        if(minutos<10)
        {
            minutos= "0"+minutos;
        }
        if(segundos<10)
        {
            segundos = "0"+segundos;
        }
        if(horas<10)
        {
            horas = "0" + horas;
        }
      }
    </script>
@endsection
