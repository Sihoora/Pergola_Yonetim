<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\File;
use Http\Controllers\FileController;

class OrderController extends Controller
{
    //
    public function index()
    {
        
        $users = User::all();
        
        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_code;
            $newOrderNumber = intval($lastOrderNumber) + 1; // 1 artır  
        } else {
            $newOrderNumber = 1;
        }  

             return view('admin.include.orders.order_create', compact('newOrderNumber', 'users'));
    }

    public function order_list()
    {
        $orders = Order::all();
        return view("admin.include.orders.orders_list", compact("orders"));
    }




    public function store(Request $request)
    {

        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_code;
            $newOrderNumber = intval($lastOrderNumber) + 1; // 1 artır
        } else {
            $newOrderNumber = 1;
        }
  
        $validatedData = $request->validate([
            'order_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:50',
            'quantity' => 'required|numeric',
            'created_by' => 'required|integer|exists:users,id',
        ]);

        $order = Order::create([
            'order_code' => $newOrderNumber,
            'order_type' => $validatedData['order_type'],
            'product_name' => $validatedData['product_name'],
            'quantity' => $validatedData['quantity'],
            'created_by' => $validatedData['created_by'],
        ]);

        $order->save();

        return redirect()->route('order-create', $order->id)->with('success', 'Sipariş başarıyla oluşturuldu.');
    }  

    public function show($id)
    {
        // Dosyalarla birlikte sipariş verisini getiriyoruz
        $order = Order::with('order_files')->find($id);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    
        return view('admin.include.orders.order_detail', compact('order'));  // order_detail.blade.php sayfasına veriyi geçiyoruz
    }







}
