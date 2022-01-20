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
        <form id="formReset" class="login100-form validate-form" method="POST">
          {{ csrf_field() }}
          <span class="login100-form-title p-b-10">
            <img src="{{ asset('assets/img') }}/logo.png" width="250" height="160">
          </span>
          
          <span class="login100-form-title p-b-36">
            <h6>Virtual Tes tahap ke 2</h6>
          </span>

          <div class="wrap-input100">
            <input class="input100" type="email" name="email">
            <span class="focus-input100" data-placeholder="Email"></span>
          </div>
          
          <div class="container-login100-form-btn">
            <div class="wrap-login100-form-btn">
              <div class="login100-form-bgbtn"></div>
              <button class="login100-form-btn">
                Reset Password
              </button>
            </div>
          </div>

          <div class="text-center p-t-20">
            <span class="txt1">
							Already Have Account ?
						</span>
						<a class="txt2" href="{{ route('login') }}">
                Login Here
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

  <!-- sweetAlert -->
  <script src="https://unpkg.com/sweetalert2@7.1.0/dist/sweetalert2.all.js"></script>

  <script type="text/javascript">
    /*===================================================================
  [ Login ]*/
    var formReset = $('#formReset');
    formReset.submit(function(e) {
      e.preventDefault();

      swal({
          allowOutsideClick: false,
          title:'Harap Menunggu!',
          text:'Permintaan sedang di proses...',
          imageUrl: "{{ asset('assets/loading.gif') }}",
          imageHeight: 150, 
          imageWidth: 150,   
          showCancelButton: false,
          showConfirmButton: false
      })

      $.ajax({
        url: "{{ route('reset-process') }}",
        type: formReset.attr('method'),
        data: formReset.serialize(),
        dataType: "json",
        success: function(res) {
          if (res.error == 1) {
            swal(
              'Failed',
              res.message,
              'error'
              ).then(OK => {
              if(OK){
                // window.location.href = "#";
              }
            });
          } else if (res.error == 0) {
            swal(
              'Success',
              res.message,
              'success'
              ).then(OK => {
              if(OK){
                window.location.href = "{{ route('resetpswd') }}";
              }
            });
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