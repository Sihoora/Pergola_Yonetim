@extends('admin.tema')

@section('css')
<!-- Include CSS for file input -->
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
    </style>
        

@endsection

@section('master')
<!-- Main content -->
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
                                                      'Üretime Gönderildi',
                                                      'Sevk İçin Hazır'
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
        

        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h4 m-0">{{ isset($proje) ? 'Proje Düzenle' : 'Proje Ekle' }}</span>
                            <div>
                                <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="document.getElementById('projeForm').submit();">{{ isset($proje) ? 'Projeyi Güncelle' : 'Yeni Proje Oluştur' }}</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pad table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-primary">
                                    <div class="card-header"></div>
                                    <div class="card-body">

               

                                        <form role="form" id="projeForm" action="{{ isset($proje) ? route('proje.update', $proje->id) : route('proje.store') }}" method="post">                                            @csrf
                                            @if(isset($proje))
                                                @method('PUT')
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Proje Kodu</label>
                                                        <input type="number" name="proje_kodu" class="form-control" value="{{ isset($proje) ? $proje->proje_kodu : '' }}" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Proje Adı</label>
                                                        <input type="text" name="proje_adi" class="form-control" value="{{ isset($proje) ? $proje->proje_adi : '' }}" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Müşteri</label>
                                                        <input type="text" name="musteri" class="form-control" value="{{ isset($proje) ? $proje->musteri : '' }}" placeholder="Enter ...">
                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Teslim Tarihi:</label>
                                                        <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                                            <input type="text" name="teslim_tarihi" class="form-control datetimepicker-input" value="{{ isset($proje) ? $proje->teslim_tarihi : '' }}" data-target="#reservationdate"/>
                                                            <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                               
                                            @if(isset($proje))
                                        
                                            <div class="col-sm-3">
                                                <div class="form-group" style="margin-left: -15px;">
                                                    <label>Proje Durumu Tanımlama</label>
                                                    <select name="durum" class="form-control">
                                                        <option value="ÜRETİMİ DEVAM EDEN PROJELER" {{ isset($proje) && $proje->durum == 'ÜRETİMİ DEVAM EDEN PROJELER' ? 'selected' : '' }}>ÜRETİMİ DEVAM EDEN PROJELER</option>
                                                        <option value="SEVK İÇİN HAZIR PROJELER" {{ isset($proje) && $proje->durum == 'SEVK İÇİN HAZIR PROJELER' ? 'selected' : '' }}>SEVK İÇİN HAZIR PROJELER</option>
                                                        <option value="SEVK EDİLMİŞ PROJELER" {{ isset($proje) && $proje->durum == 'SEVK EDİLMİŞ PROJELER' ? 'selected' : '' }}>SEVK EDİLMİŞ PROJELER</option>
                                                        <option value="BEKLETİLEN PROJELER" {{ isset($proje) && $proje->durum == 'BEKLETİLEN PROJELER' ? 'selected' : '' }}>BEKLETİLEN PROJELER</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @endif


                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product addition form -->
                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-left">
                                <button type="button" class="btn btn-primary mr-2" onclick="addProductInput()">
                                    <i class="fa fa-plus"></i> Ürün Ekle
                                </button>
                                @if(isset($proje))
                                <a href="{{ route('proje.ilerletSurec', $proje->id) }}" class="btn btn-success">Sonraki Aşama</a>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

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
                                                    <div id="dynamicInputs" style="padding: 5px; display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 8px;"></div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-end">
                                                <div>
                                                    <button type="submit" class="btn btn-success" style="margin-right: 20px;" onclick="submitUrunForm()">Ürünü Kaydet</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- File upload form -->
                            <div class="col-md-4">
                                <div class="card card-primary card-outline">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <form id="formDetay2" method="POST" action="{{ route('file.upload') }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="proje_id" value="{{ isset($proje) ? $proje->id : '' }}">
                                            <div class="form-group" style="text-align: center;">
                                                <label>Dosya Yükle</label>
                                                <div class="file-loading">
                                                    <input id="file-upload" type="file" name="file" class="file" data-show-preview="false">
                                                </div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                            </div>                                                
                                        </form>

                                        <div style="text-align: center;"><h5 class="mt-4">Yüklenen Dosyalar</h5></div>
                                        <ul class="list-group" style="gap: 8px;">
                                            @if(isset($proje) && $proje->files->count() > 0)
                                                @foreach($proje->files as $file)
                                                    <li class="list-group-item" style="text-align: center; border-radius: 10px;">
                                                        {{ $file->file_name }}
                                                        <div class="row justify-content-center" style="gap: 2px;">
                                                            <a href="{{ route('file.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                                                            <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                                            </form>
                                                            <button type="button" class="btn btn-sm btn-info" onclick="showFilePreview('{{ route('file.preview', $file->id) }}')">Görüntüle</button>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item" style="text-align: center;">Yüklenen dosya yok.</li>
                                            @endif
                                        </ul>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- End of File upload form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/js/fileinput.min.js"></script>
<script src="{{ asset('admin') }}/dist/js/proje_ekle_js/input_fields.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $("#file-upload").fileinput({
            theme: 'fa',
            allowedFileExtensions: ['xlsx', 'docx', 'txt', 'png', 'jpg', 'jpeg', 'dvg'],
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

    
    $(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var urunId = urlParams.get('urun_id');

    if (urunId) {
        $.ajax({
            url: '/dashboard/urun-duzenle/' + urunId,
            method: 'GET',
            success: function(data) {
                $('select[name="urun_name"]').val(data.urun_name).change();
                loadDynamicInputs(data.urun_name, data);
                $('#urun_id').val(data.id);  // Ürün ID'sini formda gizli inputa set et
            }
        });
    }

    $('select[name="urun_name"]').on('change', function() {
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


    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Başarılı',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Hata',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
    }); 


    
        // Datalist seçeneklerini dinamik olarak güncellemek için bir örnek
        document.addEventListener('DOMContentLoaded', function() {
        var options = ["Düz Krem", "Düz Beyaz", "Düz Gri"];
        var dataList = document.getElementById('kumasCinsiOptions');
        
        options.forEach(function(option) {
            var opt = document.createElement('option');
            opt.value = option;
            dataList.appendChild(opt);
        });
    });


    function showFilePreview(url) {
    $('#filePreviewIframe').attr('src', url);
    $('#filePreviewModal').modal('show');
}



</script>
@endsection
