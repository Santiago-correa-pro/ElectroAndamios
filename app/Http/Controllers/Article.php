<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleFormRequest;
use App\Articulo;
use DB;

class Article extends Controller
{
    public function __construct() {

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request) {  
            $query = trim($request->input('searchText'));

            $articulos = DB::table('articulo')
            ->join('categoria', 'articulo.idcategoria', '=' , 'categoria.idcategoria')
            ->select('articulo.idarticulo','articulo.nombre','articulo.codigo','articulo.stock',
            'articulo.descripcion','articulo.estado', 
            'categoria.nombre as category')
            ->where('articulo.estado', '=', 'Activo')
            ->where('articulo.nombre', 'LIKE', '%'.$query.'%')
            ->orderBy('articulo.idarticulo', 'desc')
            ->paginate(7);
        }

        return view('almacen.articulo.index')->with(['articulos' => $articulos, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = DB::table('categoria')->where('condicion', '=', '1')->get();

        $select = [];
        
        foreach($categorias as $categoria){
            $select[$categoria->idcategoria] = $categoria->nombre;
        };

        return view('almacen.articulo.create', compact('select'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleFormRequest $request)
    {
        $articulo = new Articulo;
        $articulo->idcategoria = $request->input('idcategoria');
        $articulo->nombre = $request->input('nombre');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->stock = $request->input('stock');
        $articulo->codigo = $request->input('codigo');        
        $articulo->estado = 'Activo';

        $articulo->save();

        return Redirect::to('almacen/articulo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo = Articulo::find($id);
        return view('almacen.articulo.show')->with('articulo', $articulo);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Articulo::find($id);

        $categorias = DB::table('categoria')->where('condicion', '=', '1')->get();

        $select = [];
        
        foreach($categorias as $categoria){
            $select[$categoria->idcategoria] = $categoria->nombre;
        };

        return view('almacen.articulo.edit', compact('select'))->with('articulo', $articulo);
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
        $articulo = Articulo::find($id);
        $articulo->idcategoria = $request->input('idcategoria');
        $articulo->nombre = $request->input('nombre');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->stock = $request->input('stock');
        $articulo->codigo = $request->input('codigo');        
        $articulo->estado = 'Activo';
        $articulo->save();

        return Redirect::to('almacen/articulo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo = Articulo::find($id);
        $articulo->estado = 'Inactivo';
        $articulo->update();

        return Redirect::to('almacen/articulo');
    }
}
