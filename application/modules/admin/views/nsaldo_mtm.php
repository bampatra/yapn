<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Neraca Saldo (Bulanan)</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Neraca Saldo (Bulanan)</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr style="visibility: hidden;">
                        <?php
                        for ($x = 0; $x < 17; $x++) {
                            echo '<th></th>';
                        }
                        ?>
                    </tr>
                    <tr>
                        <th colspan="2" class="middle_side"> REKENING </th>
                        <th colspan="15" class="middle_side">
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
                        <th>No</th>
                        <th style="text-align: left;">Rekening</th>
                        <?php
                        $bulan_list = array("SALDO AWAL", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember", "PENYESUAIAN");
                        foreach($bulan_list as $bulan){
                            echo("<th>".strtoupper($bulan)."</th>"."\n");
                        }
                        ?>
                        <th>TOTAL</th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                    <tfoot id="footer-content">

                    </tfoot>
                </table>

            </div>
        </div>

    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
    $(document).ready(function(){
        get_nsaldo_mtm();
    })


    function get_nsaldo_mtm(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_nsaldo_mtm', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {

                // monthly_total = 0;
                // grand_total = 0;

                prev_gol = 0;
                total_saldoawal = total_jan = total_feb = total_mar = total_apr = total_may = total_jun = total_jul = total_aug = total_sep = total_oct = total_nov = total_dec = total_adj = total_all = 0;
                total2_saldoawal = total2_jan = total2_feb = total2_mar = total2_apr = total2_may = total2_jun = total2_jul = total2_aug = total2_sep = total2_oct = total2_nov = total2_dec = total2_adj = total2_all = 0;
                total3_saldoawal = total3_jan = total3_feb = total3_mar = total3_apr = total3_may = total3_jun = total3_jul = total3_aug = total3_sep = total3_oct = total3_nov = total3_dec = total3_adj = total3_all = 0;
                start = start2 = true;
                total_aset_tetap = 0;


                html = '';

                data.forEach(function(data, i) {

                    if(data.parent_rekening == '0' && !start){

                        if(data.no_rekening == '300'){
                            row_level = "row_level3"
                        } else if(data.no_rekening == '200'){
                            row_level = "row_level2"
                        } else {
                            row_level = "row_level1"
                        }


                        html += '<tr class="'+ row_level+'">' +
                            '       <td></td>' +
                            '       <td></td>' +
                            '       <th>'+ convertToRupiah(total_saldoawal) +'</th>' +
                            '       <th>'+ convertToRupiah(total_jan) +'</th>' +
                            '       <th>'+ convertToRupiah(total_feb) +'</th>' +
                            '       <th>'+ convertToRupiah(total_mar) +'</th>' +
                            '       <th>'+ convertToRupiah(total_apr) +'</th>' +
                            '       <th>'+ convertToRupiah(total_may) +'</th>' +
                            '       <th>'+ convertToRupiah(total_jun) +'</th>' +
                            '       <th>'+ convertToRupiah(total_jul) +'</th>' +
                            '       <th>'+ convertToRupiah(total_aug) +'</th>' +
                            '       <th>'+ convertToRupiah(total_sep) +'</th>' +
                            '       <th>'+ convertToRupiah(total_oct) +'</th>' +
                            '       <th>'+ convertToRupiah(total_nov) +'</th>' +
                            '       <th>'+ convertToRupiah(total_dec) +'</th>' +
                            '       <th>'+ convertToRupiah(total_adj) +'</th>' +
                            '       <th>'+ convertToRupiah(total_all) +'</th>' +
                            '</tr>';


                        if(data.no_rekening != '300') {
                            total2_saldoawal += parseInt(total_saldoawal);
                            total2_jan += parseInt(total_jan);
                            total2_feb += parseInt(total_feb);
                            total2_mar += parseInt(total_mar);
                            total2_apr += parseInt(total_apr);
                            total2_may += parseInt(total_may);
                            total2_jun += parseInt(total_jun);
                            total2_jul += parseInt(total_jul);
                            total2_aug += parseInt(total_aug);
                            total2_sep += parseInt(total_sep);
                            total2_oct += parseInt(total_oct);
                            total2_nov += parseInt(total_nov);
                            total2_dec += parseInt(total_dec);
                            total2_adj += parseInt(total_adj);
                            total2_all += parseInt(total_all);
                        }

                        total_saldoawal = total_jan = total_feb = total_mar = total_apr = total_may = total_jun = total_jul = total_aug = total_sep = total_oct = total_nov = total_dec = total_adj = total_all = 0;
                    }

                    if(prev_gol != data.no_golongan && data.parent_rekening == '0' && !start){

                        if(prev_gol == '11'){
                            html += '<tr class="row_level2">' +
                                '       <td></td>' +
                                '       <th>TOTAL ASET LANCAR</th>' +
                                '       <th>'+ convertToRupiah(total2_saldoawal) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jan) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_feb) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_mar) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_apr) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_may) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jun) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jul) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_aug) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_sep) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_oct) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_nov) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_dec) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_adj) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_all) +'</th>' +
                                '</tr>';

                            total3_saldoawal += parseInt(total_saldoawal);
                            total3_jan += parseInt(total2_jan);
                            total3_feb += parseInt(total2_feb);
                            total3_mar += parseInt(total2_mar);
                            total3_apr += parseInt(total2_apr);
                            total3_may += parseInt(total2_may);
                            total3_jun += parseInt(total2_jun);
                            total3_jul += parseInt(total2_jul);
                            total3_aug += parseInt(total2_aug);
                            total3_sep += parseInt(total2_sep);
                            total3_oct += parseInt(total_oct);
                            total3_nov += parseInt(total2_nov);
                            total3_dec += parseInt(total2_dec);
                            total3_adj += parseInt(total2_adj);
                            total3_all += parseInt(total2_all);

                            total2_saldoawal = total2_jan = total2_feb = total2_mar = total2_apr = total2_may = total2_jun = total2_jul = total2_aug = total2_sep = total2_oct = total2_nov = total2_dec = total2_adj = total2_all = 0;
                        }

                        if(data.no_rekening == '200'){

                            total3_saldoawal += parseInt(total_saldoawal);
                            total3_jan += parseInt(total2_jan);
                            total3_feb += parseInt(total2_feb);
                            total3_mar += parseInt(total2_mar);
                            total3_apr += parseInt(total2_apr);
                            total3_may += parseInt(total2_may);
                            total3_jun += parseInt(total2_jun);
                            total3_jul += parseInt(total2_jul);
                            total3_aug += parseInt(total2_aug);
                            total3_sep += parseInt(total2_sep);
                            total3_oct += parseInt(total_oct);
                            total3_nov += parseInt(total2_nov);
                            total3_dec += parseInt(total2_dec);
                            total3_adj += parseInt(total2_adj);
                            total3_all += parseInt(total2_all);

                            total2_saldoawal = total2_jan = total2_feb = total2_mar = total2_apr = total2_may = total2_jun = total2_jul = total2_aug = total2_sep = total2_oct = total2_nov = total2_dec = total2_adj = total2_all = 0;

                            html += '<tr class="row_level3">' +
                                '       <td></td>' +
                                '       <th>TOTAL ASET</th>' +
                                '       <th>'+ convertToRupiah(total3_saldoawal) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_jan) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_feb) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_mar) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_apr) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_may) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_jun) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_jul) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_aug) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_sep) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_oct) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_nov) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_dec) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_adj) +'</th>' +
                                '       <th>'+ convertToRupiah(total3_all) +'</th>' +
                                '</tr>';

                            total3_saldoawal = total3_jan = total3_feb = total3_mar = total3_apr = total3_may = total3_jun = total3_jul = total3_aug = total3_sep = total3_oct = total3_nov = total3_dec = total3_adj = total3_all = 0;
                        }


                    }


                    if(data.parent_rekening == '0' && data.is_title == '1'){
                        html += '<tr class="tr-hover" style="background-color: rgba(183,214,170,1);">' +
                            '<td></td>' +
                            '<td><strong>'+ data.nama_rekening +'</strong></td>';


                        for (i = 0; i < 15; i++) {
                            html += '<td></td>';
                        }

                        html +=   '</tr>';
                        return;
                    }



                    if((data.nama_parent_rekening.trim() == 'Modal' || data.nama_rekening.trim() == 'Modal') && prev_gol != data.no_golongan){

                        if(!start2){
                            html += '<tr class="row_level1">' +
                                '       <td></td>' +
                                '       <td></td>' +
                                '       <th>'+ convertToRupiah(total_saldoawal) +'</th>' +
                                '       <th>'+ convertToRupiah(total_jan) +'</th>' +
                                '       <th>'+ convertToRupiah(total_feb) +'</th>' +
                                '       <th>'+ convertToRupiah(total_mar) +'</th>' +
                                '       <th>'+ convertToRupiah(total_apr) +'</th>' +
                                '       <th>'+ convertToRupiah(total_may) +'</th>' +
                                '       <th>'+ convertToRupiah(total_jun) +'</th>' +
                                '       <th>'+ convertToRupiah(total_jul) +'</th>' +
                                '       <th>'+ convertToRupiah(total_aug) +'</th>' +
                                '       <th>'+ convertToRupiah(total_sep) +'</th>' +
                                '       <th>'+ convertToRupiah(total_oct) +'</th>' +
                                '       <th>'+ convertToRupiah(total_nov) +'</th>' +
                                '       <th>'+ convertToRupiah(total_dec) +'</th>' +
                                '       <th>'+ convertToRupiah(total_adj) +'</th>' +
                                '       <th>'+ convertToRupiah(total_all) +'</th>' +
                                '</tr>';

                            total2_saldoawal += parseInt(total_saldoawal);
                            total2_jan += parseInt(total_jan);
                            total2_feb += parseInt(total_feb);
                            total2_mar += parseInt(total_mar);
                            total2_apr += parseInt(total_apr);
                            total2_may += parseInt(total_may);
                            total2_jun += parseInt(total_jun);
                            total2_jul += parseInt(total_jul);
                            total2_aug += parseInt(total_aug);
                            total2_sep += parseInt(total_sep);
                            total2_oct += parseInt(total_oct);
                            total2_nov += parseInt(total_nov);
                            total2_dec += parseInt(total_dec);
                            total2_adj += parseInt(total_adj);
                            total2_all += parseInt(total_all);

                            total_saldoawal = total_jan = total_feb = total_mar = total_apr = total_may = total_jun = total_jul = total_aug = total_sep = total_oct = total_nov = total_dec = total_adj = total_all = 0;
                        }

                        if(data.no_rekening == "401"){
                            html += '<tr class="row_level2">' +
                                '       <td></td>' +
                                '       <th></th>' +
                                '       <th>'+ convertToRupiah(total2_saldoawal) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jan) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_feb) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_mar) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_apr) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_may) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jun) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_jul) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_aug) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_sep) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_oct) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_nov) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_dec) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_adj) +'</th>' +
                                '       <th>'+ convertToRupiah(total2_all) +'</th>' +
                                '</tr>';

                            total3_saldoawal += parseInt(total_saldoawal);
                            total3_jan += parseInt(total2_jan);
                            total3_feb += parseInt(total2_feb);
                            total3_mar += parseInt(total2_mar);
                            total3_apr += parseInt(total2_apr);
                            total3_may += parseInt(total2_may);
                            total3_jun += parseInt(total2_jun);
                            total3_jul += parseInt(total2_jul);
                            total3_aug += parseInt(total2_aug);
                            total3_sep += parseInt(total2_sep);
                            total3_oct += parseInt(total_oct);
                            total3_nov += parseInt(total2_nov);
                            total3_dec += parseInt(total2_dec);
                            total3_adj += parseInt(total2_adj);
                            total3_all += parseInt(total2_all);

                            total2_saldoawal = total2_jan = total2_feb = total2_mar = total2_apr = total2_may = total2_jun = total2_jul = total2_aug = total2_sep = total2_oct = total2_nov = total2_dec = total2_adj = total2_all = 0;
                        }

                        html += '<tr class="tr-hover" style="background-color: rgba(217,234,212,1)">' +
                            '<td></td>' +
                            '<td>'+ data.nama_golongan +'</td>';


                        for (i = 0; i < 15; i++) {
                            html += '<td></td>';
                        }

                        html +=   '</tr>';

                        start2 = false;
                    }

                    rekening_total =    parseInt(data.SALDOAWAL) +
                                        parseInt(data.JANUARY) +
                                        parseInt(data.FEBRUARY) +
                                        parseInt(data.MARCH) +
                                        parseInt(data.APRIL) +
                                        parseInt(data.MAY) +
                                        parseInt(data.JUNE) +
                                        parseInt(data.JULY) +
                                        parseInt(data.AUGUST) +
                                        parseInt(data.SEPTEMBER) +
                                        parseInt(data.OCTOBER) +
                                        parseInt(data.NOVEMBER) +
                                        parseInt(data.DECEMBER) +
                                        parseInt(data.ADJUSTMENT);

                    html += '<tr class="tr-hover" style="text-align: right">' +
                        '       <td>'+ data.no_rekening +'</td>' +
                        '       <td style="text-align: left;">' +
                        '           <strong>'+ data.nama_rekening +'</strong><br>' +
                        '           <span>S/N: '+ data.s_n_golongan +'</span><br>' +
                        '       </td>' +
                        '       <td>'+ convertToRupiah(data.SALDOAWAL) +'</td>' +
                        '       <td>'+ convertToRupiah(data.JANUARY) +'</td>' +
                        '       <td>'+ convertToRupiah(data.FEBRUARY) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MARCH) +'</td>' +
                        '       <td>'+ convertToRupiah(data.APRIL) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MAY) +'</td>' +
                        '       <td>'+ convertToRupiah(data.JUNE) +'</td>' +
                        '       <td>'+ convertToRupiah(data.JULY) +'</td>' +
                        '       <td>'+ convertToRupiah(data.AUGUST) +'</td>' +
                        '       <td>'+ convertToRupiah(data.SEPTEMBER) +'</td>' +
                        '       <td>'+ convertToRupiah(data.OCTOBER) +'</td>' +
                        '       <td>'+ convertToRupiah(data.NOVEMBER) +'</td>' +
                        '       <td>'+ convertToRupiah(data.DECEMBER) +'</td>' +
                        '       <td>'+ convertToRupiah(data.ADJUSTMENT) +'</td>' +
                        '       <td>'+ convertToRupiah(rekening_total) +'</td>' +
                        '</tr>';


                    total_saldoawal += parseInt(data.SALDOAWAL);
                    total_jan += parseInt(data.JANUARY);
                    total_feb += parseInt(data.FEBRUARY);
                    total_mar += parseInt(data.MARCH);
                    total_apr += parseInt(data.APRIL);
                    total_may += parseInt(data.MAY);
                    total_jun += parseInt(data.JUNE);
                    total_jul += parseInt(data.JULY);
                    total_aug += parseInt(data.AUGUST);
                    total_sep += parseInt(data.SEPTEMBER);
                    total_oct += parseInt(data.OCTOBER);
                    total_nov += parseInt(data.NOVEMBER);
                    total_dec += parseInt(data.DECEMBER);
                    total_adj += parseInt(data.ADJUSTMENT);
                    total_all += parseInt(rekening_total);


                    // monthly_total += parseInt(data.MONTHLY_TOTAL);
                    // grand_total += parseInt(data.TOTAL);

                    prev_gol = data.no_golongan;


                    start = false;

                });

                html += '<tr class="row_level1">' +
                    '       <td></td>' +
                    '       <td></td>' +
                    '       <th>'+ convertToRupiah(total_saldoawal) +'</th>' +
                    '       <th>'+ convertToRupiah(total_jan) +'</th>' +
                    '       <th>'+ convertToRupiah(total_feb) +'</th>' +
                    '       <th>'+ convertToRupiah(total_mar) +'</th>' +
                    '       <th>'+ convertToRupiah(total_apr) +'</th>' +
                    '       <th>'+ convertToRupiah(total_may) +'</th>' +
                    '       <th>'+ convertToRupiah(total_jun) +'</th>' +
                    '       <th>'+ convertToRupiah(total_jul) +'</th>' +
                    '       <th>'+ convertToRupiah(total_aug) +'</th>' +
                    '       <th>'+ convertToRupiah(total_sep) +'</th>' +
                    '       <th>'+ convertToRupiah(total_oct) +'</th>' +
                    '       <th>'+ convertToRupiah(total_nov) +'</th>' +
                    '       <th>'+ convertToRupiah(total_dec) +'</th>' +
                    '       <th>'+ convertToRupiah(total_adj) +'</th>' +
                    '       <th>'+ convertToRupiah(total_all) +'</th>' +
                    '</tr>';

                total2_saldoawal += parseInt(total_saldoawal);
                total2_jan += parseInt(total_jan);
                total2_feb += parseInt(total_feb);
                total2_mar += parseInt(total_mar);
                total2_apr += parseInt(total_apr);
                total2_may += parseInt(total_may);
                total2_jun += parseInt(total_jun);
                total2_jul += parseInt(total_jul);
                total2_aug += parseInt(total_aug);
                total2_sep += parseInt(total_sep);
                total2_oct += parseInt(total_oct);
                total2_nov += parseInt(total_nov);
                total2_dec += parseInt(total_dec);
                total2_adj += parseInt(total_adj);
                total2_all += parseInt(total_all);


                html += '<tr class="row_level2">' +
                    '       <td></td>' +
                    '       <th>TOTAL LABA RUGI</th>' +
                    '       <th>'+ convertToRupiah(total2_saldoawal) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_jan) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_feb) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_mar) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_apr) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_may) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_jun) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_jul) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_aug) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_sep) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_oct) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_nov) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_dec) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_adj) +'</th>' +
                    '       <th>'+ convertToRupiah(total2_all) +'</th>' +
                    '</tr>';

                total3_saldoawal += parseInt(total_saldoawal);
                total3_jan += parseInt(total2_jan);
                total3_feb += parseInt(total2_feb);
                total3_mar += parseInt(total2_mar);
                total3_apr += parseInt(total2_apr);
                total3_may += parseInt(total2_may);
                total3_jun += parseInt(total2_jun);
                total3_jul += parseInt(total2_jul);
                total3_aug += parseInt(total2_aug);
                total3_sep += parseInt(total2_sep);
                total3_oct += parseInt(total_oct);
                total3_nov += parseInt(total2_nov);
                total3_dec += parseInt(total2_dec);
                total3_adj += parseInt(total2_adj);
                total3_all += parseInt(total2_all);

                html += '<tr class="row_level3" style="text-align: right">' +
                    '       <th></th>' +
                    '       <th>MODAL AKHIR</th>' +
                    '       <th>'+ convertToRupiah(total3_saldoawal) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_jan) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_feb) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_mar) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_apr) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_may) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_jun) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_jul) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_aug) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_sep) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_oct) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_nov) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_dec) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_adj) +'</th>' +
                    '       <th>'+ convertToRupiah(total3_all) +'</th>' +
                    '</tr>';


                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();


                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                // $('#footer-content').html(html_footer);
                $('#dataTable').DataTable({
                    "scrollX": true,
                    "paging": false,
                    "bSort": false
                } );

                // $('#main-content').after(html_footer);

                $('.tr-hover').click(function(e){
                    e.preventDefault();
                    $('.tr-hover').removeClass('selected');
                    $(this).addClass('selected');
                })



            }
        })
    }
</script>