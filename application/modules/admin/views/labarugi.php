

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laba Rugi</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laba Rugi</h6>
        </div>
        <div class="card-body" style="overflow-x: auto">
            <div>
                <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="labarugi_table">
                    <tr style="visibility: hidden;">
                        <th style="width: 7.5%"></th>
                        <th style="width: 17.5%"></th>
                        <?php
                        for ($x = 0; $x < 6; $x++) {
                            echo '<th class="initial_cell"></th>';
                        }
                        ?>
                    </tr>
                    <tr>
                        <th colspan="2" class="left_side"> PERIODE </th>
                        <th colspan="3" class="middle_side">
                            <?php
                            $bulan = array("Saldo Awal", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember", "Penyesuaian");
                            echo strtoupper($bulan[$_SESSION['laporan_bulan']])
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

                                         if($_SESSION['laporan_bulan'] != '13'){
                                             $var = $_SESSION['akhir_periode'];
                                             $date = str_replace('/', '-', $var);
                                             echo date("d-M-Y", strtotime($date) );
                                         } else {
                                             echo "31-Jan-".((int)$_SESSION['laporan_tahun'] + 1);
                                         }

                                         ?>
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" class="left_side"> LABA (RUGI) </th>
                        <th colspan="3" class="middle_side"></th>
                        <th colspan="3" class="right_side"></th>
                    </tr>

                </table>

            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    $(document).ready(function(){
        get_laba_rugi();
    })


    function get_laba_rugi(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_laba_rugi', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){

                total_40 = 0;
                monthly_total_40 = 0;
                total_50 = 0;
                monthly_total_50 = 0;

                html_40 = '<tr><td colspan="8" style="background-color: rgba(243,243,243,1)"> <strong>Pendapatan</strong></td></tr>\n' +
                    '                    <tr>\n' +
                    '                        <th> No. </th>\n' +
                    '                        <th> Rekening </th>\n' +
                    '                        <th colspan="6" style="text-align: right;">Jumlah</th>\n' +
                    '                    </tr>';
                html_50 = '<tr><td colspan="8" style="background-color: rgba(243,243,243,1)"> <strong>Biaya</strong></td></tr>\n' +
                    '                    <tr>\n' +
                    '                        <th> No. </th>\n' +
                    '                        <th> Rekening </th>\n' +
                    '                        <th colspan="6" style="text-align: right;">Jumlah</th>\n' +
                    '                    </tr>';

                data.forEach(function(data, i){

                    if(data.no_golongan == '40'){
                        html_40 += '<tr class="tr-hover">\n' +
                            '                            <td>'+ data.no_rekening +'</td>\n' +
                            '                            <td>'+ data.nama_rekening +'</td>\n' +
                            '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>\n' +
                            '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                            '                        </tr>';

                        total_40 += parseInt(data.TOTAL);
                        monthly_total_40 += parseInt(data.MONTHLY_TOTAL);

                    } else if(data.no_golongan == '50') {
                        html_50 += '<tr class="tr-hover">\n' +
                            '                            <td>'+ data.no_rekening +'</td>\n' +
                            '                            <td>'+ data.nama_rekening +'</td>\n' +
                            '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>\n' +
                            '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                            '                        </tr>';

                        total_50 += parseInt(data.TOTAL);
                        monthly_total_50 += parseInt(data.MONTHLY_TOTAL);
                    }

                })

                html_40 += '<tr class="tr-hover">\n' +
                    '                            <td></td>\n' +
                    '                            <td><strong>Total Pendapatan</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(monthly_total_40) +'</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(total_40) +'</strong></td>\n' +
                    '                        </tr>';

                html_50 += '<tr class="tr-hover">\n' +
                    '                            <td></td>\n' +
                    '                            <td><strong>Total Biaya</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(monthly_total_50) +'</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(total_50) +'</strong></td>\n' +
                    '                        </tr>';

                $('#labarugi_table tr:last').after(html_40);
                $('#labarugi_table tr:last').after(html_50);

                final_monthly = parseInt(monthly_total_40) - parseInt(monthly_total_50);
                final_total = parseInt(total_40) - parseInt(total_50);

                laba_or_rugi =(final_total > 0) ?  "LABA"  :  "RUGI";

                html_footer = '<tr class="tr-hover" style="background-color: #dedede">\n' +
                    '                            <td></td>\n' +
                    '                            <td><strong>'+ laba_or_rugi +'</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(final_monthly) +'</strong></td>\n' +
                    '                            <td colspan="3" style="text-align: right;"><strong>'+ convertToRupiah(final_total) +'</strong></td>\n' +
                    '                        </tr>';


                $('#labarugi_table tr:last').after(html_footer);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }



</script>
