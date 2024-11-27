@extends('admin.tema')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">

<style>
    .dataTables_wrapper .dataTables_processing .text-center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80%;
}

.btn.btn-warning.btn-sm {
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: bold;
}


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

    .btn-primary {
        background-color: #195697;
        border-color: #007bff;
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
                                    <th class="text-left">Proje Kodu</th>
                                    <th>Proje Adı</th>
                                    <th>Müşteri</th>
                                    <th>Teslim Tarihi</th>
                                    <th>Durum</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projeler as $proje)
                                    <tr>
                                        <td class="text-left">{{ $proje->proje_kodu }}</td>
                                        <td>{{ $proje->proje_adi }}</td>
                                        <td>{{ $proje->musteri }}</td>
                                        <td>{{ \Carbon\Carbon::parse($proje->teslim_tarihi)->format('d/m/Y') }}
                                        </td>
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
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Seçiniz...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('proje.detay', $proje->id) }}">Proje Detay</a>
                                                    <a class="dropdown-item" href="{{ route('proje.edit', $proje->id) }}">Düzenle</a>
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
@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(document).ready(function() {
        $('#projectTable').DataTable();

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
