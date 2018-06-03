<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonFormRequest;
use App\Persona;
use DB;

class Person extends Controller
{
    public function __construct() {

    }

    /**
     * Display a listing of the resource.
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) {
        if($request) {
            $query = trim($request->input('searchText'));
            $personas = DB::table('persona')
            ->where('nombre', 'LIKE', '%'.$query.'%')
            ->where('tipo_persona', '=' , 'Cliente')
            ->orwhere('num_documento', 'LIKE', '%'.$query.'%')
            ->where('tipo_persona', '=' , 'Cliente')
            ->orderBy('idpersona', 'desc')
            ->paginate(7);
        }

        return view('ventas.cliente.index')->with('personas', $personas);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create() {
        return view('ventas.cliente.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PersonFormRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PersonFormRequest $request) {
        $persona = new Persona;
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->input('nombre');
        $persona->tipo_documento = $request->input('tipo_documento');
        $persona->num_documento = $request->input('num_documento');
        $persona->direccion = $request->input('direccion');
        $persona->telefono = $request->input('telefono');
        $persona->email = $request->input('email');

        $persona->save();

        return Redirect::to('ventas/cliente');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $persona = Persona::find($id);

        return view('ventas.cliente.show')->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) {

        $persona = Persona::find($id);

        return view('ventas.cliente.edit')->with('persona', $persona);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(PersonFormRequest $request, $id) {
        $persona = Persona::find($id);
        $persona->nombre = $request->input('nombre');
        $persona->tipo_documento = $request->input('tipo_documento');
        $persona->num_documento = $request->input('num_documento');
        $persona->direccion = $request->input('direccion');
        $persona->telefono = $request->input('telefono');
        $persona->email = $request->input('email');

        $persona->update();

        return Redirect::to('ventas/cliente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id) {
        $persona = Persona::find($id);
        $persona->tipo_persona = 'Inactivo';
        $persona->delete();
        
        return Redirect::to('ventas/cliente');
    }

}
