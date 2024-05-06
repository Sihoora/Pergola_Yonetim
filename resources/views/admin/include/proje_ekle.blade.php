@extends('admin.tema')

@section('css')

@endsection


@section('master')
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <span class="h4 m-0">Proje Ekle</span>
              <div>
                <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="document.getElementById('projeForm').submit();">Yeni Proje Oluştur</button>
                <button type="button" class="btn btn-danger">Projeyi Kaydet</button>
              </div>
            </div>
          </div>
          <div class="card-body pad table-responsive">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">
                  <div class="card-header"></div>
                  <div class="card-body">
                    <form role="form" id="projeForm" action="{{ route('proje.store') }}" method="post">
                      @csrf
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Proje Kodu</label>
                            <input type="number" name="proje_kodu" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Proje Adı</label>
                            <input type="text" name="proje_adi" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Müşteri</label>
                            <input type="text" name="musteri" class="form-control" placeholder="Enter ...">
                          </div>
                        </div>
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Teslim Tarihi:</label>
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="text" name="teslim_tarihi" class="form-control datetimepicker-input" data-target="#reservationdate"/>
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

            <div class="row mb-3">
              <div class="col-md-12 d-flex justify-content-left">
                <button type="button" class="btn btn-primary mr-2">
                  <i class="fa fa-plus"></i> Ürün Ekle
                </button>
                <button type="button" class="btn btn-secondary">
                  <i class="fa fa-cog"></i> Üretim Emirleri Oluştur
                </button>
              </div>
            </div>

            <div class="row">
              <div class="col-md-8">
                <div class="card card-primary card-outline">
                  <div class="card-header"></div>
                  <div class="card-body">
                    <form id="formDetay1" method="POST" action="#">
                      @csrf
                      <div class="row">
                        <div class="col-sm-3">
                          <div class="form-group">
                            <label>Ürün Grubu</label>
                            <select class="form-control" name="urun_grubu" onchange="getDynamicInputs(this.value)">
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

                     
                       
                    </form>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="card card-primary card-outline">
                  <div class="card-header"></div>
                  <div class="card-body">
                    <form id="formDetay2" method="POST" action="#">
                      @csrf
                     
                    </form>
                  </div>
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
<script src="{{ asset('admin') }}/dist/js/proje_ekle_js/input_fields.js"></script>
@endsection
