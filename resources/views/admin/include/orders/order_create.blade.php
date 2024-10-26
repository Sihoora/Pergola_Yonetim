@extends('admin.tema')

@section('css')
<style>
input::file-selector-button {
  font-weight: bold;
  color: dodgerblue;
  border: thin solid grey;
  border-radius: 5px;
}
</style>
@endsection

@section('master')
<div class="content">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 m-0">Sipariş Oluştur</span>
                            <div class="row" style=" justify-content: end;">
                                <!-- Siparişi Tamamla Butonu -->
                                <button type="submit" form="orderForm" class="btn btn-success" style="margin-right: 20px;">Siparişi Tamamla</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pad table-responsive">
                        <div class="row" style="text-align: center; align-items: center; justify-content: center;">
                            <div class="col-md-10">
                                <div class="card card-primary">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <form class="row" style="justify-content: space-between;" role="form" id="orderForm" action="{{ isset($order) ? route('order.update', $order->id) : route('orders.store') }}" method="post" enctype="multipart/form-data"> 
                                            @csrf
                                            @if(isset($order))
                                                @method('PUT')
                                            @endif
                    
                                            <div class="col-md-6 row" style="justify-content: center; align-items: center; text-align: center; border-right:2px solid #dee2e6">
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Sipariş Kodu</label>
                                                        <input type="text" name="order_code" class="form-control" value="{{ isset($order) ? $order->order_code : $newOrderNumber }}" placeholder="Sipariş Kodu" disabled>
                                                        <input type="hidden" name="order_code" value="{{ isset($order) ? $order->order_code : $newOrderNumber }}">
                                                    </div>
                                                </div>
                                        
                                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                        
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Sipariş Türü</label>
                                                        <input type="text" name="order_type" class="form-control @error('order_type') is-invalid @enderror"
                                                        value="{{ old('order_type', isset($order) ? $order->order_type : '') }}" placeholder="Sipariş Türü Giriniz">
                                                        @error('order_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="company">Firma Seçin</label>
                                                    <select name="company_id" id="company" class="form-control" required>
                                                        <option value="">Firma Seçin</option>
                                                        @foreach($companies as $company)
                                                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                                            {{ $company->company_name }}
                                                        @endforeach
                                                    </select>
                                                </div>
                                                </div>
                                        
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Ürün Adı</label>
                                                        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror"
                                                        value="{{ old('product_name', isset($order) ? $order->product_name : '') }}" placeholder="Ürün Adı Giriniz">
                                                        @error('product_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                        
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label>Ürün Adedi</label>
                                                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror"
                                                        value="{{ old('quantity', isset($order) ? $order->quantity : '') }}" placeholder="Ürün Adedi Giriniz">
                                                        @error('quantity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-md-5 d-flex flex-column" style="text-align: center;">
                                                <div class="row" style="margin-top: auto;">
                                                    <label for="file" style="display: block;">
                                                        <img src="https://i.imgur.com/MXDcuyY.png" alt="" style="width: 90px; height: auto; margin-left: 5px;">
                                                        <h6>(Opsiyonel)</h6>
                                                        <input type="file" name="file" id="file"> 
                                                    </label>
                                                </div>

                                                <div>
                                                <input type="hidden" name="file_type" id="file_type" value="order_content">
                                                    </div>
                                                <div class="row" style="justify-content: end; margin-top: auto;">
                                                <button type="submit" class="btn btn-success" style="margin-right: 20px;">Yeni Sipariş Oluştur</button>
                                                    </div>
                                            </div>

                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
@endsection