<?php

namespace App\Http\Controllers\service_orders;

use Illuminate\Http\Request;
use App\Models\service_orders\Goods;
use App\Models\service_orders\Services;
use App\Models\service_orders\ServiceOrders;
use App\Models\customer\Customer;
use App\Models\security\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ServiceOrderGoodsController extends Controller
{
    /**
     * Display a listing of goods and service orders.
     */
    public function index()
    {
        $roleNames = array("OPERADOR_SERVICIOS_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_goods'], '');
        $goods = Goods::all();
        $service_orders = ServiceOrders::all();
        
        return view('service_orders_goods.goods.index', ['goods' => $goods, 'service_orders' => $service_orders]);
    }

    public function create()
    {
        // Aquí puedes cargar los datos necesarios para tu vista, como los clientes y usuarios disponibles
        $customers = Customer::all();
        $users = User::all();
        $services = Services::all();

        return view('service_orders.service_orders_goods.create', compact('customers', 'users','services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'delivery_date' => 'required|date',
            'prepayment' => 'required|numeric',
            'delivery' => 'required|boolean',
            'status' => 'required|boolean',
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'goods' => 'required|array',
            'goods.*.name' => 'required|string',
            'goods.*.description' => 'required|string',
            'goods.*.cost' => 'required|numeric',
        ]);

        // Crear la orden de servicio
        $serviceOrder = ServiceOrders::create([
            'delivery_date' => $request->delivery_date,
            'prepayment' => $request->prepayment,
            'delivery' => $request->delivery,
            'status' => $request->status,
            'customer_id' => $request->customer_id,
            'user_id' => $request->user_id,
        ]);

        // Crear los bienes asociados a la orden de servicio
        foreach ($request->goods as $goodData) {
            Goods::create([
                'name' => $goodData['name'],
                'description' => $goodData['description'],
                'cost' => $goodData['cost'],
                'service_id' => $serviceOrder->service_id,
                'service_order_id' => $serviceOrder->id,
            ]);
        }
        return redirect()->route('service_orders.index')->with('success', 'Orden de servicio creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $roleNames = array("OPERADOR_SERVICIOS_BIENES");
        if (!Gate::allows('has-rol', [$roleNames])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::find($id);
        $goods->status = 0;
        $goods->save();
        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_goods'], '');
        return redirect()->back()->with('success', 'Bien eliminado con éxito');
    }
}
