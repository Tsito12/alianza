<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/subirArchivos.css')}}" rel="stylesheet">
    <title>Subir archivos</title>
</head>
<body>
    <header>
        <div class="logo-contenedor">
            <img src="{{asset('img/logo.png')}}">
        </div>
        <h2>Tu crédito de confianza.</h2>
    </header>
    <section>        
        <form method="post" enctype="multipart/form-data" action="{{ url('store') }}" >
          @csrf
            <div class="tabla">
                <div class="nombre">INE</div>
                <div class="input-contenedor">
                    <input type="file" name="ine" id="ine" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                    <input type="text" name="hiddenine" value="{{$documentos->ine}}" style="display: none;">
                    <label for="ine" class="label-file">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                        </svg>
                        <span>Subir archivo.</span>
                    </label>
                    @error('file')
                      <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                      <div class="alerta">Error</div>
                    @enderror
                    <div class="contenedor-nombre"><span id="nombre-ine"></span></div>    
                </div>
                @if(!is_null($documentos->ine))
                  @php
                      $ruta = "storage/".str_replace("public/","",$documentos->ine);
                  @endphp
                  <div class="estado"><div class="centrar-estado">
                    <h6>Ya se subió un documento</h6>
                    <a href="{{asset($ruta)}}" class="ver">Ver</a>
                  </div></div>
                @endif
                
                <div class="nombre">Comprobante de ingresos</div>
                <div class="input-contenedor">
                    <input type="file" name="ingresos" id="ingresos" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                    <input type="text" name="hiddeningresos" value="{{$documentos->ingresos}}" style="display: none;">
                    <label for="ingresos" class="label-file">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                        </svg>
                        <span>Subir archivo.</span>
                    </label>
                    <div class="contenedor-nombre"><span id="nombre-ingresos"></span></div>   
                    
                </div>
                <div class="estado">
                  @if(!is_null($documentos->ingresos))
                      @php
                          $ruta = "storage/".str_replace("public/","",$documentos->ingresos);
                      @endphp
                      <div class="estado"><div class="centrar-estado">
                        <h6>Ya se subió un documento</h6>
                        <a href="{{asset($ruta)}}" class="ver">Ver</a>
                      </div></div>
                    @endif 
                </div>
                <div class="nombre">Comprobante de domicilio</div>
                <div class="input-contenedor">
                    <input type="file" name="comprobantedomicilio" id="comprobantedomicilio" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                    <input type="text" name="hiddencomprobante" value="{{$documentos->comprobanteDomicilio}}" style="display: none;">
                    <label for="comprobantedomicilio" class="label-file">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                        </svg>
                        <span>Subir archivo.</span>
                    </label>
                    <div class="contenedor-nombre"><span id="nombre-domicilio"></span></div>   
                            
                </div>
                <div class="estado">
                  @if(!is_null($documentos->comprobanteDomicilio))
                      @php
                          $ruta = "storage/".str_replace("public/","",$documentos->comprobanteDomicilio);
                      @endphp
                      <div class="estado"><div class="centrar-estado">
                        <h6>Ya se subió un documento</h6>
                        <a href="{{asset($ruta)}}" class="ver">Ver</a>
                      </div></div>
                    @endif  
                </div>
                <div class="nombre">Fotografía</div>
                <div class="input-contenedor">
                    <input type="file" name="fotografia" id="fotografia" class="input-file" accept="image/png, .jpeg, .jpg, .pdf"/>
                    <input type="text" name="hiddenfotografia" value="{{$documentos->fotografia}}" style="display: none;">
                    <label for="fotografia" class="label-file">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="upload" class="svg-inline--fa fa-upload fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path fill="currentColor" d="M296 384h-80c-13.3 0-24-10.7-24-24V192h-87.7c-17.8 0-26.7-21.5-14.1-34.1L242.3 5.7c7.5-7.5 19.8-7.5 27.3 0l152.2 152.2c12.6 12.6 3.7 34.1-14.1 34.1H320v168c0 13.3-10.7 24-24 24zm216-8v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h136v8c0 30.9 25.1 56 56 56h80c30.9 0 56-25.1 56-56v-8h136c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z"></path>
                        </svg>
                        <span>Subir archivo.</span>
                    </label>
                    <div class="contenedor-nombre"><span id="nombre-foto"></span></div>    
                          
                </div>
                <div class="estado">
                  @if(!is_null($documentos->fotografia))
                      @php
                          $ruta = "storage/".str_replace("public/","",$documentos->fotografia);
                      @endphp
                      <div class="estado"><div class="centrar-estado">
                        <h6>Ya se subió un documento</h6>
                        <a href="{{asset($ruta)}}" class="ver">Ver</a>
                      </div></div>
                    @endif  
                </div>
            </div>
            <button type="submit" class="btn">Enviar</button>
        </form>
    </section>
</body>
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
    document.getElementById('nombre-fo  to').textContent = nombreArchivo;
});
</script>
</html>