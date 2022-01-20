<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="{{ asset('assets/img') }}/logo.png" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="login/css/util.css">
  <link rel="stylesheet" type="text/css" href="login/css/main.css">
  <link rel="stylesheet" href="login/vendor/pnotify/pnotify.custom.css" />
  <!--===============================================================================================-->
</head>

<body>
  @if ($message = Session::get('warning'))
		<div class="alert alert-warning" data-dismiss="alert">
			<strong><i class="fa fa-warning"></i> Warning :</strong> {{ $message }}
		</div>
	@endif
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form id="formLogin" class="login100-form validate-form" method="POST">
          {{ csrf_field() }}
          <span class="login100-form-title p-b-10">
            <img src="{{ asset('assets/img') }}/logo.png" width="250" height="160">
          </span>
          
          <span class="login100-form-title p-b-36">
            <h6>Virtual Tes tahap ke 2</h6>
          </span>

          <div class="wrap-input100">
            <input class="input100" type="text" name="email">
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>
          

          <div class="wrap-input100">
            <span class="btn-show-pass">
              <i class="zmdi zmdi-eye"></i>
            </span>
            <input class="input100" type="password" name="password">
            <span class="focus-input100" data-placeholder="Password"></span>
          </div>

          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Login
              </button>
            </div>
          </div>

          <div class="text-center p-t-20">
            <span class="txt1">
							Forgot password ?
						</span>
						<a class="txt2" href="{{ route('resetpswd') }}">
                            Here
						</a>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div id="dropDownSelect1"></div>

  <!--===============================================================================================-->
  <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="login/vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="login/vendor/bootstrap/js/popper.js"></script>
  <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="login/vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="login/vendor/daterangepicker/moment.min.js"></script>
  <script src="login/vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="login/vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="login/js/main.js"></script>
  <script src="login/vendor/pnotify/pnotify.custom.js"></script>

  <script type="text/javascript">
    /*===================================================================
  [ Login ]*/
    var formLogin = $('#formLogin');
    formLogin.submit(function(e) {
      e.preventDefault();
      $.ajax({
        url: "{{ route('login-process') }}",
        type: formLogin.attr('method'),
        data: formLogin.serialize(),
        dataType: "json",
        success: function(res) {
          if (res.error == 1) {
            if (res.message.email != null) {
              new PNotify({
                title: 'Alert!',
                text: res.message.email,
                type: 'warning',
                icon: "fa fa-warning",
                delay: 1500
              })
            }
            if (res.message.password != null) {
              new PNotify({
                title: 'Alert!',
                text: res.message.password,
                type: 'warning',
                icon: "fa fa-warning",
                delay: 1500
              })
            }
          } else if (res.error == 0) {
            new PNotify({
              title: 'Success',
              text: 'Login Success <br><b><i>' + res.email,
              type: 'success',
              icon: "fa fa-check",
              delay: 500,
              after_close: function() {
                window.location.href = "{{ route('dashboard') }}";
              }
            })
          } else {
            new PNotify({
              title: 'Failed',
              text: 'Login Failed, ' + res.message,
              type: 'error',
              icon: "fa fa-times",
              delay: 500
            })
          }
        }
      });
    });
    //key f5
    document.onkeydown = fkey;
    document.onkeypress = fkey
    document.onkeyup = fkey;
    var wasPressed = false;
    function fkey(e) {
      e = e || window.event;
      if (wasPressed) return;
      if (e.keyCode == 116) {
        $('.input100').val('');
        wasPressed = true;
      } else {
      }
    }
  </script>
</body>

</html>