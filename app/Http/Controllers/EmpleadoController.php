<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Area;
use App\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::orderBy('id', 'DESC')->get();
        $areas = Area::orderBy('id', 'DESC')->get();
        $rols = Rol::orderBy('id', 'DESC')->get();

        return view('empleados.index', compact('empleados', 'areas', 'rols'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'sexo' => 'required',
            'area_id' => 'required',
            'descripcion' => 'required'
        ]);

        if(!$validator->passes()) {
            return response()->json(['error' => true, 'errors' => $validator->errors()->toArray()]);
        } else {
            try {
                $empleado = new Empleado();

                $empleado->nombre = $request->nombre;
                $empleado->email = $request->email;
                $empleado->sexo = $request->sexo;
                $empleado->area_id = $request->area_id;
                $empleado->descripcion = $request->descripcion;
                $empleado->boletin = $request->boletin;

                if($empleado->save()) {
                    $empleado->roles()->attach($request->rols);
                    return response()->json(['error' => false, 'msg' => 'Empleado creado exitosamente']);   
                }
            } catch (Exception $e) {
                return response()->json(['error' => true, 'msg' => 'Empleado no registrado', 'error_msg' => $e->getMessage()]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $empleado = Empleado::find($id);
        $areas = Area::orderBy('id', 'DESC')->get();
        $rols = Rol::orderBy('id', 'DESC')->get();
        $vista = view('empleados.show', compact('empleado', 'areas', 'rols'));
        return response(['body' => $vista->render()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'sexo' => 'required',
            'area_id' => 'required',
            'descripcion' => 'required'
        ]);

        if(!$validator->passes()) {
            return response()->json(['error' => true, 'errors' => $validator->errors()->toArray()]);
        } else {
            try {
                $empleado = Empleado::find($id);
                $empleado->nombre = $request->nombre;
                $empleado->email = $request->email;
                $empleado->sexo = $request->sexo;
                $empleado->area_id = $request->area_id;
                $empleado->descripcion = $request->descripcion;
                $empleado->boletin = $request->boletin;

                $empleado->roles()->sync($request->rols);

                if($empleado->save()) {
                    return response()->json(['error' => false, 'msg' => 'Empleado actualizado', 'empleado' => $empleado]);   
                }
            } catch (\Exception $e) {
                return response()->json(['error' => true, 'msg' => 'Empleado no actualizado', 'error_msg' => $e->getMessage()]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Empleado::find($id);
        if($empleado->delete()) {
            return response()->json(['error' => false, 'msg' => 'Empleado eliminado exitosamente']);
        } else {
            return response()->json(['error' => true, 'msg' => 'Error al momento de eliminar el empleado']);
        }
    }
}
