<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\OrderNote;
use App\Models\OrderFile;
use App\Models\Company;
use App\Models\File;
use App\Http\Controllers\OrderFileController;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    //
    public function index()
    {
        
        $users = User::all();
        $companies = Company::all();
        
        $lastOrder = Order::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_code;
            $newOrderNumber = intval($lastOrderNumber) + 1; // 1 artır  
        } else {
            $newOrderNumber = 1;
        }  

             return view('admin.include.orders.order_create', compact('newOrderNumber', 'users', 'companies'));
    }

    public function order_list()
    {
        $orders = Order::all();
        return view("admin.include.orders.orders_list", compact("orders"));
    }

    public function store(Request $request)
    {
        DB::beginTransaction(); 
    
        try {
            $lastOrder = Order::orderBy('id', 'desc')->first();
            $newOrderNumber = $lastOrder ? intval($lastOrder->order_code) + 1 : 1;
    

            $validatedData = $request->validate([
                'order_type' => 'required|string|max:50',
                'product_name' => 'required|string|max:50',
                'quantity' => 'nullable|numeric',
                'created_by' => 'required|integer|exists:users,id',
                'company_id' => 'nullable|exists:companies,id',
                // Dosya yükleme kontrolü
                'file' => 'nullable|file|mimes:pdf,png,jpg,jpeg,doc,docx,xlsx,txt|max:8192',
                'file_type' => 'nullable|string|max:255',
            ]);
    
            $order = Order::create([
                'order_code' => $newOrderNumber,
                'company_id'=> $validatedData['company_id'],
                'order_type' => $validatedData['order_type'],
                'product_name' => $validatedData['product_name'],
                'quantity' => $validatedData['quantity'],
                'created_by' => $validatedData['created_by'],
            ]);
    
            $this->ekleSabitNotlar($order->id);

    
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $fileType = $request->file_type;
    
                $path = $file->store('order_files');
                $orderFile = new OrderFile();
                $orderFile->order_id = $order->id; 
                $orderFile->file_path = $path;
                $orderFile->file_type = $fileType;
                $orderFile->file_name = $file->getClientOriginalName();
                
                $orderFile->save();
            }
    
            // if success, commit the transaction
            DB::commit();
    
            return redirect()->route('order.details', $order->id)->with('success', 'Sipariş başarıyla oluşturuldu.');
    
        } catch (\Exception $e) {
            // if any exception, rollback the transaction
            DB::rollBack();
            return redirect()->back()->withErrors('Sipariş oluşturulurken bir hata oluştu: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $order = Order::find($id);
        $companies = Company::all();

    
        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    
        return view('admin.include.orders.order_create', compact('order', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $order = Order::find($id);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    
        $validatedData = $request->validate([
            'order_type' => 'required|string|max:50',
            'product_name' => 'required|string|max:50',
            'quantity' => 'required|numeric',
        ]);
    
        $order->order_type = $validatedData['order_type'];
        $order->product_name = $validatedData['product_name'];
        $order->quantity = $validatedData['quantity'];
        $order->save();
    
        return redirect()->route('order.details', $order->id)->with('success', 'Sipariş başarıyla güncellendi.');
    }
    
    public function ekleSabitNotlar($orderId)
    {
        $order = Order::find($orderId);
        
        // Her durum için sabit notlar
        $sabitNotlar = [
            'Talep Oluşturuldu' => [
                'Sipariş talebi oluşturuldu.',
                'Ürün ve miktar bilgileri kontrol edildi.',
                'Tedarikçi seçimi yapıldı.',
                'Fiyat teklifi bekleniyor.'
            ],
            'Sipariş Verildi' => [
                'Tedarikçi ile sipariş görüşüldü.',
                'Fiyat ve ödeme şartları belirlendi.',
                'Sipariş tedarikçiye iletildi.',
                'Teslimat tarihi netleştirildi.'
            ],
            'Teslim Alındı' => [
                'Ürünler depoya ulaştı.',
                'Ürün kalite kontrolü yapıldı.',
                'İrsaliye kontrolü yapıldı.',
                'Stok girişi tamamlandı.'
            ]
        ];

        // Sadece mevcut duruma ait notları ekle
        if (isset($sabitNotlar[$order->status])) {
            foreach ($sabitNotlar[$order->status] as $not) {
                OrderNote::create([
                    'order_id' => $orderId,
                    'note' => $not, 
                    'checked' => false,
                    'status' => $order->status
                ]);
            }
        }
    }

    public function show($id)
    {
        // Dosyalarla birlikte sipariş verisini getiriyoruz
        $order = Order::with('order_files')->find($id);
        $order_notes = Order::with('order_notes')->find($id);
        $company = Company::with('orders')->find($order->company_id);

    
        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    
        return view('admin.include.orders.order_detail', compact('order', 'order_notes', 'company'));  // order_detail.blade.php sayfasına veriyi geçiyoruz
    }

    public function storeNote(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'note' => 'required|string',
    ]);
    

    OrderNote::create([
        'order_id' => $request->input('order_id'),
        'note' => $request->input('note'),
        'checked' => false
    ]);

    return redirect()->back()->with('success', 'Sipariş notu başarıyla eklendi.');
    }
   
    public function ilerletSurec($id)
    {
        $order = Order::find($id);
    
        if (!$order) {
            return redirect()->back()->with('error', 'Sipariş bulunamadı.');
        }
    
        // Mevcut duruma ait tüm notların kontrolü
        $allNotesChecked = $order->order_notes()
            ->where('status', $order->status)
            ->where('checked', false)
            ->count() === 0;
    
        if (!$allNotesChecked) {
            return redirect()->back()->with('error', 'Bu aşamadaki tüm notlar tamamlanmadan süreci ilerletemezsiniz.');
        }
    
        // Statü güncelleme
        switch ($order->status) {
            case 'Talep Oluşturuldu':
                $order->status = 'Sipariş Verildi';
                break;
    
            case 'Sipariş Verildi':
                $order->status = 'Teslim Alındı';
                break;
    
            case 'Teslim Alındı':
                return redirect()->back()->with('success', 'Sipariş zaten tamamlanmış durumda.');
        }
    
        $order->save();
        
        // Yeni duruma ait notları ekle
        $this->ekleSabitNotlar($order->id);
    
        return redirect()->back()->with('success', 'Sipariş süreci başarıyla ilerletildi!');
    }

    public function toggleCheckbox($noteId, Request $request)
    {
        $note = OrderNote::find($noteId);
        
        if ($note) {
            // Checkbox verisini güncelliyoruz
            $note->checked = $request->input('checked');
            $note->save();
            
            return response()->json(['status' => 'success']);
        }
        
        return response()->json(['status' => 'error']);
    }
    public function updateNoteStatus(Request $request)
    {
        $request->validate([
            'note_id' => 'required|exists:order_notes,id',
            'checked' => 'required|boolean',
        ]);

        $note = OrderNote::find($request->input('note_id'));

        if ($note) {
            $note->checked = $request->input('checked');
            $note->save();
        }

        return redirect()->back()->with('success', 'Not durumu başarıyla güncellendi.');
    }







}
