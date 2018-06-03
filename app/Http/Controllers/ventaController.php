<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Venta;
use App\DetalleVenta;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;


class ventaController extends Controller
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

            $ventas = DB::table('venta')
            ->join('persona','venta.idcliente', '=', 'persona.idpersona')
            ->join('detalle_venta', 'venta.idventa' , '=', 'detalle_venta.idventa')
            ->select('venta.idventa','venta.fecha_hora','persona.nombre', 
            'venta.tipo_comprobante', 'venta.serie_comprobante', 
            'venta.num_comprobante', 'venta.impuesto', 'venta.estado', 'venta.total_venta')
            ->where('venta.num_comprobante', 'LIKE', '%' . $query . '%')
            ->where('venta.estado', '=', 'A')
            ->groupBy('venta.idventa','venta.fecha_hora','persona.nombre', 
            'venta.tipo_comprobante', 'venta.serie_comprobante', 
            'venta.num_comprobante', 'venta.impuesto', 'venta.estado', 'venta.total_venta')
            ->paginate(7);
        }
        return view('ventas.venta.index')->with(['ventas' => $ventas, 'searchText' => $query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $personas = DB::table('persona')->where('tipo_persona', '=', 'Cliente')->get();
        $articulos = DB::table('articulo')
        ->join('detalle_ingreso as di', 'articulo.idarticulo', '=', 'di.idarticulo')
        ->select('articulo.nombre','articulo.idarticulo', 'articulo.stock' , DB::raw('avg(di.precio_venta) as precio_promedio')) 
        ->where('articulo.estado', '=', 'Activo')
        ->where('articulo.stock', '>', '0')
        ->groupBy('articulo.nombre', 'articulo.idarticulo', 'articulo.stock')
        ->get();

        $pSelect = [];
        $comprobante = ['Boleta' => 'Boleta', 'Factura' => 'Factura', 'Ticket' => 'Ticket'];

        foreach($personas as $persona) {
            $pSelect[$persona->idpersona] = $persona->nombre;
        }


        return view('ventas.venta.create')->with(['personas' => $pSelect, 'articulos' => $articulos, 'comprobante' => $comprobante]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
        try {
            DB::beginTransaction();
            $venta = new Venta;
            $venta->idcliente = $request->input('idcliente');
            $venta->tipo_comprobante = $request->input('tipo_comprobante');
            $venta->serie_comprobante = $request->input('serie_comprobante');
            $venta->num_comprobante = $request->input('num_comprobante');
            $venta->total_venta = $request->input('total_venta');
            $myTime = Carbon::now('America/Lima');
            $venta->fecha_hora = $myTime->toDateTimeString();
            $venta->impuesto = 0;
            $venta->estado = 'A';
            $venta->save();

            $idarticulo = $request->input('idarticulo');
            $cantidad = $request->input('cantidad');
            $precio_venta = $request->input('precio_venta');
            $descuento = $request->input('descuento');

            $detalle = new DetalleVenta;
            $detalle->idventa = $venta->idventa;
            $detalle->idarticulo = $idarticulo[0];
            $detalle->cantidad = $cantidad[0];
            $detalle->precio_venta = $precio_venta[0];
            $detalle->descuento = $descuento[0];
            $detalle->save();
            DB::commit();

        } catch(\Exception $e) {
            DB::rollBack();
        }
        return Redirect::to('ventas/venta');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ventas = DB::table('venta')
        ->join('persona', 'persona.idpersona', '=', 'venta.idcliente')
        ->join('detalle_venta', 'detalle_venta.idventa', '=', 'venta.idventa')
        ->select('venta.idventa', 'venta.fecha_hora', 'persona.nombre', 'venta.tipo_comprobante',
        'venta.serie_comprobante', 'venta.num_comprobante', 'venta.impuesto', 'venta.estado', 
        DB::raw('sum(detalle_venta.cantidad * precio_venta) as total'))
        ->groupBy('venta.idventa', 'venta.fecha_hora', 'persona.nombre', 'venta.tipo_comprobante',
        'venta.serie_comprobante', 'venta.num_comprobante', 'venta.impuesto', 'venta.estado')
        ->where('venta.idventa', '=', $id)
        ->first();

        $detalles = DB::table('detalle_venta')
        ->join('articulo', 'detalle_venta.idarticulo', '=', 'articulo.idarticulo')
        ->select('articulo.nombre as articulon', 'detalle_venta.cantidad', 'detalle_venta.descuento', 'detalle_venta.precio_venta')
        ->where('detalle_venta.idventa', '=', $id)
        ->get();

        return view('ventas.venta.show')->with(['ventas' => $ventas, 'detalles' => $detalles]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ingreso = Venta::findOrFail($id);
        $ingreso->estado = 'C';
        $ingreso->update();

        return Redirect::to('ventas/venta');
    }
}
