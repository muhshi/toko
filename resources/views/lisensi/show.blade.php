@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data lisensi</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Settings 1</a>
              </li>
              <li><a href="#">Settings 2</a>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">

          @if(Auth::user()->level_id == 1)

          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <p class="text-muted font-13 m-b-30">
                KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
              </p>

              <table id="datatable-keytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nama User</th>
                    <th>Jumlah</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>ID Toko</th>
                    <th>Action</th>
                  </tr>
                </thead>


                <tbody>
                @if(!empty($lisensi_list))
                  <?php foreach($lisensi_list as $lisensi): ?>
                  <tr>
                    <td>{{ $lisensi->user_id }}</td>
                    <td>{{ $lisensi->jumlah }}</td>
                    <td>{{ $lisensi->tanggal }}</td>
                    <td>{{ $lisensi->keterangan }}</td>
                    <td>{{ $lisensi->toko_id }}</td>
                    <td>
                      <div class="row center">
                        <div class="box-button col-md-4 col-sm-12">
                          <center><a href="<?php echo $lisensi->id ?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></center>
                        </div>
                        <div class="box-button col-md-4 col-sm-12">
                          <center><a href="<?php echo url("lisensi/edit/".$lisensi->id) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a></center>
                        </div>
                        <div class="box-button col-md-4 col-sm-12">
                          <center>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['LisensiController@delete', $lisensi->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs confirm', 'id' => 'confirm']) !!}
                            {!! Form::close() !!}
                          </center>
                        </div>
                      </div>
                      <!-- <a href="<?php echo $lisensi->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a> -->
                    </td>
                  </tr>
                  <?php endforeach ?>
                @else
                    <p> Tidak ada data lisensi</p>
                @endif
                </tbody>
              </table>

              <div>
                <a href="<?php echo 'create' ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah lisensi </a>
              </div>
            </div>
          </div>

          @else
              <div>
                <h2> Anda Tidak Berwenang Memasuki Halaman Ini </h2>
              </div>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script>
  $(document).ready(function(){
    $('.confirm').click(function(){
      confirm('Apakah Anda Yakin Untuk Menghapus data ini?');
    });
  });
</script>

@stop