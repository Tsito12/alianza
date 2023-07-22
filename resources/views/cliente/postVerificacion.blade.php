@extends('layouts.app')
@section('content')
    <link href="{{asset('css/pantallaPostVerificacion.css')}}" rel="stylesheet">
  <section>
    <h3>Has verificado tu cuenta exitosamente.</h3>
    <div class="img-contenedor">
      <img src="{{asset('img/BotVerificacion.png')}}">
    </div>
    <a href="{{route('file-upload')}}">Aceptar</a>
  </section>

@endsection