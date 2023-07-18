<?php

namespace App\Http\Controllers\inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\inventory\ProductMovement;
use App\Models\inventory\ProductWarehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProductMovementController extends Controller
{
    public function index()
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/INDEX'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_index_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $movements = ProductMovement::with('productWarehouse.warehouse', 'productWarehouse.product')
        ->get();
        $this->addAudit(Auth::user(), $this->typeAudit['access_index_product_movement'], '');
        return view('inventory.product_movement.index', ['movements' => $movements]);
    }
    public function create()
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/CREATE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_create_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }
        $productWarehouses = ProductWarehouse::all();
        $this->addAudit(Auth::user(), $this->typeAudit['access_create_product_movement'], '');
        return view('inventory.product_movement.create', ['productWarehouses' => $productWarehouses]);
    }

    public function store(Request $request)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/STORE'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_store_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'product_warehouse_id' => 'required|exists:product_warehouses,id',
            'incoming' => 'required|boolean',
            'quantity' => 'required|integer',
        ]);

        $productWarehouse = ProductWarehouse::findOrFail($request->product_warehouse_id);

        if (!$request->incoming && $request->quantity > $productWarehouse->cantidad) {
            return redirect()->back()->withInput()->with('error', 'La cantidad del movimiento excede la cantidad disponible en el almacén.');
        }

        $movement = new ProductMovement();
        $movement->product_warehouse_id = $request->product_warehouse_id;
        $movement->incoming = $request->incoming;
        $movement->quantity = $request->quantity;

        $movement->save();
        // Actualizar la cantidad en ProductWarehouse
        if ($movement->incoming) {
            $productWarehouse->cantidad += $movement->quantity;
        } else {
            $productWarehouse->cantidad -= $movement->quantity;
        }
        $productWarehouse->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_store_product_movement'], '');
        return redirect()->route('product_warehouse.index')->with('success', 'Movimiento de producto creado exitosamente.');
    }
    public function edit(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $movement = ProductMovement::findOrFail($id);
        $productWarehouses = ProductWarehouse::all();

        $this->addAudit(Auth::user(), $this->typeAudit['access_edit_product_movement'], '');

        return view('inventory.product_movement.edit', [
            'movement' => $movement,
            'productWarehouses' => $productWarehouses,
        ]);
    }

    public function update(Request $request, string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/EDIT'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_edit_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $request->validate([
            'product_warehouse_id' => 'required|exists:product_warehouses,id',
            'quantity' => 'required|integer',
        ]);

        $productWarehouse = ProductWarehouse::findOrFail($request->product_warehouse_id);

        if (!$request->incoming && $request->quantity > $productWarehouse->cantidad) {
            return redirect()->back()->with('error', 'La cantidad del movimiento excede la cantidad disponible en el almacén.');
        }

        $movement = ProductMovement::findOrFail($id);
        $previousQuantity = $movement->quantity;

        $movement->product_warehouse_id = $request->product_warehouse_id;
        $movement->quantity = $request->quantity;

        $movement->save();

        // Actualizar la cantidad en ProductWarehouse
        $quantityDiff = $request->quantity - $previousQuantity;
        if ($movement->incoming) {
            $productWarehouse->cantidad += $quantityDiff;
        } else {
            $productWarehouse->cantidad -= $quantityDiff;
        }
        $productWarehouse->save();

        $this->addAudit(Auth::user(), $this->typeAudit['access_update_product_movement'], '');
        return redirect()->route('product_warehouse.index')->with('success', 'Movimiento de producto actualizado exitosamente.');
    }
    public function destroy(string $id)
    {
        if (!Gate::allows('action-allowed-to-user', ['PRODUCT-MOVEMENT/DESTROY'])) {
            $this->addAudit(Auth::user(), $this->typeAudit['not_access_destroy_product_movement'], '');
            return redirect()->route('dashboard')->with('error', 'No tiene permisos para acceder a esta sección.');
        }

        $movement = ProductMovement::findOrFail($id);
        $productWarehouse = ProductWarehouse::findOrFail($movement->product_warehouse_id);

        if ($movement->status) {
            if ($movement->incoming) {
                if($productWarehouse->cantidad < $movement->quantity){
                    return redirect()->back()->with('error', 'La cantidad del movimiento excede la cantidad disponible en el almacén.');
                }
                $productWarehouse->cantidad -= $movement->quantity;
            } else {
                $productWarehouse->cantidad += $movement->quantity;
            }
            $productWarehouse->save();
        }

        $movement->delete();

        $this->addAudit(Auth::user(), $this->typeAudit['access_destroy_product_movement'], '');
        return redirect()->route('product_warehouse.index')->with('success', 'Movimiento de producto eliminado exitosamente.');
    }
    
}
