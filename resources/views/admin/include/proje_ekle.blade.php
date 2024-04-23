@extends('admin.tema')
@section('css')

<style>
  .form-group.row {
    display: flex; /* Flexbox kullanarak düzenleme */
    align-items: center; /* İçerikleri dikey olarak ortalar */
    margin-bottom: 10px; /* Daha az boşluk için */
    gap: 100px; /* Etiket ve input arasında boşluk */
  }

  .form-group.row > label {
    flex-basis: 20%; /* Etiket genişliği */
    flex-shrink: 0; /* Ekran daraltıldığında etiketin daralmamasını sağlar */
    margin-bottom: 0; /* Alt boşluğu kaldırır */
    white-space: nowrap; /* Etiketin tek satırda kalmasını sağlar */
    overflow: hidden; /* Uzun metinleri keser */
    text-overflow: ellipsis; /* Kesilen metinlerin sonuna üç nokta koyar */
  }

  .form-group.row > div {
    flex-grow: 1; /* Kalan alanı input bölümüne verir */
  }

  .form-control {
    width: 100%; /* Input'u div'in genişliğine sığdırır */
  }

  .dimensions-input-group {
    display: flex;
    gap: 5px; /* Inputlar arasında boşluk */
    flex-wrap: wrap; /* Gerekirse yeni satıra geçer */
  }

  .dimensions-input-group input {
    flex-grow: 1; /* Inputları esnek yapar */
    padding: 0.375rem 0.75rem; /* Bootstrap varsayılanı */
    font-size: 1rem; /* Bootstrap varsayılanı */
    line-height: 1.5; /* Bootstrap varsayılanı */
    color: #495057; /* Bootstrap varsayılanı */
    background-color: #fff; /* Bootstrap varsayılanı */
    background-clip: padding-box; /* Bootstrap varsayılanı */
    border: 1px solid #ced4da; /* Bootstrap varsayılanı */
    border-radius: 0.25rem; /* Bootstrap varsayılanı */
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out; /* Bootstrap varsayılanı */
  }
</style>



@endsection



@section('master')
<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center"> <!-- İçerikleri sağa ve sola yaslamak için d-flex ve justify-content-between sınıfları eklendi -->
              <span class="h4 m-0">Proje Ekle</span> <!-- Başlığı butonlarla aynı satırda sola yaslamak için düzenleme yapıldı ve h1 yerine span kullanıldı, stil için h4 m-0 eklendi -->
              <div>
                <button type="button" class="btn btn-success" style="margin-right: 20px;" onclick="document.getElementById('projeForm').submit();">Yeni Proje Oluştur</button>
                <button type="button" class="btn btn-danger">Projeyi Kaydet</button>
              </div>
            </div>
          </div>
          <div class="card-body pad table-responsive">
            <div class="row">
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    
                  </div>
                  <!-- form start -->
                  <div class="card-body">
                  <form role="form" id="projeForm" action="{{ route('proje.store') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-sm-2">
                      <!-- text input -->
                      <div class="form-group">
                        <label>Proje Kodu</label>
                        <input type="number"  name="proje_kodu" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-3" style="margin-left:30px;">
                    <div class="form-group">
                        <label>Proje Adı</label>
                        <input type="text" name="proje_adi" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-2" style="margin-left:30px;">
                    <div class="form-group">
                        <label>Müşteri</label>
                        <input type="text" name="musteri" class="form-control" placeholder="Enter ...">
                      </div>
                    </div>
                    <div class="col-sm-2" style="margin-left:30px;">
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

                  <div class="row">
                    <div class="col-sm-3">
                    <div class="form-group">
                    <label>Ürün Ailesi</label>
                        <select class="form-control" name="urun_ailesi" style="width:250px;">
                          <option>Retractable Pergolas</option>
                          <option>Bioclimatic Pergolas</option>
                          <option>Sun Shading</option>  
                        </select>
                    </div>
                    </div>
                    <div class="col-sm-3">
                    <div class="form-group">
                    <label>Ürün Grubu</label>
                        <select class="form-control" name="urun_grubu" style="width:250px;">
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
                    <div class="col-sm-3">
                    <div class="form-group">
                    <label>Ürün Alt Grubu</label>
                        <select class="form-control" name="urun_alt_grubu" style="width:250px;">
                          <option>deneme1</option>
                          <option>deneme2</option>
                        </select>
                      </div>  
                    </div>
                    <div class="col-sm-3">
                    <div class="form-group">
                    <label>Üretim Şablonu</label>
                        <select class="form-control" name="uretim_sablonu" style="width:250px;">
                          <option>Pergola Üretim Şablonu</option>
                          <option>Bioclimatic Üretim Şablonu</option>
                          <option>iZipscreen Üretim Şablonu</option>
                        </select>
                      </div>
                    </div>
                    


                  </div>
                    <!-- /.card-body -->
                  </form>
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
    <div class="row mb-3">
    <div class="col-md-12 d-flex justify-content-left" style="padding-top: 30px">
      <!-- Reçete Oluştur Butonu -->
      <button type="button" class="btn btn-primary mr-2">
        <i class="fa fa-plus"></i> Reçete Oluştur
      </button>
      <!-- Üretim Emirleri Oluştur Butonu -->
      <button type="button" class="btn btn-secondary">
        <i class="fa fa-cog"></i> Üretim Emirleri Oluştur
      </button>
    </div>
