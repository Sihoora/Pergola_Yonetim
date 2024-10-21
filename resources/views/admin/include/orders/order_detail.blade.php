@extends('admin.tema')

@section('css')
@endsection

@section('master')
<div class="content">
    <div class="container-fluid"> 

               <!-- Dosya Önizleme Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewModalLabel">Dosya Önizleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="filePreviewIframe" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div> 




        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="m-0">Sipariş Detayı</h4>
                        </div>
                    </div>

                    <div class="card-body pad table-responsive">
                        <form role="form" id="orderForm" action="" method="post"> 
                            @csrf
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Sipariş Kodu</label>
                                        <input type="text" name="order_code" class="form-control" value="{{ $order->order_code }}" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Sipariş Türü</label>
                                        <input type="text" name="order_type" class="form-control" value="{{ $order->order_type }}" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ürün Adı</label>
                                        <input type="text" name="product_name" class="form-control" value="{{ $order->product_name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Ürün Adedi</label>
                                        <input type="number" name="quantity" class="form-control" value="{{ $order->quantity }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs mt-4" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Proje Detayı</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Üretim Emirleri</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dosyalar</a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content mt-3" id="custom-tabs-one-tabContent">
                            <!-- Sipariş Detayı Tab İçeriği -->
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card-body pad table-responsive">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p>Sipariş detayları bu alanda gösterilecektir.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Üretim Emirleri Tab İçeriği -->
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                <div class="card-body pad table-responsive">
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <p>Üretim emirleri bu alanda görüntülenecektir.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    <!-- Dosyalar Tab İçeriği -->
                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                        <div class="card-body pad table-responsive">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Dosya Yükleme Formu -->
                                    <form action="{{ route('order-files.upload', $order->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Dosya Yükle</label>
                                            <input type="file" class="form-control" name="file" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="file_type">Dosya Türü</label>
                                            <select name="file_type" class="form-control">
                                                <option value="delivery_note">İrsaliye</option>
                                                <option value="invoice">Fatura</option>
                                                <option value="other">Diğer</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button type="submit" class="btn btn-success">Yükle</button>
                                    </form>
                                </div>
                            </div>
<!-- Dosya Listeleme -->
<ul class="list-group" style="gap: 8px;">
    @if($order->order_files->count() > 0)
        
        <!-- Fatura Dosyaları -->
        @if($order->order_files->where('file_type', 'invoice')->count() > 0)
            <h5 class="mt-4">Fatura Dosyaları</h5>
            @foreach($order->order_files as $file)
                @if($file->file_type == 'invoice')
                    <li class="list-group-item text-center" style="border-radius: 10px;">
                        {{ $file->file_name }} - {{ ucfirst($file->file_type) }}
                        <div class="row justify-content-center" style="gap: 2px;">
                            <a href="{{ route('order-files.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                            <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('order-files.preview', $file->id) }}')">Görüntüle</button>
                            <form action="{{ route('order-files.delete', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </div>
                    </li>
                @endif
            @endforeach
        @endif

        <!-- İrsaliye Dosyaları -->
        @if($order->order_files->where('file_type', 'delivery_note')->count() > 0)
            <h5 class="mt-4">İrsaliye Dosyaları</h5>
            @foreach($order->order_files as $file)
                @if($file->file_type == 'delivery_note')
                    <li class="list-group-item text-center" style="border-radius: 10px;">
                        {{ $file->file_name }} - {{ ucfirst($file->file_type) }}
                        <div class="row justify-content-center" style="gap: 2px;">
                            <a href="{{ route('order-files.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                            <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('order-files.preview', $file->id) }}')">Görüntüle</button>
                            <form action="{{ route('order-files.delete', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </div>
                    </li>
                @endif
            @endforeach
        @endif

        <!-- Diğer Dosyalar -->
        @if($order->order_files->where('file_type', 'other')->count() > 0)
            <h5 class="mt-4">Diğer Dosyalar</h5>
            @foreach($order->order_files as $file)
                @if($file->file_type == 'other')
                    <li class="list-group-item text-center" style="border-radius: 10px;">
                        {{ $file->file_name }} - {{ ucfirst($file->file_type) }}
                        <div class="row justify-content-center" style="gap: 2px;">
                            <a href="{{ route('order-files.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                            <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('order-files.preview', $file->id) }}')">Görüntüle</button>
                            <form action="{{ route('order-files.delete', $file->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </div>
                    </li>
                @endif
            @endforeach
        @endif

    @else
        <li class="list-group-item text-center">Bu sipariş için henüz dosya yüklenmemiş.</li>
    @endif
</ul>





                        </div>
                    </div>

                    
        </div>
    </div>
</div>
                    </div> <!-- card-body Sonu -->
                </div> <!-- card Sonu -->
            </div> <!-- col-md-12 Sonu -->
        </div> <!-- row Sonu -->
    </div> <!-- container-fluid Sonu -->
</div> <!-- content Sonu -->
@endsection


@section('js')

<script>
// Dosya önizleme modalı açma fonksiyonu
function showFilePreview(url) {
    $('#filePreviewIframe').attr('src', url);
    $('#filePreviewModal').modal('show');
}
</script>




@endsection