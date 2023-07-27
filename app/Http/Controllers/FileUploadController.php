<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Documentos;
use App\Models\Documentoscliente;
use App\Models\Cliente;
use Illuminate\Support\Facades\Storage;


//prueba para subir archivos
class FileUploadController extends Controller
{
    //
    public function index(Request $request)
    {
        $idcliente = $request->query('idcliente');
        if(is_null($idcliente)||$idcliente=="")
        {
            $usuario = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            $cliente = Cliente::where('user_id',$usuario)->first();
            $idcliente = $cliente->id;
        }
        $ine = Documentoscliente::where('idcliente', $idcliente)->where('tipodocumento',1)->first();
        $ingresos = Documentoscliente::where('idcliente', $idcliente)->where('tipodocumento',2)->first();
        $domicilio = Documentoscliente::where('idcliente', $idcliente)->where('tipodocumento',3)->first();
        $foto = Documentoscliente::where('idcliente', $idcliente)->where('tipodocumento',4)->first();
        $documentosN = array(
            "ine" => $ine,
            "ingresos" => $ingresos,
            "domicilio" => $domicilio,
            "foto" => $foto
        );
        foreach($documentosN as $documento)
        {
            if(is_null($documento))
            {
                $documento = new Documentocliente();
                $documento->documento = "";
                $documento->idcliente = $idcliente;
            }
        }
        $documentos = Documentos::where('idcliente',$idcliente)->first();
        if(is_null($documentos))
        {
            $documentos= new Documentos();
            $documentos->ine=null;
            $documentos->curp=null;
            $documentos->actaNacimiento=null;
            $documentos->rfc=null;
            $documentos->comprobanteDomicilio=null;
            $documentos->fotografia=null;
            $documentos->ingresos=null;
            $documentos->idcliente=$idcliente;
        }
        return view('file-upload')->with('documentos',$documentos)->with('documentosN',$documentosN);
    }
 
