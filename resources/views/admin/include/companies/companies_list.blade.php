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
</style>
@endsection

@section('master')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Firma Listesi</h3>
                    </div>
                    <div class="card-body">
                        <table id="companyTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-left">Firma Adı</th>
                                    <th>Telefon</th>
                                    <th>E-posta</th>
                                    <th>Vergi Kimlik Numarası</th>
                                    <th>Şehir</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($companies as $company)
                                    <tr>
                                        <td class="text-left">{{ $company->company_name }}</td>
                                        <td>{{ $company->phone }}</td>
                                        <td>{{ $company->email }}</td>
                                        <td>{{ $company->tax_id }}</td>
                                        <td>{{ $company->city }}</td>
                                        <td class="text-center align-middle">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Seçiniz...
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{ route('company.details', $company->id) }}">Firma Detay</a>
                                                    <a class="dropdown-item" href="{{ route('company-edit', $company->id) }}">Düzenle</a>
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
    $('#companyTable').DataTable();
});
</script>
@endsection
