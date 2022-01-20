@extends('dashboard/pages/base')
@section('title', 'Setting')
@section('dashboard', 'active')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengaturan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
              <li class="breadcrumb-item active">Pengaturan</li>
            </ol>
          </div><!-- /.col -->
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Form
                            <small>Pengaturan</small>
                        </h3>
                        <!-- tools box -->
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                            <i class="fas fa-minus"></i></button>
                            <!-- <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip"
                                    title="Remove">
                            <i class="fas fa-times"></i></button> -->
                        </div>
                        <!-- /. tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body pad">
                        <form id="form-update" action="{{ route('setting_update') }}" method="post" role="form">
                            {{ csrf_field() }}
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Nama" name="name" value="{{ Auth::user()->name }}" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label>Email :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ Auth::user()->email }}" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- Password Lama -->
                            <div class="form-group">
                                <label>Password Lama :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password Lama" name="password" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- Password Lama -->
                            <div class="form-group">
                                <label>Password Baru :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="Password Baru" name="new_password" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <button type="submit" class="btn btn-block btn-success">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      <!-- ./row -->
    </section>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <script type="text/javascript">
        $(document).ready(function() {
            var formUpdate = $('#form-update');
            
            formUpdate.submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: formUpdate.attr('action'),
                    type: "POST",
                    data: formUpdate.serialize(),
                    dataType: "json",
                    success: function( res ){
                        console.log(res)
                        if( res.error == 1 ){
                            if (res.message.email != null) {
                                swal(
                                    'Alert!',
                                    res.message.email[0],
                                    'warning'
                                ).then(OK => {
                                    if(OK){
                                        //window.location.href = "#";
                                    }
                                });
                            }
                            if (res.message.new_password != null) {
                                swal(
                                    'Alert!',
                                    res.message.new_password[0],
                                    'warning'
                                ).then(OK => {
                                    if(OK){
                                        //window.location.href = "#";
                                    }
                                });
                            }
                        
                        } else if( res.error == 0 ) {
                            swal(
                                'Success',
                                res.message,
                                'success'
                            ).then(OK => {
                                if(OK){
                                    window.location.href = "{{ route('setting_page') }}";
                                }
                            });
                           
                        } else {
                            swal(
                                'Failed',
                                res.message,
                                'error'
                            ).then(OK => {
                                if(OK){
                                    //window.location.href = "#";
                                }
                            });
                        }
                    }
                })
            });
        });
    </script>
@endsection