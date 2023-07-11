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
        <h3>¿Cómo prefieres que nuestro asesor se comunique contigo?</h3>
      </div>
      <form action="{{route('contacto')}}" method="POST">
        @csrf
        <div class="inps">
          <label class="radio-button">
            <input type='radio' name='radio' value='1' checked/> WhatsApp<span></span>
          </label>
          <label class="radio-button">
            <input type='radio' name='radio' value='2'/> Llamada telefónica<span></span>
          </label>
          <label class="radio-button">
            <input type='radio' name='radio' value='3'/> SMS<span></span>
          </label>
        </div>
        <div class="btn-contenedor">
          <button type="submit">Aceptar</button>
        </div>
      </form>
    </div>
  </section>
@endsection