</div>
                    
            <!-- From_detay 1 card -->
<div class="row" style="padding-top: 0px;">
  <div class="col-md-6">
    <div class="card card-primary card-outline">
      <div class="card-header">
      </div>
      <div class="card-body">
        <form id="formDetay1" method="POST" action="#">
          @csrf
          <!-- Örnek bir input satırı -->
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">Sistem Adı</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">En</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">Açılım</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">Ön Yükseklik</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">Arka Yükseklik</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group row">
            <label for="input1" class="col-sm-4 col-form-label">Motor Tipi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input1" name="input1">
            </div>
          </div>
          <div class="form-group">
  <label for="dimensions" class="dimensions-label">Arka Direk (En/Boy/Kalınlık):</label>
  <div class="dimensions-input-group">
    <input type="text" id="width" name="width" placeholder="En">
    <input type="text" id="height" name="height" placeholder="Boy">
    <input type="text" id="thickness" name="thickness" placeholder="Kalınlık">
  </div>
</div>
<div class="form-group">
  <label for="dimensions" class="dimensions-label">Karkas (En/Yükseklik/EK):</label>
  <div class="dimensions-input-group">
    <input type="text" id="width" name="width" placeholder="En">
    <input type="text" id="height" name="height" placeholder="Boy">
    <input type="text" id="thickness" name="thickness" placeholder="Kalınlık">
  </div>
</div>
          <!-- Diğer input satırları benzer şekilde eklenecek... -->
        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>




  <div class="col-md-6">
    <!-- Form_detay 2 card -->
    <div class="card card-primary card-outline">
      <div class="card-header">
      </div>
      <div class="card-body">
        <form id="formDetay2" method="POST" action="#">
          @csrf
          <!-- Örnek bir input satırı -->
          <div class="form-group row">
            <label for="input2" class="col-sm-4 col-form-label">Kumaş Cinsi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input2" name="input2">
            </div>
          </div>
          <div class="form-group row">
            <label for="input2" class="col-sm-4 col-form-label">Sistem Rengi</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input2" name="input2">
            </div>
          </div>
          <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Çıta Rengi</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="beyaz">Beyaz</option>
              <option value="kahverengi">Kahverengi</option>
              <option value="siyah">Siyah</option>
            </select>
          </div>
        </div>
          <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Plastik Rengi</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="beyaz">Beyaz</option>
              <option value="kahverengi">Kahverengi</option>
              <option value="siyah">Siyah</option>
            </select>
          </div>
        </div>
         <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Pabuç Tipi</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="beyaz">Beyaz</option>
              <option value="kahverengi">Kahverengi</option>
              <option value="siyah">Siyah</option>
            </select>
          </div>
        </div>
          <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Led Dizilim</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="beyaz">Beyaz</option>
              <option value="kahverengi">Kahverengi</option>
              <option value="siyah">Siyah</option>
            </select>
          </div>
        </div>
          <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Dizilim Tercihi</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="beyaz">Beyaz</option>
              <option value="kahverengi">Kahverengi</option>
              <option value="siyah">Siyah</option>
            </select>
          </div>
        </div>
          <!-- Çıta Rengi select option -->
        <div class="form-group row">
          <label for="citaRengi" class="col-sm-4 col-form-label">Palet Yapılacak Mı</label>
          <div class="col-sm-8">
            <select class="form-control" id="citaRengi" name="citaRengi">
              <option value="">Seçiniz...</option>
              <option value="evet">Evet</option>
              <option value="hayır">Hayır</option>
             
            </select>
          </div>
        </div>
          <div class="form-group row">
            <label for="input2" class="col-sm-4 col-form-label">Sandık Uzunluk</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input2" name="input2">
            </div>
          </div>
          
          <div class="form-group row">
            <label for="input2" class="col-sm-4 col-form-label">Sandık Açıklama</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="input2" name="input2">
            </div>
          </div>
          <!-- Diğer input satırları benzer şekilde eklenecek... -->
        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
<!-- /.row -->



          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
@endsection
