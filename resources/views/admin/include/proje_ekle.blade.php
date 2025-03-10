@extends('admin.tema')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

<style>
.product-card {
        width: 100%; /* Kartın genişliğini ayarlayın */
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
        display: flex;
        justify-content: space-between;
        gap: 3px;
        flex-wrap: nowrap;
    }

    .product-info-item {
        flex-grow: 1; /* Öğelerin genişlemesini sağlar */
        flex-shrink: 0; /* Öğelerin küçülmesini engeller */
        flex-basis: calc(33.333% - 10px); /* Üç sütun olacak şekilde genişlik ayarlanır */
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .product-info-item strong {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
        color: #555;
    }

    .product-info-item p {
        margin: 0;
        color: #777;
    }

    .product-info-item p span {
        color: #333;
    }

    .product-info-item p i {
        color: #28a745;
    }

</style>

@endsection
@section('master')
<!-- Main content -->
<div class="content">
    <div class="container-fluid"> 

        @if(isset($proje))
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
                            <input type="hidden" name="surec" value="Üretime Gönderildi">
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
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 m-0">{{ isset($proje) ? 'Proje Düzenle' : 'Proje Ekle' }}</span>

                            <div class="row" style=" justify-content: end;">
                                <!-- Siparişi Tamamla Butonu -->
                                @if(isset($proje))
                                    <button type="button" class="btn btn-success" style="margin-right: 20px;"
                                      onclick="confirmOrder('{{ route('proje.detay', $proje->id) }}')">Siparişi Tamamla</button>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header"></div>
                                    <div class="card-body">

                                        <form role="form" id="projeForm"
                                        action="{{ isset($proje) ? route('proje.update', $proje->id) : route('proje.store') }}"
                                        method="post"> 
                                      @csrf
                                      @if(isset($proje))
                                          @method('PUT')
                                      @endif
                                      <div class="row">
                                          <div class="col-sm-3">
                                              <div class="form-group">
                                                  <label>Proje Kodu</label>
                                                  <input type="text" name="proje-kodu" class="form-control"
                                                         value="{{ isset($proje) ? $proje->proje_kodu : $newProjectCode }}"
                                                         placeholder="Proje Kodu Giriniz" disabled>
                                                         <input type="hidden" name="proje_kodu" value="{{ isset($proje) ? $proje->proje_kodu : $newProjectCode }}">
                                              </div>
                                          </div>
                                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                          <div class="col-sm-3">
                                              <div class="form-group">
                                                  <label>Proje Adı</label>
                                                  <input type="text" name="proje_adi" class="form-control @error('proje_adi') is-invalid @enderror"
                                                         value="{{ old('proje_adi', isset($proje) ? $proje->proje_adi : '') }}"
                                                         placeholder="Proje Adı Giriniz">
                                                  @error('proje_adi')
                                                  <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                              <div class="form-group">
                                                  <label>Müşteri</label>
                                                  <input type="text" name="musteri" class="form-control @error('musteri') is-invalid @enderror"
                                                         value="{{ old('musteri', isset($proje) ? $proje->musteri : '') }}"
                                                         placeholder="Müşteri Giriniz">
                                                  @error('musteri')
                                                  <div class="invalid-feedback">{{ $message }}</div>
                                                  @enderror
                                              </div>
                                          </div>
                                          <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Teslim Tarihi:</label>
                                                <div class="input-group date" id="datepicker" data-target-input="nearest">
                                                    <input type="text" name="teslim_tarihi" class="form-control @error('teslim_tarihi') is-invalid @enderror"
                                                           value="{{ old('teslim_tarihi', isset($proje) ? \Carbon\Carbon::parse($proje->teslim_tarihi)->format('d/m/Y') : '') }}"
                                                           placeholder="Gün/Ay/Yıl Formatında Tarih Giriniz">
                                                    <div class="input-group-append">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                    @error('teslim_tarihi')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                        <div class="row" style=" justify-content: end;">
                                         <button type="button" class="btn btn-success" style="margin-right: 20px;"
                                            onclick="document.getElementById('projeForm').submit();">{{ isset($proje) ? 'Projeyi
                                                Güncelle' : 'Yeni Proje Oluştur' }}</button>
                                        </div>
                                  </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        @if(isset($proje))

                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-left">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-order-note">
                                    <i class="fa fa-pencil-square-o" style="margin-right: 5px;"></i> Sipariş Notu Oluştur
                                </button>
                            </div>
                        </div>         


                        <div class="row">
                            <!-- Sol tarafta ürün ekleme ve eklenen ürünler tabı -->
                            <div class="col-md-8">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Ürün Ekleme Alanı</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Eklenen Ürünler</a>
                                            </li>
                                        </ul>
                    
                                        <!-- Tab content -->
                                        <div class="tab-content">
                                            <!-- Ürün Ekleme Alanı Tabı -->
                                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                                <!-- Ürün ekleme formu burada olacak -->

                           <!-- Hatalar alanı -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                       
                        <!-- Ürün Ekleme Formu -->
                        <form id="Urun" method="POST" action="{{ route('urun.store') }}">
                            @csrf
                            <input type="hidden" id="urun_id" name="urun_id" value="">
                            <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">

                            <div class="row justify-content-center mx-auto text-center">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        <label>Ürün Grubu</label>
                                        <select class="form-control" name="urun_name" onchange="getDynamicInputs(this.value)">
                                            <option value="0">Ürün Grubu Seçiniz</option>
                                            <option>Pergola Avantgarde</option>
                                            <option>Pergola Elegant</option>
                                            <option>Pergola Classic</option>
                                            <option>Pergola SkyLounge</option>
                                            <option>Pergola SkyMax</option>
                                            <option>Pergola SkyPro</option>
                                            <option>Toscana</option>
                                            <option>iZipscreen</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-md-9">
                                    <div id="dynamicInputs" style="padding: 5px; display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 8px;">
                                        <!-- Dinamik form alanları burada oluşacak -->
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-success" style="margin-right: 20px;" onclick="submitUrunForm()">Ürünü Kaydet</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                                        <!-- Eklenen Ürünler Tabı -->
                                          <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                              <!-- Ürün Bilgileri -->
                                              <div class="row">
                                                 @foreach($proje->urunler as $urun)
                                                     <div class="col-lg-12 mb-2" style="height: %20;">
                                                            <div class="product-card">
                                                                <div class="product-header" style="justify-content: space-between;">
                                                                    <h5 class="product-title">{{ $urun->urun_name }}</h5>
                                                                    <button type="button" class="btn btn-warning btn-sm editProduct" data-id="{{ $urun->id }}">Düzenle</button>
                                                                    </div>
                                                                <div class="product-info d-flex flex-wrap">
                                                                    

                                                                    <div class="product-info-item">
                                                                        <strong>En</strong>
                                                                        <p>{{ $urun->en }}</p>
                                                                    </div>
                                                                    <div class="product-info-item">
                                                                        <strong>Boy</strong>
                                                                        <p>{{ $urun->boy }}</p>
                                                                    </div>
                                                                    <div class="product-info-item">
                                                                        <strong>Ral Kodu</strong>
                                                                        <p>{{ $urun->ral_kodu }}</p>
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
                                                                        <strong>Led Dizilim</strong>
                                                                        <p>{{ $urun->led_dizilim }}</p>
                                                                    </div>
                                                                    <div class="product-info-item">
                                                                        <strong>Led Adet</strong>
                                                                        <p>{{ $urun->led_adet }}</p>
                                                                    </div>
                                                                    <div class="product-info-item">
                                                                        <strong>Led Model</strong>
                                                                        <p>{{ $urun->led_alici}}</p>
                                                                    </div>
                                                                    <div class="product-info-item">
                                                                        <strong>Motor Model</strong>
                                                                        <p>{{ $urun->motor_model }}</p>
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
                                                                        <strong>Kompozit Ral</strong>
                                                                        <p>{{ $urun->kompozit_ral }}</p>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

        <!-- Dosya yükleme formu -->
        <div class="col-md-4">
            <div class="card card-primary card-outline">
                <div class="card-header"></div>
                <div class="card-body">
                    <!-- Dosya Yükleme Formu -->
                    <form id="formGeneral" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                        <input type="hidden" name="file_type" value="general">
                        <div class="form-group text-center">
                            <label>Dosya Yükle</label>
                            <div class="file-loading">
                                <input id="file-upload-general" type="file" name="file" class="file" data-show-preview="false">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                        </div>
                    </form>
                    <hr>

                    <div class="text-center">
                        <h5 class="mt-4">Yüklenen Dosyalar</h5>
                    </div>
                    
                    <ul class="list-group" style="gap: 8px;">
                        @if(isset($proje) && $proje->files->count() > 0)
                            @if($proje->files->where('file_type', 'general')->count() > 0)
                                <h5 class="mt-4">Genel Dosyalar</h5>
                                @foreach($proje->files as $file)
                                    @if($file->file_type == 'general')
                                        <li class="list-group-item text-center" style="border-radius: 10px;">
                                            {{ $file->file_name }}
                                            <div class="row justify-content-center" style="gap: 2px;">
                                                <a href="{{ route('file.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                                                <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                                <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                                </form>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                    
                            @if($proje->files->where('file_type', 'technical_drawing')->count() > 0)
                            <h5 class="mt-4">Teknik Çizim Dosyaları</h5>
                                @foreach($proje->files as $file)
                                    @if($file->file_type == 'technical_drawing')
                                        <li class="list-group-item text-center" style="border-radius: 10px;">
                                            {{ $file->file_name }}
                                            <div class="row justify-content-center" style="gap: 2px;">
                                                <a href="{{ route('file.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                                                <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                                <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display:inline;">
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
                            <li class="list-group-item text-center">Yüklenen dosya yok.</li>
                        @endif
                    </ul>
                    

    
                <div class="card card-primary card-outline" style="margin-top: 10px">
            <div class="card-header">
                <h5 class="card-title mb-0">Sipariş Notları</h5>
            </div>
            <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">
                    <!-- Dinamik Notlar -->
                    @if($proje->notlar->count() == 0)
                        <li class="done" style="border: 0.1rem solid;">
                            <span>
                                <i class="fa fa-sticky-note"></i>
                            </span>
                            <div class="icheck-primary d-inline"></div>
                            <span class="text">Sipariş notu bulunmamaktadır.</span>
                            <div class="tools">
                            </div>
                        </li>
                    @endif  
                    @foreach($proje->notlar as $note)
                        @if($note->is_order_note == 1) 
                            <li class="@if($note->checked) done @endif" style="border: 0.1rem solid;">
                                <span>
                                    <i class="fa fa-sticky-note"></i>
                                </span>
                                <div class="icheck-primary d-inline"></div>
                                <span class="text">{{ $note->not }}</span>
                                <div class="tools">
                                </div>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        </div>


@endif  



<!-- Modal -->
<div class="modal fade" id="filePreviewModal" tabindex="-1" role="dialog" aria-labelledby="filePreviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filePreviewModalLabel">Dosya Önizleme</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="filePreviewIframe" style="width: 100%; height: 1000px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
            </div>
        </div>
    </div>
</div>
@endsection



@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/js/fileinput.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/proje_ekle_js/input_fields.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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


    $(document).ready(function () {
        var urlParams = new URLSearchParams(window.location.search);
        var urunId = urlParams.get('urun_id');

        if (urunId) {
            $.ajax({
                url: '/dashboard/urun-duzenle/' + urunId,
                method: 'GET',
                success: function (data) {
                    $('select[name="urun_name"]').val(data.urun_name).change();
                    loadDynamicInputs(data.urun_name, data);
                    $('#urun_id').val(data.id);  // Ürün ID'sini formda gizli inputa set et
                }
            });
        }

        $('select[name="urun_name"]').on('change', function () {
            var selectedValue = $(this).val();
            loadDynamicInputs(selectedValue);
        });
    });

    function loadDynamicInputs(selectedValue, data = null) {
        var dynamicInputs = document.getElementById("dynamicInputs");
        dynamicInputs.innerHTML = "";

        if (selectedValue) {
            getDynamicInputs(selectedValue, data);
        }
    }


    function submitUrunForm() {
        const urunForm = document.getElementById('Urun');
        const urunId = document.getElementById('urun_id').value;

        if (urunId) {
            urunForm.action = `{{ url('urun-duzenle') }}/${urunId}`;
            urunForm.method = 'POST';
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'PUT';
            urunForm.appendChild(methodInput);
        } else {
            urunForm.action = `{{ route('urun.store') }}`;
            urunForm.method = 'POST';
        }

        urunForm.submit();
    }


    function confirmOrder(url) {
        Swal.fire({
            title: 'Siparişi tamamlamak üzeresiniz',
            text: "Bu işlemi onaylıyor musunuz?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, tamamla!',
            cancelButtonText: 'İptal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    $(document).ready(function () {
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Başarılı',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    });

    function showFilePreview(url) {
        $('#filePreviewIframe').attr('src', url);
        $('#filePreviewModal').modal('show');
    }

    $(document).on('click', '.editProduct', function() {
            var urunId = $(this).data('id');

            $.ajax({
                url: '/dashboard/urun-duzenle/' + urunId,
                method: 'GET',
                success: function(data) {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata',
                            text: data.error,
                            timer: 3000,
                            showConfirmButton: false
                        });
                    } else {
                        var url = "{{ route('proje.edit', ':id') }}";
                        url = url.replace(':id', data.proje_id);
                        window.location.href = url + '?urun_id=' + urunId;
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Bir hata oluştu. Lütfen tekrar deneyin.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });
</script>

<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap Datepicker Türkçe Dil Ayarı -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.tr.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'dd/mm/yyyy', // Gün/Ay/Yıl formatı
            language: 'tr', // Türkçe dil desteği
            autoclose: true, // Tarih seçildiğinde otomatik kapanması
            todayHighlight: true // Bugün tarihini vurgulama
        });
    });
</script>


@endsection