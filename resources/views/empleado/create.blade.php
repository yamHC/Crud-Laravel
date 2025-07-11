@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/empleado') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @include('empleado.form', ['modo' => 'Crear']) <!-- Incluimos el formulario de empleado () -->
        </form>
    </div>
@endsection
