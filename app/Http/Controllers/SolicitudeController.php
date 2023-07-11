<?php

namespace App\Http\Controllers;

use App\Models\Solicitude;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Convenios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuevaSolicitud;
use Illuminate\Support\Facades\Auth;
//use Barryvdh\DomPDF\Facade\Pdf;
use PDF;

/**
 * Class SolicitudeController
 * @package App\Http\Controllers
 */
class SolicitudeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitudes = Solicitude::paginate();
        //$idusuario = Auth::id();
        //$cliente = Cliente::where('user_id',$idusuario)->first();

        return view('solicitude.index', compact('solicitudes'))
            ->with('i', (request()->input('page', 1) - 1) * $solicitudes->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $solicitude = new Solicitude();
        $iduser = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $cliente = Cliente::where('user_id', $iduser)->first();
        return view('solicitude.create', compact('solicitude'))->with('idcliente',$cliente->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $iduser = $request->session()->get('login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d');
        $cliente = Cliente::where('user_id', $iduser)->first();
        
        $solicitude = new Solicitude();
        $solicitude->pagominimo=$request->input('pagominimo');
        $solicitude->pagomaximo=$request->input('pagomaximo');
        $solicitude->pagodeseado=$request->input('pagodeseado');
        $solicitude->plazo=$request->input('plazo');
        $solicitude->creditomaximo=$request->input('creditomaximo');
        $solicitude->prestamosolicitado=$request->input('prestamosolicitado');
        $solicitude->estado="En proceso";
        $solicitude->idcliente=$cliente->id;
        request()->validate(Solicitude::$rules);
        $solicitude->save();
        */
        request()->validate(Solicitude::$rules);
        $solicitude = Solicitude::create($request->all());
        /*
        if(is_null($solicitude->estado)||$solicitude->estado="")
        {
            $solicitude->estado="En proceso";
            $solicitude->save();
        }
        */
        return redirect()->route('solicitudes.show',$solicitude->id);
        //return redirect()->route('home');
        /*
        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude created successfully.');
        */
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $solicitude = Solicitude::find($id);
        $cliente = Cliente::find($solicitude->idcliente);
        $Meses = $solicitude->plazo;

        $retenciones=3; //Las retenciones estan relacionadas con el convenio, de momento todo se hace usando datos del convenio 54.00
        //Se deben calcular los datos de los pagos, retencion y demás


        $monto = $solicitude->prestamosolicitado;
        $usuario = User::find(Auth::id());
        $convenioT = Convenios::where('nombreCorto',$usuario->convenio)->first();
        $convenio = $convenioT->InstitucionNominaID.".00";
        $retenciones = $convenioT->retenciones;
        //$convenio = 54.00;
        $diaMes = 1;
        $fechaInicio = date("Y-m-d");
        $Transaccion = rand(10,10000000);

        //opcion para cuando se va a imprimir el pdf, para que no se vuelvan a realizar los calclulos
        if( !is_null(session('datosSolicitud'))  )
        {
            $opcion=$request->get('opcion');
            if($opcion=='imprimir'){
                //return redirect()->route('imprimirDatosSolicitud',$datos);
                $datos=session('datosSolicitud');
                $pdf = PDF::loadView('imprimir', ['datos' => $datos]);
                $nombrepdf=strtoupper($cliente->nombre).'$'.number_format($monto, 2, '.', ',').$Meses.'Meses['.date("H:i:s").'].pdf';
                $descarga = $pdf->download($nombrepdf);
                $contenido = $descarga->getOriginalContent();
                $ruta = "public/files/".$cliente->id."/solicitudes/".$solicitude->id.'.pdf';
                Storage::put($ruta, $contenido);
                $datosCorreo = [
                    'idcliente' => $cliente->id,
                    'idsolicitud' =>$solicitude->id,
                ];
                $mailCliente = Auth::user();
                Mail::to($mailCliente)->send(new NuevaSolicitud($datosCorreo));
                return $descarga;
                //imprimir($datos);
            }
        }
        
        
        //Consultas a la base de datos 100% real
        $simulacion     = DB::connection('produccion')->select("
                CALL CREPAGCRECAMORPRO($monto,$convenio,30,'M','D',$diaMes,'$fechaInicio',$Meses,3001,20235,'S','N','N',0.0,'S',@a,@b,@c,@d,@e,@f,@g,1,184,'$fechaInicio','192.168.100.184','/microfin/catalogoCliente.htm',13,-$Transaccion)
            ");
            DB::disconnect('produccion');
            $cuotasMensuales = count($simulacion);
            $cuotasQuincenales = count($simulacion)*2;
            $Par_FechaInicio = $simulacion[0]->Par_FechaInicio;
            $Par_FechaVenc = $simulacion[0]->Par_FechaVenc;
            $MontoCuotaMensual = $simulacion[0]->MontoCuota;
            $MontoCuotaQuincenal = ($MontoCuotaMensual/2);
            $montoRetenciones = $retenciones*$MontoCuotaQuincenal;

            //Conexion a SAFI en produccion
            $seguro     = DB::connection('produccion')->select("
                CALL CALCSEGUROINDVPRO(DATEDIFF('$Par_FechaVenc','$Par_FechaInicio'),$monto,3001,@a,'S',@b,@c,1,0,'1900-01-01', '','SolicitudCreditoDAO',0,0);
            ");
            DB::disconnect('produccion');

            $MontoSeguro = $seguro[0]->MontoSeguro;
            $montoRecibir = ($monto)-($montoRetenciones+$MontoSeguro);

            //     Se guardan los detalles de la solicitud - Comentar si es que algo truena
            $solicitude->montoretenido=$montoRetenciones;
            $solicitude->coberturariesgo=$MontoSeguro;
            $solicitude->montorecibido=$montoRecibir;
            $solicitude->pagoplazo = $MontoCuotaQuincenal;
            $solicitude->save();

            $datos = array(
                'cuotasQuincenales' => $cuotasQuincenales,
                'cuotasMensuales' => $cuotasMensuales,
                'Par_FechaInicio' => $Par_FechaInicio,
                'Par_FechaVenc' => $Par_FechaVenc,
                'MontoCuotaMensual' => $MontoCuotaMensual,
                'MontoCuotaQuincenal' => $MontoCuotaQuincenal,
                'MontoSeguro' => $MontoSeguro,
                'Monto' => $monto,
                'retenciones' => $retenciones,
                'montoRetenciones' => $montoRetenciones,
                'montoRecibir' => $montoRecibir,


                'NombreCompleto' => strtoupper($cliente->nombre),
                'whatsapp' => $cliente->telefono,
                'cuantoGana' => $cliente->ingresoquincenal,
                'cuantoDisponible' => $cliente->disponiblequincenal,
                'ajustePasivos' => $cliente->ajuste,
                'pagoMinimo' => $solicitude->pagominimo,
                'porcentajePago' => 0.4,        //Porcentaje que estaba por defecto
                'pagoMaximo' => $solicitude->pagomaximo,
                'pagoQuincenal' => $solicitude->pagodeseado,
                'meses' => $solicitude->plazo,
                'retenciones' => 3,             //Retenciones por defecto para el convenio 54.0
                'creditoMaximo' => $solicitude->creditomaximo,
                'plazoCredito' => $solicitude->meses,
                'montoSolicitado' => $solicitude->prestamosolicitado,
                'diaPago' => 1,
                'fechaInicio' => date("Y-m-d"),
                //'button' => $request->button,
            );

            session(['datosSolicitud' => $datos]);
            //En la vista, el botón imprimir, redirige a este mismo controlador, mismo metodo
            //pero se incluye un campo opcion, donde se da la opción para generar el pdf y mandarlo por correo

            
        return view('detalle', compact('solicitude'))->with('datos',$datos)->with('cliente',$cliente)->with('convenios', $convenioT);  
        return view('solicitude.show', compact('solicitude'))->with('datos',$datos)
               ->with('cliente',$cliente)->with('convenios', $convenioT);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitude = Solicitude::find($id);

        return view('solicitude.edit', compact('solicitude'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Solicitude $solicitude
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Solicitude $solicitude)
    {
        request()->validate(Solicitude::$rules);

        $solicitude->update($request->all());

        return redirect()->route('solicitudes.show',$solicitude->id);
        return redirect()->route('home');
        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $solicitude = Solicitude::find($id)->delete();

        return redirect()->route('home');
        return redirect()->route('solicitudes.index')
            ->with('success', 'Solicitude deleted successfully');
    }
}
