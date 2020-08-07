

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Neraca</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laba (Rugi)</h6>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="labarugi_table">
                    <tr style="visibility: hidden;">
                        <?php
                        for ($x = 0; $x < 8; $x++) {
                            echo '<th class="initial_cell"></th>';
                        }
                        ?>
                    </tr>
                    <tr>
                        <th colspan="2" class="left_side"> PERIODE </th>
                        <th colspan="3" class="middle_side">
                            <?php
                                $monthName = date("F", mktime(0, 0, 0, $_SESSION['laporan_bulan'], 10));
                                echo strtoupper($monthName);
                            ?>
                        </th>
                        <th colspan="3" class="right_side">
                            <?php
                            $var = $_SESSION['awal_periode'];
                            $date = str_replace('/', '-', $var);
                            echo date("d-M-Y", strtotime($date) );
                            ?>
                            sampai dengan <span class="akhir-periode-string">
                                         <?php

                                         $var = $_SESSION['akhir_periode'];
                                         $date = str_replace('/', '-', $var);
                                         echo date("d-M-Y", strtotime($date) );

                                         ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="left_side"> LABA (RUGI) </th>
                        <th colspan="3" class="middle_side"></th>
                        <th colspan="3" class="right_side"></th>
                    </tr>
                    <tr>
                        <th> No. </th>
                        <th> Ket. </th>
                        <th colspan="6" style="text-align: right;">Jumlah</th>
                    </tr>

                </table>

            </div>
        </div>

    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Neraca</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered display nowrap" width="100%" cellspacing="0" style="margin-bottom: 0;">
                <tr style="visibility: hidden;" >
                    <?php
                    for ($x = 0; $x < 8; $x++) {
                        echo '<th class="initial_cell"></th>';
                    }
                    ?>
                </tr>
                <tr>
                    <th colspan="2" class="left_side"> Neraca </th>
                    <th colspan="6" class="right_side"></th>
                </tr>
            </table>

            <div class="row">
                <div class="col-lg-6 mb-4">
                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="asetlancar_table">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #dceafd;">Aset Lancar</th>
                        </tr>
                    </table>

                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="asettetap_table">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #dceafd;">Aset Tetap</th>
                        </tr>
                    </table>
                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #dceafd; text-align: right"><span style="float: left">TOTAL ASET</span><span id="total_aset"></span></th>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-6 mb-4">
                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="kewajiban_table">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #fddce5;">Kewajiban</th>
                        </tr>
                    </table>

                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="ekuitas_table">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #fddce5;">Ekuitas</th>
                        </tr>
                    </table>
                    <table class="table table-bordered display nowrap" width="100%" cellspacing="0">
                        <tr style="visibility: hidden;" >
                            <th style="width: 10%"></th>
                            <th style="width: 35%"></th>
                            <?php
                            for ($x = 0; $x < 2; $x++) {
                                echo '<th class="secondary_cell"></th>';
                            }
                            ?>
                        </tr>
                        <tr>
                            <th colspan="4" style="background-color: #fddce5; text-align: right;"><span style="float: left">TOTAL KEWAJIBAN DAN EKUITAS</span><span id="total_kewajiban_ekuitas"></span></th>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<style>
    .tr-hover:hover{
        cursor: pointer;
        background: #ffe1dd;
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

    /* Limit image width to avoid overflow the container */
    img {
        max-width: 100%; /* This rule is very important, please do not ignore this! */
    }

    #canvas {
        height: 600px;
        width: 600px;
        background-color: #ffffff;
        cursor: default;
        border: 1px solid black;
    }

    .img-container {
        /* Never limit the container height here */
        max-width: 100%;
    }

    .img-container img {
        /* This is important */
        width: 100%;
    }

    .cropper-container{
        max-width: 740px !important;
        margin-bottom: 60px;
    }

    tr{
        font-size: 14px;
    }

    th{
        color: black;
    }

    td{
        color: #333333;
    }

    td, th{
        padding: 0.4rem !important;
    }

    .left_side{
        background-color: rgba(183,214,170,1);
        color: rgba(40,77,23,1);

    }

    .middle_side{
        text-align: center;
        background-color: rgba(160,198,230,1);
        color: rgba(13,58,100,1);
    }

    .right_side{
        text-align: center;
        background-color: rgba(120,165,174,1);
        color: rgba(37,77,86,1);
    }

    .initial_cell{
        width: 12.5%;
    }

    .secondary_cell{
        width: 25%;
    }
