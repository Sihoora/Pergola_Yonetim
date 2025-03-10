@extends('admin.tema')

@section('css')
<style>
    
    .taskbar-date {
        display: flex;
        padding: 0;
        margin: 0;
        list-style-type: none;
        flex-wrap: nowrap;
        justify-content: space-evenly;

    }
    .taskbar-date li {
        font-size: 0.8rem;
        font-weight: 500;
        text-align: center;
        position: relative;
        margin: 0;
        margin-top: 5px;
        padding: 5px; 
        white-space: nowrap; 
        flex-basis: 16%; 
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .taskbar-container {
        margin-bottom: 20px;
    }

    .taskbar {
        display: flex;
        justify-content: space-between;
        list-style: none;
        padding: 0;
        margin: 0;
        overflow: hidden;
        border-radius: 12px;
    }

    .taskbar li {
        position: relative;
        flex: 1;
        display: flex;
        text-align: center;
        align-items: center;
        justify-content: center;
        padding: 10px;
        background-color: #ededed;
        margin-right: 0.8px;
        border-right: 1px solid #dee2e6;
        transition: background-color 0.3s ease;
        border-radius: 12px;
    }

    .taskbar li.active {
        background-color: #28a745;
        color: white;
    }

    .taskbar li:after {
        content: '';
        position: absolute;
        right: -12px;
        top: %50;
        border-top: 15px solid transparent;
        border-bottom: 15px solid transparent;
        border-left: 15px solid transparent;
        z-index: 1;
    }

    .taskbar li.active:after {
        border-left-color: #28a745;
    }

    .taskbar li:last-child {
        margin-right: 0;
        border-right: none;
    }

    .taskbar li:last-child:after {
        display: none;
    }

    .taskbar li span {
        display: inline-block;
        background-color: #6c757d;
        color: white;
        width: 30px;
        height: 30px;
        line-height: 30px;
        border-radius: 50%;
        margin-right: 10px;
        margin-bottom: 5px;
    }

    .taskbar li p {
        margin: 0;
        line-height: 1;
    }

    .taskbar li.active span {
        background-color: #155724;
    }


    
    .file-card {
        width: 200px; /* Kartın genişliğini ayarlayın */
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin: 5px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .file-card:hover {
        transform: scale(1.02);
    }


    .product-card {
        height: auto;
        margin-top: 10px; 
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        background-color: #f9f9f9;
        transition: transform 0.2s ease;
    }

    .product-header {
        display: flex;
        flex-grow: 1;
        justify-content: center;
        text-align: center;
        border-bottom: 2px solid #eee;
        margin-bottom: 5px;
    }

    .product-title {
        display: flex;
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .product-info {
        display: grid; /* Öğeleri grid layout'a yerleştir */
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); /* Sütunları otomatik ayarlayarak genişlik kazandır */
        justify-content: center; /* Merkeze hizala */
        align-items: stretch; /* Yükseklikleri eşit yap */
        gap: 5px;
    }

    .product-info-item {
        background-color: #fff;
        padding: 3px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: center; /* İçerikleri dikey olarak ortalar */
        align-items: center; /* İçerikleri yatay olarak ortalar */
        height: auto;
    }

    .product-info-item strong {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        font-size: 0.8rem;
        color: #555;
        margin-top: 3px;
    }

    .product-info-item p {
        color: #777;
        font-weight: 500;
        font-size: 0.7rem; /* Yazı boyutunu ayarlar */
        text-align: center; /* Yazıyı ortalar */
        word-wrap: break-word; /* Yazı taşarsa kırılmasını sağlar */
    }

    .product-info-item p span {
        color: #333;
    }

    .product-info-item p i {
        color: #28a745;
    }

    .details-header-text {
        font-size: 1rem; 
        font-weight: bold; 
        color: #333; 
        text-align: start; 
        border-bottom:2px solid #dee2e6;
        margin-bottom: 8px;
        padding-bottom: 2px;
    }   

</style>
@endsection

@section('master')
<div class="content">
    <div class="container-fluid">
        <!-- Süreç Task Bar -->
        @if(isset($proje))
        <div class="row mb-2">
            <div class="col-12">
                <ul class="taskbar">
                    @php
                        $sira = [
                            'Yeni Proje',
                            'Teknik Çizim',
                            'Proje Onay',
                            'Proje Ön Hazırlık',
                            'Üretim Aşaması',
                            'Sevk İçin Hazır',
                        ];
                    @endphp
                    @foreach($sira as $index => $step)
                        <li class="{{ $proje->surec == $step ? 'active' : '' }}">
                            <span>{{ $index + 1 }}</span>
                            <p>{{ $step }}</p>
                            @php
                                $surecTarih = $proje->surecTarihleri->where('surec', $step)->first();
                            @endphp
                        </li>
                    @endforeach
                </ul>
                     @if($surecTarihleri->isNotEmpty())
                        <ul class="taskbar-date">
                            @foreach($surecTarihleri as $surecTarih)
                                <li>{{ $surecTarih->surec }}: {{ \Carbon\Carbon::parse($surecTarih->tarih)->format('d F Y H:i') }}</li>
                            @endforeach
                                <li>{{ $proje->surec }}: <em>Henüz tamamlanmadı</em></li>
                        </ul>
                            @else
                                <p>Henüz süreç tarihi kaydı bulunmamaktadır.</p>
                            @endif 
            </div>
        </div>
    @endif
 


        <!-- Üretim Emri Oluştur Modal -->
        <div class="modal fade" id="modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Üretim Emri Oluştur</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('note.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="proje_id" value="{{ $proje->id }}">
                            <div class="form-group">
                                <label for="surec">Süreç Seçin</label>
                                <select class="form-control" name="surec">
                                    @foreach($sira as $step)
                                    <option value="{{ $step }}">{{ $step }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="not">Not</label>
                                <textarea class="form-control" name="not" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sipariş Notu Oluştur Modal -->
<div class="modal fade" id="modal-order-note" tabindex="-1" role="dialog" aria-labelledby="modalOrderNoteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOrderNoteLabel">Sipariş Notu Oluştur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('note.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="proje_id" value="{{ $proje->id }}">
                    <input type="hidden" name="surec" value="Yeni Proje">
                    <input type="hidden" name="is_order_note" value="1"> <!-- Sipariş notu olduğunu belirten alan -->
                    
                    <div class="form-group">
                        <label for="note">Not</label>
                        <textarea name="not" id="not" class="form-control" rows="5" required></textarea>
                    </div>
                    
                    <!-- Eklemek istediğiniz diğer alanlar varsa buraya ekleyebilirsiniz -->
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>


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


<!-- Proje Detayları -->
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary card-outline">
            <div class="card-header"></div>
            <div class="card-body">

                <div class="row" style="margin-top:20px;">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header"></div>
                            <div class="card-body">
                                <form role="form" action="#" method="post">
                                    @csrf
                                    @if(isset($proje))
                                    @method('PUT')
                                    @endif
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Proje Kodu</label>
                                                <input type="text" name="proje_kodu" class="form-control" value="{{ isset($proje) ? $proje->proje_kodu : '' }}" placeholder="Enter ..." disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Proje Adı</label>
                                                <input type="text" name="proje_adi" class="form-control" value="{{ isset($proje) ? $proje->proje_adi : '' }}" placeholder="Enter ..." disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Müşteri</label>
                                                <input type="text" name="musteri" class="form-control" value="{{ isset($proje) ? $proje->musteri : '' }}" placeholder="Enter ..." disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Oluşturulma Tarihi:</label>
                                                <input type="text" name="created_at" class="form-control" value="{{ isset($proje) ? $proje->created_at : '' }}" placeholder="Enter ..." disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Teslim Tarihi:</label>
                                                <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                    <input type="text" name="teslim_tarihi" class="form-control datetimepicker-input" value="{{ old('teslim_tarihi', isset($proje) ? \Carbon\Carbon::parse($proje->teslim_tarihi)->format('d/m/Y') : '') }}" data-target="#reservationdate" disabled />
                                                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div> <!-- /.col-md-12 -->
                </div> <!-- /.row -->

                <!-- Üretim Emri Oluştur -->
                <div class="row">
                    <div class="col-12" style="align-items: right; text-align: right;">
                        @can('view projects')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                            <i class="fa fa-cog" style="margin-right: 5px;"></i> Üretim Emri Oluştur
                        </button>
                        @endcan
                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-order-note">
                            <i class="fa fa-pencil-square-o" style="margin-right: 5px;"></i> Sipariş Notu Oluştur
                        </button>

                        <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('proje.pdf', $proje->id) }}'">
                            <i class="fa fa-file-pdf-o" style="margin-right: 5px;"></i> PDF Oluştur
                        </button>
                    </div>
                </div>

<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist" style="margin-top: 20px;">
    <li class="nav-item">
        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Proje Detayı</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Üretim Emirleri</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dosyalar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-uretim-malzeme-tab" data-toggle="pill" href="#custom-tabs-one-uretim-malzeme" role="tab" aria-controls="custom-tabs-one-uretim-malzeme" aria-selected="false">Üretim Malzeme Listesi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-montaj-malzeme-tab" data-toggle="pill" href="#custom-tabs-one-montaj-malzeme" role="tab" aria-controls="custom-tabs-one-montaj-malzeme" aria-selected="false">Montaj Malzeme Listesi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-depo-sevkiyat-tab" data-toggle="pill" href="#custom-tabs-one-depo-sevkiyat" role="tab" aria-controls="custom-tabs-one-depo-sevkiyat" aria-selected="false">Depo & Sevkiyat</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-tabs-one-ilave-siparisler-tab" data-toggle="pill" href="#custom-tabs-one-ilave-siparisler" role="tab" aria-controls="custom-tabs-one-ilave-siparisler" aria-selected="false">Proje İçin İlave Siparişler</a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="custom-tabs-one-tabContent">
    <!-- Proje Detayı Tab İçeriği -->
    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
        <!-- Proje Detayı -->
        <div class="card-body pad table-responsive" style="display: flex; justify-content: space-between; flex-wrap: wrap;">
            <!-- Ürün Bilgileri -->
            <div class="col-md-8" style="border-right:2px solid #dee2e6">
                <h5 class="details-header-text">ÜRÜNLER</h5>
                @foreach($proje->urunler as $urun)
                <div class="col-md-12">
                    <div class="product-card border-dark mb-1">
                        <div class="product-header">
                            <h5 class="product-title">{{ $urun->urun_name }}</h5>
                        </div>
                        <div class="product-info">
                            <div class="product-info-item">
                                <strong>Ral Kodu</strong>
                                <p>{{ $urun->ral_kodu }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>En</strong>
                                <p>{{ $urun->en }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Boy</strong>
                                <p>{{ $urun->boy }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Kumaş Cinsi</strong>
                                <p>{{ $urun->kumas_cinsi }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Kumaş Profil Ral</strong>
                                <p>{{ $urun->kumas_profil_ral }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Led Model</strong>
                                <p>{{ $urun->led_model }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Motor Model</strong>
                                <p>{{ $urun->motor_model }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Kumanda</strong>
                                <p>{{ $urun->kumanda }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Flanş</strong>
                                <p>{{ $urun->flans }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Arka Çelik</strong>
                                <p>{{ $urun->arka_celik }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Arka Çelik İçin Not</strong>
                                <p>{{ $urun->arka_celik_not }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Taşıyıcı Çelik Ayak</strong>
                                <p>{{ $urun->tasiyici_celik_ayak }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Çelik Ayak Model</strong>
                                <p>{{ $urun->celik_ayak_model }}</p>
                            </div>
                            <div class="product-info-item">
                                <strong>Taşıyıcı Çelik Not</strong>
                                <p>{{ $urun->tasiyici_celik_not }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Notlar -->
            <div class="col-md-4">
                <h5 class="details-header-text">NOTLAR</h5>
                <ul class="todo-list" data-widget="todo-list">
                    <!-- Dinamik Notlar -->
                    @foreach($proje->notlar as $note)
                    @if(($note->surec == 'Yeni Proje') && ($note->is_order_note))
                    <li class="@if($note->checked) done @endif" style="border: 0.1rem solid;">
                        <span>
                            <i class="fa fa-sticky-note"></i>
                        </span>
                        <div class="icheck-primary d-inline"></div>
                        <span class="text">{{ $note->not }}</span>
                        <div class="tools"></div>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <!-- Dosyalar Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
        
        <!-- Dosya Listesi -->
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                    <div class="card-header">
                        <span class="h5 m-0">Sipariş Dosyaları</span>
                    </div>
                    <div class="card-body">
                        @if(isset($proje) && $proje->files->count() > 0)
                        <div class="row">
                            @foreach($proje->files->where('file_type', 'general') as $file)
                            <div class="">
                                <div class="file-card">
                                    <div class="product-header">
                                        <h5 class="product-title">{{ $file->file_name }}</h5>
                                    </div>
                                    <div class="product-info d-flex justify-content-around align-items-center">
                                        <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Yüklenen dosya yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                    <div class="card-header">
                        <span class="h5 m-0">İmalat Dosyaları</span>
                        <!-- Teknik Çizim Dosyası Yükleme Butonu -->
                        <button class="btn btn-success float-right" data-toggle="collapse" data-target="#uploadTechnicalDrawingForm">
                            İmalat Dosyası Yükle
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Teknik Çizim Dosyası Yükleme Formu -->
                        <div id="uploadTechnicalDrawingForm" class="collapse">
                            <form id="formTeknikCizim" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                                <input type="hidden" name="file_type" value="technical_drawing">
                                <div class="form-group">
                                    <label>Teknik Çizim Dosyası Yükle</label>
                                    <input id="file-upload-technical" type="file" name="file" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                </div>
                            </form>
                        </div>

                        <!-- Yüklenen Teknik Çizim Dosyaları Listesi -->
                        @if(isset($proje) && $proje->files->count() > 0)
                        <div class="row">
                            @foreach($proje->files->where('file_type', 'technical_drawing') as $file)
                            <div class="">
                                <div class="file-card">
                                    <div class="product-header">
                                        <h5 class="product-title">{{ $file->file_name }}</h5>
                                    </div>
                                    <div class="product-info">
                                        <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Yüklenen dosya yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Üretim Emirleri Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">

        <!-- Üretim Emirleri İçeriği -->
        @if(isset($proje->notlar) && $proje->notlar->count() > 0)
        <!-- SÜREÇ NOTLARI -->
        <div class="card" style="margin-top: 15px;">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Üretim Emirleri ve Süreç Notları
                </h3>
            </div>
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <!-- Dinamik Notlar -->
                    @foreach($proje->notlar as $note)
                        @if($note->surec == $proje->surec) 
                            <li class="@if($note->checked) done @endif">
                                <span>
                                    <i class="fa fa-sticky-note"></i>
                                </span>
                                <div class="icheck-primary d-inline ml-2">
                                    <input type="checkbox" class="toggle-checkbox" data-note-id="{{ $note->id }}" id="todoCheck{{ $note->id }}" @if($note->checked == 1) checked @endif>
                                    <label for="todoCheck{{ $note->id }}"></label>
                                </div>
                                <span class="text">{{ $note->not }}</span>
                                <div class="tools">
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="card-footer clearfix">
                <button type="button" class="btn btn-primary float-right" id="advance-process-btn" disabled>Süreci İlerlet</button>
            </div>
        </div>
        @else
        <p>Üretim emri bulunmamaktadır.</p>
        @endif

    </div>

    <!-- Üretim Malzeme Listesi Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-uretim-malzeme" role="tabpanel" aria-labelledby="custom-tabs-one-uretim-malzeme-tab">
           <!-- Üretim Malzeme Listesi Yükleme ve Listeleme -->
    <div class="row" style="margin-top: 30px;">
        <div class="col-md-12">
            <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                <div class="card-header">
                    <span class="h5 m-0">Üretim Malzeme Listesi</span>
                    <!-- Malzeme Listesi Dosyası Yükleme Butonu -->
                    <button class="btn btn-success float-right" data-toggle="collapse" data-target="#uploadMaterialListForm">
                        Malzeme Listesi Yükle
                    </button>
                </div>
                <div class="card-body">
                    <!-- Malzeme Listesi Dosyası Yükleme Formu -->
                    <div id="uploadMaterialListForm" class="collapse">
                        <form id="formMaterialList" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                            <input type="hidden" name="file_type" value="material_list">
                            <div class="form-group">
                                <label>Malzeme Listesi Dosyası Yükle</label>
                                <input id="file-upload-material" type="file" name="file" class="form-control-file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                            </div>
                        </form>
                    </div>

                    <!-- Yüklenen Malzeme Listesi Dosyaları Listesi -->
                    @if(isset($proje) && $proje->files->count() > 0)
                    <div class="row">
                        @foreach($proje->files->where('file_type', 'material_list') as $file)
                        <div class="">
                            <div class="file-card">
                                <div class="product-header">
                                    <h5 class="product-title">{{ $file->file_name }}</h5>
                                </div>
                                <div class="product-info d-flex justify-content-around align-items-center">
                                    <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                    <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p>Yüklenen dosya yok.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Montaj Malzeme Listesi Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-montaj-malzeme" role="tabpanel" aria-labelledby="custom-tabs-one-montaj-malzeme-tab">
        <!-- Montaj Malzeme Listesi İçeriği -->
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                    <div class="card-header">
                        <span class="h5 m-0">Montaj Malzeme Listesi</span>
                        <button class="btn btn-success float-right" data-toggle="collapse" data-target="#uploadMontajListForm">
                            Montaj Malzeme Yükle
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="uploadMontajListForm" class="collapse">
                            <form id="formMontajList" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                                <input type="hidden" name="file_type" value="montaj_list">
                                <div class="form-group">
                                    <label>Montaj Malzeme Dosyası Yükle</label>
                                    <input id="file-upload-montaj" type="file" name="file" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                </div>
                            </form>
                        </div>
    
                        <!-- Yüklenen Montaj Malzeme Dosyaları Listesi -->
                        @if(isset($proje) && $proje->files->count() > 0)
                        <div class="row">
                            @foreach($proje->files->where('file_type', 'montaj_list') as $file)
                            <div class="">
                                <div class="file-card">
                                    <div class="product-header">
                                        <h5 class="product-title">{{ $file->file_name }}</h5>
                                    </div>
                                    <div class="product-info d-flex justify-content-around align-items-center">
                                        <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Yüklenen dosya yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Depo & Sevkiyat Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-depo-sevkiyat" role="tabpanel" aria-labelledby="custom-tabs-one-depo-sevkiyat-tab">
        <!-- Depo & Sevkiyat İçeriği -->
        
        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                    <div class="card-header">
                        <span class="h5 m-0">Depo & Sevkiyat</span>
                        <button class="btn btn-success float-right" data-toggle="collapse" data-target="#uploadDepoSevkiyatForm">
                            Depo/Sevkiyat Dosyası Yükle
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="uploadDepoSevkiyatForm" class="collapse">
                            <form id="formDepoSevkiyat" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                                <input type="hidden" name="file_type" value="depo_sevkiyat">
                                <div class="form-group">
                                    <label>Depo/Sevkiyat Dosyası Yükle</label>
                                    <input id="file-upload-depo-sevkiyat" type="file" name="file" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                </div>
                            </form>
                        </div>
    
                        <!-- Yüklenen Depo/Sevkiyat Dosyaları Listesi -->
                        @if(isset($proje) && $proje->files->count() > 0)
                        <div class="row">
                            @foreach($proje->files->where('file_type', 'depo_sevkiyat') as $file)
                            <div class="">
                                <div class="file-card">
                                    <div class="product-header">
                                        <h5 class="product-title">{{ $file->file_name }}</h5>
                                    </div>
                                    <div class="product-info d-flex justify-content-around align-items-center">
                                        <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Yüklenen dosya yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>


    </div>

    <!-- Proje İçin İlave Siparişler Tab İçeriği -->
    <div class="tab-pane fade" id="custom-tabs-one-ilave-siparisler" role="tabpanel" aria-labelledby="custom-tabs-one-ilave-siparisler-tab">
        <!-- İlave Siparişler İçeriği -->

        <div class="row" style="margin-top: 30px;">
            <div class="col-md-12">
                <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
                    <div class="card-header">
                        <span class="h5 m-0">Proje İçin İlave Siparişler</span>
                        <button class="btn btn-success float-right" data-toggle="collapse" data-target="#uploadIlaveSiparislerForm">
                            İlave Sipariş Yükle
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="uploadIlaveSiparislerForm" class="collapse">
                            <form id="formIlaveSiparisler" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                                <input type="hidden" name="file_type" value="ilave_siparisler">
                                <div class="form-group">
                                    <label>İlave Sipariş Dosyası Yükle</label>
                                    <input id="file-upload-ilave-siparisler" type="file" name="file" class="form-control-file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                </div>
                            </form>
                        </div>
    
                        <!-- Yüklenen İlave Sipariş Dosyaları Listesi -->
                        @if(isset($proje) && $proje->files->count() > 0)
                        <div class="row">
                            @foreach($proje->files->where('file_type', 'ilave_siparisler') as $file)
                            <div class="">
                                <div class="file-card">
                                    <div class="product-header">
                                        <h5 class="product-title">{{ $file->file_name }}</h5>
                                    </div>
                                    <div class="product-info d-flex justify-content-around align-items-center">
                                        <button type="button" class="btn btn-info flex-grow-1" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                        <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary flex-grow-1">İndir</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p>Yüklenen dosya yok.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col-md-12 -->
</div> <!-- /.row -->


@endsection



@section('js')

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

$(document).ready(function () {
        $("#file-upload").fileinput({
            theme: 'fa',
            allowedFileExtensions: ['xlsx', 'docx', 'txt', 'png', 'jpg', 'jpeg', 'dwg', 'pdf', 'zip'],
            maxFileSize: 8192,
            showUpload: false,
            showRemove: false,
            dropZoneEnabled: false,
            fileActionSettings: {
                showZoom: false,
                showRemove: false,
            },
            layoutTemplates: {
                main1: '{preview}\n' +
                    '<div class="input-group {class}">\n' +
                    '   <div class="input-group-prepend">\n' +
                    '       <span class="input-group-text"><i class="fa fa-upload"></i></span>\n' +
                    '   </div>\n' +
                    '   <div class="form-control file-caption {class}">\n' +
                    '       <span class="file-caption-icon"></span>\n' +
                    '       <input class="file-caption-name" placeholder="{caption}" readonly>\n' +
                    '   </div>\n' +
                    '   <div class="input-group-append">\n' +
                    '       <button type="button" tabindex="500" title="{removeTitle}" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="fa fa-trash"></i></button>\n' +
                    '   </div>\n' +
                    '</div>',
                main2: '{preview}\n' +
                    '<div class="input-group {class}">\n' +
                    '   <div class="input-group-prepend">\n' +
                    '       <span class="input-group-text"><i class="fa fa-upload"></i></span>\n' +
                    '   </div>\n' +
                    '   <div class="form-control file-caption {class}">\n' +
                    '       <span class="file-caption-icon"></span>\n' +
                    '       <input class="file-caption-name" placeholder="{caption}" readonly>\n' +
                    '   </div>\n' +
                    '   <div class="input-group-append">\n' +
                    '       <button type="button" tabindex="500" title="{removeTitle}" class="btn btn-default fileinput-remove fileinput-remove-button"><i class="fa fa-trash"></i></button>\n' +
                    '   </div>\n' +
                    '</div>',
            },
        });
    });     






    // Dosya önizleme modalı açma fonksiyonu
    function showFilePreview(url) {
        $('#filePreviewIframe').attr('src', url);
        $('#filePreviewModal').modal('show');
    }

    $(document).ready(function() {
        $('.toggle-checkbox, .static-checkbox').on('change', function() {
            var noteId = $(this).data('note-id');
            var isChecked = $(this).is(':checked') ? 1 : 0;
    
            // Dinamik ve sabit notlar için aynı AJAX işlemi
            var checkboxType = $(this).hasClass('static-checkbox') ? 'static' : 'dynamic';
    
            $.ajax({
                url: '/proje/' + noteId + '/toggle-checkbox',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    checked: isChecked,
                    type: checkboxType 
                },
                success: function(response) {
                    if(response.status === 'success') {
                        console.log('Checkbox durumu güncellendi.');
                    } else {
                        alert('Checkbox güncellenirken bir hata oluştu.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX hatası:', error);
                    alert('Checkbox güncellenirken bir hata oluştu.');
                }
            });

            checkAllCheckboxes();
        });

        
        function checkAllCheckboxes() {
            var allCheckboxesChecked = $('input.toggle-checkbox').length === $('input.toggle-checkbox:checked').length &&
                $('input.static-checkbox').length === $('input.static-checkbox:checked').length;
    
            $('#advance-process-btn').prop('disabled', !allCheckboxesChecked);
        }
    });

    document.getElementById('advance-process-btn').addEventListener('click', function() {
        const form = document.createElement('form');
        form.method = 'GET';
        form.action = '{{ route("proje.ilerletSurec", $proje->id) }}';

      
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

      
        document.body.appendChild(form);
        form.submit();
    });
         
        @if(session('warning'))
            Swal.fire({
                title: 'Bütün notları doğruladınız. Süreci İlerletmek istiyor musunuz?',
                text: 'Bu eylem geri alınamaz.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet',
                cancelButtonText: 'Hayır'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Başarılı!',
                        text: 'Süreç başarıyla ilerletildi',
                        icon: 'success'
                    });
                } else {
                    Swal.fire({
                        title: 'Hata!',
                        text: 'Süreç ilerletilirken bir hata oluştu.',
                        icon: 'error'
                    });
                }
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Hata!',
                text: 'Proje süreci zaten son aşamada, daha ileriye gidemez!',
                icon: 'error'
            });
        @endif


        @if(session('success'))
            Swal.fire({
                title: 'Başarılı!',
                text: 'Not Ekleme işlemi başarılı!',
                icon: 'success'
            });
        @endif 
        
        


     @if(session('info'))
           Swal.fire({
                  title: 'Başarılı!',
                  text: 'Dosya başarıyla yüklendi.',
                  icon: 'success' 
           });
         @endif

    

        </script>   
@endsection
                