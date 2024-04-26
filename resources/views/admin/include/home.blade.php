@extends('admin.tema')

@section('master')

<style>
  /* Styles for the welcome message container */
  .welcome-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  /* Styles for the main welcome heading */
  .welcome-heading {
    font-size: 48px;
    font-weight: bold;
    color: #333;
  }

  /* Styles for the subheading */
  .welcome-subheading {
    font-size: 20px;
    color: #666;
    margin-top: 10px;
  }
</style>

<div class="welcome-container">
  <h1 class="welcome-heading">Hoşgeldiniz!</h1>
  <p class="welcome-subheading">Pergola Yönetim Sistemine hoşgeldiniz.</p>

          <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Primary Block Quotes
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <blockquote>
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                </blockquote>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-text-width"></i>
                  Secondary Block Quotes
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body clearfix">
                <blockquote class="quote-secondary">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                  <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                </blockquote>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

</div>

@endsection
