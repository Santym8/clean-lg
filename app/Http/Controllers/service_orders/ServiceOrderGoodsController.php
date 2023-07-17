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
        // $roleNames = array("OPERADOR_ORDENES_SERVICIOS_BIENES");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_service_orders_goods'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }
        
        if (!Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_service_orders_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $goods = Goods::all();
        $services = Services::all();
        $service_order_goods = ServiceOrders::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_service_orders_goods'], '');
        return view('service_orders.service_orders_goods.index', ['service_order_goods' => $service_order_goods,'goods' => $goods,'services' => $services]);
    }

    public function create()
    {
        // $roleNames = array("OPERADOR_ORDENES_SERVICIOS_BIENES");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_service_orders_goods'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }
        // Aquí puedes cargar los datos necesarios para tu vista, como los clientes y usuarios disponibles

        if (!Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_service_orders_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $customers = Customer::all();
        $users = User::all();
        $services = Services::all();

        $this->addAudit(Auth::user(), $this->typeAudit['access_create_service_orders_goods'], '');
        return view('service_orders.service_orders_goods.create', compact('customers', 'users','services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $roleNames = array("OPERADOR_ORDENES_SERVICIOS_BIENES");
        // if (!Gate::allows('has-rol', [$roleNames])) {
        //     $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_service_orders_goods'], '');
        //     return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        // }

        if (!Gate::allows('action-allowed-to-user', ['SERVICE_ORDERS_GOODS/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_service_orders_goods'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            //SeoGoods
            //'name' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric',
            'service_id' => 'required',
            //'service_order_id' => 'required',
            //SeoServiceOrders
            'delivery_date' => 'required',
            'prepayment' => 'required|numeric',
            'customer_id'=>'required',
            //'user_id'=>'required',
        ]);

        $service_orders = new ServiceOrders();
        $service_orders->delivery_date = $request->delivery_date;
        $service_orders->prepayment = $request->prepayment;
        $service_orders->customer_id = $request->customer_id;
        $service_orders->user_id = Auth::id();
        $service_orders->save();


        if ($request->has('service_id') && $request->has('description') && $request->has('cost')) {
            
            $serviceIds = $request->service_id;
            $descriptions = $request->description;
            $costs = $request->cost;
            foreach ($serviceIds as $index => $serviceId) {
            
                $goods = new Goods();
                //$goods->name = $request->name;
                $goods->description = $descriptions[$index];
                $goods->cost = $costs[$index];
                $goods->service_id = $serviceId;
                $goods->service_order_id = $service_orders->id;
                //$goods->service_orders()->associate($service_orders);
                $goods->save();
            }
        }
      
       

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_service_orders_goods'], '');
        return redirect()->route('service_orders_goods.index')->with('success', 'Orden y bien creado con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    
    }
}
