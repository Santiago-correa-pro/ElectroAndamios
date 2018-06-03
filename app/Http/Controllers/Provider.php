<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PersonFormRequest;
use App\Persona;
use DB;

class Provider extends Controller
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
            ->where('tipo_persona', '=' , 'Proveedor')
            ->orwhere('num_documento', 'LIKE', '%'.$query.'%')
            ->where('tipo_persona', '=' , 'Proveedor')
            ->orderBy('idpersona', 'desc')
            ->paginate(7);
        }

        return view('compras.proveedor.index')->with('personas', $personas);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create() {
        return view('compras.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PersonFormRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(PersonFormRequest $request) {
        $persona = new Persona;
        $persona->tipo_persona = 'Proveedor';
        $persona->nombre = $request->input('nombre');
        $persona->tipo_documento = $request->input('tipo_documento');
        $persona->num_documento = $request->input('num_documento');
        $persona->direccion = $request->input('direccion');
        $persona->telefono = $request->input('telefono');
        $persona->email = $request->input('email');

        $persona->save();

        return Redirect::to('compras/proveedor');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {

        $persona = Persona::find($id);

        return view('compras.proveedor.show')->with('persona', $persona);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($id) {

        $persona = Persona::find($id);

        return view('compras.proveedor.edit')->with('persona', $persona);
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

        return Redirect::to('compras/proveedor');
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
        $persona->update();
        
        return Redirect::to('compras/proveedor');
    }

}
