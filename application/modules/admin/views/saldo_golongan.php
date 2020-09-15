

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Saldo per Golongan</h1>
    <br>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 1%">No</th>
                        <th style="width: 12%">Golongan</th>
                        <th style="width: 10%">Neraca</th>
                        <th style="width: 10%"> Debet </th>
                        <th style="width: 10%"> Kredit </th>
                        <th style="width: 10%">
                            <?php
                            $bulan = array("Saldo Awal", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember", "Penyesuaian");
                            echo strtoupper($bulan[((int)$_SESSION['laporan_bulan'])])
                            ?>
                        </th>
                        <th style="width: 10%"> Debet </th>
                        <th style="width: 10%"> Kredit </th>
                        <th style="width: 12%"> Total </th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!--    <div class="card shadow mb-4">-->
<!--        <div class="card-header py-3">-->
<!--            <h6 class="m-0 font-weight-bold text-primary">Harta / Aset Bersih</h6>-->
<!--        </div>-->
<!--        <div class="card-body">-->
<!--            <div>-->
<!--                <table class="table table-bordered display nowrap" id="secondaryDataTable" width="100%" cellspacing="0">-->
<!--                    <thead>-->
<!--                        <tr>-->
<!--                            <th style="width: 10%"></th>-->
<!--                            <th style="width: 30%">Harta / Aset Bersih</th>-->
<!--                            <th> [BULAN] </th>-->
<!--                            <th> Total </th>-->
<!--                        </tr>-->
<!--                    </thead>-->
<!--                    <tbody id="secondary-content">-->
<!---->
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

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
                html = '';
                html_secondary = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td>'+ data.no_golongan +'</td>' +
                        '   <td>'+ data.nama_golongan +'</td>' +
                        '   <td>'+ data.neraca +'</td>' +
                        '   <td>'+ convertToRupiah(data.MONTHLY_DEBET) +'</td>' +
                        '   <td>'+ convertToRupiah(data.MONTHLY_KREDIT) +'</td>' +
                        '   <td>'+ convertToRupiah(data.MONTHLY_TOTAL) +'</td>' +
                        '   <td>'+ convertToRupiah(data.TOTAL_DEBET) +'</td>' +
                        '   <td>'+ convertToRupiah(data.TOTAL_KREDIT) +'</td>' +
                        '   <td>'+ convertToRupiah(data.TOTAL) +'</td>' +
                        '    </tr>';

                })

                // $('.daterangepicker').remove();
                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "bSort": false,
                    // "scrollX": true,
                    "pageLength": 50
                } );
                // datatable_init(1, true);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }



</script>
