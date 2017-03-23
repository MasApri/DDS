@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Pegawai</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row">

          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="datatable-keytable" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Pendidikan</th>
          @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <th>Ketepatan Waktu</th>
                    <th>Nilai Pengalaman</th>
                    <th>Action</th>
          @endif                    
                  </tr>
                </thead>


                <tbody>
                @if(!empty($pegawai_list))
                  <?php foreach($pegawai_list as $pegawai): ?>
                  <tr>
                    <td>{{ $pegawai->nama }}</td>
                    <td>{{ $pegawai->nip }}</td>
                    <td>{{ $pegawai->jabatan }}</td>
                    <td>{{ $pegawai->tingkat_pendidikan }}</td>
            @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                    <td>{{ $pegawai->ketepatan_waktu }}</td>
                    <td>{{ $pegawai->nilai_pengalaman }}</td>
                    <td>
                      <div class="row center">
                        <div class="box-button col-md-6 col-sm-6">
                          <center><a href="<?php echo url("pegawai/edit/".$pegawai->id) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a></center>
                        </div>
                        <div class="box-button col-md-6 col-sm-6">
                          <center>
                            {!! Form::open(['method' => 'DELETE', 'action' => ['PegawaiController@delete', $pegawai->id]]) !!}
                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs', 'id' => 'confirm']) !!}
                            {!! Form::close() !!}
                          </center>
                        </div>
                      </div>
                      <!-- <a href="<?php echo $pegawai->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a> -->
                    </td>
              @endif               
                  </tr>
                  <?php endforeach ?>
                @else
                    <p> Tidak ada data pegawai</p>
                @endif
                </tbody>
              </table>

              <div>
                <a href="<?php echo 'create' ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Pegawai </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    $('#confirm').click(function(){
      confirm('Apakah Anda Yakin Untuk Menghapus data ini?');
    });
  });
</script>

@stop