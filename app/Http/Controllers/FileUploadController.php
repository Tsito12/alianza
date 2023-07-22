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
            $documentoIne = Documentoscliente::where('idcliente',$request->idcliente)->where('tipodocumento',1)->first();
            if(is_null($documentoIne))
            {
                $documentoIne = new Documentoscliente();
            }
            $documentoIne->documento = $ine;
            $documentoIne->tipodocumento = 1;
            $documentoIne->idcliente = $request->input('idcliente');
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
            if(is_null($documentoDom))
            {
                $documentoDom = new Documentoscliente();
            }
            $documentoDom->documento = $comprobanteDom;
            $documentoDom->tipodocumento = 3;
            $documentoDom->idcliente = $request->input('idcliente');
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
            if(is_null($documentoFoto))
            {
                $documentoFoto = new Documentoscliente();
            }
            $documentoFoto->documento = $foto;
            $documentoFoto->tipodocumento = 4;
            $documentoFoto->idcliente = $request->input('idcliente');
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
            if(is_null($documentoIngresos))
            {
                $documentoIngresos = new Documentoscliente();
            }
            $documentoIngresos->documento = $ingresos;
            $documentoIngresos->tipodocumento = 2;
            $documentoIngresos->idcliente = $request->input('idcliente');
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
            return response()->json([
                'estado' => $request->input('movimiento')
            ]);
        }catch(Exception $e)
        {
            return "Ocurrio un error";
        }
    }
}
