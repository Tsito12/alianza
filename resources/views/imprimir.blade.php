<!DOCTYPE html>
<html>
    <head>
        <style>
            .texto-pequeno{
                font-size: 10px;
            }
            .texto-centro{
                text-align: center;
            }
            .texto-derecha{
                text-align: right;
            }
            .texto-izquierda{
                text-align: left;
            }
            .gris{
                background: gray;
                padding-left: 20px;
                padding-right: 20px;
            }
            .clienteDatos{
                background: #eee;
                border:0;
                border-bottom: 1px solid;
            }
            .cabecera-exi{
                /*background-color: black;*/
                height: 20px;
                border: 0;
                background-color: #ffe699;
                font-weight: bold;
                font-family: Cambria, Georgia, serif;
                font-size: 8px;
            }
            .cabecera-liquida{
                /*background-color: black;*/
                height: 20px;
                border: 0;
                background-color: #fff2cc;
                font-weight: bold;
                font-family: Cambria, Georgia, serif;
                font-size: 8px;
            }
            .logo{
                width: 20%;
            }
            .grisObscuro{
                background: #808080;
                font-weight: bold;
            }
            .subrayado{
                text-decoration: underline;
            }
            .bordesolido{
                border-color: black;
                border-width: 1px;
                border-style: solid;
            }
            .tablaDato{
                width:50px;
                border-color: black;
                border-width: 1px;
                border-style: solid;
                text-align: center;
                height: 15px;
            }
            .tablaInfor{
                text-align: right;
                /*height: 120px;*/
            }
            .tablaInfor{

            }
            .contenedor{
                border-color: black;
                border-width: 1px;
                border-style: solid;
            }
            .mayuscula {
                text-transform: uppercase;
            }
            .bordeTabla {
                border: 1px solid black;
                border-collapse: collapse;
            }

            #noBordeTabla td, #noBordeTabla th {
                border: none;
                padding: 5px;
            }

            .bordeDerecho{
                border-right: 1px solid black;
                border-collapse: collapse;
            }
            .texto-blanco{
                color:white;
            }
            .derecha {
                position: absolute;
                right: 30px;
                /*top:-15px;*/
            }
            .texto-justificado{
                text-align : justify;
            }
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #clientes td, #clientes th {
                border: 1px solid #dddddd;
                /*text-align: left;*/
                padding: 10px;
            }

            #grupos td, #grupos th {
                border: 1px solid #dddddd;
                /*text-align: left;*/
                padding: 3px;
            }
            .texto-rojo{
                color: red;
            }
            .texto-verde{
                color: green;
            }
            .texto-grande{
                font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;
                font-size: 40px;
                font-weight: bold;
            }
            .subrayado{
                text-decoration: underline;
            }
        </style>
    </head>
    <body style="padding-left: 15px;padding-right: 15px;">
        @php
            $dia = array("DOMINGO","LUNES","MARTES","MIÉRCOLES","JUEVES","VIERNES","SÁBADO");
            $mes = array("ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
            //$sucursal = Auth::user()->sucursal->nombre;
        @endphp
        <div style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size: 11px;">
            <div class="texto-izquierda">
                <img width="150px;" src="" alt="">
            </div>
            <div class="texto-centro">
                <h1><strong>Simulador y evidencia de análisis de crédito - {{ date('Y') }}</strong></h1>
            </div>
            <div class="texto-derecha">
                 {{ $dia[date("w")] }}, {{ date('d') }} DE {{ $mes[date("n")-1] }} DE {{ date('Y') }} {{ date('H:m') }}
            </div>
        </div>
        <br>
        <div class="texto-centro" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;">
            <strong>DATOS DEL CLIENTE</strong>
        </div>
        <br>
        <table id="noBordeTabla" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;">
            <tr>
                <td width="45%"> <strong>Nombre del cliente:</strong></td>
                <td width="55%" class="mayuscula">{{ $datos['NombreCompleto'] }}</td>
            </tr><tr>
                <td width="45%"> <strong>Whatsapp:</strong></td>
                <td width="55%">
                    <a href="https://web.whatsapp.com/send/?phone=+52{{ $datos['whatsapp'] }}&text=Hola." target="_blank">{{ $datos['whatsapp'] }}</a>
                </td>
            </tr><tr>
                <td width="45%"> <strong>INGRESO QUINCENAL:</strong></td>
                <td width="55%">$ {{ number_format($datos['cuantoGana'], 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td valign="center"> <strong>DISPONIBLE QUINCENAL:</strong></td>
                <td valign="center">$ {{ number_format($datos['cuantoDisponible'], 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td valign="center"> <strong>AJUSTE POR PASIVOS (+ -):</strong></td>
                <td valign="center">$ {{ number_format($datos['ajustePasivos'], 2, '.', ',') }}</td>
            </tr>
            @php
                $porcentajeUsado = $datos['porcentajePago']*10;
            @endphp
            <tr style='text-decoration: underline'>
                <td valign="center"> <strong>TOTAL DISPONIBLE:</strong></td>
                <td valign="center"><strong>$ {{ number_format($datos['ajustePasivos']+$datos['cuantoDisponible'], 2, '.', ',') }}</strong>
                    <small>
                        @for($i=0;$i<$porcentajeUsado;$i++) 
                            {{-- * --}}
                        @endfor
                    </small>
                </td>
            </tr>
            <tr style='text-decoration: underline'>
                <td valign="center"> <strong>DISPONIBLE CALCULADO AL {{ ($datos['porcentajePago'])*(100) }}%:</strong></td>
                <td valign="center"><strong>$ {{ number_format($datos['pagoMaximo'], 2, '.', ',') }}</strong>
                    <small>
                        @for($i=0;$i<$porcentajeUsado;$i++) 
                            {{-- * --}}
                        @endfor
                    </small>
                </td>
            </tr>
        </table>
        <br>
        <div class="texto-centro" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;">
            <strong>DATOS DEL CRÉDITO</strong>
        </div>
        <br>
        <table id="noBordeTabla" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;">
            <tr>
                <td width="40%"><strong>MONTO DEL CRÉDITO:</strong></td>
                <td valign="center" class="texto-grande texto-verde">$ {{ number_format($datos['montoSolicitado'], 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td valign="center"><strong>PLAZO:</strong></td>
                <td valign="center">{{ $datos['cuotasQuincenales'] }} QUINCENAS - {{ $datos['cuotasMensuales'] }} MESES</td>
            </tr>
            <tr>
                <td valign="center"><strong>FECHA INICIO:</strong></td>
                <td valign="center">{{ $datos['Par_FechaInicio'] }}</td>
            </tr>
            <tr>
                <td valign="center"><strong>DESCUENTO QUINCENAL:</strong></td>
                <td valign="center"><strong>$ {{ number_format($datos['MontoCuotaQuincenal'], 2, '.', ',') }}</strong></td>
            </tr>
            <tr>
                <td valign="center"><strong>{{ $datos['retenciones'] }} RETENCIONES:</strong></td>
                <td valign="center">- $ {{ number_format($datos['montoRetenciones'], 2, '.', ',') }}</td>
            </tr>
            <tr>
                <td valign="center"><strong>COBERTURA DE RIESGO:</strong></td>
                <td valign="center">- $ {{ number_format($datos['MontoSeguro'], 2, '.', ',') }}</td>
            </tr>
        </table>
        <br><br>
        <table id="noBordeTabla" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;">
            <tr>
                <td valign="center"><strong>MONTO A RECIBIR DESPUES DE RETENCIONES Y SEGURO:</strong></td>
                <td valign="center" class="texto-grande texto-verde">$ {{ number_format($datos['montoRecibir'], 2, '.', ',') }}</td>
            </tr>
        </table>
        <br><br><br>
        <table id="noBordeTabla" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size: 11px;">
            <tr>
                <td width="50%" class="texto-centro">_____________________________________________</td>
                <td width="50%" class="texto-centro">_____________________________________________</td>
            </tr>
            <tr>
                <td width="50%" class="texto-centro">ASESOR DE CRÉDITO</td>
                <td width="50%" class="texto-centro">SUB-COMITÉ DE CRÉDITO</td>
            </tr>
        </table>
        <br><br><br><br><br>
        <table id="noBordeTabla" style="font-family: Calibri, Candara, Segoe, 'Segoe UI', Optima, Arial, sans-serif;font-size: 11px;">
            <tr>
                <td width="50%" class="texto-centro mayuscula subrayado">_________________{{ $datos['NombreCompleto'] }}_______________</td>
            </tr>
            <tr>
                <td width="50%" class="texto-centro">NOMBRE Y FIRMA DEL CLIENTE</td>
            </tr>
        </table>
        <div style="page-break-inside:avoid;"></div>
    </body>
</html>