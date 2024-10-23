@extends('admin.tema')

@section('master')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Sipariş Listesi</h3>
                    </div>
                    <div class="card-body">
                        <table id="projectTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Sipariş Kodu</th>
                                    <th>Ürün Adı</th>
                                    <th>Sipariş Türü</th>
                                    <th>Ürün Adedi</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="text-left">{{ $order->order_code }}</td>
                                        <td>{{ $order->product_name }}</td>
                                        <td>{{ $order->order_type }}</td>
                                        <td>{{ $order->quantity }}</td>
                                        <td>
                                            <span class="badge {{ $order->status == 'Sipariş Teslim Alındı' ? 'badge-success' : 'badge-warning' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Seçiniz...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('order.details', $order->id) }}">Proje Detay</a>
                                                    <a class="dropdown-item" href="">Düzenle</a>
                                                </div> 
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
