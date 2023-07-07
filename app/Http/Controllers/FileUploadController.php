<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Documentos;
use App\Models\Cliente;


//prueba para subir archivos
class FileUploadController extends Controller
{
    //
    public function index(Request $request)
    {
        $usuario = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $cliente = Cliente::where('user_id',$usuario)->first();
        $idcliente = $cliente->id;
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
            $documentos->idcliente=null;
        }
        return view('file-upload')->with('documentos',$documentos);
    }
 
    public function store(Request $request)
    {
         
        $validatedData = $request->validate([
         'ine' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'curp' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'actanacimiento' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'rfc' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'comprobantedomicilio' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
         'fotografia' => 'mimetypes:application/pdf,application/msword,image/jpeg,image/bmp,image/png|max:2048',
 
        ]);

        //Se obtiene el id del cliente para la ruta de sus archivos personales
        $usuario = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $cliente = Cliente::where('user_id',$usuario)->first();
        $idcliente = $cliente->id;


        //Si no se van a subir archivos, se toma el valor de un input oculto que puede contener la ruta de un archivo que ya se subió,
        //de otra forma, realiza todo el proceso de subir el archivo nuevamente
        if(is_null($request->file('ine')))
        {
            $ine=$request->input('hiddenine');
        } else
        {
            $nameIne = $request->file('ine')->getClientOriginalName();
            $pathIne = $request->file('ine')->store('public/files/'.$idcliente);
            $ine = $pathIne;
        }
        if(is_null($request->file('curp')))
        {
            $curp=$request->input('hiddencurp');
        } else
        {
            $nameCurp = $request->file('curp')->getClientOriginalName();
            $pathCurp = $request->file('curp')->store('public/files/'.$idcliente);
            $curp = $pathCurp;
        }

        if(is_null($request->file('actanacimiento')))
        {
            $actaNacimiento=$request->input('hiddenacta');
        } else
        {
            $nameActa = $request->file('actanacimiento')->getClientOriginalName();
            $pathActa = $request->file('actanacimiento')->store('public/files/'.$idcliente);
            $actaNacimiento = $pathActa;
        }

        if(is_null($request->file('rfc')))
        {
            $rfc=$request->input('hiddenrfc');
        } else
        {
            $nameRfc = $request->file('rfc')->getClientOriginalName();
            $pathRfc = $request->file('rfc')->store('public/files/'.$idcliente);
            $rfc = $pathRfc;
        }
        if(is_null($request->file('comprobantedomicilio')))
        {
            $comprobanteDom=$request->input('hiddencomprobante');
        } else
        {
            $nameComprobante = $request->file('comprobantedomicilio')->getClientOriginalName();
            $pathComprobante = $request->file('comprobantedomicilio')->store('public/files/'.$idcliente);
            $comprobanteDom = $pathComprobante;
        }

        if(is_null($request->file('fotografia')))
        {
            $foto=$request->input('hiddenfoto');
        } else
        {
            $nameFoto = $request->file('fotografia')->getClientOriginalName();
            $pathFoto = $request->file('fotografia')->store('public/files/'.$idcliente);
            $foto = $pathFoto;
        }

        
        
        //$datosCliente = ClienteP::where('iduser',$userid)->first();

        $Buscardocumentos = Documentos::where('idcliente',$idcliente)->first();
        if(is_null($Buscardocumentos))
        {
            $documentos = new Documentos();
            $documentos->ine=$ine;
            $documentos->curp=$curp;
            $documentos->actaNacimiento=$actaNacimiento;
            $documentos->rfc=$rfc;
            $documentos->comprobanteDomicilio=$comprobanteDom;
            $documentos->fotografia=$foto;
            $documentos->idcliente=$idcliente;
            $documentos->save();
        }else
        {
            $documentos = Documentos::find($Buscardocumentos->id);
            $documentos->ine=$ine;
            $documentos->curp=$curp;
            $documentos->actaNacimiento=$actaNacimiento;
            $documentos->rfc=$rfc;
            $documentos->comprobanteDomicilio=$comprobanteDom;
            $documentos->fotografia=$foto;
            $documentos->idcliente=$idcliente;
            $documentos->save();
        }

        
 
        /*
        $save = new File;
 
        $save->name = $name;
        $save->path = $path;
        $save->save();
 
        */
        return redirect('file-upload')->with('status', 'File Has been uploaded successfully in laravel 8');
 
    }
}
