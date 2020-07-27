

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>
    <br>

    <button class="btn btn-primary add-transaksi" style="background: #a50000; color: white; width: 300px;"> Tambah Transaksi </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Subtotal</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <h3>Rp. <?php echo number_format($subtotal, 2, ',', '.'); ?></h3>
                <span style="font-size: 14px">Periode: <?php
                    $var = $_SESSION['awal_periode'];
                    $date = str_replace('/', '-', $var);
                    echo date("d-M-Y", strtotime($date) );
                    ?>
                                    sampai dengan <span class="akhir-periode-string">
                                         <?php

                                         $var = $_SESSION['akhir_periode'];
                                         $date = str_replace('/', '-', $var);
                                         echo date("d-M-Y", strtotime($date) );

                                         ?></span>
            </div>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display nowrap" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th style="width: 10%">Tgl</th>
                        <th style="width: 50%">Keterangan</th>
                        <th> Debet </th>
                        <th> Kredit </th>
                        <th> Nominal </th>
                        <th> Arus Kas </th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="rekening-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rekening-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Tgl. Transaksi</label>
                        <div id="transaksi_input">
                            <input type="date" id="tgl_transaksi" name="tgl_transaksi" class="form-control form-active-control">
                        </div>

                    </div>
                    <div class="form-group modal-button-save">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="without_date" name="without_date">
                            <label class="form-check-label" for="without_date">
                                Tanpa tanggal
                            </label>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Keterangan Transaksi</label>
                        <textarea id="keterangan_transaksi" name="keterangan_transaksi" class="form-control form-active-control"></textarea>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Rekening Debet</label>
                        <select id="rekening_debet_transaksi" name="rekening_debet_transaksi" class="form-control form-active-control">
                            <option value="none"> -- Pilih Rekening Debet -- </option>
                            <?php foreach ($rekening_list as $rekening) { ?>
                                <option value="<?php echo $rekening->id_rekening; ?>">
                                    <?php echo $rekening->nama_rekening; ?> (No. Rek: <?php echo $rekening->no_rekening; ?>)
                                </option>


                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label class="col-form-label">Rekening Kredit</label>
                        <select id="rekening_kredit_transaksi" name="rekening_kredit_transaksi" class="form-control form-active-control">
                            <option value="none"> -- Pilih Rekening Kredit -- </option>
                            <?php foreach ($rekening_list as $rekening) { ?>
                                <option value="<?php echo $rekening->id_rekening; ?>">
                                    <?php echo $rekening->nama_rekening; ?> (No. Rek: <?php echo $rekening->no_rekening; ?>)
                                </option>


                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nominal</label>
                        <input type="text" id="nominal_transaksi" name="nominal_transaksi" class="form-control form-active-control" onkeydown="isNumber()">
                    </div>

                    <div class="form-group" >
                        <label class="col-form-label">Arus Kas</label>
                        <select id="arus_kas_transaksi" name="arus_kas_transaksi" class="form-control form-active-control">
                            <option value="none"> -- Pilih Arus Kas -- </option>
                            <option value="0"> Tidak ada arus kas </option>
                            <?php foreach ($arus_kas_list as $arus_kas) { ?>
                                <option value="<?php echo $arus_kas->id_arus_kas; ?>">
                                    <?php echo $arus_kas->nama_arus_kas; ?>
                                </option>


                            <?php } ?>
                        </select>
                    </div>

                    <input type="hidden" name="id_transaksi" id="id_transaksi" value="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-transaksi">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-transaksi">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>


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
</style>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    get_all_transaksi();

    function get_all_transaksi(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_transaksi', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td style="display: none;">'+ data.id_transaksi +'</td>' +
                        '   <td>'+ convertDate(data.tgl_transaksi) +'</td>' +
                        '   <td>'+ data.keterangan_transaksi +'</td>' +
                        '   <td>'+ data.nama_rekening_debet +'</td>' +
                        '   <td>'+ data.nama_rekening_kredit +'</td>' +
                        '   <td>'+ convertToRupiah(data.nominal_transaksi) +'</td>' +
                        '   <td>'+ data.nama_arus_kas +'</td>' +
                        '    </tr>';

                })

                // $('.daterangepicker').remove();
                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 1, "asc" ]],
                    "scrollX": true
                } );
                // datatable_init(1, true);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('.add-transaksi').click(function (e) {
        e.preventDefault();
        setTimeout(function () {
            $('.modal-dialog').scrollTop(0);
        }, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('.modal-button-save').css('display', 'block');
        $('#rekening-form').trigger('reset');
        $('#id_transaksi').val(0);
        $('.form-active-control').prop('disabled', false);
        $('#rekening-modal').modal('toggle');
    })

    $('#dataTable').on( 'click', 'tbody tr', function () {
        id_transaksi = $('#dataTable').DataTable().row( this ).data()[0];
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_transaksi_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_transaksi: id_transaksi},
            success: function (data) {
                $('#id_transaksi').val(data.id_transaksi);

                var d = new Date();
                var n = d.getFullYear();

                console.log(data);

                if(data.custom_tgl_transaksi.match(/-00-00$/)){
                    $('#transaksi_input').html(' <input type="text" id="tgl_transaksi" name="tgl_transaksi" class="form-control form-active-control" value="00/00/'+ n +'" readonly>')
                } else {
                    $('#transaksi_input').html(' <input type="date" id="tgl_transaksi" name="tgl_transaksi" class="form-control form-active-control" value="'+ data.custom_tgl_transaksi +'">')
                }


                $('#keterangan_transaksi').val(htmlDecode(data.keterangan_transaksi));
                $('#rekening_debet_transaksi').val(data.id_rekening_debet);
                $('#rekening_kredit_transaksi').val(data.id_rekening_kredit);
                $('#nominal_transaksi').val(data.nominal_transaksi);
                $('#arus_kas_transaksi').val(data.id_arus_kas);


                $('.form-active-control').prop('disabled', true);
                $('#rekening-modal').modal('toggle');
                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    $('.edit-transaksi').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-transaksi').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_transaksi', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#rekening-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_transaksi();
                    $('#rekening-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#without_date').change(function()
    {
        var d = new Date();
        var n = d.getFullYear();

        if ($(this).is(':checked')) {
            $('#transaksi_input').html(' <input type="text" id="tgl_transaksi" name="tgl_transaksi" class="form-control form-active-control" value="00/00/'+ n +'" readonly>')

        } else {
            $('#transaksi_input').html(' <input type="date" id="tgl_transaksi" name="tgl_transaksi" class="form-control form-active-control">')
        }
    });

    $('.tahun')


</script>
