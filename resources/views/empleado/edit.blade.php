@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" enctype="multipart/form-data">@csrf
            @method('PATCH') <!-- Usamos PATCH para indicar que es una actualizacion -->



            @include('empleado.form', ['modo' => 'Editar']) <!-- Incluimos el formulario de empleado ( form.blade.php ) -->


        </form>
    </div>
@endsection
