  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="https://i.imgur.com/pK5pgii.png" alt="AdminLTE Logo"
           style="width: 450px; height: auto; max-width: 100%;">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="https://i.imgur.com/4TSHF9j.png" style="width: 50px; height: auto; max-width: 100%;" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Emirhan Güzel</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                İmalat
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('proje_ekle') }}" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Yeni Proje Girişi</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>İmalat Projeleri</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>İstasyonlar</p>
                </a>
              </li>
            </ul>

          </li>






            <x-dropdown-link href="{{ route('profile.show') }}" class="text-gray-700 hover:bg-gray-300">
              {{ __('Profile') }}
            </x-dropdown-link>


            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-dropdown-link href="{{ route('api-tokens.index') }}" class="text-gray-700 hover:bg-gray-10">
                    {{ __('API Tokens') }}
                </x-dropdown-link>
            @endif







            <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link href="{{ route('logout') }}"
                         onclick="event.preventDefault(); this.closest('form').submit();" class="text-gray-800 hover:bg-gray-50">
                  {{ __('Log Out') }}
                  <i class="fas fa-sign-out-alt" style="margin-left: 10px;"></i>
                </x-dropdown-link>
              </form>
            </li>




           
          
           
           
          
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->