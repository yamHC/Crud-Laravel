@extends('layouts.app')

@section('content')
    <div class="container">

        @if (Session::has('mensaje'))
            {{ Session::get('mensaje') }}
        @endif

        <a href="{{ url('empleado/create') }} " class="btn btn-success">Registrar nuevo Empleado</a>
        <br><br>

        <table class="table table-light">
            <thead class="thead-dark">
                <!-- Cabcera de la Tabla-->
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Fecha de Nacimiento</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- LLamar a los datos de la BD-->
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>
                            <!-- Mostrar la foto del empleado -->
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $empleado->foto }}" alt="Foto de {{ $empleado->nombre }}"
                                class="img-thumbnail" style="width: 100px; height: 100px;">
                        </td>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->apellido }}</td>
                        <td>{{ $empleado->email }}</td>
                        <td>{{ $empleado->telefono }}</td>
                        <td>{{ $empleado->fecha_nacimiento }}</td>
                        <td>
                            <!-- Boton de Editar -->
                            <a href="{{ url('/empleado/' . $empleado->id . '/edit') }}" class="btn btn-primary">
                                Editar
                            </a>

                            |
                            <!-- Boton de Eliminar -->
                            <form action="{{ url('/empleado/' . $empleado->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <input type="submit" onclick="return confirm('¿Quieres eliminar este registro?')"
                                    value="Eliminar" class="btn btn-danger ">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
