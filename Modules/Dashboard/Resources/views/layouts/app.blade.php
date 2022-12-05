@include('dashboard::components.header')
@include('dashboard::components.nav')

@include('dashboard::components.aside')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @section('content')
        @show
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@include('dashboard::components.footer')
