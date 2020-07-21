

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Admin Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Penjualan Bulan Ini</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800" id="penjualan_bulan_ini"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Penjualan Hari Ini</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800" id="penjualan_hari_ini"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Rata-rata Ulasan</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800" id="ratarata_ulasan"></div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <div class="progress-bar bg-info ulasan-bar" role="progressbar"  aria-valuenow="4.4" aria-valuemin="0" aria-valuemax="5"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-star fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Produk Terjual</div>
                      <div class="h6 mb-0 font-weight-bold text-gray-800" id="produk_terjual"></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Overview Penjualan Harian
                      <a href="#" data-toggle="tooltip" title="
                      Nominal pesanan yang sudah selesai"><i class="fa fa-info-circle"></i>
                      </a>

                  </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="myAreaChart"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-5">
                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Pesanan</h6>
                    </div>
                    <div class="card-body" id="status-pesanan-dashboard">

                    </div>
                </div>
            </div>
          </div>


<style>

</style>
<script>

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: admin_url + 'get_grouped_daily_sales', // the url where we want to POST// our data object
        dataType: 'json',
        data: {days_num: 10},
        success: function (data) {
            statistic(data, true, "Penjualan: ");
        }
    })

    $.ajax({
        type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url: admin_url + 'dashboard_card', // the url where we want to POST// our data object
        dataType: 'json',
        success: function (data) {
            $('#penjualan_bulan_ini').html(convertToRupiah(data.penjualan_bulan_ini));
            $('#penjualan_hari_ini').html(convertToRupiah(data.penjualan_hari_ini));
            $('#ratarata_ulasan').html(data.ratarata_ulasan);

            ulasan_bar_width = parseFloat(data.ratarata_ulasan) * 20;
            $('.ulasan-bar').css("width", ulasan_bar_width + "%");
            $('#produk_terjual').html(data.produk_terjual);

        }
    })

    $.ajax({
        type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url: admin_url + 'status_pesanan_dashboard', // the url where we want to POST// our data object
        dataType: 'json',
        success: function (data) {
            html = '<h4 class="small font-weight-bold">Diterima <span class="float-right">'+ data.diterima_percent +'%</span></h4>\n' +
                '                        <div class="progress mb-4">\n' +
                '                            <div class="progress-bar bg-warning" role="progressbar" style="width: '+ data.diterima_percent +'%" aria-valuenow="'+ data.diterima_percent +'" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                '                        </div>\n' +
                '                        <h4 class="small font-weight-bold">Diproses <span class="float-right">'+ data.diproses_percent +'%</span></h4>\n' +
                '                        <div class="progress mb-4">\n' +
                '                            <div class="progress-bar" role="progressbar" style="width: '+ data.diproses_percent +'%" aria-valuenow="'+ data.diproses_percent +'" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                '                        </div>\n' +
                '                        <h4 class="small font-weight-bold">Dikirim <span class="float-right">'+ data.dikirim_percent +'%</span></h4>\n' +
                '                        <div class="progress mb-4">\n' +
                '                            <div class="progress-bar bg-info" role="progressbar" style="width: '+ data.dikirim_percent +'%" aria-valuenow="'+ data.dikirim_percent +'" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                '                        </div>\n' +
                '                        <h4 class="small font-weight-bold">Selesai <span class="float-right">'+ data.selesai_percent +'%</span></h4>\n' +
                '                        <div class="progress mb-4">\n' +
                '                            <div class="progress-bar bg-success" role="progressbar" style="width: '+ data.selesai_percent +'%" aria-valuenow="'+ data.selesai_percent +'" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                '                        </div>\n' +
                '                        <h4 class="small font-weight-bold">Dibatalkan<span class="float-right">'+ data.dibatalkan_percent +'%</span></h4>\n' +
                '                        <div class="progress mb">\n' +
                '                            <div class="progress-bar bg-danger" role="progressbar" style="width: '+ data.dibatalkan_percent +'%" aria-valuenow="'+ data.dibatalkan_percent +'" aria-valuemin="0" aria-valuemax="100"></div>\n' +
                '                        </div>';

            $('#status-pesanan-dashboard').html(html);

        }
    })
</script>

