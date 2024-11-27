@extends('admin.tema')

@section('css')
@endsection

@section('master')
<div class="content">
    <div class="container-fluid">

        <!-- Modal for File Preview -->
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

        <!-- Company Details -->
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h4 class="m-0">Şirket Detayı</h4>
                    </div>

                    <div class="card-body pad table-responsive">
                        <form role="form" action="" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Şirket Adı</label>
                                        <input type="text" name="company_name" class="form-control" value="{{ $company->company_name }}" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>E-posta</label>
                                        <input type="text" name="e-mail" class="form-control" value="{{ $company->email }}" disabled>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Telefon Numarası</label>
                                        <input type="text" name="phone" class="form-control" value="{{ $company->phone }}" disabled>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>

                        <!-- New Cards for Contact and Address Information -->
                        <div class="row mt-4">
                            <!-- Contact Information Card -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="m-0">İletişim Bilgileri</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>İlgili Kişi:</strong> {{ $company->contact_person }}</p>
                                        <p><strong>İletişim Numarası:</strong> {{ $company->contact_phone }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Address Information Card -->
                            <div class="col-md-6">
                                <div class="card shadow-sm border-secondary">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="m-0">Adres Bilgileri</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Adres:</strong> {{ $company->address }}</p>
                                        <p><strong>Şehir:</strong> {{ $company->city }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs -->
                        <ul class="nav nav-tabs mt-4" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-files-tab" data-toggle="pill" href="#custom-tabs-one-files" role="tab">Dosyalar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-orders-tab" data-toggle="pill" href="#custom-tabs-one-orders" role="tab">Geçmiş Siparişler</a>
                            </li>
                        </ul>

                        <div class="tab-content mt-3">
                            <!-- Files Tab -->
                            <div class="tab-pane fade show active" id="custom-tabs-one-files" role="tabpanel">
                                <div class="card-body pad table-responsive">
                                    <!-- Files content here -->
                                </div>
                            </div>

                            <!-- Orders Tab -->
                            <div class="tab-pane fade" id="custom-tabs-one-orders" role="tabpanel">
                                <div class="card-body pad table-responsive">
                                    <!-- Orders content here -->

                                    @if($company->id && $company->orders->count() > 0)
                                    <div class="row">
                                        @foreach($company->orders as $order)
                                            <div class="col-md-6 col-lg-4 mb-4">
                                                <div class="card shadow-sm border-light">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-weight-bold">{{ $order->product_name }}</h5>
                                                        <p class="card-text">
                                                            <strong>Adet:</strong> {{ $order->quantity }}<br>
                                                            <strong>Tip:</strong> {{ $order->type }}<br>
                                                            <strong>Sipariş Kodu:</strong> {{ $order->order_code }}
                                                        </p>
                                                    </div>
                                                    <div class="card-footer text-right">
                                                        <small class="text-muted">Sipariş Tarihi: {{ $order->created_at->format('d-m-Y') }}</small>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Bu şirkete ait geçmiş sipariş bulunamadı.</p>
                                @endif
                                


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
<script>
    function showFilePreview(url) {
        $('#filePreviewIframe').attr('src', url);
        $('#filePreviewModal').modal('show');
    }
</script>
@endsection
