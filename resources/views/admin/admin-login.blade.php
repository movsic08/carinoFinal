<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>FPOP Record Management System</title>
  <base href="/public">
  <!-- Favicon -->
  <link rel="icon" href="assets/img/logo-2.png" type="image/png">


  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

<!-- core:css -->
<link rel="stylesheet" href="{{ asset('backend-assets/vendors/core/core.css') }}">
<!-- endinject -->

<!-- Plugin css for this page -->
<!-- Add your plugin CSS links here if needed -->
<!-- End plugin CSS for this page -->

<!-- inject:css -->
<link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
<link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
<!-- endinject -->

<!-- Layout styles -->
<link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
<!-- End layout styles -->

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

<style type="text/css">
			
.authlogin-side-wrapper{
    width: 100%;
    height: 100%;
    background-image: url({{ asset('upload/bg_image_1.jpg')  }});
  }
  body {
    background-image: url('https://t3.ftcdn.net/jpg/05/07/34/36/360_F_507343642_vSd0WhUYE1OXM2rpRWGKYTdk0hdqQAhm.jpg');
    background-size: cover; /* Optional: Adjust the background size as needed */
    background-repeat: no-repeat; /* Optional: Prevent the background from repeating */
  }


</style>

</head>
<body>
	<div class="main-wrapper">
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">
            <div class="row w-100 mx-0 auth-page">
                <div class="col-md-8 col-xl-6 mx-auto">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="authlogin-side-wrapper"></div>
                            </div>
                            <div class="col-md-8 ps-md-0">
                                <div class="auth-form-wrapper px-4 py-5">
                                    <a href="https://fpop1969.org/wp-content/uploads/2022/10/logo-768x768.png"
                                        class="noble-ui-logo logo-light d-block mb-2">FPOP <span>Pangasinan Chapter</span></a>
                                    <h5 class="text-muted fw-normal mb-4">Welcome back! Log in to your account.</h5>
                                    <form class="form-sample" method="POST" action="{{ route('login') }}" id="loginForm">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="login" class="form-label">Email/Username/Phone</label>
                                            <input type="text" name="login" class="form-control" id="login"
                                                placeholder="Email/Username/Phone" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="userPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="userPassword" autocomplete="current-password" placeholder="Password"
                                                required>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input type="checkbox" class="form-check-input" id="authCheck">
                                            <label class="form-check-label" for="authCheck">
                                                Remember me
                                            </label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-outline-primary"
                                                onclick="validateForm()">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var login = document.getElementById("login").value;
        var password = document.getElementById("userPassword").value;

        if (login.trim() === "" || password.trim() === "") {
            alert("Please enter both username and password.");
            return false;
        }

        document.getElementById("loginForm").submit();
    }
</script>


<!-- core:js -->
<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
<!-- Add your plugin JavaScript links here if needed -->
<!-- End plugin JavaScript for this page -->

<!-- inject:js -->
<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/template.js') }}"></script>
<!-- endinject -->


<!-- Custom js for this page -->
	<!-- End custom js for this page -->

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

  <script>
   @if(Session::has('message'))
   var type = "{{ Session::get('alert-type','info') }}"
   switch(type){
      case 'info':
      toastr.info(" {{ Session::get('message') }} ");
      break;
  
      case 'success':
      toastr.success(" {{ Session::get('message') }} ");
      break;
  
      case 'warning':
      toastr.warning(" {{ Session::get('message') }} ");
      break;
  
      case 'error':
      toastr.error(" {{ Session::get('message') }} ");
      break; 
   }
   @endif 
  </script>

</body>
</html>