

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Laporan Arus Kas</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Laporan Arus Kas</h6>
        </div>
        <div class="card-body" style="overflow-x: auto">
            <div>
                <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="aruskas_table">
                    <tr style="visibility: hidden;">
                        <th style="width: 5%"></th>
                        <th style="width: 20%"></th>
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
                            echo strtoupper($bulan[((int)$_SESSION['laporan_bulan'])])
                            ?>
                        </th>
                        <th colspan="3" class="right_side">
                            <?php
                            $var = $_SESSION['awal_periode'];
                            $date = str_replace('/', '-', $var);
                            echo date("d-M-Y", strtotime($date));
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
                    <tr id="saldokas_row">
                        <th colspan="2" class="left_side"> SALDO KAS </th>
                        <th colspan="3" class="middle_side"></th>
                        <th colspan="3" class="right_side"></th>
                    </tr>
                    <tr id="aruskas_row">
                        <th colspan="2" class="left_side"> ARUS KAS </th>
                        <th colspan="3" class="middle_side"></th>
                        <th colspan="3" class="right_side"></th>
                    </tr>
                    <tr id="kasbank_row">
                        <th colspan="2" class="left_side"> KAS & BANK </th>
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
        get_laporan_arus_kas();
        get_kas_bank();
    })


    function get_laporan_arus_kas(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_laporan_arus_kas', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                prev_name = '';
                first = true;
                aruskas_grand_total = 0;
                aruskas_monthly_total = 0;
                aktivitas_monthly_total = 0;
                aktivitas_grand_total = 0;
                monthly_penerimaan_kas = 0;
                monthly_pengeluaran_kas = 0;
                total_penerimaan_kas = 0;
                total_pengeluaran_kas = 0;

                data.forEach(function(data, i) {

                    if(prev_name != data.aktivitas_arus_kas){
                        if(!first){
                            html += '<tr>\n' +
                                '<th></th>\n' +
                                '<th></th>\n' +
                                '<th colspan="3" style="text-align: right">'+ convertToRupiah(aktivitas_monthly_total) +'</th>\n' +
                                '<th colspan="3" style="text-align: right">'+ convertToRupiah(aktivitas_grand_total) +'</th>\n' +
                                '</tr>';

                            aktivitas_monthly_total = 0;
                            aktivitas_grand_total = 0;
                        }
                        html += '<tr>\n' +
                            '                        <th colspan="8" style="background-color: #dedede">'+ data.aktivitas_arus_kas +'</th>\n' +
                            '                    </tr>';
                    }

                    html += '<tr class="tr-hover">\n' +
                        '                            <td>'+ (i + 1) +'</td>\n' +
                        '                            <td>'+ data.nama_arus_kas +'</td>\n' +
                        '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>\n' +
                        '                            <td colspan="3" style="text-align: right;">'+ convertToRupiah(data.TOTAL) +'</td>\n' +
                        '                        </tr>';

                    aktivitas_monthly_total += parseInt(data.MONTHLY_TOTAL);
                    aktivitas_grand_total += parseInt(data.TOTAL);

                    aruskas_monthly_total += parseInt(data.MONTHLY_TOTAL);
                    aruskas_grand_total += parseInt(data.TOTAL);

                    if(data.nama_arus_kas.includes("Deb")){
                        monthly_penerimaan_kas += parseInt(data.MONTHLY_TOTAL);
                        total_penerimaan_kas += parseInt(data.TOTAL);
                    } else {
                        monthly_pengeluaran_kas += parseInt(data.MONTHLY_TOTAL);
                        total_pengeluaran_kas += parseInt(data.TOTAL);
                    }

                    prev_name = data.aktivitas_arus_kas;
                    first = false;
                })

                html += '<tr>\n' +
                    '<th></th>\n' +
                    '<th></th>\n' +
                    '<th colspan="3" style="text-align: right">'+ convertToRupiah(aktivitas_monthly_total) +'</th>\n' +
                    '<th colspan="3" style="text-align: right">'+ convertToRupiah(aktivitas_grand_total) +'</th>\n' +
                    '</tr>';

                html += '<tr>\n' +
                    '                        <th colspan="2"> TOTAL </th>\n' +
                    '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(aruskas_monthly_total) +'</th>\n' +
                    '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(aruskas_grand_total) +'</th>\n' +
                    '                    </tr>' +
                    '<tr>\n' +
                    '                        <th colspan="8"><span style="visibility: hidden">p</span></th>\n' +
                    '                    </tr>';

                $('#aruskas_row').after(html);

                get_saldo_kas(monthly_penerimaan_kas,total_penerimaan_kas,monthly_pengeluaran_kas,total_pengeluaran_kas);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    function get_saldo_kas(monthly_penerimaan_kas, total_penerimaan_kas, monthly_pengeluaran_kas, total_pengeluaran_kas){
        monthly_calc = monthly_penerimaan_kas + monthly_pengeluaran_kas;
        calc = total_penerimaan_kas + total_pengeluaran_kas;

        html = '<tr class="tr-hover">\n' +
            '                        <td> 1 </td>\n' +
            '                        <td> Penerimaan Kas </td>\n' +
            '                        <td colspan="3" style="text-align: right">'+ convertToRupiah(monthly_penerimaan_kas) +'</td>\n' +
            '                        <td colspan="3" style="text-align: right">'+ convertToRupiah(total_penerimaan_kas) +'</td>\n' +
            '                    </tr>\n' +
            '                    <tr class="tr-hover">\n' +
            '                        <td> 2 </td>\n' +
            '                        <td> Pengeluaran Kas </td>\n' +
            '                        <td colspan="3" style="text-align: right">'+ convertToRupiah(monthly_pengeluaran_kas) +'</td>\n' +
            '                        <td colspan="3" style="text-align: right">'+ convertToRupiah(total_pengeluaran_kas) +'</td>\n' +
            '                    </tr>\n' +
            '                    <tr>\n' +
            '                        <th colspan="2"> Saldo Kas </th>\n' +
            '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(monthly_calc) +'</th>\n' +
            '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(calc) +'</th>\n' +
            '                    </tr>\n' +
            '                    <tr>\n' +
            '                        <th colspan="8"><span style="visibility: hidden">p</span></th>\n' +
            '                    </tr>';

        $('#saldokas_row').after(html);

    }

    function get_kas_bank(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_kas_bank', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {

                monthly_total = 0;
                grand_total = 0;

                html = '<tr style="text-align: right">' +
                    '<th>No</th>' +
                    '<th style="text-align: left;">Rekening</th>' +
                    '<th>+</th>' +
                    '<th>-</th>' +
                    '<th>=</th>' +
                    '<th>+</th>' +
                    '<th>-</th>' +
                    '<th>=</th>' +
                    '</tr>';

                data.forEach(function(data, i) {
                    html += '<tr class="tr-hover" style="text-align: right">' +
                        '       <td>'+ data.no_rekening +'</td>' +
                        '       <td style="text-align: left;"><strong>'+ data.nama_rekening +'</strong></td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_DEBET) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_KREDIT) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL_DEBET) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL_KREDIT) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL) +'</td>' +
                            '</tr>';


                    monthly_total += parseInt(data.MONTHLY_TOTAL);
                    grand_total += parseInt(data.TOTAL);
                });

                html += '<tr>\n' +
                    '                        <th colspan="2"> TOTAL </th>\n' +
                    '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(monthly_total) +'</th>\n' +
                    '                        <th colspan="3" style="text-align: right">'+ convertToRupiah(grand_total) +'</th>\n' +
                    '                    </tr>' +
                    '   <tr>\n' +
                    '                        <th colspan="8"><span style="visibility: hidden">p</span></th>\n' +
                    '                    </tr>';

                $('#kasbank_row').after(html);

            }
        })
    }



</script>
