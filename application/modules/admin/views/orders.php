

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Daftar Pesanan</h1>
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

    <button class="btn btn-primary upload-excel" style="background: #a50000; color: white; "> <i class="fas fa-upload"></i> Upload Resi Bulky </button>
    <button class="btn btn-primary download-excel" style="background: #a50000; color: white; "> <i class="fas fa-download"></i> Download Transaksi </button></a>
    <br><br>
    <!-- <button class="btn btn-primary add-user" style="background: #a50000; color: white; width: 300px;"> Tambah Alamat </button>-->

    <table style="width: 100%; height:50px; background: white; text-align: center; cursor: pointer;"><tr style="background: lightgrey">
            <td class="status_order status_selected" id="status_all"> Semua </td>
            <td class="status_order" id="status_1"> Diterima </td>
            <td class="status_order" id="status_2"> Diproses </td>
            <td class="status_order" id="status_3"> Dikirim </td>
            <td class="status_order" id="status_4"> Selesai </td>
            <td class="status_order" id="status_5"> Dibatalkan </td>
        </tr></table>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="display: none;"> Tgl Filter </th>
                        <th> Informasi Pesanan </th>
                        <th> Alamat Kirim </th>
                        <th> Status Pesanan </th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="upload-excel-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="excel-form">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                        <label class="custom-file-label" for="validatedCustomFile">Pilih file</label>
                    </div>
                    <br>
                    <div class="alert alert-danger excel-error" role="alert" style="display: none; font-size: 13px; margin-top: 10px;">
                        <strong>Terdapat kesalahan dalam file:</strong>
                        <div class="excel-error-content">

                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary final-upload-excel">Upload</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="download-excel-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Download Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control" name="tipe_download" id="tipe_download">
                    <option value="all">Semua Transaksi</option>
                    <option value="1"> Diterima </option>
                    <option value="2"> Diproses </option>
                    <option value="3"> Dikirim </option>
                    <option value="4"> Selesai </option>
                    <option value="5"> Dibatalkan </option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary final-download-excel">Download</button>
            </div>
        </div>
    </div>
</div>

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
    $('#navbar-orders').addClass('active');

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';

    status = 'all';

    $('.upload-excel').click(function(e){
        e.preventDefault();
        $('#upload-excel-modal').modal('show');
        $('#excel-form')[0].reset();
        $('.custom-file-label').html('Pilih file...');
        $('.excel-error').css('display', 'none');
    })

    $('#validatedCustomFile').change(function(){
        filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('.custom-file-label').html(filename);
    })

    $('.status_order').click(function(){

        $('.status_order').removeClass('status_selected');
        $(this).addClass('status_selected');

        status = $(this).attr('id').split('status_')[1];
        get_all_orders();
    })

    $('.download-excel').click(function(e){
        e.preventDefault();
        $('#download-excel-modal').modal('show');
    })


    $('.final-download-excel').click(function(e){
        location.href = admin_url + 'download_excel_transaksi?status=' + $('#tipe_download').val();
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

                html = '';
                data.forEach(function(data){

                    date = new Date(data.tgl_web_so_m);
                    html += '<tr class="hover-active">' +
                        ' <td style="display: none;">'+ data.bukti_web_so_m +'</td>'+
                        ' <td style="display: none;">'+ date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() +'</td>'+
                    '                      <td style="width: 35%"><span style="font-size: 11px;">User: '+ data.email_web_user +'</span><br><strong>No. '+ data.bukti_web_so_m +'</strong><br><span style="font-size: 13px;">Tgl '+ data.tgl_web_so_m +'</span><br><strong style="color: #a50000">'+ convertToRupiah(data.grand_total_web_so_m) +'</strong></td>\n'+
                        '                      <td style="width: 40%;">'+ data.nama_web_user_alamat +' <br> '+ data.telp_web_user_alamat +'<br>'+ data.alamat_web_user_alamat +'<br>'+ data.kecamatan_web_user_alamat +', '+ data.kota_web_user_alamat +', '+ data.provinsi_web_user_alamat +'</td>\n' +
                        '                      <td style="width: 25%">'+ status_pesanan(data.status_web_so_m, data.paid_by_user, data.is_refunded) +'</td>\n' +
                        '                    </tr>';


                })

                $('.daterangepicker').remove();
                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                datatable_init();

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
        url: admin_url + 'get_grouped_daily_order', // the url where we want to POST// our data object
        dataType: 'json',
        data: {days_num: 10},
        success: function (data) {
            statistic(data, false, 'Jumlah: ');
        }
    })

    $('.final-upload-excel').click(function(e){
        e.preventDefault();

        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        var formData =new FormData();
        formData.append('excel_file', $('#validatedCustomFile')[0].files[0]); //use get('files')[0]
        formData.append('tipe',$('#tipe_excel_selector').val());


        $.ajax({
            url : admin_url + 'upload_excel_resi',
            dataType : 'json',
            cache : false,
            contentType : false,
            processData : false,
            data : formData, //formdata will contain all the other details with a name given to parameters
            type : 'post',
            success : function(response) {
                if(response.Status == "OK"){
                    $('#upload-excel-modal').modal('hide');
                    show_snackbar(response.Message);
                    get_all_orders();
                } else if (response.Status == "ERRORS"){
                    console.log(response.Errors);
                    $('.excel-error').css('display', 'block');
                    html_error = '<ul>';
                    response.Errors.forEach(function(error){
                        html_error += '<li>'+ error +'</li>';
                    })
                    html_error += '</ul>';
                    $('.excel-error-content').html(html_error);
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        });

    })


</script>
