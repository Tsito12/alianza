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
        $codigo = $cliente->confirmaciontelefono;
        $error = "El codigo de verificación es incorrecto";
        if($request->input('verificacion')==$codigo) return redirect()->route('home');
        else return view('cliente.confirmarNumero')->with('error', $error);
        
    }
}
