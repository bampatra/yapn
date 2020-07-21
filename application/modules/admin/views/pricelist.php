

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Harga</h1>
    <br>

    <button class="btn btn-primary add-harga" style="background: #a50000; color: white; width: 300px;"> Tambah Harga </button>
    <button class="btn btn-primary upload-excel" style="background: #a50000; color: white; "> <i class="fas fa-upload"></i> </button>
    <a href="<?php echo base_url('admin/download_excel_pricelist')?>"><button class="btn btn-primary download-excel" style="background: #a50000; color: white; "> <i class="fas fa-download"></i> </button></a>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Harga</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID Pricelist </th>
                        <th style="display: none;"> ID Product </th>
                        <th style="width: 60%">Nama Produk</th>
                        <th> Harga </th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-harga-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Harga</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-harga-form">
                    <div class="form-group product-form" >
                        <label  class="col-form-label">Nama Produk</label>
                        <textarea id="nama_web_product" class="form-control" disabled></textarea>
                        <input type="hidden" id="ucode_web_product"  name="ucode_web_product">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Harga</label><br>
                        <span style="font-size: 12px; margin-top: -5px">Contoh: 1000000 atau 500000</span>
                        <input type="text" id="nominal_web_pricelist" name="nominal_web_pricelist" class="form-control form-active-control numbers-only">
                    </div>
                    <div class="form-group update_promosi_check" style="display: none;">
                        <label> Update Harga Akhir Promosi?</label>
                        <div class="alert alert-info" role="alert" style="font-size: 12px; color: #858796">
                            Dicentang: Harga akhir promosi yang terdaftar di master promosi akan diupdate berdasarkan persentase promosi <br>
                            Tidak dicentang: Harga akhir promosi yang terdaftar di master promosi akan tetap
                        </div>
                        <input class="form-control form-active-control" type="checkbox" id="update_promosi" name="update_promosi">
                    </div>

                    <input type="hidden" id="id_web_pricelist" name="id_web_pricelist" value="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-harga">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-harga">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="product-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableProd" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th>Produk</th>
                    </tr>
                    </thead>
                    <tbody id="prod-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
                <div style="margin-bottom: 5px;"><a href="<?php echo base_url('admin/download_template_pricelist')?>" style="font-size: 13px; text-decoration: underline; color: #a50000; cursor: pointer;"> Download Template </a></div>
                <br>
                <form id="excel-form">
                    <label for="exampleFormControlSelect1">Tipe</label>
                    <select class="form-control" id="tipe_excel_selector">
                        <option value="tambah">Tambah</option>
                        <option value="tambah_update">Tambah & Update</option>
                    </select>
                    <br>
                    <div class="alert alert-primary excel-alert" role="alert">
                        Semua data di file excel akan ditambahkan. Data yang sama tidak akan ditambahkan.
                    </div>
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


<style>
    tr:hover{
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

    .tooltip{
        z-index: 5001;
        text-align: left;
    }
</style>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    $('#tipe_excel_selector').change(function(){
        if($(this).val() == 'tambah'){
            $('.excel-alert').html('Semua data di file excel akan ditambahkan. Data yang sudah terdaftar tidak akan ditambahkan atau diupadte.');
        } else {
            $('.excel-alert').html('Data baru akan ditambahkan. Data yang sudah terdaftar akan diupdate berdasarkan <strong> Nama Produk. </strong>');
        }
    });

    $('#validatedCustomFile').change(function(){
        filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('.custom-file-label').html(filename);
    })

    $('.upload-excel').click(function(e){
        e.preventDefault();
        $('#upload-excel-modal').modal('show');
        $('#excel-form')[0].reset();
        $('.excel-alert').html('Semua data di file excel akan ditambahkan. Data yang sudah terdaftar tidak akan ditambahkan atau diupadte.');
        $('.custom-file-label').html('Pilih file...');
        $('.excel-error').css('display', 'none');
    })

    $('.final-upload-excel').click(function(e){
        e.preventDefault();

        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        var formData =new FormData();
        formData.append('excel_file', $('#validatedCustomFile')[0].files[0]); //use get('files')[0]
        formData.append('tipe',$('#tipe_excel_selector').val());


        $.ajax({
            url : admin_url + 'upload_excel_pricelist',
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
                    get_all_pricelist();
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

    $('.numbers-only').keydown(function(evt){
        return isNumber(evt)
    })

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('#collapseHargaPromo').addClass('show');
    $('#navbar-harga').addClass('active');

    product_url = '<?php echo base_url('product/');?>';
    mode = '';

    function toggle_prod(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $('#product-modal').modal('toggle');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_product_not_in_pricelist', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.ucode_web_product +'</td>'+
                        '                      <td>'+ data.nama_web_product +'</td>' +
                        '</tr>';
                })

                $('#dataTableProd').DataTable().destroy();
                $('#prod-content').html(html);
                $('#dataTableProd').DataTable();
                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('#dataTableProd').on( 'click', 'tbody tr', function () {
        ucode_web_product = $('#dataTableProd').DataTable().row( this ).data()[0];
        nama_web_product = $('#dataTableProd').DataTable().row( this ).data()[1];
        $('#ucode_web_product').val(ucode_web_product);
        $('#nama_web_product').val(nama_web_product);
        $('#product-modal').modal('hide');
    } );

    get_all_pricelist();

    //get all products
    function get_all_pricelist(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_pricelist', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.id_web_pricelist +'</td>'+
                        ' <td style="display: none;">'+ data.ucode_web_product +'</td>'+
                        '                      <td>'+ data.nama_web_product +'</td>\n'+
                        '                      <td style="text-align: right;">'+ data.nominal_web_pricelist +'</td>\n' +
                        '                    </tr>';
                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable();

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }


    // get pricelist by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        id_web_pricelist = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_pricelist_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {id_web_pricelist: id_web_pricelist},
            success     : function(data){

                mode = 'view';
                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('#id_web_pricelist').val(data.id_web_pricelist);
                $('#ucode_web_product').val(htmlDecode(data.ucode_web_product));
                $('#nama_web_product').val(htmlDecode(data.nama_web_product));
                $('#nominal_web_pricelist').val(htmlDecode(data.nominal_web_pricelist));


                $('.form-active-control').prop('disabled', true);
                $('.update_promosi_check').css('display', 'none');

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-harga-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );


    $('.add-harga').click(function (e) {
        e.preventDefault();
        mode = 'add';
        $('#id_web_pricelist').val(0);
        $('#ucode_web_product').val(0);
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('#master-harga-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('.update_promosi_check').css('display', 'block');
        $('#master-harga-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');
    })

    $('.edit-harga').click(function(e){
        mode = 'edit';
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
        $('.update_promosi_check').css('display', 'block');
    })

    $('.save-harga').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_harga', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-harga-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_pricelist();
                    $('#master-harga-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#product-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#master-harga-modal').modal('show')
    })

    $('.product-form').click(function(e){
        e.preventDefault();
        if(mode == 'add'){
            $('#master-harga-modal').modal('hide');
            setTimeout(function() {
                // needs to be in a timeout because we wait for BG to leave
                // keep class modal-open to body so users can scroll
                $('body').addClass('modal-open');
            }, 400);
            toggle_prod();
        }
    })

</script>
