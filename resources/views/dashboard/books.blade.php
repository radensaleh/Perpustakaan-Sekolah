@extends('dashboard/pages/base')
@section('title', 'Data Books')
@section('books', 'active')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Buku</h1>
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
                        <form id="form-add" enctype="multipart/form-data" action="{{ route('book.store') }}" method="post">
                            @csrf
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
                            <!-- Author -->
                             <div class="form-group">
                                <label>Author:</label>
                                <select name="user_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                @foreach($author as $a)
                                    <option value="{{ $a->user_id }}">{{ $a->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- Kategori -->
                             <div class="form-group">
                                <label>Kategori:</label>
                                <select name="category" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="Umum">Umum</option>
                                <option value="Agama">Agama</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Bahasa">Bahasa</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Seni dan Rekreasi">Seni dan Rekreasi</option>
                                <option value="Sains dan Matematika">Sains dan Matematika</option>
                                <option value="Sejarah dan Geografi">Sejarah dan Geografi</option>
                                <option value="Filsafat dan Psikologi">Filsafat dan Psikologi</option>
                                </select>
                            </div>
                            <!-- Publikasi -->
                             <div class="form-group">
                                <label>Tahun Terbit:</label>
                                <select name="publication_year" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                </select>
                            </div>
                            <!-- ISBN -->
                            <div class="form-group">
                                <label>ISBN :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" name="isbn" id="isbn" class="form-control" placeholder="ISBN" required>
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
                        <form id="form-update" enctype="multipart/form-data" action="{{ route('book.update', 'update') }}" method="post">
                            @csrf
                            {{ method_field('patch') }}
                            <input type="hidden" name="book_id" id="id-update" value="">
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
                            <!-- Author -->
                             <div class="form-group">
                                <label>Author:</label>
                                <select id="update-author" name="user_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                @foreach($author as $a)
                                    <option value="{{ $a->user_id }}">{{ $a->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <!-- Kategori -->
                             <div class="form-group">
                                <label>Kategori:</label>
                                <select id="update-kategori" name="category" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="Umum">Umum</option>
                                <option value="Agama">Agama</option>
                                <option value="Sosial">Sosial</option>
                                <option value="Bahasa">Bahasa</option>
                                <option value="Teknologi">Teknologi</option>
                                <option value="Seni dan Rekreasi">Seni dan Rekreasi</option>
                                <option value="Sains dan Matematika">Sains dan Matematika</option>
                                <option value="Sejarah dan Geografi">Sejarah dan Geografi</option>
                                <option value="Filsafat dan Psikologi">Filsafat dan Psikologi</option>
                                </select>
                            </div>
                            <!-- Publikasi -->
                             <div class="form-group">
                                <label>Tahun Terbit:</label>
                                <select id="update-tahun" name="publication_year" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                <option value="2010">2010</option>
                                <option value="2011">2011</option>
                                <option value="2012">2012</option>
                                <option value="2013">2013</option>
                                <option value="2014">2014</option>
                                <option value="2015">2015</option>
                                <option value="2016">2016</option>
                                <option value="2017">2017</option>
                                <option value="2018">2018</option>
                                <option value="2019">2019</option>
                                <option value="2020">2020</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                </select>
                            </div>
                            <!-- ISBN -->
                            <div class="form-group">
                                <label>ISBN :</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-credit-card"></i></span>
                                    </div>
                                    <input type="text" name="isbn" id="update-isbn" class="form-control" placeholder="ISBN" required>
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
                                    <th>Pencipta/Author</th>
                                    <th>Kategori</th>
                                    <th>Tahun Terbit</th>
                                    <th>ISBN</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->publication_year }}</td>
                                    <td>{{ $data->isbn }}</td>
                                    <td>
                                        <button type="button" onclick="return update('{{ $data->book_id }}', '{{ $data->name }}', '{{ $data->user_id }}', '{{ $data->category }}', '{{ $data->publication_year }}', '{{ $data->isbn }}')" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Ubah</button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete" data-id="{{ $data->book_id }}"><i class="fas fa-trash"></i> Hapus</button>
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
                            <form id="modal-form-delete" method="post" action="{{ route('book.destroy', 'destroy') }}">
                                {{ method_field('delete') }}
                                {{ csrf_field() }}
                                <div class="modal-body">
                                <input type="hidden" name="book_id" id="id-delete" value="">
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
                                    <th>Pencipta/Author</th>
                                    <th>Kategori</th>
                                    <th>Tahun Terbit</th>
                                    <th>ISBN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($book as $key => $data)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{{ $data->publication_year }}</td>
                                    <td>{{ $data->isbn }}</td>
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
        function update(id, nama, user_id, kategori, tahun ,isbn) {
            $('#card-add').hide()
            $('#card-update').show()

            var u_id = $('#id-update')
            var u_nama = $('#update-nama')
            var u_author = $('#update-author')
            var u_kategori = $('#update-kategori')
            var u_tahun = $('#update-tahun')
            var u_isbn = $('#update-isbn')
                
            u_id.val(id)
            u_nama.val(nama)
            u_author.val(user_id).trigger('change')
            u_kategori.val(kategori).trigger('change')
            u_tahun.val(tahun).trigger('change')
            u_isbn.val(isbn)

        }
        
        $(document).ready(function() {
            var formAdd    = $('#form-add');
            formAdd.submit(function (e) {
                e.preventDefault();
                
                var formData = new FormData(this);

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
                                    window.location.href = "{{ route('books') }}";
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
                                    window.location.href = "{{ route('books') }}";
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
                                        window.location.href = "{{ route('books') }}";
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