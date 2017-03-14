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

                <table id="datatable-keytable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Survei</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Target</th>
                            <th>Realisasi</th>
                            <th>Dateline</th>
                             <th>Selengakapanya</th> 
                        </tr>
                    </thead>


                    <tbody>
                        @if(!empty($survei))
                        <?php foreach ($survei as $survei): ?>
                            <tr>
                                <td>{{ $survei->nama_survei }}</td>
                                <td>{{ $survei->tahun }}</td>
                                <td>{{ $survei->bulan }}</td>
                                <td>{{ $survei->target }}</td>
                                <td>{{ $survei->realisasi }}</td>
                                <td>{{ $survei->dateline }}</td>
                                <td><a href=" <?php echo url("/laporan/harian/detil?id=" . $survei->id . "&survei=" . $survei->nama_survei . "&survei_id=" . $survei->survei_id) ?> " style="color: red">detail</a></td> 
                            </tr>
                        <?php endforeach ?>
                        @else
                    <p> Tidak ada data aksesoris</p>
                    @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@stop

