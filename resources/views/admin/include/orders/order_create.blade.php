@extends('admin.tema')

@section('css')
@endsection

@section('master')
<div class="content">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 m-0">Sipariş Oluşturma</span>
                            <div class="row" style=" justify-content: end;">
                                <!-- Siparişi Tamamla Butonu -->
                                <button type="submit" form="orderForm" class="btn btn-success" style="margin-right: 20px;">Siparişi Tamamla</button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body pad table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <form role="form" id="orderForm" action="{{ route('orders.store') }}" method="post"> 
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Sipariş Kodu</label>
                                                        <input type="text" name="order_code" class="form-control" value="{{$newOrderNumber}}" placeholder="Sipariş Kodu" disabled>
                                                        <input type="hidden" name="order_code" value="{{$newOrderNumber}}">
                                                    </div>
                                                </div>

                                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Sipariş Türü</label>
                                                        <input type="text" name="order_type" class="form-control @error('order_type') is-invalid @enderror" placeholder="Sipariş Türü Giriniz">
                                                        @error('order_type')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Ürün Adı</label>
                                                        <input type="text" name="product_name" class="form-control @error('product_name') is-invalid @enderror" placeholder="Ürün Adı Giriniz">
                                                        @error('product_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Ürün Adedi</label>
                                                        <input type="number" name="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Ürün Adedi Giriniz">
                                                        @error('quantity')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row" style=" justify-content: end;">
                                                <button type="submit" class="btn btn-success" style="margin-right: 20px;">Yeni Sipariş Oluştur</button>
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
