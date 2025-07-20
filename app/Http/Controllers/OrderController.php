<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderPlant;
use App\Models\Plant;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['plants' => function ($query) {
            $query->withPivot('quantity', 'price');
        }])->paginate(8);
    
        return response()->json($orders);
    }
    
    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
    
        DB::beginTransaction();
    
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_date' => now(),
                'status' => 'pending',
                'total_price' => $data['total_price'],
                'address' => $data['address'],
                'city' => $data['city'],
                'country' => $data['country'],
                'phone_number' => $data['phone_number'],
            ]);
        
            foreach ($data['plants'] as $plantData) {
                $plant = Plant::findOrFail($plantData['id']);
            
                // Validar stock suficiente
                if ($plant->stock < $plantData['quantity']) {
                    throw new \Exception("No hay stock suficiente para la planta: {$plant->name}");
                }
            
                OrderPlant::create([
                    'order_id' => $order->id,
                    'plant_id' => $plant->id,
                    'quantity' => $plantData['quantity'],
                    'price' => $plantData['price'],
                ]);
            
                // Reducir el stock
                $plant->stock -= $plantData['quantity'];
                $plant->save();
            }
        
            DB::commit();
        
            return response()->json([
                'message' => 'Order placed successfully.',
                'order_id' => $order->id,
            ], 201);
        
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
    
    public function show($id)
    {
        $order = Order::with(['plants' => function ($query) {
            $query->withPivot('quantity', 'price');
        }])->findOrFail($id);
    
        if (Auth::id() !== $order->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }
    
        return response()->json($order);
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,delivered,cancelled',
        ]);
    
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();
    
        return response()->json([
            'message' => 'Order status updated successfully.',
            'order' => $order,
        ]);
    }
    
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
    
        if (Auth::id() !== $order->user_id && Auth::user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }
    
        $order->delete();
    
        return response()->json(['message' => 'Order deleted successfully'], 200);
    }
    
    public function getOrdersByUser($userId)
    {
        if (Auth::id() !== (int)$userId) {
            return response()->json(['error' => 'Unauthorized.'], 403);
        }
    
        $orders = Order::where('user_id', $userId)
            ->with(['plants' => function ($query) {
                $query->withPivot('quantity', 'price'); 
            }])
            ->get(); 
        
        return response()->json($orders);
    }
    
     public function getUserByOrder($id)
    {
        $order = Order::with('user')->findOrFail($id);
    
        return response()->json($order->user);
    }
    
        public function search(Request $request)
    {
        $query = $request->input('q');
    
        $orders = Order::where('status', 'like', "%{$query}%")
            ->orWhereDate('order_date', $query)
            ->with(['plants' => function ($query) {
                $query->withPivot('quantity', 'price');
            }])
            ->paginate(8); 
        
        return response()->json($orders);
    }
}
