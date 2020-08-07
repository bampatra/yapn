

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
            <div>
                <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 10%">No</th>
                        <th style="width: 30%">Golongan</th>
                        <th>Neraca</th>
                        <th> Debet </th>
                        <th> Kredit </th>
                        <th> [BULAN] </th>
                        <th> Debet </th>
                        <th> Kredit </th>
                        <th> Total </th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Harta / Aset Bersih</h6>
        </div>
        <div class="card-body">
            <div>
                <table class="table table-bordered display nowrap" id="secondaryDataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th style="width: 10%"></th>
                            <th style="width: 30%">Harta / Aset Bersih</th>
                            <th> [BULAN] </th>
                            <th> Total </th>
                        </tr>
                    </thead>
                    <tbody id="secondary-content">

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

    .tr-hover td, .tr-hover th{
        padding: 0.4rem !important;
    }

    td{
        color: #333333;
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
                    "scrollX": true,
                    "pageLength": 50
                } );
                // datatable_init(1, true);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }



</script>
