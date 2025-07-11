<?php

namespace App\Http\Controllers;

use App\Models\Empleado;    // Importamos el modelo Empleado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Importamos Storage para manejar archivos

class EmpleadoController extends Controller
{
    # ------ Listar empleados ------
    public function index()
    {
        
        $datos['empleados'] = Empleado::paginate(5); # Aca llamamos a la clase Empleado y usamos el metodo paginate para paginar los resultados, en este caso 5 resultados por pagina
        return view('empleado.index', $datos);
    }


    # ------ Creacion de un nuevo empleado ------
    public function create()
    {
        return view('empleado.create');
    }


    # ------ Recibir datos del formulario y almacenar un nuevo empleado ------
    public function store(Request $request)
    {
        # validar los datos del formulario
        $campos = [
            'nombre' => 'required|string|max:100',
            'apellido' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'telefono' => 'required|string|max:15',
            'fecha_nacimiento' => 'required|date',
            'foto' => 'nullable|image|max:2048',  # Validamos que la foto sea una imagen y no supere los 2MB
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'foto.required' => 'La foto es requerida',
        ];

        $this->validate($request, $campos, $mensaje);  # Validamos los datos del formulario

        # $datosEmpleado = request()->all(); || llamamos a todos los datos del formulario
        $datosEmpleado = request()->except('_token');

        if ($request->hasFile('foto')) {
            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');  # Guardamos la foto en la carpeta public/uploads
        }
        
        Empleado::insert($datosEmpleado);             # insert -> almacena los datos en la base de datos
        
        return redirect('empleado')->with('mensaje','Empleado agregado correctamente');  # Redirigimos a la vista de empleados y mostramos un mensaje de exito
    }



    public function show($id)
    {
        //
    }

    # ------ Editar un empleado ------
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id); # recuperamos el empleado por su id, si no existe lanzara un error 404
        return view('empleado.edit', compact('empleado'));  # Pasamos el empleado a la vista de edicion
    }


    # ------ Actualizar un empleado (funciona junto a edit )------
    public function update(Request $request, $id)
    {
        $datosEmpleado = request()->except(['_token','_method']); # Excluimos los campos _token y _method del formulario, ya que no son necesarios para actualizar los datos
         
        # recuperamos el empleado por su id, si no existe lanzara un error 404
        if ($request->hasFile('foto')) {
            $empleado = Empleado::findOrFail($id); 

            Storage::delete('public/' . $empleado->foto);  # Eliminamos la foto anterior del empleado

            $datosEmpleado['foto'] = $request->file('foto')->store('uploads', 'public');  # Guardamos la foto en la carpeta public/uploads
        }
        
        Empleado::where('id','=',$id)->update($datosEmpleado);  # Actualizamos los datos del empleado por su id

        $empleado = Empleado::findOrFail($id); # recuperamos el empleado por su id, si no existe lanzara un error 404
        return view('empleado.edit', compact('empleado'));  # Pasamos el empleado a la vista de edicion
    }

    

    # ------ Eliminar un empleado ------
    public function destroy($id)
    {
        
        $empleado = Empleado::findOrFail($id); # recuperamos el empleado por su id, si no existe lanzara un error 404

        // Borra la foto correctamente con el empleado
        if (Storage::disk('public')->exists($empleado->foto)) {
            Storage::disk('public')->delete($empleado->foto);
        }

        // Elimina el empleado
        Empleado::destroy($id);

        return redirect('empleado')->with('mensaje','Empleado eliminado correctamente');  # Redirigimos a la vista de empleados y mostramos un mensaje de exito
    }
}
