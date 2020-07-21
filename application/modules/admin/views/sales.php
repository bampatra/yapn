
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Penjualan</h1>
    <br>

    <!-- Area Chart -->
    <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Statistik

            </h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
            <div class="chart-area">
                <canvas id="myAreaChart"></canvas>
            </div>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Penjualan
                <a href="#" data-toggle="tooltip" title="
                      Daftar penjualan adalah daftar pesanan yang sudah diselesaikan"><i class="fa fa-info-circle"></i>
                </a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="display: none;"> Tgl Filter </th>
                        <th> Tanggal Pesanan </th>
                        <th> Tanggal Selesai </th>
                        <th> No. Pesanan </th>
                        <th> Nominal </th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<style>
    .hover-active:hover{
        cursor: pointer;
        background: #ffe1dd;
        transition: 0.2s;
    }

    .btn-primary{
        background: #a50000;
        color: white;
        border: 1px solid white;
        transition: .2s;
    }

    .btn-primary:hover{
        background: white;
        color: #a50000;
        border: 1px solid #a50000;
    }

    .status_order{
        width: 16%;
    }

    .status_selected{
        color: #a50000; border-bottom: 1px solid #a50000;
    }

    .status_order:hover{
        color: #a50000;
    }
</style>


<script>

    $('#collapsePesanan').addClass('show');
    $('#navbar-sales').addClass('active')

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    status = '4';

    $('.status_order').click(function(){

        $('.status_order').removeClass('status_selected');
        $(this).addClass('status_selected');

        status = $(this).attr('id').split('status_')[1];
        get_all_orders();
    })

    get_all_orders();

    //get all products
    function get_all_orders(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_orders', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {status: status},
            success     : function(data){

                console.log(data);

                html = '';
                data.forEach(function(data){

                    date = new Date(data.selesai_date);
                    html += '<tr class="hover-active">' +
                        ' <td style="display: none;">'+ data.bukti_web_so_m +'</td>'+
                        ' <td style="display: none;">'+ date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() +'</td>'+
                    '                      <td style="width: 25%">'+ data.tgl_web_so_m +'</td>\n'+
                    '                      <td style="width: 25%">'+ data.selesai_date +'</td>\n'+
                        '                      <td style="width: 25%;">'+ data.bukti_web_so_m +'</td>\n' +
                        '                      <td style="width: 25%; text-align: right;">'+ convertToRupiah(data.grand_total_web_so_m) +'</td>\n' +
                        '                    </tr>';


                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                datatable_init(3);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('#dataTable').on( 'click', 'tbody tr', function () {

        bukti_web_so_m = $('#dataTable').DataTable().row( this ).data()[0];
        var win = window.open('<?php echo base_url('admin/orders?no=')?>' + bukti_web_so_m, '_blank');
        if (win) {
            //Browser has allowed it to be opened
            win.focus();
        } else {
            //Browser has blocked it
            alert('Aktifkan pop-up untuk situs ini');
        }

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

</script>

