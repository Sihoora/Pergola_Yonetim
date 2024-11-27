
  @section('css')

  @endsection
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="https://i.imgur.com/pK5pgii.png" alt="Pergola logo" href="{{ route('dashboard') }}"
           style="width: 450px; height: auto; max-width: 100%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.imgur.com/4TSHF9j.png" style="width: 50px; height: auto; max-width: 100%;" alt="User Image">
        </div>
        <div class="info d-flex align-items-center">
          <a class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        
      <li class="nav-item has-treeview">
          <a href="#" class="nav-link active" style="padding-left: 15px;">
            <i class="nav-icon bi bi-buildings" style="padding-left: 0px;"></i>
            <p>
              İmalat Menüsü----
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('proje_ekle') }}" class="nav-link ">
                <i class="fa fa-plus-circle nav-icon"></i>
                <p>Yeni Proje/Sipariş Oluştur</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('proje-liste')}}" class="nav-link">
                <i class="fa fa-list-ul nav-icon"></i>
                <p>Proje Yönetim</p>
              </a>
            </li>
          </ul>
        </li>

        <div class="user-menu mt-auto">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-box-seam"></i>
              <p style="margin-left: 12px;">
                 Sipariş Menüsü
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                  <a href="{{route('order-create')}}" class="nav-link">
                    <i class="fa fa-plus-circle nav-icon"></i>
                    <p>Satın Alma</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('order.list')}}" class="nav-link">
                    <i class="fa fa-list-ul nav-icon"></i>
                    <p>Sipariş Yönetim</p>
                  </a>
                </li>
                </ul>
            </ul>
          </li>
        </div>


        <div class="user-menu mt-auto">
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link active">
                <i class="nav-icon bi bi-building-add"></i>
                <p style="margin-left: 12px;">
                   Firma Menüsü
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview" >
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                      <li class="nav-item">
                    <a href="{{route('company-create')}}" class="nav-link">
                      <i class="fa fa-plus-circle nav-icon"></i>
                      <p>Firma Oluştur</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('company.list')}}" class="nav-link">
                      <i class="fa fa-list-ul nav-icon"></i>
                      <p>Firma Yönetim</p>
                    </a>
                  </li>
                  </ul>
              </ul>
            </li>
          </div>

          <div class="user-menu mt-auto">
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link active">
                  <i class="nav-icon bi bi-chat-square-quote"></i>
                  <p style="margin-left: 12px;">
                     İletişim
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" >
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                      <a href="{{route('chat.index')}}" class="nav-link">
                        <i class="bi bi-chat-square-dots-fill nav-icon"></i>
                        <p>Sohbet Odası</p>
                      </a>
                    </li>
                    </ul>
                </ul>
              </li>
            </div>

        <div class="user-menu mt-auto">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon bi bi-person-gear"></i>
              <p style="margin-left: 12px;">
                 Profil Ayarları
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" >
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>Profilim</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                      <i class="fa fa-list-ul nav-icon"></i>
                      <p>Yönetim Paneli</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                      @csrf
                      <a href="{{ route('logout') }}" class="nav-link logout" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Çıkış Yap</p>
                      </a>
                    </form>
                  </li>
                </ul>
            </ul>
          </li>
        </div>


      </ul>
    </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    @section('js')
    
    <script src="{{ asset('admin') }}/dist/js/menu.js"></script>
    
    @endsection