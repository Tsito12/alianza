@extends('layouts.app')
@section('content')
    <link href="{{asset('css/pantallaPostVerificacion.css')}}" rel="stylesheet">
    <link href="{{ asset('img/SacimexImagotipo.png') }}" rel="icon">
    <style>
        @font-face {
            font-family: 'Presidencia Fina';
            src: url('{{asset('fonts/PresidenciaFina.otf')}}') format('opentype');
        }

        @font-face {
            font-family: 'Presidencia Firme';
            src: url('{{asset('fonts/PresidenciaFirme.otf')}}') format('opentype');
        }
    </style>
  <section>
    <h3>Has verificado tu cuenta exitosamente.</h3>
    <div class="img-contenedor">
      <img src="{{asset('img/BotVerificacion.png')}}">
    </div>
    <a href="{{route('file-upload')}}">Aceptar</a>
  </section>

@endsection