<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\IngresoFormRequest;
use App\IngresoModel;
use App\DetalleIngreso;
use DB;

use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;

class Ingreso extends Controller
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
            $ingreso = DB::table('ingreso')
            ->join('persona', 'persona.idpersona', '=', 'ingreso.idproveedor')
            ->join('detalle_ingreso', 'detalle_ingreso.idingreso', '=', 'ingreso.idingreso')
            ->select('ingreso.idingreso', 'ingreso.fecha_hora', 'persona.nombre', 'ingreso.tipo_comprobante',
            'ingreso.serie_comprobante', 'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado', 
            DB::raw('sum(detalle_ingreso.cantidad*precio_compra) as total'))
            ->where('ingreso.num_comprobante', 'LIKE', '%' . $query . '%')
            ->where('ingreso.estado', '=', 'A')
            ->orderBy('ingreso.idingreso', 'desc')
            ->groupBy('ingreso.idingreso', 'ingreso.fecha_hora', 'persona.nombre', 'ingreso.tipo_comprobante',
            'ingreso.serie_comprobante', 'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado')
            ->paginate(7);
        }

        return view('compras.ingreso.index')->with(['ingresos' => $ingreso, 'searchText' => $query]);
    }

    public function create() {
        $personas = DB::table('persona')->where('tipo_persona', '=', 'Proveedor')->get();
        $articulos = DB::table('articulo')->select('articulo.nombre','articulo.idarticulo') 
        ->where('articulo.estado', '=', 'Activo')->get();

        $select = [];
        $pSelect = [];
        $comprobante = ['Boleta' => 'Boleta', 'Factura' => 'Factura', 'Ticket' => 'Ticket'];

        foreach($articulos as $articulo) {
            $select[$articulo->idarticulo] = $articulo->nombre;
        }

        foreach($personas as $persona) {
            $pSelect[$persona->idpersona] = $persona->nombre;
        }

        return view('compras.ingreso.create')->
        with(['personas' => $pSelect, 'articulos' => $select, 'comprobante' => $comprobante]);
    }

    public function store(IngresoFormRequest $request) {
        try {
            DB::beginTransaction();
            $ingreso = new IngresoModel;
            $ingreso->idproveedor = $request->input('idproveedor');
            $ingreso->tipo_comprobante = $request->input('tipo_comprobante');
            $ingreso->serie_comprobante = $request->input('serie_comprobante');
            $ingreso->num_comprobante = $request->input('num_comprobante');
            $myTime = Carbon::now('America/Lima');
            $ingreso->fecha_hora = $myTime->toDateTimeString();
            $ingreso->impuesto = '0';
            $ingreso->estado = 'A';
            $ingreso->save();

            $idarticulo = $request->input('idarticulo');
            $cantidad = $request->input('cantidad');
            $precio_compra = $request->input('precio_compra');
            $precio_venta = $request->input('precio_venta');
            
            $detalle = new DetalleIngreso;
            $detalle->idingreso = $ingreso->idingreso;
            $detalle->idarticulo = $idarticulo;
            $detalle->cantidad = $cantidad;
            $detalle->precio_compra = $precio_compra;
            $detalle->precio_venta = $precio_venta;
            $detalle->save();
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
        }

       return Redirect::to('compras/ingreso');
    }

    public function show($id) {

        $ingreso = DB::table('ingreso')
        ->join('persona', 'persona.idpersona', '=', 'ingreso.idproveedor')
        ->join('detalle_ingreso', 'detalle_ingreso.idingreso', '=', 'ingreso.idingreso')
        ->select('ingreso.idingreso', 'ingreso.fecha_hora', 'persona.nombre', 'ingreso.tipo_comprobante',
        'ingreso.serie_comprobante', 'ingreso.num_comprobante', 'ingreso.impuesto', 'ingreso.estado', 
        DB::raw('sum(detalle_ingreso.cantidad * detalle_ingreso.precio_compra) as total'))
        ->groupBy('ingreso.idingreso','ingreso.fecha_hora','persona.nombre','ingreso.tipo_comprobante',
        'ingreso.serie_comprobante','ingreso.num_comprobante','ingreso.impuesto','ingreso.estado')
        ->where('ingreso.idingreso', '=', $id)
        ->first();

        $detalles = DB::table('detalle_ingreso')
        ->join('articulo', 'detalle_ingreso.idarticulo', '=', 'articulo.idarticulo')
        ->select('articulo.nombre as articulon', 'detalle_ingreso.cantidad', 'detalle_ingreso.precio_compra', 'detalle_ingreso.precio_venta')
        ->where('detalle_ingreso.idingreso', '=', $id)
        ->get();

        return view('compras.ingreso.show')->with(['ingreso' => $ingreso, 'detalles' => $detalles]);
    }

    public function destroy($id) {
        $ingreso = IngresoModel::findOrFail($id);
        $ingreso->estado = 'C';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }

}
