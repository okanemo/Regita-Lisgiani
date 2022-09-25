<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('sites/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{url('sites/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('sites/dist/css/adminlte.min.css')}}">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-daygrid/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-timegrid/main.min.css')}}">
  <link rel="stylesheet" href="{{url('sites/plugins/fullcalendar-bootstrap/main.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" style="color:black">
    <li class="nav-item dropdown">
        <a  href="{{ url('admin/profile') }}" style="text-decoration: none;color:black">
            <i class="fas fa-user"></i>
        </a>
    </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a  href="{{ url('/admin/logout') }}" style="text-decoration: none;color:black">
            <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-white sidebar-light elevation-4" style="background-color: #fff !important;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">Porting</span>
    </a>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-header">Admin</li>
        @foreach(Session::get('menu_list') as $key)
          <li class="nav-item">
            <a href="{{ url('admin/'.$key['menu_url']) }}" class="nav-link">
              <i class="nav-icon far fa-circle text-green"></i>
                <p>{{$key['menu_name']}}</p>
            </a>
          </li>
        @endforeach
        </ul>
      </nav>
    <!-- /.sidebar -->
  </aside>
  @section('content')
  @show
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url('sites/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('sites/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('sites/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{url('sites/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('sites/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('sites/dist/js/demo.js')}}"></script>

<!-- fullCalendar 2.2.5 -->
<script src="{{url('sites/plugins/moment/moment.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-daygrid/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-timegrid/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-interaction/main.min.js')}}"></script>
<script src="{{url('sites/plugins/fullcalendar-bootstrap/main.min.js')}}"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

</body>
</html>
