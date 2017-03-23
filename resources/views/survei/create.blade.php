
@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Input Data Survei</h2>
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
          <br />
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

          @if(Auth::user()->role == 1)
          
          {{ Form::open(array('action' => 'SurveiController@store', 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}
                      <span class="section">Data Survei</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Seksi</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="seksi_id">
                            <option value="-1" disabled>Pilih Seksi</option>
                            <option value="1">Sosial</option>
                            <option value="2">Neraca Wilayah dan Analisis</option>
                            <option value="3">Produksi</option>
                            <option value="4">Distribusi</option>
                            <option value="5">IPDS</option>
                          </select>
                        </div>
                      </div>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_survei">Nama Survei<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="nama_survei" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="1" name="nama_survei" placeholder="Tulis Lengkap Nama Survei (Sesuai Dokumen)" required="required" type="text">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Pendekatan Unit Sampel</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="pendekatan_unit_sampel">
                            <option value="-1" disabled>Pilih Jenis Survei</option>
                            <option value="1">Rumah Tangga</option>
                            <option value="2">Unit Usaha/Perusahaan</option>
                          </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Indeks Kesulitan Survei</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="form-control" name="indeks_kesulitan_id">
                            <option value="-1" disabled>Pilih Indeks Kesulitan Survei</option>
                            <option value="1">Sangat sulit (>10 Dokumen)</option>
                            <option value="2">Mudah (8-10 Dokumen)</option>
                            <option value="3">Sedang (6-8 Dokumen)</option>
                            <option value="4">Mudah (3-5 Dokumen)</option>
                            <option value="5">Sangat mudah (1-2 Dokumen)</option>
                          </select>
                        </div>
                      </div>
                      <!--
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mulai">Waktu Selesai<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
	                        <div class="xdisplay_inputx form-group has-feedback">
    	                    <input type="text" class="form-control has-feedback-left" name="waktu_selesai" id="single_cal2" placeholder="Waktu Selesai" aria-describedby="inputSuccess2Status">
                        	<span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
                            <span id="inputSuccess2Status" class="sr-only">(success)</span>
                          </div>
                        </div>
                      </div>
                      -->
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
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