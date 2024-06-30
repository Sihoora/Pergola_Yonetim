@extends('admin.tema')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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

        $('.getUrunler').on('click', function() {
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
                            '<a href="#" class="btn btn-warning btn-sm editProduct" data-id="' + urun.id + '">Edit</a>'
                                
                        ]).draw(false);
                    });

                    $('.editProduct').on('click', function() {
                        var urunId = $(this).data('id');
                        editProduct(urunId);
                    });
                }
            });
        });
    });

    function editProduct(urunId) {
        $.ajax({
            url: '/dashboard/urun-duzenle/' + urunId,
            method: 'GET',
            success: function(data) {
                var url = "{{ route('proje.edit', ':id') }}";
                url = url.replace(':id', data.proje_id);
                window.location.href = url + '?urun_id=' + urunId;
            }
        });
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
    
</script>
@endsection
