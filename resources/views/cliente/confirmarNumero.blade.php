@extends('layouts.app')
@section('content')

@php
    use App\Http\Controllers\TelefonoController;
@endphp

<style>
    @font-face {
        font-family: 'Presidencia Fina';
        src: url('fonts/PresidenciaFina.otf') format('opentype');
    }

    @font-face {
        font-family: 'Presidencia Firme';
        src: url('fonts/PresidenciaFirme.otf') format('opentype');
    }
</style>
<link href="css/confirmacion.css" rel="stylesheet">
    <form action="{{route('confirmarTelefono')}}" method="POST">
        @csrf
        <section>
            <div class="inp-contenedor">
              <h3>Ingresa tu código de verificación:</h3>
              <div class="inps">
                <input id="1" name="1" type="text" maxlength="1">
                <input id="2" name="2" type="text" maxlength="1">
                <input id="3" name="3" type="text" maxlength="1">
                <input id="4" name="4" type="text" maxlength="1">
              </div>
              <button>Aceptar</button>
            </div>
          </section>
        </body>
        <script>
          const input1 = document.getElementById('1'),
                input2 = document.getElementById('2'),
                input3 = document.getElementById('3'),
                input4 = document.getElementById('4');
        
          input1.addEventListener('keyup', ev => {
            var key = ev.keyCode || ev.which;
            
            if(key !== 8){
              input2.focus();
            };
          });
        
          input2.addEventListener('keyup', ev => {
            var key = ev.keyCode || ev.which;
        
            if(key !== 8){
              input3.focus();
            };
        
            if(key === 8){
              input1.focus();
            };
          });
        
          input3.addEventListener('keyup', ev => {
            var key = ev.keyCode || ev.which;
        
            if(key !== 8){
              input4.focus();
            };
        
            if(key === 8){
              input2.focus();
            };
          });
        
          input4.addEventListener('keyup', ev => {
            var key = ev.keyCode || ev.which;
        
            if(key === 8){
              input3.focus();
            };
          });
        </script>
    </form>
@endsection