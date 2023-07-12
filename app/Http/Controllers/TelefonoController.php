<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Auth;

class TelefonoController extends Controller
{
    //

    public function index()
    {
        $error = "";
        return view('cliente.confirmarNumero')->with('error',$error);
    }

    public function verificar(Request $request)
    {
        $cliente = Cliente::where('user_id',Auth::id())->first();
        //$solicitud = Solicitude::where('idcliente',$cliente->id)->first();
        $codigo = $cliente->confirmaciontelefono;
        $telefono = "52".$cliente->telefono;
        $telefonoAsesor = "52"."9513566175";
        $error = "El codigo de verificación es incorrecto";
        if($request->input('verificacion')==$codigo) 
        {
            if($cliente->convenio!=10)
            {
                //$this->enviarMensajeSolicitudEnviada($telefonoAsesor, $$cliente->id);
                return 'En breve, un asesor se comunicara con usted';
            } else
            {
                return "Terminó la simulación";
            }
            
        }
        else return view('cliente.confirmarNumero')->with('error', $error);
        
    }

    private function enviarMensajeSolicitudEnviada($telefono, $idcliente)
    {
        // ***************     Area de mensajes **********************
            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EAADTQdf3uewBAOu94FLbcVyBh9jcTVWfsTk3YpJHkPpbHQtt9tcz73mcFYi9k2yZAQWBagkMciPZAJjHVwcMTrkzYG6swcCRcZCl9TZCYecKGn837IkG0OAZCUCEY3DH8n7GaNEe6xhS40d7zlHI3K3xY8X4hTKrp6SU3ScsYVXl2dDgOgttXKOf0kLfFr8aAXqtamrXr4xGpt8GzcN8gMdRzzfQE0acZD';
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
                    . '    "name": "cliente_registrado",'
                    . '    "language": { '
                    . '     "code": "es_MX"'
                    . '    },'
                    . '"components": [
                        {
                            "type": "body",
                            "parameters": [
                            {
                                "type": "text",
                                "text": "'.$idcliente.'"
                            },
                            ]
                        },
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
            print_r($response);
            //OBTENEMOS EL CODIGO DE LA RESPUESTA
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            //CERRAMOS EL CURL
            curl_close($curl);
    }
}
