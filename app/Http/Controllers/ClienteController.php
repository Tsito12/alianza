<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Convenios;
use App\Models\Solicitude;

/**
 * Class ClienteController
 * @package App\Http\Controllers
 */
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate();

        return view('cliente.index', compact('clientes'))
            ->with('i', (request()->input('page', 1) - 1) * $clientes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        $iduser = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $usuario = User::find($iduser);
        $cliente = Cliente::where('user_id',$iduser)->first();
        $convenio = Convenios::where('nombreCorto',$usuario->convenio)->first();
        if(is_null($cliente)){
            $cliente = new Cliente();
            $cliente->nombre="";
            $cliente->telefono="";
        }
        return view('cliente.datosCliente', compact('cliente'))->with('usuario',$iduser)->with('cliente',$cliente)->with('convenio', $convenio);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $creditoMaximo=$request->input('creditomaximo');
        if($creditoMaximo!=0||!is_null($creditoMaximo)||$creditoMaximo!="")
        {
            $solicitud = new Solicitude();
            $solicitud->pagominimo=500;
            $solicitud->pagomaximo=$request->input('pagomaximo');
            $solicitud->pagodeseado=$request->input('pagodeseado');
            $solicitud->plazo=$request->input('plazo');
            $solicitud->creditomaximo=$request->input('creditomaximo');
            $solicitud->prestamosolicitado=$request->input('prestamosolicitado');
            $solicitud->estado='En proceso';
            $solicitud->idcliente=$request->input('idcliente');
            $solicitud->save();
            $idsolicitud = $solicitud->id;
            return redirect()->route('solicitudes.show',$solicitud->id);
            return redirect()->route('home');
        }
        $ingresoquincenal = $request->input('ingresoquincenal');
        $iduser = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        
        
        $cliente = new Cliente();
        if($ingresoquincenal==""||is_null($ingresoquincenal)||$ingresoquincenal=0)
        {
            request()->validate(Cliente::$rules);
            $cliente = Cliente::create($request->all());
            $usuario = User::find($iduser);
            $usuario->name=$cliente->nombre;
            $usuario->save();


            $numeroConfirmacion = $request->input('confirmaciontelefono');
            $telefono = "52".$cliente->telefono;
            $this->enviarMensajeConfirmacionNumero($telefono, $numeroConfirmacion);
            return redirect()->route('confirmarTelefono');
        }else{
            $cliente = Cliente::where('user_id',$iduser)->first();
            $cliente->ingresoquincenal = $request->input('ingresoquincenal');
            $cliente->disponiblequincenal = $request->input('disponiblequincenal');
            $cliente->ajuste = $request->input('ajuste');
            $cliente->convenio = $request->input('convenio');
            $cliente->save();
            return redirect()->route('home');
        }
        
        
        
        return redirect()->route('home');
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente created successfully.');
    }

    private function enviarMensajeConfirmacionNumero($telefono, $numeroConfirmacion)
    {
        // ***************     Area de mensajes **********************
            //TOKEN QUE NOS DA FACEBOOK
            $token = 'EAADTQdf3uewBAJl9FWezKtsBDlODZCaYMvCaeZAuaaV5ZAQ3tS4kMDXG0lxaZBIOlZCakW8P86lMrfGfIFWJToKtQtDxOfAZAjweSsjpJP0sgymdDNCewj2KMQulqKQPddLxBDyU6xbjQHAhAZBGPnypqIGasA9k5weuZAEgyjW8fZBe3lVHTKyf7F5L4bBKgPOibJ0b8ROQY4QZDZD';
            //Telefono del cliente
            
            //$telefono = "52".$cliente->telefono;
            //URL A DONDE SE MANDARA EL MENSAJE
            $url = 'https://graph.facebook.com/v17.0/116652391481178/messages';

            //CONFIGURACION DEL MENSAJE
            $mensaje = ''
                    . '{'
                    . '"messaging_product": "whatsapp", '
                    . '"to": "'.$telefono.'", '
                    . '"type": "template", '
                    . '"template": {'
                    . '    "name": "prueba_auth",'
                    . '    "language": { '
                    . '     "code": "es_MX"'
                    . '    },'
                    . '"components": [
                        {
                            "type": "body",
                            "parameters": [
                            {
                                "type": "text",
                                "text": "'.$numeroConfirmacion.'"
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
                                "text": "'. $numeroConfirmacion .'"
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

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.show', compact('cliente'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::find($id);

        return view('cliente.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        $estado = $request->input('estado');
        if($estado != ""|| !is_null($estado))
        {
            $clienteN = Cliente::find($cliente->id);
            $clienteN->estado = $estado;
            $clienteN->save();
        }else{
            request()->validate(Cliente::$rules);

            $cliente->update($request->all());
        }
        

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id)->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente deleted successfully');
    }
}
