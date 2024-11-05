<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pergola Yönetim</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('admin') }}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.5/css/fileinput.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>

@keyframes slideIn {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOut {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

</style>




 @yield('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    @include('admin.data.navbar')
      <div class="container-fluid">
        @include('admin.data.menu')


        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  
  
<!-- MAİN CONTENT HERE -->
  
  


  @yield('master')




<!-- END MAİN CONTENT  -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('admin') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('admin') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('admin') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('admin') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('admin') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('admin') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('admin') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('admin') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('admin') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('admin') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('admin') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('admin') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('admin') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="{{ asset('admin') }}/dist/js/menu.js"></script>

<script>
  // Bildirim izni kontrolü ve isteme
  function requestNotificationPermission() {
      if ('Notification' in window) {
          Notification.requestPermission();
      }
  }

  // Sayfa yüklendiğinde bildirim izni iste
  document.addEventListener('DOMContentLoaded', requestNotificationPermission);

  // Echo kanalını dinle
  window.Echo.private(`App.Models.User.${userId}`)
      .notification((notification) => {
          if (notification.type === 'mention') {
              // Masaüstü bildirimi göster
              if ('Notification' in window && Notification.permission === 'granted') {
                  const notificationOptions = {
                      body: notification.message.content,
                      icon: notification.sender.avatar || '/default-avatar.png', // Varsayılan avatar yolunu ayarlayın
                      badge: '/notification-badge.png', // Bildirim rozeti için bir resim yolu
                      tag: 'mention-notification',
                      data: {
                          url: notification.url
                      }
                  };

                  const desktopNotification = new Notification(notification.title, notificationOptions);

                  // Bildirime tıklandığında ilgili URL'ye yönlendir
                  desktopNotification.onclick = function() {
                      window.focus();
                      window.location.href = this.data.url;
                  };
              }

              // Özel bildirim kutusu oluştur
              const notificationHtml = `
                  <div class="custom-notification" style="
                      position: fixed;
                      top: 20px;
                      right: 20px;
                      background: white;
                      padding: 15px;
                      border-radius: 8px;
                      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                      z-index: 9999;
                      max-width: 350px;
                      display: flex;
                      align-items: start;
                      gap: 10px;
                      animation: slideIn 0.5s ease-out;
                  ">
                      <img src="${notification.sender.avatar || '/default-avatar.png'}" 
                           style="width: 40px; height: 40px; border-radius: 50%;" 
                           alt="${notification.sender.name}">
                      <div>
                          <div style="font-weight: bold; margin-bottom: 5px;">
                              ${notification.title}
                          </div>
                          <div style="color: #666; font-size: 0.9em;">
                              ${notification.message.content}
                          </div>
                      </div>
                      <button onclick="this.parentElement.remove()" 
                              style="position: absolute; top: 5px; right: 5px; 
                                     border: none; background: none; cursor: pointer; 
                                     font-size: 18px; color: #999;">
                          ×
                      </button>
                  </div>
              `;

              // Bildirimi DOM'a ekle
              document.body.insertAdjacentHTML('beforeend', notificationHtml);

              // 5 saniye sonra bildirimi otomatik olarak kaldır
              setTimeout(() => {
                  const notification = document.querySelector('.custom-notification');
                  if (notification) {
                      notification.style.animation = 'slideOut 0.5s ease-out';
                      setTimeout(() => notification.remove(), 500);
                  }
              }, 5000);
          }
      });
</script>


@yield('js')


</body>
</html>
