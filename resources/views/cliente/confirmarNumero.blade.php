@extends('layouts.app')
@section('content')

@php
    use App\Http\Controllers\TelefonoController;
@endphp


    <form action="{{route('confirmarTelefono')}}" method="POST">
        @csrf
    {{Form::label('verificacion', 'Ingresa el codigo de verificación');}}
    {{Form::text('verificacion')}}
    <p>{{$error}}</p>
    </form>
@endsection