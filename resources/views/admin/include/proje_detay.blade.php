@extends('admin.tema')

@section('css')
<style>
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
        background-color: #e9ecef;
        border-radius: 5px;
    }

    .taskbar li {
        position: relative;
        flex: 1;
        text-align: center;
        padding: 10px;
        background-color: #f8f9fa;
        margin-right: 5px;
        border-right: 1px solid #dee2e6;
        transition: background-color 0.3s ease;
    }

    .taskbar li.active {
        background-color: #28a745;
        color: white;
    }

    .taskbar li:after {
        content: '';
        position: absolute;
        right: -15px;
        top: 0;
        border-top: 20px solid transparent;
        border-bottom: 20px solid transparent;
        border-left: 15px solid #f8f9fa;
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
    }

    .taskbar li.active span {
        background-color: #155724;
    }

    .product-card {
        border: 1px solid #ddd;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .product-card:hover {
        transform: scale(1.02);
    }

    .product-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eee;
        padding-bottom: 10px;
        margin-bottom: 15px;
    }

    .product-title {
        font-size: 1.25rem;
        font-weight: bold;
        color: #333;
    }

    .product-info {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 10px;
    }

    .product-info-item {
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
<div class="content">
    <div class="container-fluid">
        <!-- Süreç Task Bar -->
        @if(isset($proje))
        <div class="row mb-3">
            <div class="col-12">
                <ul class="taskbar">
                    @php
                    $sira = [
                        'Yeni Proje',
                        'Proje Onaylandı',
                        'Teknik Çizimler Yapıldı',
                        'Üretime Gönderildi',
                        'Sevk İçin Hazır',
                        'Sevk Edildi'
                    ];
                    $sabit_notlar = [
                        'Yeni Proje' => ['Proje bilgileri girildi.', 'Ürün bilgileri girildi.', 'Genel dosyalar yüklendi.'],
                        'Proje Onaylandı' => ['Proje onayı alındı.', 'Deneme Sabit Not'],
                        'Teknik Çizimler Yapıldı' => ['Teknik çizimler tamamlandı.'],
                        'Üretime Gönderildi' => ['Üretim süreci başlatıldı.'],
                        'Sevk İçin Hazır' => ['Ürünler sevk için hazır.'],
                        'Sevk Edildi' => ['Ürünler sevk edildi.', 'Proje tamamlandı.']
                    ];
                    @endphp
                    @foreach($sira as $index => $step)
                    <li class="{{ $proje->surec == $step ? 'active' : '' }}">
                        <span>{{ $index + 1 }}</span>
                        <p>{{ $step }}</p>
                    </li>
                    @endforeach
                </ul>
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

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header"></div>
                    <div class="card-body">
                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Proje Detayı</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Dosyalar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Üretim Emirleri</a>
                            </li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <!-- Proje Detayı -->
                                <div class="card-body pad table-responsive">
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
                                                                    <input type="number" name="proje_kodu" class="form-control" value="{{ isset($proje) ? $proje->proje_kodu : '' }}" placeholder="Enter ..." disabled>
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
                                                                    <label>Teslim Tarihi:</label>
                                                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                                        <input type="text" name="teslim_tarihi" class="form-control datetimepicker-input" value="{{ isset($proje) ? $proje->teslim_tarihi : '' }}" data-target="#reservationdate" disabled />
                                                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Üretim Emri Oluştur -->
                                    <div class="row mb-3">
                                        <div class="col-12" style="margin-bottom: 15px;">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">Üretim Emri Oluştur</button>
                                            <button type="button" class="btn btn-success" onclick="window.location.href='{{ route('proje.pdf', $proje->id) }}'">PDF Oluştur</button>
                                            <button type="button" class="btn btn-info" onclick="window.print();">Yazdır</button>
                                        </div>

                                    </div>

                                <div class="row">
                                    @foreach($proje->urunler as $urun)
                                    <div class="col-md-12">
                                        <div class="product-card border-dark mb-3">
                                            <div class="product-header">
                                                <h5 class="product-title">{{ $urun->urun_name }}</h5>
                                            </div>
                                            <div class="product-info">
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
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                           
                <!-- Dosya Listesi -->
<div class="row" style="margin-top: 30px;">
<div class="col-md-12">
    <div class="card card-primary card-outline" style="border-top: 3px solid orange;">
        <div class="card-header">
            <span class="h5 m-0">Genel Dosyalar</span>
        </div>  
        <div class="card-body">
            @if(isset($proje) && $proje->files->count() > 0)
            <div class="row">
                @foreach($proje->files->where('file_type', 'general') as $file)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-header">
                            <h5 class="product-title">{{ $file->file_name }}</h5>
                        </div>
                        <div class="product-info d-flex justify-content-around align-items-center">
                            <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary btn-block">İndir</a>
                            <button type="button" class="btn btn-info btn-block" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
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
            <span class="h5 m-0">Yüklenen Teknik Çizim Dosyaları</span>
        </div>
        <div class="card-body">
            @if(isset($proje) && $proje->files->count() > 0)
            <div class="row">
                @foreach($proje->files->where('file_type', 'technical_drawing') as $file)
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-header">
                            <h5 class="product-title">{{ $file->file_name }}</h5>
                        </div>
                        <div class="product-info d-flex justify-content-around align-items-center">
                            <a href="{{ route('file.download', $file->id) }}" class="btn btn-primary btn-block">İndir</a>
                            <button type="button" class="btn btn-info btn-block" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
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

<div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
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
                            <span class="handle">
                                <i class="fas fa-ellipsis-v"></i>
                                <i class="fas fa-ellipsis-v"></i>
                            </span>
                            <div class="icheck-primary d-inline ml-2">
                                <input type="checkbox" class="toggle-checkbox" data-note-id="{{ $note->id }}" id="todoCheck{{ $note->id }}" @if($note->checked == 1) checked @endif>
                                <label for="todoCheck{{ $note->id }}"></label>
                            </div>
                            <span class="text">{{ $note->not }}</span>
                            <div class="tools">
                                <i class="fas fa-edit"></i>
                                <i class="fas fa-trash-o"></i>
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

<!-- Dosya Modal -->
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

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
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
                text: 'Not ekleme işlemini tamamladınız..',
                icon: 'success'
            });
         @endif  

        </script>   
@endsection
                