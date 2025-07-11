<h1> {{ $modo }} empleado</h1>

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="form-group">

    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" placeholder="Nombre" id="nombre"
        value="{{ isset($empleado->nombre) ? $empleado->nombre : '' }}" class="form-control" >
    <br>

</div>

<div class="form-group">

    <label for="apellido">Apellido:</label>
    <input type="text" name="apellido" placeholder="Apellido" id="apellido"
        value="{{ isset($empleado->apellido) ? $empleado->apellido : '' }}" class="form-control">
    <br>

</div>


<div class="form-group">

    <label for="email">Email:</label>
    <input type="text" name="email" placeholder="Email" id="email"
        value="{{ isset($empleado->email) ? $empleado->email : '' }}" class="form-control">
    <br>

</div>


<div class="form-group">

    <label for="telefono">Telefono:</label>
    <input type="text" name="telefono" placeholder="Telefono" id="telefono"
        value="{{ isset($empleado->telefono) ? $empleado->telefono : '' }}" class="form-control">
    <br>

</div>

<div class="form-group">

    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" placeholder="Fecha de Nacimiento" id="fecha_nacimiento"
        value="{{ isset($empleado->fecha_nacimiento) ? $empleado->fecha_nacimiento : '' }}" class="form-control">
    <br>

</div>

<div class="form-group">

    <label for="foto">Foto:</label>
    @if (isset($empleado->foto))
        <img src="{{ asset('storage') . '/' . $empleado->foto }}" alt="Foto de {{ $empleado->nombre }}"
            class="img-thumbnail" style="width: 100px; height: 100px;">
    @endif
    <input type="file" name="foto" placeholder="Foto" id="foto"
        value="{{ isset($empleado->foto) ? $empleado->foto : '' }} " class="form-control img-thumbnail img-fluid">
    <br>

</div>

<a href="{{ url('empleado/') }}" class="btn btn-primary">Regresar</a>


<input class="btn btn-success" type="submit" value="{{ $modo }} datos"></input>
