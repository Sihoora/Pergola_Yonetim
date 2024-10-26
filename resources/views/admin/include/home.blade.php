@extends('admin.tema')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
@endsection

@section('master')

<style>
  .welcome-container {
    background-color: #fff;
    padding: 40px;
    border-radius: 15px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    text-align: center;
    margin-bottom: 40px;
  }

  .welcome-heading {
    font-size: 42px;
    font-weight: bold;
    color: #4A4A4A;
  }

  .welcome-subheading {
    font-size: 18px;
    color: #888;
    margin-top: 15px;
  }

  .stat-card {
    border: none;
    border-radius: 10px;
    padding: 20px;
    text-align: center;
    margin-bottom: 20px;
    background-color: #f3f4f6;
    transition: transform 0.3s ease;
  }

  .stat-card:hover {
    transform: translateY(-5px);
  }

  .stat-card h5 {
    margin-bottom: 10px;
    font-size: 18px;
    font-weight: 600;
    color: #555;
  }

  .stat-card p {
    font-size: 22px;
    font-weight: 700;
    color: #333;
  }

  /* Hover effect for table rows */
  table#projectTable tbody tr:hover {
    background-color: #f1f1f1;
  }

  /* Badge styling */
  .badge {
    padding: 10px;
    font-size: 14px;
    font-weight: 600;
    border-radius: 5px;
  }

  .badge.bg-gray { background-color: #d3d3d3; }
  .badge.bg-green { background-color: #28a745; }
  .badge.bg-yellow { background-color: #ffc107; }
  .badge.bg-red { background-color: #dc3545; }
</style>

<div class="welcome-container">
  <div style="border-bottom: 3px solid #eee; margin-bottom: 30px;">
  <h1 class="welcome-heading">HOŞGELDİNİZ!</h1>
  <p class="welcome-subheading">Pergola Yönetim Sistemine Hoşgeldin, {{ Auth::user()->name }}!</p>
  </div>
        <div class="row">
                <div class="col-md-6">
                                  <!-- Gelen Kutusu -->
                              <div class="card" style="">
                            <div class="card-header border-transparent">
                              <h5>Gelen Kutusu</h5>
                            </div>
                            <div class="card-body p-1">
                              <div class="table-responsive">
                                <table class="table m-0">
                                      @if(auth()->user()->unreadNotifications->count())
                                          <tbody>
                                        @foreach(auth()->user()->unreadNotifications as $notification)
                                              <tr>
                                                  <td style="width: 50px;">
                                                    <i class="fa fa-exclamation-circle" style="font-size:24px; color:red;"></i>
                                                  </td>
                                                  <td style="text-align: start;">
                                                        <a href="{{ $notification->data['url'] }}">
                                                          {{ $notification->data['title'] }}
                                                        </a>
                                                  </td>
                                              </tr>
                                        @endforeach
                                          </tbody>
                                        @else
                                              <p>Henüz okunmamış bildiriminiz yok.</p>
                                        @endif
                                  </table>
                              </div>
                                  </div>
                                    <div class="card-footer">
                                </div>
                      </div>  
                  </div>
                  <div class="col-md-6">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">
                            <i class="fa fa-book"></i>
                            
                          </h3>
                      </div>
                    <div class="card-body">
                        <blockquote style="border-bottom: 3px solid #eee;">
                          <p>O halde her fırsatta kararlılıkla yeni şeyler yapmaya giriş.</p>
                          <small>İnşirah Suresi</small>
                        </blockquote>
                        <blockquote class="quote-secondary" style="border-bottom: 3px solid #eee;">
                          <p>Güç zihninizdedir, dışarıda bir yerlerde değil. Bunu anladığınızda dayanıklılık gücünüzü de bulacaksınız.</p>
                           <small>Marcus Aurelius</small>
                        </blockquote>
                    </div>
                  </div>
        </div>

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $devamEdenProjeSayisi }}</h3>

                <p>Üretimi Devam Eden Proje</p>
              </div>
              <div class="icon">
                <i class="fa fa-cogs"></i>
              </div>
              <div class="small-box-footer"></div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $sevkeHazirProjeSayisi }}</h3>

                <p>Sevk İçin Hazır Proje</p>
              </div>
              <div class="icon">
                <i class="fa fa-cubes"></i>
              </div>
              <div class="small-box-footer"></div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $bekletilenProjeSayisi }}</h3>

                <p>Bekletilen Proje</p>
              </div>
              <div class="icon">
                <i class="fa fa-hourglass-half"></i>
              </div>
              <div class="small-box-footer"></div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $sevkEdilmisProjeSayisi }}</h3>

                <p>Sevk Edilmiş Proje</p>
              </div>
              <div class="icon">
                <i class="fa fa-check-square-o"></i>
              </div>
              <div class="small-box-footer"></div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

</div>


@endsection

@section('js')
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
  $(document).ready(function() {
      $('#projectTable').DataTable({
          "language": {
              "search": "Proje Ara:",
              "lengthMenu": "Her sayfada _MENU_ kayıt göster",
              "info": "_TOTAL_ projeden _START_ - _END_ arası gösteriliyor",
              "paginate": {
                  "previous": "Önceki",
                  "next": "Sonraki"
              }
          }
      });

  });
</script>
@endsection