</style>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    $(document).ready(function(){
        get_saldo_golongan();
    })


    function get_saldo_golongan(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_saldo_golongan', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                length = data.length;
                html_labarugi = '';
                html_asetlancar = '';
                html_asettetap = '';
                html_kewajiban = '';
                html_ekuitas = '';

                labarugi_monthly_total = 0;
                labarugi_total = 0;
                asetlancar_total = 0;
                asettetap_total = 0;
                kewajiban_total = 0;
                ekuitas_total = 0;
                total_surplus_modal = 0;

                data.forEach(function(data, i){

                   if(data.neraca.trim() == 'Laba Rugi'){
                       html_labarugi += '<tr>\n' +
               '                            <td>'+ data.no_golongan +'</td>\n' +
               '                            <td>'+ data.nama_golongan +'</td>\n' +
               '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>\n' +
               '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
               '                        </tr>';

                       if(data.nama_golongan.trim() == 'Pendapatan'){
                           labarugi_monthly_total += parseInt(data.MONTHLY_TOTAL);
                           labarugi_total += parseInt(data.TOTAL);
                       } else {
                           labarugi_monthly_total -= parseInt(data.MONTHLY_TOTAL);
                           labarugi_total -= parseInt(data.TOTAL);
                       }

                   } else if(data.neraca.trim() == 'Aset Lancar'){
                       html_asetlancar += '<tr>\n' +
                           '                            <td>'+ data.no_golongan +'</td>\n' +
                           '                            <td>'+ data.nama_golongan +'</td>\n' +
                           '                            <td colspan="2" style="text-align: right">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                           '                        </tr>';

                       asetlancar_total += parseInt(data.TOTAL);
                   } else if(data.neraca.trim() == 'Aset Tetap'){
                       html_asettetap += '<tr>\n' +
                           '                            <td>'+ data.no_golongan +'</td>\n' +
                           '                            <td>'+ data.nama_golongan +'</td>\n' +
                           '                            <td colspan="2" style="text-align: right">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                           '                        </tr>';

                       asettetap_total += parseInt(data.TOTAL);
                   } else if(data.neraca.trim() == 'Kewajiban'){
                       html_kewajiban += '<tr>\n' +
                           '                            <td>'+ data.no_golongan +'</td>\n' +
                           '                            <td>'+ data.nama_golongan +'</td>\n' +
                           '                            <td colspan="2" style="text-align: right">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                           '                        </tr>';

                       kewajiban_total += parseInt(data.TOTAL);
                   } else if(data.neraca.trim() == 'Modal'){
                       html_ekuitas += ' <tr>\n' +
                           '                            <td>'+ data.no_golongan +'</td>\n' +
                           '                            <td>'+ data.nama_golongan +'</td>\n';

                       if(data.nama_golongan.trim() == 'Modal'){
                           html_ekuitas += '                            <td style="text-align: right"></td>\n' +
                               '                            <td style="text-align: right">'+ convertToRupiah(data.TOTAL) +'</td>' +
                               '</tr>' +
                               ' <tr>\n' +
                               '                            <td></td>\n' +
                               '                            <td>Laba</td>\n' +
                               '                            <td style="text-align: right" id="labarugitotal"></td>\n' +
                               '                            <td style="text-align: right"></td>';
                       } else {
                           html_ekuitas += '                            <td style="text-align: right">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                               '                            <td style="text-align: right"></td>';

                           total_surplus_modal += parseInt(data.TOTAL);
                       }

                       html_ekuitas +=  '</tr>';
                       ekuitas_total += parseInt(data.TOTAL);
                   }


                })

                // TOTAL row
                laba_or_rugi = (labarugi_total > 0) ? 'LABA' : 'RUGI'
                html_labarugi += '<tr>\n' +
                    '                        <th colspan="2" style="text-align: center">'+ laba_or_rugi +'</th>\n' +
                    '                        <th colspan="3" style="text-align: right;">'+ convertToRupiah(labarugi_monthly_total) +'</th>\n' +
                    '                        <th colspan="3" style="text-align: right;">'+ convertToRupiah(labarugi_total) +'</th>\n' +
                    '                    </tr>';

                html_asetlancar += '<tr> <td colspan="4" style="text-align: right"><strong>'+ convertToRupiah(asetlancar_total) +'</strong></td> </tr>';
                html_asettetap += '<tr> <td colspan="4" style="text-align: right"><strong>'+ convertToRupiah(asettetap_total) +'</strong></td> </tr>';
                html_kewajiban += '<tr> <td colspan="4" style="text-align: right"><strong>'+ convertToRupiah(kewajiban_total) +'</strong></td> </tr>';


                total_surplus_modal += labarugi_total;

                html_ekuitas += '<tr>' +
                    '<td></td>' +
                    '<td> Surplus Modal </td>' +
                    '<td style="text-align: right"></td>' +
                    '<td style="text-align: right">'+ convertToRupiah(total_surplus_modal) +'</td>' +
                    '</tr>' +
                    '<tr> <td colspan="4" style="text-align: right"><strong><span style="float: left;">Modal Akhir: </span>'+ convertToRupiah(ekuitas_total + total_surplus_modal) +'</strong></td> </tr>';

                $('#labarugi_table tr:last').after(html_labarugi);
                $('#asetlancar_table tr:last').after(html_asetlancar);
                $('#asettetap_table tr:last').after(html_asettetap);
                $('#kewajiban_table tr:last').after(html_kewajiban);
                $('#ekuitas_table tr:last').after(html_ekuitas);


                $('#labarugitotal').html(convertToRupiah(labarugi_total));


                total_aset = asetlancar_total + asettetap_total;
                total_kewajiban_ekuitas = kewajiban_total + ekuitas_total + total_surplus_modal;

                $('#total_aset').html(convertToRupiah(total_aset));
                $('#total_kewajiban_ekuitas').html(convertToRupiah(total_kewajiban_ekuitas));

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }



</script>
