@include('layouts.app')

<link href="{{asset('css/subirArchivos.css')}}" rel="stylesheet">
<title>Subir archivos</title>
<section>
    <form method="post" enctype="multipart/form-data" action="{{ url('store') }}" >
      @csrf
      {{Form::hidden('idcliente',$documentosN['ine']->idcliente)}}
        <div class="tabla">
            <div class="nombre">INE</div>
            <div class="input-contenedor">
                <input type="file" name="ine" id="ine" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                <input type="text" name="hiddenine" value="{{$documentosN['ine']->documento}}" style="display: none;">
                <input type="hidden" id="documentoIne" name="documentoIne" value="{{$documentosN['ine']->id}}">
                <label for="ine" class="label-file">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                    </svg>
                    <span>Subir archivo.</span>
                </label>
                <div class="contenedor-nombre"><span id="nombre-ine"></span></div>    
            </div>
            <div class="estado"><div class="centrar-estado">
            @if(!is_null($documentosN['ine']->documento))
              @php
                  $ruta = "storage/".str_replace("public/","",$documentosN['ine']->documento);
              @endphp
              
                <h6>Ya se subió un documento</h6>
                <a href="{{asset($ruta)}}" class="ver">Ver</a>

            @endif
            </div>
            @if (Auth::user()->tipo=="Admin")
                <div>
                    <!--como hacer que se pase que opcion fue la que se pulsó -->
                    <a class="btn @if($documentosN['ine']->estado=="Aprobado") disabled @endif" id="aprobarIne" onclick="movimiento(this)" href="#">Aprobar</a>
                    <a class="btn btn-danger @if($documentosN['ine']->estado=="Rechazado") disabled @endif" id="rechazarIne" onclick="movimiento(this)" href="#">Rechazar</a>
                    <label for="motivoIne" class="form-control">Observaciones</label>
                    <input class="form-control" type="text" name="motivoIne" id="motivoIne" value="{{$documentosN['ine']->observaciones}}">
                </div>
            @endif
        </div>
            <div class="nombre">Comprobante de ingresos</div>
            <div class="input-contenedor">
                <input type="file" name="ingresos" id="ingresos" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                <input type="text" name="hiddeningresos" value="{{$documentosN['ingresos']->documento}}" style="display: none;">
                <input type="hidden" id="documentoIngresos" name="documentoIngresos" value="{{$documentosN['ingresos']->id}}">
                <label for="ingresos" class="label-file">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                    </svg>
                    <span>Subir archivo.</span>
                </label>
                <div class="contenedor-nombre"><span id="nombre-ingresos"></span></div>   
                
            </div>
            <div class="estado">
              @if(!is_null($documentosN['ingresos']->documento))
                  @php
                      $ruta = "storage/".str_replace("public/","",$documentosN['ingresos']->documento);
                  @endphp
                  <div class="estado"><div class="centrar-estado">
                    <h6>Ya se subió un documento</h6>
                    <a href="{{asset($ruta)}}" class="ver">Ver</a>
                  </div></div>
                @endif 
                @if (Auth::user()->tipo=="Admin")
                    <div>
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a class="btn @if($documentosN['ingresos']->estado=="Aprobado") disabled @endif" id="aprobarIngresos" onclick="movimiento(this)" href="#">Aprobar</a>
                        <a class="btn btn-danger @if($documentosN['ingresos']->estado=="Rechazado") disabled @endif" id="rechazarIngresos" onclick="movimiento(this)" href="#">Rechazar</a>
                        <label for="motivoIngresos" class="form-control">Observaciones</label>
                        <input class="form-control" type="text" name="motivoIngresos" id="motivoIngresos" value="{{$documentosN['ingresos']->observaciones}}">
                    </div>
                @endif
            </div>
            <div class="nombre">Comprobante de domicilio</div>
            <div class="input-contenedor">
                <input type="file" name="comprobantedomicilio" id="comprobantedomicilio" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                <input type="text" name="hiddencomprobante" value="{{$documentosN['domicilio']->documento}}" style="display: none;">
                <input type="hidden" id="documentoDomicilio" name="documentoDomicilio" value="{{$documentosN['domicilio']->id}}">
                <label for="comprobantedomicilio" class="label-file">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                    </svg>
                    <span>Subir archivo.</span>
                </label>
                <div class="contenedor-nombre"><span id="nombre-domicilio"></span></div>   
                        
            </div>
            <div class="estado">
              @if(!is_null($documentosN['domicilio']->documento))
                  @php
                      $ruta = "storage/".str_replace("public/","",$documentosN['domicilio']->documento);
                  @endphp
                  <div class="estado"><div class="centrar-estado">
                    <h6>Ya se subió un documento</h6>
                    <a href="{{asset($ruta)}}" class="ver">Ver</a>
                  </div></div>
                @endif  
                @if (Auth::user()->tipo=="Admin")
                    <div>
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a class="btn @if($documentosN['domicilio']->estado=="Aprobado") disabled @endif" id="aprobarDomicilio" onclick="movimiento(this)" href="#">Aprobar</a>
                        <a class="btn btn-danger @if($documentosN['ingresos']->estado=="Rechazado") disabled @endif" id="rechazarDomicilio" onclick="movimiento(this)" href="#">Rechazar</a>
                        <label for="motivoDomicilio" class="form-control">Observaciones</label>
                        <input class="form-control" type="text" name="motivoDomicilio" id="motivoDomicilio" value="{{$documentosN['domicilio']->observaciones}}">
                    </div>
                @endif
            </div>
            <div class="nombre">Fotografía</div>
            <div class="input-contenedor">
                <input type="file" name="fotografia" id="fotografia" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                <input type="text" name="hiddenfotografia" value="{{$documentosN['foto']->documento}}" style="display: none;">
                <input type="hidden" id="documentoFoto" name="documentoFoto" value="{{$documentosN['foto']->id}}">
                <label for="fotografia" class="label-file">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                    </svg>
                    <span>Subir archivo.</span>
                </label>
                <div class="contenedor-nombre"><span id="nombre-foto"></span></div>    
                      
            </div>
            <div class="estado">
              @if(!is_null($documentosN['foto']->documento))
                  @php
                      $ruta = "storage/".str_replace("public/","",$documentosN['foto']->documento);
                  @endphp
                  <div class="estado"><div class="centrar-estado">
                    <h6>Ya se subió un documento</h6>
                    <a href="{{asset($ruta)}}" class="ver">Ver</a>
                  </div></div>
                @endif  
                @if (Auth::user()->tipo=="Admin")
                    <div>
                        <!--como hacer que se pase que opcion fue la que se pulsó -->
                        <a class="btn @if($documentosN['foto']->estado=="Aprobado") disabled @endif" id="aprobarFoto" onclick="movimiento(this)" href="#">Aprobar</a>
                        <a class="btn btn-danger @if($documentosN['foto']->estado=="Rechazado") disabled @endif" id="rechazarFoto" onclick="movimiento(this)" href="#">Rechazar</a>
                        <label for="motivoFoto" class="form-control">Observaciones</label>
                        <input class="form-control" type="text" name="motivoFoto" id="motivoFoto" value="{{$documentosN['foto']->observaciones}}">
                    </div>
                @endif
            </div>
        </div>
        <button type="submit" class="btn">Enviar</button>
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
            motivo = documento.getElementById("motivoIne").value;
        break;
        case "Ingresos":
            documentoid = document.getElementById("documentoIngresos").value;
            motivo = document.getElementById("motivoIngresos").value;
        break;
        case "Domicilio":
            documentoid = document.getElementById("documentoDomicilio").value;
            motivo = document.getElementById("motivoDomicilio").value;
        break;
        case "Foto":
            documentoid = document.getElementById("documentoFoto").value;
            motivo = document.getElementById("motivoFoto").value;
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
                            }

                            );
    

}
</script>
