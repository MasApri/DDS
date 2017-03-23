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
                            <table id="datatable-keytable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Seksi</th>
                                        <th>Nama</th>
                                        <th>Pendekatan Unit Sampel</th>
                                        <th>Indeks Kesulitan</th>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2) 
                                        <th>Action</th>
                    @endif
                                    </tr>
                                </thead>


                                <tbody>
                                    @if(!empty($survei_list))
                                    <?php foreach ($survei_list as $survei): ?>
                                        <tr>
                                            <td>{{ $survei->seksi }}</td>
                                            <td>{{ $survei->nama_survei }}</td>
                                            <td>{{ $survei->pendekatan_unit_sampel }}</td>
                                            <td>{{ $survei->indeks_kesulitan }}</td>
                    @if(Auth::user()->role == 1 || Auth::user()->role == 2) 
                                            <td>
                                                <div class="row center">
                                                    <div class="box-button col-md-6 col-sm-6">
                                                        <center><a href="<?php echo url("survei/edit/".$survei->id) ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a></center>
                                                    </div>
                                                    <div class="box-button col-md-6 col-sm-6">
                                                        <center>
                                                            {!! Form::open(['method' => 'DELETE', 'action' => ['SurveiController@delete', $survei->id]]) !!}
                                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                                            {!! Form::close() !!}
                                                        </center>
                                                    </div>
                                                </div>
                                            </td>
                    @endif
                                        </tr>
                                    <?php endforeach ?>
                                    @else
                                <p> Tidak ada data survei</p>
                                @endif
                                </tbody>
                            </table>

                            <div>
                                <a href="<?php echo 'create' ?>" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Survei </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@stop