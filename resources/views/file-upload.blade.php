@php
    use App\Models\Solicitude;
@endphp
@include('layouts.app')

<link href="{{asset('css/subirArchivos.css')}}" rel="stylesheet">
<title>Subir archivos</title>
<style>
    @font-face {
        font-family: 'Presidencia';
        src: url('{{asset('fonts/PresidenciaFina.otf')}}') format('opentype'),
            url('{{asset('fonts/PresidenciaFuerte.otf')}}') format('opentype'),
            url('{{asset('fonts/PresidenciaFuerte-Italicas.otf')}}') format('opentype'),
            url('{{asset('fonts/PresidenciaFuerte-Versalitas.otf')}}') format('opentype'),
            url('{{asset('fonts/PresidenciaFirme.otf')}}') format('opentype'),
            url('{{asset('fonts/PresidenciaFirme-Italicas.otf')}}') format('opentype');
    }
</style>
<section>
    <form method="post" enctype="multipart/form-data" action="{{ url('store') }}" >
      @csrf
      {{Form::hidden('idcliente',$documentosN['ine']->idcliente)}}
        <div class="tabla">
            <div class="filas">
                <div class="nombre">INE</div>
                <div class="input-contenedor">
                    <input type="hidden" id="documentoIne" name="documentoIne" value="{{$documentosN['ine']->id}}">
                    <div class="grid-x @if ($documentosN['ine']->estado=="Aprobado")  d-none @endif " id="subirIne">
                        <input type="file" name="ine" id="ine" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                        <input type="text" name="hiddenine" value="{{$documentosN['ine']->documento}}" style="display: none;">
                        <label for="ine" class="label-file">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                            <span>Subir archivo.</span>
                        </label>
                        <div class="contenedor-nombre"><span id="nombre-ine"></span></div>  
                    </div>  
                </div>
                <div class="estado">
                    <div class="estado">
                        @if(!is_null($documentosN['ine']->documento))
                            @php
                                $ruta = "storage/".str_replace("public/","",$documentosN['ine']->documento);
                            @endphp              
                            <h6>Ya se subió un documento</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="filas">
                <div class="visualizacion-contenedor">
                    <embed id="inepro" src="{{asset($ruta)}}"  frameborder="0">
                </div>
            </div>
            @if (Auth::user()->tipo=="Admin")
                <div class="filas">
                    <div class="botones-contenedor">
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a id="aprobarIne" onclick="movimiento(this)" href="#" class=" boton-ap-re verde @if($documentosN['ine']->estado=="Aprobado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a id="rechazarIne" onclick="movimiento(this)" href="#" class=" boton-ap-re rojo @if($documentosN['ine']->estado=="Rechazado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-down"></i>
                        </a>
                    </div>
                    <input id="motivoIne" name="motivoIne" type="text" placeholder="Observaciones" value="{{$documentosN['ine']->observaciones}}" class="observaciones">
                    <a class="boton-integracion">Enviar a integración</a>
                </div>        
            @else
                @if ($documentosN['ine']->estado!="En revisión")
                    <div class="filas">
                        <p class="text-center">{{$documentosN['ine']->estado}}</p>
                        <label for="motivoIne" class="form-control">Observaciones</label>
                        <input class="observaciones disabled" type="text" name="motivoIne" id="motivoIne" value="{{$documentosN['ine']->observaciones}}" readonly>
                    </div>
                @endif
            @endif    
                    @if ($documentosN['ine']->estado!="En revisión")
                            <div>
                                <p class="text-center">{{$documentosN['ine']->estado}}</p>
                                <label for="motivoIne" class="form-control">Observaciones</label>
                                <input class="form-control disabled" type="text" name="motivoIne" id="motivoIne" value="{{$documentosN['ine']->observaciones}}" readonly>
                            </div>
                    @endif
            @endif
        </div>
        <div class="tabla">
            <div class="filas">
                <div class="nombre">Comprobante de ingresos</div>
                <div class="input-contenedor">
                    <input type="hidden" id="documentoIngresos" name="documentoIngresos" value="{{$documentosN['ingresos']->id}}">
                    <div class="grid-x @if ($documentosN['ingresos']->estado=="Aprobado") d-none @endif " id="subirIngresos">
                        <input type="file" name="ingresos" id="ingresos" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                        <input type="text" name="hiddeningresos" value="{{$documentosN['ingresos']->documento}}" style="display: none;">
                        <label for="ingresos" class="label-file">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                            <span>Subir archivo.</span>
                        </label>
                        <div class="contenedor-nombre"><span id="nombre-ingresos"></span></div>  
                    </div>  
                </div>
                <div class="estado">
                    <div class="estado">
                        @if(!is_null($documentosN['ingresos']->documento))
                            @php
                                $ruta = "storage/".str_replace("public/","",$documentosN['ingresos']->documento);
                            @endphp              
                            <h6>Ya se subió un documento</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="filas">
                <div class="visualizacion-contenedor">
                    <embed id="ingresospro" src="{{asset($ruta)}}"  frameborder="0">
                </div>
            </div>
            @if (Auth::user()->tipo=="Admin")
                <div class="filas">
                    <div class="botones-contenedor">
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a id="aprobarIngresos" onclick="movimiento(this)" href="#" class=" boton-ap-re verde @if($documentosN['ingresos']->estado=="Aprobado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a id="rechazarIngresos" onclick="movimiento(this)" href="#" class=" boton-ap-re rojo @if($documentosN['ingresos']->estado=="Rechazado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-down"></i>
                        </a>
                    </div>
                    <input type="text" name="motivoIngresos" id="motivoIngresos" value="{{$documentosN['ingresos']->observaciones}}" class="observaciones">
                    <a class="boton-integracion">Enviar a integración</a>
                </div>        
            @else
                @if ($documentosN['ingresos']->estado!="En revisión")
                    <div class="filas">
                        <p class="text-center">{{$documentosN['ingresos']->estado}}</p>
                        <label for="motivoIngresos" class="form-control">Observaciones</label>
                        <input class="observaciones disabled" type="text" name="motivoIngresos" id="motivoIngresos" value="{{$documentosN['ingresos']->observaciones}}" readonly>
                    </div>
                @endif
            @endif
        </div>
        <div class="tabla">
            <div class="filas">
                <div class="nombre">Comprobante de domicilio</div>
                <div class="input-contenedor">
                    <input type="hidden" id="documentoDomicilio" name="documentoDomicilio" value="{{$documentosN['domicilio']->id}}">
                    <div class="grid-x @if ($documentosN['domicilio']->estado=="Aprobado") d-none @endif " id="subirDomicilio">
                        <input type="file" name="comprobantedomicilio" id="comprobantedomicilio" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                        <input type="text" name="hiddencomprobante" value="{{$documentosN['domicilio']->documento}}" style="display: none;">
                        <label for="comprobantedomicilio" class="label-file">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                            <span>Subir archivo.</span>
                        </label>
                        <div class="contenedor-nombre"><span id="nombre-domicilio"></span></div>  
                    </div>  
                </div>
                <div class="estado">
                    <div class="estado">
                        @if(!is_null($documentosN['domicilio']->documento))
                            @php
                                $ruta = "storage/".str_replace("public/","",$documentosN['domicilio']->documento);
                            @endphp              
                            <h6>Ya se subió un documento</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="filas">
                <div class="visualizacion-contenedor">
                    <embed id="domiciliopro" src="{{asset($ruta)}}"  frameborder="0">
                </div>
            </div>
            @if (Auth::user()->tipo=="Admin")
                <div class="filas">
                    <div class="botones-contenedor">
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a id="aprobarDomicilio" onclick="movimiento(this)" href="#" class=" boton-ap-re verde @if($documentosN['domicilio']->estado=="Aprobado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a id="rechazarDomicilio" onclick="movimiento(this)" href="#" class=" boton-ap-re rojo @if($documentosN['domicilio']->estado=="Rechazado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-down"></i>
                        </a>
                    </div>
                    <input type="text" name="motivoDomicilio" id="motivoDomicilio" value="{{$documentosN['domicilio']->observaciones}}" class="observaciones">
                    <a class="boton-integracion">Enviar a integración</a>
                </div>        
            @else
                @if ($documentosN['domicilio']->estado!="En revisión")
                    <div class="filas">
                        <p class="text-center">{{$documentosN['domicilio']->estado}}</p>
                        <label for="motivoDomicilio" class="form-control">Observaciones</label>
                        <input class="observaciones disabled" type="text" name="motivoDomicilio" id="motivoDomicilio" value="{{$documentosN['domicilio']->observaciones}}" readonly>
                    </div>
                @endif
            @endif
        </div>
        <div class="tabla">
            <div class="filas">
                <div class="nombre">Fotografía</div>
                <div class="input-contenedor">
                    <input type="hidden" id="documentoFoto" name="documentoFoto" value="{{$documentosN['foto']->id}}">
                    <div class="grid-x @if ($documentosN['foto']->estado=="Aprobado") d-none @endif " id="subirFoto">
                        <input type="file" name="fotografia" id="fotografia" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                        <input type="text" name="hiddenfotografia" value="{{$documentosN['foto']->documento}}" style="display: none;">
                        <label for="fotografia" class="label-file">
                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                            </svg>
                            <span>Subir archivo.</span>
                        </label>
                        <div class="contenedor-nombre"><span id="nombre-foto"></span></div>  
                    </div>  
                </div>
                <div class="estado">
                    <div class="estado">
                        @if(!is_null($documentosN['foto']->documento))
                            @php
                                $ruta = "storage/".str_replace("public/","",$documentosN['foto']->documento);
                            @endphp              
                            <h6>Ya se subió un documento</h6>
                        @endif
                    </div>
                </div>
            </div>
            <div class="filas">
                <div class="visualizacion-contenedor">
                    <embed id="fotopro" src="{{asset($ruta)}}"  frameborder="0">
                </div>
            </div>
            @if (Auth::user()->tipo=="Admin")
                <div class="filas">
                    <div class="botones-contenedor">
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a id="aprobarFoto" onclick="movimiento(this)" href="#" class=" boton-ap-re verde @if($documentosN['foto']->estado=="Aprobado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-up"></i>
                        </a>
                        <a id="rechazarFoto" onclick="movimiento(this)" href="#" class=" boton-ap-re rojo @if($documentosN['foto']->estado=="Rechazado") disabled @endif ">
                            <i class="fa-regular fa-thumbs-down"></i>
                        </a>
                    </div>
                    <input type="text" name="motivoFoto" id="motivoFoto" value="{{$documentosN['foto']->observaciones}}" class="observaciones">
                    <a class="boton-integracion">Enviar a integración</a>
                </div>        
            @else
                @if ($documentosN['foto']->estado!="En revisión")
                    <div class="filas">
                        <p class="text-center">{{$documentosN['foto']->estado}}</p>
                        <label for="motivoFoto" class="form-control">Observaciones</label>
                        <input class="observaciones disabled" type="text" name="motivoFoto" id="motivoFoto" value="{{$documentosN['foto']->observaciones}}" readonly>
                    </div>
                @endif
            @endif
        </div>
        <button type="submit" class="boton">Enviar</button>
    </form>
    @php
        $aprobados = true;
        foreach ($documentosN as $documento) {
            if ($documento->estado!="Aprobado") {
                $aprobados = false;
                break;
            }
        }
    @endphp
    
        @php
            $solicitud = Solicitude::where('idcliente', $documentosN['ine']->idcliente)->first();
        @endphp
        <form action="{{route('solicitudes.update',$solicitud)}}" method="post">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="estado" value="En integracion">
            <input type="hidden" name="idcliente" value="{{$documentosN['ine']->idcliente}}">
            <!--<input type="hidden" name="prestamosolicitado", value="{{$solicitud->prestamosolicitado}}">-->
            <input type="submit" id="botonIntegracion" class="btn boton @if (!$aprobados||(Auth::user()->tipo!="Admin")) d-none
            @endif
            " value="Mandar a integración">
        </form>
    
