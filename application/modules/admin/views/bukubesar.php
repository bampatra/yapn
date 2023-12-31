

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Buku Besar</h1>
    <br>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Buku Besar</h6>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label">Buku Besar</label>
                        <div class="col-sm-10">
                        <select id="rekening_bukubesar" name="rekening_bukubesar" class="form-control form-active-control selectpicker" data-live-search="true" data-container="body">
                                <?php foreach ($rekening_list as $rekening) { ?>
                                    <option data-tokens="<?php echo $rekening->no_rekening; ?>" value="<?php echo $rekening->id_rekening; ?>">
                                        <?php echo $rekening->nama_rekening; ?>
                                    </option>


                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">No. Rek.</label>
                        <label for="inputEmail3" class="col-sm-2 col-form-label no_rek">Loading...</label>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">S/N</label>
                        <label for="inputEmail3" class="col-sm-2 col-form-label s_n">Loading...</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Saldo</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table style="border-collapse:collapse; width: 100%;">
                            <tr>
                                <td> DEBIT </td>
                                <td style="text-align: right" class="debit">Loading...</td>
                            </tr>
                            <tr style="border-bottom: 1px solid black; height: 30px;">
                                <td> KREDIT </td>
                                <td style="text-align: right" class="kredit">Loading...</td>
                            </tr>
                            <tr style="height: 30px;">
                                <td> SALDO </td>
                                <td style="text-align: right" class="saldo">Loading...</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary download"> <i class="fas fa-print"></i> DOWNLOAD EXCEL </button>
        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 10%">Tanggal</th>
                        <th style="width: 50%">Keterangan</th>
                        <th> Debet </th>
                        <th> Kredit </th>
                        <th> Mutasi </th>
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

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    $(document).ready(function(){
        get_rekening_detail();
    })


    function get_bukubesar(no_rekening, s_n){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_bukubesar', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {no_rek: no_rekening, s_n: s_n},
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    if(data.month_transaksi == '0' || data.month_transaksi == '13'){
                        date = data.year_transaksi;
                    } else {
                        date = convertDate(data.tgl_transaksi);
                    }

                    html += '<tr class="tr-hover">' +
                        '   <td>'+ date +'</td>' +
                        '   <td>'+ data.keterangan_transaksi +'</td>' +
                        '   <td>'+ convertToRupiah(data.DEBET) +'</td>' +
                        '   <td>'+ convertToRupiah(data.KREDIT) +'</td>' +
                        '   <td>'+ convertToRupiah(data.MUTASI) +'</td>' +
                        '    </tr>';

                })

                // $('.daterangepicker').remove();
                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "bSort": false,
                    // "scrollX": true,
                    pagingType: "simple",
                } );
                // datatable_init(1, true);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    function get_rekening_detail(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_rekening_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_rekening: $('#rekening_bukubesar').val()},
            success: function (data) {
                $('.no_rek').html(data.no_rekening);
                $('.s_n').html(data.s_n_golongan);

                get_saldo_summary(data.no_rekening, data.s_n_golongan)
                get_bukubesar(data.no_rekening, data.s_n_golongan);
            }
        })
    }

    function get_saldo_summary(no_rekening, s_n){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_saldo_summary', // the url where we want to POST// our data object
            dataType: 'json',
            data: {no_rek: no_rekening},
            success: function (data) {

                if(data != null && data != undefined){
                    $('.debit').html(convertToRupiah(data.TOTAL_DEBET));
                    $('.kredit').html(convertToRupiah(data.TOTAL_KREDIT));

                    if(s_n == 'Debet'){
                        $('.saldo').html(convertToRupiah(data.TOTAL_DEBET - data.TOTAL_KREDIT));
                    } else {
                        $('.saldo').html(convertToRupiah(data.TOTAL_KREDIT - data.TOTAL_DEBET));
                    }
                } else {
                    $('.debit').html(convertToRupiah(0));
                    $('.kredit').html(convertToRupiah(0));
                    $('.saldo').html(convertToRupiah(0));

                }


            }
        })
    }

    $('#rekening_bukubesar').change(function(){
        $('.no_rek').html('Loading...');
        $('.s_n').html('Loading...');
        $('.debit').html('Loading...');
        $('.kredit').html('Loading...');
        $('.saldo').html('Loading...');
        get_rekening_detail();
    })

    $('.download').click(function(e){
        e.preventDefault();
        // $.ajax({
        //     type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        //     url: admin_url + 'download_bukubesar', // the url where we want to POST// our data object
        //     dataType: 'json',
        //     data: {no_rek: $('.no_rek').html(), s_n: $('.s_n').html()},
        //     success: function (response) {
        //     }
        // })

        window.location.href = admin_url + 'download_bukubesar?rek=' + $('.no_rek').html();

    })


</script>