    public function store(Request $request)
    {
         
        $validatedData = $request->validate([
         'ine' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'comprobantedomicilio' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'fotografia' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'ingresos' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
 
        ]);
        
        //Se obtiene el id del cliente para la ruta de sus archivos personales
        $idcliente = $request->input('idcliente');
        if(is_null($idcliente)||$idcliente=="")
        {
            $usuario = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
            $cliente = Cliente::where('user_id',$usuario)->first();
            $idcliente = $cliente->id;
        }
        $cliente = Cliente::find($request->input('idcliente'));
        $telefonoAsesor = "529513566175";       //Mi telefono de mientras

        //Si no se van a subir archivos, se toma el valor de un input oculto que puede contener la ruta de un archivo que ya se subió,
        //de otra forma, realiza todo el proceso de subir el archivo nuevamente
        $documentoscliente = new Documentoscliente();
        if(is_null($request->file('ine')))
        {
            $ine=$request->input('hiddenine');
        } else
        {
            $nameIne = $request->file('ine')->getClientOriginalName();
            $pathIne = $request->file('ine')->store('/files/'.$idcliente, 'public');
            $ine = $pathIne;
            $estado = "Documento modificado";
            $observaciones = "Documento modificado";
            $documentoIne = Documentoscliente::where('idcliente',$request->idcliente)->where('tipodocumento',1)->first();
            if(is_null($documentoIne))
            {
                $documentoIne = new Documentoscliente();
                $estado = "En revisión";
                $observaciones = null;
            }
            $documentoIne->documento = $ine;
            $documentoIne->tipodocumento = 1;
            $documentoIne->idcliente = $idcliente;
            $documentoIne->estado = $estado;
            $documentoIne->observaciones = $observaciones;
            $documentoIne->save();
        }
        if(is_null($request->file('comprobantedomicilio')))
        {
            $comprobanteDom=$request->input('hiddencomprobante');
        } else
        {
            $nameComprobante = $request->file('comprobantedomicilio')->getClientOriginalName();
            $pathComprobante = $request->file('comprobantedomicilio')->store('/files/'.$idcliente);
            $comprobanteDom = $pathComprobante;
            $documentoDom = Documentoscliente::where('idcliente',$request->idcliente)->where('tipodocumento',3)->first();
            $estado = "Documento modificado";
            $observaciones = "Documento modificado";
            if(is_null($documentoDom))
            {
                $documentoDom = new Documentoscliente();
                $estado = "En revisión";
                $observaciones = null;
            }
            $documentoDom->documento = $comprobanteDom;
            $documentoDom->tipodocumento = 3;
            $documentoDom->idcliente = $idcliente;
            $documentoDom->estado = $estado;
            $documentoDom->observaciones = $observaciones;
            $documentoDom->save();
        }

        if(is_null($request->file('fotografia')))
        {
            $foto=$request->input('hiddenfotografia');
        } else
        {
            $nameFoto = $request->file('fotografia')->getClientOriginalName();
            $pathFoto = $request->file('fotografia')->store('/files/'.$idcliente);
            $foto = $pathFoto;
            $documentoFoto = Documentoscliente::where('idcliente',$request->idcliente)->where('tipodocumento',4)->first();
            $estado = "Documento modificado";
            $observaciones = "Documento modificado";
            if(is_null($documentoFoto))
            {
                $documentoFoto = new Documentoscliente();
                $estado = "En revisión";
                $observaciones = null;
            }
            $documentoFoto->documento = $foto;
            $documentoFoto->tipodocumento = 4;
            $documentoFoto->idcliente = $idcliente;
            $documentoFoto->estado = "En revisión";
            $documentoFoto->observaciones = $observaciones;
            //$this->mensajeDocumentoModificado($telefonoAsesor,$idcliente);
            $documentoFoto->save();
        }
        if(is_null($request->file('ingresos')))
        {
            $ingresos=$request->input('hiddeningresos');
        } else
        {
            $nameIngresos = $request->file('ingresos')->getClientOriginalName();
            $pathIngresos = $request->file('ingresos')->store('/files/'.$idcliente);
            $ingresos = $pathIngresos;
            $documentoIngresos = Documentoscliente::where('idcliente',$request->idcliente)->where('tipodocumento',2)->first();
            $estado = "Documento modificado";
            $observaciones = "Documento modificado";
            if(is_null($documentoIngresos))
            {
                $documentoIngresos = new Documentoscliente();
                $estado="En revisión";
                $observaciones = null;
            }
            $documentoIngresos->documento = $ingresos;
            $documentoIngresos->tipodocumento = 2;
            $documentoIngresos->idcliente = $idcliente;
            $documentoIngresos->estado = $estado;
            $documentoIngresos->observaciones = $observaciones;
            //$this->mensajeDocumentoModificado($telefonoAsesor,$idcliente);
            $documentoIngresos->save();
        }

        
        
        //$datosCliente = ClienteP::where('iduser',$userid)->first();

        $Buscardocumentos = Documentos::where('idcliente',$idcliente)->first();
        if(is_null($Buscardocumentos))
        {
            $documentos = new Documentos();
            $documentos->ine=$ine;
            $documentos->comprobanteDomicilio=$comprobanteDom;
            $documentos->fotografia=$foto;
            $documentos->ingresos=$ingresos;
            $documentos->idcliente=$idcliente;
            $documentos->save();
        }else
        {
            $documentos = Documentos::find($Buscardocumentos->id);
            $documentos->ine=$ine;
            $documentos->comprobanteDomicilio=$comprobanteDom;
            $documentos->fotografia=$foto;
            $documentos->ingresos=$ingresos;
            $documentos->idcliente=$idcliente;
            $documentos->save();
        }

        
 
        /*
        $save = new File;
 
        $save->name = $name;
        $save->path = $path;
        $save->save();
 
        */
        return redirect()->route('file-upload',['idcliente' => $idcliente])->with('status', 'File Has been uploaded successfully in laravel 8');
 
    }