</section>

<script>
document.getElementById('ine').addEventListener('change', ev => {
const archivo = ev.target.files[0];
const nombreArchivo = archivo ? archivo.name : '';
document.getElementById('nombre-ine').textContent = nombreArchivo;
});

document.getElementById('ingresos').addEventListener('change', ev => {
const archivo = ev.target.files[0];
const nombreArchivo = archivo ? archivo.name : '';
document.getElementById('nombre-ingresos').textContent = nombreArchivo;
});

document.getElementById('comprobantedomicilio').addEventListener('change', ev => {
const archivo = ev.target.files[0];
const nombreArchivo = archivo ? archivo.name : '';
document.getElementById('nombre-domicilio').textContent = nombreArchivo;
});

document.getElementById('fotografia').addEventListener('change', ev => {
const archivo = ev.target.files[0];
const nombreArchivo = archivo ? archivo.name : '';
document.getElementById('nombre-foto').textContent = nombreArchivo;
});

function movimiento(boton)
{
    let accion = boton.innerText;
    let documento = boton.id.replaceAll("aprobar","");
    documento = documento.replaceAll("rechazar","");
    let documentoid = null;
    let resultado = "";
    if(accion == "Aprobar") resultado = "Aprobado";
    else resultado = "Rechazado";
    let motivo;
    switch(documento)
    {
        case "Ine":
            documentoid = document.getElementById("documentoIne").value;
            motivo = document.getElementById("motivoIne").value;
            if(resultado=="Rechazado"||resultado=="En revision") document.getElementById("subirIne").classList.remove("d-none");
            else document.getElementById("subirIne").classList.add("d-none");
        break;
        case "Ingresos":
            documentoid = document.getElementById("documentoIngresos").value;
            motivo = document.getElementById("motivoIngresos").value;
            if(resultado=="Rechazado"||resultado=="En revision") document.getElementById("subirIngresos").classList.remove("d-none");
            else document.getElementById("subirIngresos").classList.add("d-none");
        break;
        case "Domicilio":
            documentoid = document.getElementById("documentoDomicilio").value;
            motivo = document.getElementById("motivoDomicilio").value;
            if(resultado=="Rechazado"||resultado=="En revision") document.getElementById("subirDomicilio").classList.remove("d-none");
            else document.getElementById("subirDomicilio").classList.add("d-none");
        break;
        case "Foto":
            documentoid = document.getElementById("documentoFoto").value;
            motivo = document.getElementById("motivoFoto").value;
            if(resultado=="Rechazado"||resultado=="En revision") document.getElementById("subirFoto").classList.remove("d-none");
            else document.getElementById("subirFoto").classList.add("d-none");
        break;
    }
    var formData = new FormData();

    formData.append("_token", document.getElementsByTagName('input')[0].value);
    formData.append("documento", documentoid);
    formData.append("movimiento", resultado);
    formData.append("motivo", motivo);
    fetch('/cambiarEstado', {
                        method: 'POST',
                        body: formData
                     }).then((response) => {
                                return response.json();
                            })
                            .then((data) => {
                                console.log(data['estado']);
                                boton.classList.add("disabled");
                                if(data['estado']=="Aprobado")
                                {
                                    boton.nextElementSibling.classList.remove('disabled');
                                }else if(data['estado']=="Rechazado")
                                {
                                    boton.previousElementSibling.classList.remove('disabled');
                                }
                                if(documentosListos(boton))
                                {
                                    document.getElementById("botonIntegracion").classList.remove("d-none");
                                }
                            }

                            );
    

}

function documentosListos(boton)
{
    let todoListo = true;
    if(boton.id.indexOf("aprobar")==-1)
    {
        console.log("Se apretó el botón de rechazar para el documento "+boton.id.replaceAll("rechazar",""));
        document.getElementById("botonIntegracion").classList.add("d-none");
        todoListo = false;

    }else
    {
        const ine = document.getElementById("aprobarIne").className;
        const ingresos = document.getElementById("aprobarIngresos").className;
        const domicilio = document.getElementById("aprobarDomicilio").className;
        const foto = document.getElementById("aprobarFoto").className;
        let documentos = [ine,ingresos,domicilio,foto];
        for(let i = 0; i < documentos.length; i++)
        {
            console.log(documentos[i]);
            if(documentos[i].indexOf("disabled")==-1) todoListo = false;
        }
    }
    console.log(todoListo);
    return todoListo;
}
</script>
