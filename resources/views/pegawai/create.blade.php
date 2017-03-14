@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Input Data Pegawai</h2>
          <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        @if(count($errors)>0)
          <div class="well">
            <ul style="color: red;">
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach 
            </ul>
          </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-12" style="color: white;">
              <a>.</a>
            </div>
            <div class="col-md-6">
              <div class="alert alert-success alert-block" style="width: 100%">
                <button type="button" class="close" data-dismiss="alert">×</button>
                      <strong>{{ $message }}</strong>
              </div>
            </div>
        </div>
        @endif
          <br />
          @if(Auth::user()->role == 1)
          {{ Form::open(array('action' => 'PegawaiController@store', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                      <span class="section">Data Pegawai</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Nama <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nama" placeholder="misal: warkito" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nip">NIP <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="number" name="nip" class="form-control"  data-validate-length-range="18,18" placeholder="NIP" required="required">
                          </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Jabatan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="jabatan">
                            <option value="-1" disabled>Pilih Jabatan</option>
                            <option value="1">Kepala BPS</option>
                            <option value="2">KASI</option>
                            <option value="3">Staff/KSK</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Tingkat Pendidikan</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="pendidikan">
                            <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                            <option value="1">Tidak Sekolah</option>
                            <option value="2">SD/MI/SR</option>
                            <option value="3">SMP/MTS</option>
                            <option value="4">SMA/MA</option>
                            <option value="5">DI/DII/DIII</option>
                            <option value="6">DIV/SI</option>
                            <option value="7">SII/SIII</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="email" class="form-control col-md-7 col-xs-12" name="email" placeholder="misal: warkito@email.com" required="required" type="email">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="username">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input id="username" class="form-control col-md-7 col-xs-12" name="username" placeholder="misal: warkito" required="required" type="text">
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Ketepatan Waktu</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="ketepatan_waktu">
                            <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                            <option value="1">Sangat Tepat</option>
                            <option value="2">Cukup Tepat</option>
                            <option value="3">Tepat Waktu</option>
                            <option value="4">Terlambat</option>
                            <option value="5">Sangat Terlambat</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="Pengalaman">Nilai Pengalaman <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="nilai_pengalaman">
                            <option value="-1" disabled>Pilih Pendidikan Terakhir</option>
                            <option value="1">Sangat Ahli</option>
                            <option value="2">Ahli</option>
                            <option value="3">Sedang</option>
                            <option value="4">Kurang</option>
                            <option value="5">Tidak Ahli</option>
                          </select>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

          <?php echo Form::close() ?>
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
@stop