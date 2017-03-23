@extends('master')

@section('main')
<div class="right_col" role="main" style="min-height: 300px;">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12" >
            <div class="x_panel">
                <div class="x_title">
                    <h2>Jadwal Untuk {{ Auth::user()->name }}</h2>
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

                  <div class="col-md-12 col-sm-12 col-xs-12">  
                    <div class="profile_title">
                      <div class="col-md-6">
                        <h2>Grafik Target dan Realisai {{ Auth::user()->name }}</h2>
                      </div>
                    </div>
                    <!-- start of user-activity-graph -->
                    <div id="echart_bar_horizontal" style="min-height:500px;"></div>
                    <!-- end of user-activity-graph -->
                  </div>
                  
                  </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="<?php echo asset('public/js/jquery.min.js') ?>"></script>
<script type="text/javascript">
  $(document).ready(function(){
    
    $('#seksi').change(function(){

      $('#survei').html("<p>loading...</p>");
      var id = $(this).val();
      //alert('<?php echo url('monitoring/survei?id='); ?>'+id);
        $('#survei').load('<?php echo url('monitoring/survei?id='); ?>'+id);

    });

  });
</script>
<script src="<?php echo asset('public/js/morris.min.js') ?>"></script>
<script src="<?php echo asset('public/js/echarts.min.js') ?>"></script>
<script src="<?php echo asset('public/js/raphael.min.js') ?>"></script>

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
          text: 'Target',
          subtext: 'Target dan realisasi Seluruh Survei Bulanan'
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
          data: [
          <?php foreach ($survei as $survei) : ?>
          '{{ $survei->nama_survei }}',
          <?php endforeach ?>            
          ]
        }],
        series: [{
          name: 'Target',
          type: 'bar',
          data: [
          <?php foreach ($dateline as $dateline) : ?>
          '{{ $dateline->dateline }}',
          <?php endforeach ?>        
          ]
          }]
      });

    </script>
@stop

