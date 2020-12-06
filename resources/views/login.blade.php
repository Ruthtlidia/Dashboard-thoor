<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}" rel="stylesheet" type="text/css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js')}}"></script>


    <script src="{{asset('assets/js/alert/package/dist/sweetalert2.min.js')}}"></script>
<link rel="stylesheet" href="{{asset('assets/js/alert/package/dist/sweetalert2.min.css')}}">

    <link href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}" rel="stylesheet" type="text/css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}" rel="stylesheet" type="text/css">

    <link href="{{asset('assets/vendors/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js')}}"></script>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}" >
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Logar</h3>
                <form action="javascript:void(0)" method="post" id="frmLogarUsuario" enctype="multipart/form-data">
                    @csrf
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control p_input" name='email' id='email'>
                  </div>
                  <div class="form-group">
                    <label>Senha</label>
                    <input type="text" class="form-control p_input" name='password' id='password'>
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                  </div>
                  <div class="text-center">
                    <button type="submit" onclick="logar()" class="btn btn-primary btn-block enter-btn">Entrar</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('assets/requisicoes.js')}}"></script>
    <script src="{{asset('assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/js/misc.js')}}"></script>
    <script src="{{asset('assets/js/settings.js')}}"></script>
    <script src="{{asset('assets/js/todolist.js')}}"></script>


    <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/vendors/progressbar.js/progressbar.min.js')}}"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
<script src="{{asset('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/misc.js')}}"></script>
<script src="{{asset('assets/js/settings.js')}}"></script>
<script src="{{asset('assets/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('assets/js/dashboard.js')}}"></script>

<script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script>
<script src="{{asset('assets/vendors/chart.js/Chart.min.js')}}"></script>

<!-- inject:js -->
<script src="{{asset('assets/js/off-canvas.js')}}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('assets/js/settings.js')}}"></script>
<script src="{{asset('assets/js/todolist.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('assets/js/chart.js')}}"></script>

<script src="{{asset('assets/graficos.js')}}"></script>
<script src="{{asset('assets/scripts.js')}}"></script>
<script src="{{asset('assets/requisicoes.js')}}"></script>
<script src="{{asset('assets/js/file-upload.js')}}"></script>
<script src="{{asset('assets/vendors/select2/select2.min.js')}}"></script>
<script src="{{asset('assets/js/select2.js')}}"></script>

    <!-- endinject -->
  </body>
</html>
