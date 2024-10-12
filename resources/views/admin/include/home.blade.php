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
  <h1 class="welcome-heading">Hoşgeldiniz!</h1>
  <p class="welcome-subheading">Pergola Yönetim Sistemine hoşgeldiniz.</p>

  

<div class="row mt-5">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fa fa-book"></i>
          Kerim Kur'an
        </h3>
      </div>
      <div class="card-body">
        <blockquote>
          <p>O halde her fırsatta kararlılıkla yeni şeyler yapmaya giriş.</p>
          <small>İnşirah Suresi</small>
        </blockquote>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-user-alt"></i>
          Sözler
        </h3>
      </div>
      <div class="card-body clearfix">
        <blockquote class="quote-secondary">
          <p>Güç zihninizdedir, dışarıda bir yerlerde değil. Bunu anladığınızda dayanıklılık gücünüzü de bulacaksınız.</p>
          <small>Marcus Aurelius</small>
        </blockquote>
      </div>
    </div>
  </div>
</div>


  <div class="row mt-5">
    <div class="col-md-3">
      <div class="stat-card">
        <h5>Üretimi Devam Eden Projeler</h5>
        <p>{{ $devamEdenProjeSayisi }} / {{ $toplamProjeSayisi }}</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h5>Bekletilen Projeler</h5>
        <p>{{ $bekletilenProjeSayisi }} / {{ $toplamProjeSayisi }}</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h5>Sevk İçin Hazır Projeler</h5>
        <p>{{ $sevkeHazirProjeSayisi }} / {{ $toplamProjeSayisi }}</p>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card">
        <h5>Sevk Edilmiş Projeler</h5>
        <p>{{ $sevkEdilmisProjeSayisi }} / {{ $toplamProjeSayisi }}</p>
      </div>
    </div>
  </div>
</div>

<div class="row mt-5">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-list"></i>
          İnbox
        </h3>
      </div>
      <div class="card-body">
        @if(auth()->user()->unreadNotifications->count())
        <ul>
            @foreach(auth()->user()->unreadNotifications as $notification)
                <li>
                    <a href="{{ $notification->data['url'] }}">
                        {{ $notification->data['message'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p>Henüz okunmamış bildiriminiz yok.</p>
    @endif
    
      </div>
    </div>
  </div>
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
