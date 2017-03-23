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
          <div class="col-sm-12">
            <div class="card-box table-responsive">
              <table id="datatable-keytable" class="table table-striped table-bordered">
                  <tr>
                    <th>Nama</th>
                    <td>{{ $pegawai->nama }}</td>
                  </tr>
                  <tr>
                    <th>Tingkat Pendidikan</th>
                    <td>{{ $pegawai->tingkat_pendidikan_id }}</td>
                  </tr>
                  <tr>
                    <th>NIP</th>
                    <td>{{ $pegawai->nip }}</td>
                  </tr>
                  <tr>
                    <th>Jabatan</th>
                    <td>{{ $pegawai->jabatan }}</td>
                  </tr>
                  <tr>
                    <th>Nilai Pengalaman</th>
                    <td>{{ $pegawai->nilai_pengalaman }}</td>
                  </tr>
                  <tr>
                    <th>Ketepatan Waktu</th>
                    <td>{{ $pegawai->ketepatan_waktu }}</td>
                  </tr>
              </table>

              <div>
                <a href="<?php echo 'show' ?>" class="btn btn-primary">Kembali</a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@stop