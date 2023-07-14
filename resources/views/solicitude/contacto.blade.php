@extends('layouts.app')
<link href="{{asset('css/preferencias.css')}}" rel="stylesheet">
<title>Preferencias de contacto</title>

@section('content')
<header>
    <div class="logo-contenedor">
      <img src="{{('img/logo.png')}}">
    </div>
    <h2>Tu crédito de confianza.</h2>
  </header>
  <section>
    <div class="contenedor-principal">
      <div class="titulo-contenedor">
        <h3>¿Cómo te gustaría que te contactáramos?</h3>
      </div>
      <form action="{{route('contacto')}}" method="POST">
        @csrf
        <div class="inps">
          <label class="radio-button">
            <input type='checkbox' name='whatsapp'/> WhatsApp<span></span>
          </label>
          <label class="radio-button">
            <input type='checkbox' name='llamada'/> Llamada telefónica<span></span>
          </label>
          <label class="radio-button">
            <input type='checkbox' name='sms'/> SMS<span></span>
          </label>
        </div>
        <div class="btn-contenedor">
          <button type="submit">Aceptar</button>
        </div>
      </form>
    </div>
  </section>
@endsection