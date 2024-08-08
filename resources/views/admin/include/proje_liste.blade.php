@extends('admin.tema')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<style>
    .bg-gray {
        background-color: #d3d3d3;
    }
    .bg-green {
        background-color: #28a745;
    }
    .bg-yellow {
        background-color: #ffc107;
    }
    .bg-red {
        background-color: #dc3545;
    }
    .text-white {
        color: #ffffff !important;
    }
    .text-dark {
        color: #000000 !important;
    }
    </style>
    
@endsection

@section('master')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Proje Listesi</h3>
                    </div>
                    <div class="card-body">
                        <table id="projectTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Proje Kodu</th>
                                    <th>Proje Adı</th>
                                    <th>Müşteri</th>
                                    <th>Teslim Tarihi</th>
                                    <th>Durum</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projeler as $proje)
                                    <tr>
                                        <td>{{ $proje->proje_kodu }}</td>
                                        <td>{{ $proje->proje_adi }}</td>
                                        <td>{{ $proje->musteri }}</td>
                                        <td>{{ $proje->teslim_tarihi }}</td>
                                        <td>
                                            @php
                                                $class = '';
                                                $text = '';
    
                                                switch ($proje->durum) {
                                                    case 'ÜRETİMİ DEVAM EDEN PROJELER':
                                                        $class = 'bg-gray';
                                                        $text = 'text-white';
                                                        break;
                                                    case 'SEVK İÇİN HAZIR PROJELER':
                                                        $class = 'bg-green';
                                                        $text = 'text-white';
                                                        break;
                                                    case 'SEVK EDİLMİŞ PROJELER':
                                                        $class = 'bg-yellow';
                                                        $text = 'text-dark';
                                                        break;
                                                    case 'BEKLETİLEN PROJELER':
                                                        $class = 'bg-red';
                                                        $text = 'text-white';
                                                        break;
                                                }
                                            @endphp
                                            <span class="badge {{ $class }} {{ $text }}">{{ $proje->durum }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('proje.edit', $proje->id) }}">Edit</a>
                                                    <a class="dropdown-item" href="{{ route('proje.delete', $proje->id) }}">Delete</a>
                                                    <a class="dropdown-item getUrunler" data-id="{{ $proje->id }}" href="#">Ürün Getir</a>
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

            <div class="col-md-12 mt-4">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Ürün Listesi</h3>
                    </div>
                    <div class="card-body">
                        <table id="urunTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Ürün Adı</th>
                                    <th>RAL Kodu</th>
                                    <th>Kumaş Cinsi</th>
                                    <th>Kumaş Profil RAL</th>
                                    <th>LED Model</th>
                                    <th>Motor Model</th>
                                    <th>Kumanda</th>
                                    <th>Flans</th>
                                    <th>Arka Çelik</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- AJAX ile doldurulacak -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#projectTable').DataTable();

        $(document).on('click', '.getUrunler', function() {
            var projeId = $(this).data('id');

            $.ajax({
                url: '/proje/' + projeId + '/urunler',
                method: 'GET',
                success: function(data) {
                    var urunTable = $('#urunTable').DataTable();
                    urunTable.clear().draw();

                    data.forEach(function(urun) {
                        urunTable.row.add([
                            urun.urun_name,
                            urun.ral_kodu,
                            urun.kumas_cinsi,
                            urun.kumas_profil_ral,
                            urun.led_model,
                            urun.motor_model,
                            urun.kumanda,
                            urun.flans,
                            urun.arka_celik,
                            '<a href="#" class="btn btn-warning btn-sm editProduct" data-id="' + urun.id + '">Edit</a>'
                        ]).draw(false);
                    });
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Hata',
                        text: 'Ürünleri getirirken bir hata oluştu. Lütfen tekrar deneyin.',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            });
        });

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
</script>
@endsection
