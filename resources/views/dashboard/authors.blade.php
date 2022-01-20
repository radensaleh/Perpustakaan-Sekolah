@extends('dashboard/pages/base')
@section('title', 'Data Authors')
@section('authors', 'active')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Authors</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    @if(Auth::user()->role == "admin")
        <div class="row">
            <div class="col-md-4">
                <div id="card-add" class="card card-outline card-success">
                    <div class="card-header">
                        <h3 class="card-title">
                            Form
                            <small>Data</small>
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
                        <form id="form-add" enctype="multipart/form-data" action="{{ route('user.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="role" value="author">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" name="name" id="nama" class="form-control" placeholder="Nama" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <!-- Email -->
                            <div class="form-group">
                                <label>Email :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                </div>
                                <!-- /.input group -->
                            </div>
                            <button type="submit" class="btn btn-block btn-success">Simpan</button>
                        </form>
                    </div>
                </div>

                <!-- FORM UPDATE CLIENTS -->
                <div id="card-update" class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">
                            Form Update
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
                        <form id="form-update" enctype="multipart/form-data" action="{{ route('user.update', 'update') }}" method="post">
                            @csrf
                            {{ method_field('patch') }}
                            <input type="hidden" name="user_id" id="id-update" value="">
                            <input type="hidden" name="role" value="author">
                            <!-- Nama -->
                            <div class="form-group">
                                <label>Nama :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                                    </div>
                                    <input type="text" name="name" id="update-nama" class="form-control" placeholder="Nama" required>
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
                                    <input type="text" name="email" id="update-email" class="form-control" placeholder="Email" required>
                                </div>
                                <!-- /.input group -->
                            </div>                           
                            <button type="submit" class="btn btn-block btn-primary">Ubah</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col-->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>
                                        <button type="button" onclick="return update('{{ $data->user_id }}', '{{ $data->name }}', '{{ $data->email }}')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Ubah</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" data-id="{{ $data->user_id }}"><i class="fas fa-trash"></i> Hapus</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- /.modal -->
                <div class="modal fade" id="modal-delete">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><b>Delete Confirmation</b></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="modal-form-delete" method="post" action="{{ route('user.destroy', 'destroy') }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                <input type="hidden" name="user_id" id="id-delete" value="">
                                    <p>
                                        <center>Are you sure you want to delete this ?</center>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-danger" id="btnDelete"><span class="fas fa-trash"></span> Yes, Delete</button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fas fa-times-circle"></span> No, Cancel</button>
                                </div>
                            </form>
                        </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->

            </div>
        </div>
      <!-- ./row -->

    @else
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($user as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                @endforeach
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
        </div>
    @endif
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script type="text/javascript">
    $('#card-update').hide();
        function update(id, nama, email) {
            $('#card-add').hide()
            $('#card-update').show()

            var u_id = $('#id-update')
            var u_nama = $('#update-nama')
            var u_email = $('#update-email')
                
            u_id.val(id)
            u_nama.val(nama)
            u_email.val(email)

        }
        
        $(document).ready(function() {
            var formAdd    = $('#form-add');
            formAdd.submit(function (e) {
                e.preventDefault();
                
                var formData = new FormData(this);
                
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
                    url: formAdd.attr('action'),
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function( res ){
                        console.log(res)
                        if( res.error == 0 ){
                            swal(
                                'Success',
                                'Berhasil tersimpan',
                                    'success'
                                ).then(OK => {
                                if(OK){
                                    window.location.href = "{{ route('authors') }}";
                                }
                            });
                        } else {
                            swal(
                                'Failed',
                                res.message,
                                'error'
                                ).then(OK => {
                                if(OK){
                                    // window.location.href = "#";
                                }
                            });
                        }
                    }
                })
            });

            var formUpdate    = $('#form-update');
            formUpdate.submit(function (e) {
                e.preventDefault();
                
                var formData = new FormData(this);

                $.ajax({
                    url: formUpdate.attr('action'),
                    type: "POST",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    dataType: "json",
                    success: function( res ){
                        console.log(res)
                        if( res.error == 0 ){
                            swal(
                                'Success',
                                res.message,
                                    'success'
                                ).then(OK => {
                                if(OK){
                                    window.location.href = "{{ route('authors') }}";
                                }
                            });
                        } else {
                            swal(
                                'Failed',
                                res.message,
                                'error'
                                ).then(OK => {
                                if(OK){
                                    // window.location.href = "#";
                                }
                            });
                        }
                    }
                })
            });

            $('#modal-delete').on('show.bs.modal', function (event) {
              var button     = $(event.relatedTarget)
              var id = button.data('id')
              var modal      = $(this)
      
              modal.find('.modal-body #id-delete').val(id)
            });

            var formDelete = $('#modal-form-delete');
            formDelete.submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: formDelete.attr('action'),
                    type: "POST",
                    data: formDelete.serialize(),
                    dataType: "json",
                    success: function( res ){
              			console.log(res)
              			if( res.error == 0 ){
                            $('#deleteData').modal('hide');
                                swal('Success',res.message,'success').then(OK => {
                                    if(OK){
                                        window.location.href = "{{ route('authors') }}";
                                    }
                                });
                  		}else{
                            $('#deleteData').modal('hide');
                            swal('Failed', res.message, 'error')
                        }
                    }
                })
            });

        });
    </script>
@endsection