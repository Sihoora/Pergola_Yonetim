@extends('admin.tema')

@section('master')

<style>
  .welcome-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  .welcome-heading {
    font-size: 48px;
    font-weight: bold;
    color: #333;
  }

  .welcome-subheading {
    font-size: 20px;
    color: #666;
    margin-top: 10px;
  }

  .stat-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    margin-bottom: 15px;
    background-color: #f9f9f9;
  }

  .stat-card h5 {
    margin-bottom: 10px;
    font-size: 20px;
    font-weight: bold;
  }

  .stat-card p {
    font-size: 24px;
    font-weight: bold;
    color: #333;
  }
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

@endsection
