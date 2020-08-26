

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Neraca Saldo</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Neraca Saldo</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
<!--                <table class="table table-bordered display nowrap" width="100%" cellspacing="0" id="dataTable">-->
<!--                    <thead>-->
<!--                    <tr style="visibility: hidden;">-->
<!--                        <th style="width: 5%"></th>-->
<!--                        <th style="width: 20%"></th>-->
<!--                        --><?php
//                        for ($x = 0; $x < 6; $x++) {
//                            echo '<th class="initial_cell"></th>';
//                        }
//                        ?>
<!--                    </tr>-->
<!--                    </thead>-->
<!--                    <tbody id="kasbank_row">-->
<!--                        <tr>-->
<!--                            <th colspan="2" class="left_side"> REKENING </th>-->
<!--                            <th colspan="3" class="middle_side">-->
<!--                                --><?php
//                                $monthName = date("F", mktime(0, 0, 0, $_SESSION['laporan_bulan'], 10));
//                                echo strtoupper($monthName);
//                                ?>
<!--                            </th>-->
<!--                            <th colspan="3" class="right_side">-->
<!--                                --><?php
//                                $var = $_SESSION['awal_periode'];
//                                $date = str_replace('/', '-', $var);
//                                echo date("d-M-Y", strtotime($date) );
//                                ?>
<!--                                sampai dengan <span class="akhir-periode-string">-->
<!--                                             --><?php
//
//                                             $var = $_SESSION['akhir_periode'];
//                                             $date = str_replace('/', '-', $var);
//                                             echo date("d-M-Y", strtotime($date) );
//
//                                             ?>
<!--                            </th>-->
<!--                        </tr>-->
<!--                    </tbody>-->
<!---->
<!--                </table>-->

                <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th colspan="2" class="left_side"> REKENING </th>
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
                        <th>No</th>
                        <th style="text-align: left;">Rekening</th>
                        <th>DEB BLN</th>
                        <th>KRD BLN</th>
                        <th>BLC BLN</th>
                        <th>DEB</th>
                        <th>KRD</th>
                        <th>BLC</th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                    <tfoot id="main-footer">

                    </tfoot>

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
        get_neraca_saldo();
    })


    function get_neraca_saldo(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_neraca_saldo', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {

                monthly_debet = 0;
                monthly_kredit = 0;
                monthly_total = 0;
                grand_total = 0;
                total_debet = 0;
                total_kredit = 0;


                html = '';

                data.forEach(function(data, i) {
                    html += '<tr class="tr-hover" style="text-align: right">' +
                        '       <td>'+ data.no_rekening +'</td>' +
                        '       <td style="text-align: left;">' +
                        '           <strong>'+ data.nama_rekening +'</strong><br>' +
                        '           <span>S/N: '+ data.s_n_golongan +'</span><br>' +
                        '           <span>['+ data.no_golongan +'] '+ data.nama_golongan +'</span>' +
                        '       </td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_DEBET) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_KREDIT) +'</td>' +
                        '       <td>'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL_DEBET) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL_KREDIT) +'</td>' +
                        '       <td>'+ convertToRupiah(data.TOTAL) +'</td>' +
                            '</tr>';


                    monthly_total += parseInt(data.MONTHLY_TOTAL);
                    monthly_debet += parseInt(data.MONTHLY_DEBET);
                    monthly_kredit += parseInt(data.MONTHLY_KREDIT);
                    grand_total += parseInt(data.TOTAL);
                    total_debet += parseInt(data.TOTAL_DEBET);
                    total_kredit += parseInt(data.TOTAL_KREDIT);
                });

                monthly_difference = parseInt(monthly_debet) - parseInt(monthly_kredit);
                total_difference = parseInt(total_debet) - parseInt(total_kredit);

                balance_or_selisih = (total_difference == 0) ?  "BALANCE"  :  "SELISIH";

                html_footer = '<tr style="">\n' +
                    '                        <td></td>\n' +
                    '                        <th>'+ balance_or_selisih +'</th>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(monthly_debet) +'</th>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(monthly_kredit) +'</td>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(monthly_difference) +'</th>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(total_debet) +'</th>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(total_kredit) +'</th>\n' +
                    '                        <th style="text-align: right">'+ convertToRupiah(total_difference) +'</th>\n' +
                    '                    </tr>';


                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#main-footer').html(html_footer);
                $('#dataTable').DataTable({
                    "scrollX": true,
                    "paging": false
                } );

                // $('#main-content').after(html_footer);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

                $('.tr-hover').click(function(e){
                    e.preventDefault();
                    $('.tr-hover').removeClass('selected');
                    $(this).addClass('selected');
                })

            }
        })
    }



</script>
