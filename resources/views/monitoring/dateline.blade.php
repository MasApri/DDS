@extends('master')

@section('main')
<!-- /page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Monitoring</h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Grafik Dateline</h2>
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

                        <div id="echart_bar_horizontal" style="height:350px;"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

<!-- /Javascript -->
<script src="<?php echo asset('public/js/echarts.min.js') ?>"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $('#seksi').change(function () {

            $('#survei').html("<p>loading...</p>");
            var id = $(this).val();
            //alert('<?php echo url('monitoring/survei?id='); ?>'+id);
            $('#survei').load('<?php echo url('monitoring/survei?id='); ?>' + id);

        });

    });
</script>
<script>
    var theme = {
        color: [
            '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
            '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
        ],

        title: {
            itemGap: 8,
            textStyle: {
                fontWeight: 'normal',
                color: '#408829'
            }
        },

        dataRange: {
            color: ['#1f610a', '#97b58d']
        },

        toolbox: {
            color: ['#408829', '#408829', '#408829', '#408829']
        },

        dataZoom: {
            dataBackgroundColor: '#eee',
            fillerColor: 'rgba(64,136,41,0.2)',
            handleColor: '#408829'
        },
        grid: {
            borderWidth: 0
        },

        categoryAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },

        valueAxis: {
            axisLine: {
                lineStyle: {
                    color: '#408829'
                }
            },
            splitArea: {
                show: true,
                areaStyle: {
                    color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                }
            },
            splitLine: {
                lineStyle: {
                    color: ['#eee']
                }
            }
        },
        timeline: {
            lineStyle: {
                color: '#408829'
            },
            controlStyle: {
                normal: {color: '#408829'},
                emphasis: {color: '#408829'}
            }
        },

        textStyle: {
            fontFamily: 'Arial, Verdana, sans-serif'
        }
    };



    var echartBar = echarts.init(document.getElementById('echart_bar_horizontal'), theme);

    echartBar.setOption({
        title: {
            text: 'Dateline',
            subtext: 'Dateline Seluruh Survei Bulanan'
        },
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            x: 100,
            data: ['Target', 'Realisasi']
        },
        toolbox: {
            show: true,
            feature: {
                saveAsImage: {
                    show: true,
                    title: "Save Image"
                }
            }
        },
        calculable: true,
        xAxis: [{
                type: 'value',
                boundaryGap: [0, 0.01]
            }],
        yAxis: [{
                type: 'category',
//                data: ['Survei A', 'Survei B', 'Survei C', 'Survei D', 'Survei E', 'Survei F']
        data: [
<?php
$hasil = '';

foreach ($dateline as $x) {
    $hasil = $hasil . "'" . $x->nama_survei . "',";
}
$hasil = substr($hasil, 0, -1);
$hasil = $hasil;

echo $hasil;
?>
        ]
            }],
        series: [{
                name: 'Dateline',
                type: 'bar',
        data: [
<?php
$hasil = '';

foreach ($dateline as $x) {
    $hasil = $hasil . "'" . $x->dateline . "',";
}
$hasil = substr($hasil, 0, -1);
$hasil = $hasil ;

echo $hasil;
?>
        ]
            }]
    });

</script>

@stop