    public function cambiarEstado(Request $request)
    {
        try{
            $documento = Documentoscliente::find($request->input('documento'));
            $documento->estado = $request->input('movimiento');
            $documento->observaciones = $request->input('motivo');
            $documento->save();
            if($documento->estado=="Rechazado")
            {
                $cliente = Cliente::find($documento->idcliente);
                //$this->mensajeDocumentoRechazado("52".$cliente->telefono);
            }
            return response()->json([
                'estado' => $request->input('movimiento')
            ]);
        }catch(Exception $e)
        {
            return "Ocurrio un error";
        }
    }

    private function mensajeDocumentoModificado($telefono, $idcliente)
    {
        // ***************     Area de mensajes **********************
            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EAADTQdf3uewBAFPzoi5in5hwB0lrGPDvmdK7i2j4kYbU4EonEZCq74KnMMVYnCIt1iDvONklkU6hFOHvtDW1782IPIZAdiLSeFZAJ6r8aYAzQtP6mNU9fdfvQZBZC2CgcZBMEGOSnDVHairOOmPeezA8FhJKXNV7L0tbZBlBoAtbbXuRdlhBxTFVYD2XcyifgOqeNdg0jfYCQZDZD';
            //Telefono del cliente
            
            //$telefono = "52".$cliente->telefono;
            //URL A DONDE SE MANDARA EL MENSAJE
            $url = 'https://graph.facebook.com/v17.0/101917919641657/messages';

            //CONFIGURACION DEL MENSAJE
            $mensaje = ''
                    . '{'
                    . '"messaging_product": "whatsapp", '
                    . '"to": "'.$telefono.'", '
                    . '"type": "template", '
                    . '"template": {'
                    . '    "name": "documento_modificado",'
                    . '    "language": { '
                    . '     "code": "es_MX"'
                    . '    },'
                    . '"components": [
                        {
                            "type": "button",
                            "sub_type": "url",
                            "index": "0",
                            "parameters": [
                            {
                                "type": "text",
                                "text": "'. $idcliente .'"
                            }
                            ]
                        }
                        ]
                        }
                    }';



            //DECLARAMOS LAS CABECERAS
            $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
            //INICIAMOS EL CURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
            $response = json_decode(curl_exec($curl), true);
            //IMPRIMIMOS LA RESPUESTA 
            //print_r($response);
            //OBTENEMOS EL CODIGO DE LA RESPUESTA
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //CERRAMOS EL CURL
            curl_close($curl);
            //return $response;
    }

    private function mensajeDocumentoRechazado($telefono)
    {
        // ***************     Area de mensajes **********************
            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EAADTQdf3uewBAFPzoi5in5hwB0lrGPDvmdK7i2j4kYbU4EonEZCq74KnMMVYnCIt1iDvONklkU6hFOHvtDW1782IPIZAdiLSeFZAJ6r8aYAzQtP6mNU9fdfvQZBZC2CgcZBMEGOSnDVHairOOmPeezA8FhJKXNV7L0tbZBlBoAtbbXuRdlhBxTFVYD2XcyifgOqeNdg0jfYCQZDZD';
            //Telefono del cliente
            
            //$telefono = "52".$cliente->telefono;
            //URL A DONDE SE MANDARA EL MENSAJE
            $url = 'https://graph.facebook.com/v17.0/101917919641657/messages';

            //CONFIGURACION DEL MENSAJE
            $mensaje = ''
                    . '{'
                    . '"messaging_product": "whatsapp", '
                    . '"to": "'.$telefono.'", '
                    . '"type": "template", '
                    . '"template": {'
                    . '    "name": "documento_rechazado",'
                    . '    "language": { '
                    . '     "code": "es_MX"'
                    . '    },'
                    . ' }
                    }';



            //DECLARAMOS LAS CABECERAS
            $header = array("Authorization: Bearer " . $token, "Content-Type: application/json",);
            //INICIAMOS EL CURL
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            //OBTENEMOS LA RESPUESTA DEL ENVIO DE INFORMACION
            $response = json_decode(curl_exec($curl), true);
            //IMPRIMIMOS LA RESPUESTA 
            //print_r($response);
            //OBTENEMOS EL CODIGO DE LA RESPUESTA
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //CERRAMOS EL CURL
            curl_close($curl);
            //return $response;
    }
}
