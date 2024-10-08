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
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fa fa-compass"></i>
            <p>
              İmalat Menüsü
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('proje_ekle') }}" class="nav-link ">
                <i class="fa fa-pencil-square-o nav-icon"></i>
                <p>Yeni Proje/Sipariş Oluştur</p>
              </a>
            </li>
            @can('view projects') 
            <li class="nav-item">
              <a href="{{route('proje-liste')}}" class="nav-link">
                <i class="fa fa-list-ul nav-icon"></i>
                <p>Proje Yönetim</p>
              </a>
            </li>
            @endcan
            <li class="nav-item">
            </li>
          </ul>
        </li>

        <div class="user-menu mt-auto">
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fa fa-cogs"></i>
              <p>
                 Profil Ayarları
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                    <a href="{{ route('profile.show') }}" class="nav-link">
                      <i class="nav-icon fas fa-user"></i>
                      <p>Profilim</p>
                    </a>
                  </li>
                  @can('access admin area')
                  <li class="nav-item">
                    <a href="{{route('users.index')}}" class="nav-link">
                      <i class="fa fa-list-ul nav-icon"></i>
                      <p>Yönetim Paneli</p>
                    </a>
                  </li>
                  @endcan
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