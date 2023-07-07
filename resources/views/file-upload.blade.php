<!DOCTYPE html>
<html>
<head>
  <title>Laravel 8 File Upload Example</title>
 
  <meta name="csrf-token" content="{{ csrf_token() }}">
 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 
 
</head>
<body>
 
<div class="container mt-4">
 
  <h2 class="text-center">Ejemplo de subir archivos</h2>
 
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ url('store') }}" >
    @csrf
          <div class="row">
 
            

            
             
              <div class="col-md-12">

                
                  <div class="row form-group">
                    <div class="col">
                      <label for="ine">INE</label>
                      <input type="file" name="ine" placeholder="Choose file" id="ine" 
                       accept="image/png, image/jpeg, application/pdf,application/msword" >
                       <input type="text" class="d-none" name="hiddenine" value="{{$documentos->ine}}">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                      
                        @if(!is_null($documentos->ine))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->ine)}}">Ver</a>
                            
                          </div>
                        @endif
                  </div>

                  <div class="row form-group">
                    <div class="col">
                      <label for="actanacimiento">Acta de nacimiento</label>
                      <input type="file" name="actanacimiento" placeholder="Choose file" id="actanacimiento" 
                      accept="image/png, image/jpeg, application/pdf,application/msword" >
                      <input type="text" class="d-none" name="hiddenacta" value="{{$documentos->actaNacimiento}}">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                        @if(!is_null($documentos->actaNacimiento))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->actaNacimiento)}}">Ver</a>
                            
                          </div>
                        @endif
                      
                  </div>

                  <div class="row form-group">
                      <div class="col">
                        <label for="curp">CURP</label>
                        <input type="file" name="curp" placeholder="Choose file" id="curp" 
                          accept="image/png, image/jpeg, application/pdf,application/msword">
                          <input type="text" class="d-none" name="hiddencurp" value="{{$documentos->curp}}">
                          @error('file')
                          <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                          @enderror
                      </div>

                        @if(!is_null($documentos->curp))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->curp)}}">Ver</a>
                            
                          </div>
                        @endif
                      
                  </div>

                  <div class="row form-group">
                    <div class="col">
                      <label for="rfc">RFC</label>
                      <input type="file" name="rfc" placeholder="Choose file" id="rfc" 
                          accept="image/png, image/jpeg, application/pdf,application/msword" >
                          <input type="text" class="d-none" name="hiddenrfc" value="{{$documentos->rfc}}">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                        @if(!is_null($documentos->rfc))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->rfc)}}">Ver</a>
                            
                          </div>
                        @endif
                      
                  </div>

                  <div class="row form-group">
                    <div class="col">
                      <label for="comprobantedomicilio">Comprobante de domicilio</label>
                      <input type="file" name="comprobantedomicilio" placeholder="Choose file" id="comprobantedomicilio" 
                        accept="image/png, image/jpeg, application/pdf,application/msword"  >
                        <input type="text" class="d-none" name="hiddencomprobante" value="{{$documentos->comprobanteDomicilio}}">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                        @if(!is_null($documentos->comprobanteDomicilio))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->comprobanteDomicilio)}}">Ver</a>
                            
                          </div>
                        @endif

                      
                  </div>

                  <div class="row form-group">
                    <div class="col">
                      <label for="fotografia">Fotografía</label>
                      <input type="file" name="fotografia" placeholder="Choose file" id="fotografia" 
                        accept="image/png, image/jpeg, application/pdf,application/msword" >
                        <input type="text" class="d-none" name="hiddenfoto" value="{{$documentos->fotografia}}">
                        @error('file')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                        @if(!is_null($documentos->fotografia))
                          <div class="col">
                            <h6>Ya se subió un documento</h6>
                            <a href="{{'/storage/'.str_replace("public/","",$documentos->fotografia)}}">Ver</a>
                            
                          </div>
                        @endif

                      
                  </div>



              </div>
                 
              <div class="col-md-12">
                  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
              </div>
          </div>     
      </form>
</div>
 
</div>  
</body>
</html>