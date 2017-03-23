@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title"> 
        <h2>Nilai Capaian Kinerja Pegawai</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        @if(Auth::user()->role == 1 || Auth::user()->role == 2 )
          {{ Form::open(array('action' => 'CkprController@show', 'enctype' => "multipart/form-data", 'novalidate', 'class' => 'form-horizontal form-label-left' )) }}

          <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tahun">Tahun <span class="required">*</span>
                </label>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <select class="form-control" name="tahun">
                        <option value="-1" disabled>Pilih Tahun</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
                <div class="col-md-3">
                <button id="send" type="submit" class="btn btn-success">Submit</button>
              </div>
            </div>

            <?php echo Form::close() ?> 
          <table id="datatable-buttons" class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>NIP</th>
                <th>Tahun</th>
                <th>Jan</th>
                <th>Feb</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agus</th>
                <th>Sep</th>
                <th>Okt</th>
                <th>Nov</th>
                <th>Des</th>
              </tr>
            </thead>


            <tbody>
            @if(!empty($ckpr))
                  <?php foreach($ckpr as $ckpr): ?>
              <tr>
                <td>{{ $ckpr->nama }}</td>
                <td>{{ $ckpr->tahun }}</td>
                <td>{{ $ckpr->januari }}</td>
                <td>{{ $ckpr->februari }}</td>
                <td>{{ $ckpr->maret }}</td>
                <td>{{ $ckpr->april }}</td>
                <td>{{ $ckpr->mei }}</td>
                <td>{{ $ckpr->juni }}</td>
                <td>{{ $ckpr->juli }}</td>
                <td>{{ $ckpr->agustus }}</td>
                <td>{{ $ckpr->september }}</td>
                <td>{{ $ckpr->oktober }}</td>
                <td>{{ $ckpr->november }}</td>
                <td>{{ $ckpr->desember }}</td>
              </tr>
              <?php endforeach ?>
            @else
                <p> Tidak ada data aksesoris</p>
            @endif
            </tbody>
          </table>

          @else
              <div>
                <h2> Anda Tidak Berwenang Memasuki Halaman Ini </h2>
              </div>
          @endif
        </div>
    </div>
  </div>
</div>
@stop