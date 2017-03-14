@extends('master')

@section('main')
	<div class="right_col" role="main" style="min-height: 300px;">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Survei</h2>
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
              <p class="text-muted font-13 m-b-30">
                KeyTable provides Excel like cell navigation on any table. Events (focus, blur, action etc) can be assigned to individual cells, columns, rows or all cells.
              </p>

              <table id="datatable-keytable" class="table table-striped table-bordered">
                  <tr>
                    <th>Seksi</th>
                    <td>{{ $survei->seksi_id }}</td>
                  </tr>
                  <tr>
                    <th>Nama</th>
                    <td>{{ $survei->nama_survei }}</td>
                  </tr>
                  <tr>
                    <th>Jenis Survei</th>
                    <td>{{ $survei->jenis_survei_id }}</td>
                  </tr>
                  <tr>
                    <th>Indeks Kesulitan</th>
                    <td>{{ $survei->indeks_kesulitan_id }}</td>
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