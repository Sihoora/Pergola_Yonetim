@extends('admin.tema')

@section('css')
<!-- Include CSS for file input -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    
    <style>
        .taskbar {
            list-style: none;
            display: flex;
            justify-content: space-between;
            padding: 0;
            margin: 0;
        }
        .taskbar li {
            flex: 1;
            position: relative;
            padding: 10px;
            text-align: center;
            background-color: #f0f0f0;
            border-right: 1px solid #ccc;
        }
        .taskbar li:last-child {
            border-right: none;
        }
        .taskbar li.active {
            background-color: #28a745;
            color: white;
        }
        .taskbar li span {
            display: block;
            font-size: 20px;
            font-weight: bold;
        }
        .taskbar li p {
            margin: 0;
        }
        </style>
        

@endsection

@section('master')
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
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
                                                <div class="form-group">
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
                                            <div class="row">
                                                <div class="col-sm-3">
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
                                            <div id="dynamicInputs"></div>
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <button type="submit" class="btn btn-success" onclick="submitUrunForm()">Ürünü Kaydet</button>
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
                                            <div class="form-group">
                                                <label>Dosya Yükle</label>
                                                <div class="file-loading">
                                                    <input id="file-upload" type="file" name="file" class="file" data-show-preview="false">
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Dosyayı Yükle</button>
                                        </form>

                                        <h5 class="mt-4">Yüklenen Dosyalar</h5>
                                        <ul class="list-group">
                                            @if(isset($proje) && $proje->files->count() > 0)
                                                @foreach($proje->files as $file)
                                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $file->file_name }}
                                                        <div>
                                                            <a href="{{ route('file.download', $file->id) }}" class="btn btn-sm btn-primary">İndir</a>
                                                            <form action="{{ route('file.delete', $file->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="list-group-item">Yüklenen dosya yok.</li>
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





</script>
@endsection
