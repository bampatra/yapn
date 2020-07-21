

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Master Produk</h1>
            <br>

            <button class="btn btn-primary add-product" style="background: #a50000; color: white; width: 300px;"> Tambah Produk </button>
            <button class="btn btn-primary upload-excel" style="background: #a50000; color: white; "> <i class="fas fa-upload"></i> </button>
            <a href="<?php echo base_url('admin/download_excel_product')?>"><button class="btn btn-primary download-excel" style="background: #a50000; color: white; "> <i class="fas fa-download"></i> </button></a>
            <br> <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Produk</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;"> ID </th>
                        <th></th>
                      <th style="width: 40%">Produk</th>
                      <th>Kategori</th>
                      <th>Tgl Produk</th>
                      <th>Stok</th>
                      <th style="width: 15%">Active</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-product-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-product-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Produk</label>
                        <textarea id="nama_web_product" name="nama_web_product" class="form-control form-active-control"></textarea>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Art No. Produk</label>
                        <input type="text" id="art_number_web_product" name="art_number_web_product" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Kategori</label>
                        <input type="text" id="nama_web_catprod" class="form-control form-active-control">
                        <input type="hidden" name="ucode_catprod" id="ucode_catprod">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Warna Produk</label>
                        <input type="text" id="nama_web_col" class="form-control form-active-control">
                        <input type="hidden" name="ucode_col" id="ucode_col">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label  class="col-form-label">Panjang (cm)</label>
                            <input type="text" id="length_web_product" name="length_web_product" class="form-control form-active-control numbers-only">
                        </div>
                        <div class="form-group col-md-6">
                            <label  class="col-form-label">Lebar (cm)</label>
                            <input type="text" id="width_web_product" name="width_web_product" class="form-control form-active-control numbers-only">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" >
                            <label  class="col-form-label">Tinggi (cm)</label>
                            <input type="text" id="height_web_product" name="height_web_product" class="form-control form-active-control numbers-only">
                        </div>
                        <div class="form-group col-md-6" >
                            <label  class="col-form-label">Berat Bersih (kg)</label>
                            <input type="text" id="wn_web_product" name="wn_web_product" class="form-control form-active-control numbers-only">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6" >
                            <label  class="col-form-label">Berat Kotor (kg)</label>
                            <input type="text" id="wg_web_product" name="wg_web_product" class="form-control form-active-control numbers-only">
                        </div>
                        <div class="form-group col-md-6" >
                            <label  class="col-form-label">Volume (m3)</label>
                            <input type="text" id="vol_web_product" name="vol_web_product" class="form-control form-active-control numbers-only">
                        </div>
                    </div>

                    <div class="form-group" >
                        <label  class="col-form-label">Deskripsi Produk</label>
                        <textarea rows="10" cols="50" type="text" id="desc_web_product" name="desc_web_product" class="form-control form-active-control"></textarea>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Cara Perawatan</label>
                        <textarea rows="10" cols="50" type="text" id="maintenance_web_product" name="maintenance_web_product" class="form-control form-active-control"></textarea>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Stok</label>
                        <input type="text" id="stok_web_product" name="stok_web_product" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label> Aktif </label>
                        <input class="form-control form-active-control" type="checkbox" id="active_web_product" name="active_web_product">
                    </div>

                    <div>
                        <label> Gambar Produk <span id="kelola-gambar-produk" style="margin-left: 5px;color: #a50000; text-decoration: underline; font-size: 12px; cursor: pointer;"> Kelola Gambar </span></label>

                        <div class="gambar-produk">

                        </div>

                    </div>

                    <input type="hidden" id="ucode_web_product" name="ucode_web_product" val="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-product">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-product">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="catprod-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <table class="table table-bordered" id="dataTableCatprod" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="display: none;"> ID </th>
                                <th>Nama Kategori</th>
                            </tr>
                        </thead>
                        <tbody id="catprod-content">

                        </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="col-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="dataTableCol" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th>Warna</th>
                    </tr>
                    </thead>
                    <tbody id="col-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="gambar-produk-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll; max-width: 70vw">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Gambar Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="gambar-produk">

                </div>
                <br>
                <button class="btn btn-primary add-gambar-produk"> Tambah Gambar </button>
                <br>
                <input style="visibility: hidden"  type="file" id="fileInput" accept="image/*" />
                <input style="display: none" type="button" id="btnCrop" value="Crop" />
                </p>
                <div style="max-width: 60vw;margin: auto;">
                    <canvas id="canvas" style="display: none">
                        Your browser does not support the HTML5 canvas element.
                    </canvas>
                </div>

                <div id="result"></div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="remove-image-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Gambar Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus foto produk ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary confirm-remove-image">Hapus</button>
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
                <div style="margin-bottom: 5px;"><a href="<?php echo base_url('admin/download_template_product')?>" style="font-size: 13px; text-decoration: underline; color: #a50000; cursor: pointer;"> Download Template </a></div>
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

    .excel-alert{
        font-size: 13px;
    }

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

    $('#tipe_excel_selector').change(function(){
        if($(this).val() == 'tambah'){
            $('.excel-alert').html('Semua data di file excel akan ditambahkan. Data yang sudah terdaftar tidak akan ditambahkan atau diupadte.');
        } else {
            $('.excel-alert').html('Data baru akan ditambahkan. Data yang sudah terdaftar akan diupdate berdasarkan <strong> Art Number. </strong><br>' +
                '                   Jika ingin mengedit Art Number, gunakan form manual');
        }
    });

    $('#validatedCustomFile').change(function(){
        filename = $(this).val().replace(/C:\\fakepath\\/i, '');
        $('.custom-file-label').html(filename);
    })

    $('.numbers-only').keydown(function(evt){
        return isNumber(evt)
    })

    $('#collapseMaster').addClass('show');
    $('#navbar-produk').addClass('active');

    product_url = '<?php echo base_url('product/');?>';
    category_url = '<?php echo base_url('category/');?>';
    main_image = true;
    remove_product = 0;
    ucode_web_product = 0;
    mode = '';
    rand_temporary_code = '';

    $('.add-gambar-produk').click(function(e){
        e.preventDefault();
        $('#fileInput').click();
    })

    get_all_products();

    //get all products
    function get_all_products(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_products', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr class="tr-hover">' +
                                            ' <td style="display: none;">'+ data.ucode_web_product +'</td>' +
                        '                       <td><img style="max-height: 100px; max-width: 100px;" src="<?php echo base_url()?>'+ data.file_web_image +'"></td>'+
                        '                      <td><span>'+ data.nama_web_product +'</span> <br> ' +
                        '                       <span style="color: darkred; font-size: 14px; font-weight: 600">'+ data.art_number_web_product +'</span> <br>' +
                        '                       <span style="color: darkblue; font-size: 14px; font-weight: 600"> '+ data.nama_web_col +'</span><br>';

                    if(data.active_web_catprod == '0'){
                        html += '<div class="alert alert-secondary" role="alert">\n' +
                            '  Kategori produk tidak aktif' +
                            '</div>';
                    }

                    if(data.active_web_col == '0'){
                        html += '<div class="alert alert-secondary" role="alert">\n' +
                            '  Warna produk tidak aktif' +
                            '</div>';
                    }

                    if(data.file_web_image == '' || data.file_web_image == null){
                        html += '<div class="alert alert-secondary" role="alert">\n' +
                            ' Produk tidak mempunyai gambar' +
                            '</div>';
                    }



                    html+=    ' </td>                   <td>'+ data.nama_web_catprod +'</td>\n' +
                        '                      <td>'+ data.date_web_product +'</td>\n' +
                        '                      <td>'+ data.stok_web_product +'</td>\n' +
                        '                      <td>'+ active_status(data.active_web_product) +'</td>\n' +
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

    // get product by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        mode = 'view';
        ucode_web_product = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_product_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {ucode_web_product: ucode_web_product},
            success     : function(data){

                  setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('#nama_web_product').val(htmlDecode(data.nama_web_product));
                $('#art_number_web_product').val(htmlDecode(data.art_number_web_product));
                $('#nama_web_catprod').val(data.nama_web_catprod);
                $('#ucode_catprod').val(htmlDecode(data.ucode_catprod));
                $('#nama_web_col').val(data.nama_web_col);
                $('#ucode_col').val(htmlDecode(data.ucode_col));
                $('#length_web_product').val(htmlDecode(data.length_web_product));
                $('#width_web_product').val(htmlDecode(data.width_web_product));
                $('#height_web_product').val(htmlDecode(data.height_web_product));
                $('#wn_web_product').val(htmlDecode(data.wn_web_product));
                $('#wg_web_product').val(htmlDecode(data.wg_web_product));
                $('#vol_web_product').val(htmlDecode(data.vol_web_product));
                $('#desc_web_product').val(htmlDecode(data.desc_web_product));
                $('#maintenance_web_product').val(htmlDecode(data.maintenance_web_product));
                $('#ucode_web_product').val(data.ucode_web_product);
                $('#stok_web_product').val(data.stok_web_product);
                if(data.active_web_product == '1'){
                    $('#active_web_product').prop('checked', true);
                } else {
                    $('#active_web_product').prop('checked', false);
                }

                $('.form-active-control').prop('disabled', true);

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-product-modal').modal('toggle');


                gambar_produk();

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();


            }
        })

    } );


    function gambar_produk(hide_control = true){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_gambar_produk', // the url where we want to POST// our data object
            dataType: 'json',
            data: {ucode_web_product: ucode_web_product},
            success: function (data) {
                length = data.length;
                html = ' <table> <tr>';
                count = 0;
                data.forEach(function(data, i){
                    html += '<td id="'+ data.id_web_image +'">' +
                        '<img style="height: 100px; width: 100px; margin-bottom: 5px;" src="<?php echo base_url()?>'+ data.file_web_image +'"><br>' +
                        '<div class="image-control">' +
                        '<i class="fas fa-trash remove-image-product" id="remove_'+data.id_web_image+'" style="cursor: pointer;"></i><span style="margin: 0px 10px;"></span>';

                    if(length > 1){
                        if(i == 0){
                            html += '<i style="font-size: 16px; cursor: pointer" class="fa fa-angle-right">';
                        } else if(i ==  (length - 1)) {
                            html += '<i style="font-size: 16px; cursor: pointer" class="fa fa-angle-left">';
                        } else {
                            html += '<i style="font-size: 16px; cursor: pointer" class="fa fa-angle-left"></i><span style="margin: 0px 10px;"></span><i style="font-size: 16px; cursor: pointer" class="fa fa-angle-right"></i>';
                        }
                    }

                    html +=    '</div>' +
                        '</td>';

                    count ++;

                    if(count % 4 === 0){
                        html += '</tr></table><table> <tr>'
                    }


                })

                html += ' </tr></table>';

                if(data.length == 0){
                    html = '<strong> Tidak ada gambar </strong>'
                }
                $('.gambar-produk').html(html);

                if(hide_control){
                    $('.image-control').css('display', 'none');
                }

                $('.fa-angle-left').click(function(e){
                    current_id = $(this).parent().parent().attr('id');
                    move_id = $(this).parent().parent().prev('td').attr('id');

                    swap(current_id, move_id);

                })

                $('.fa-angle-right').click(function(e){
                    current_id = $(this).parent().parent().attr('id');
                    move_id = $(this).parent().parent().next('td').attr('id');

                    swap(current_id, move_id);
                })


                $('.remove-image-product').click(function(e){
                    e.preventDefault();
                    main_image = false;
                    remove_product = $(this).attr('id').split('remove_')[1];
                    $('#gambar-produk-modal').modal('hide');
                    setTimeout(function() {
                        // needs to be in a timeout because we wait for BG to leave
                        // keep class modal-open to body so users can scroll
                        $('body').addClass('modal-open');
                    }, 400);
                    $('#remove-image-modal').modal('show');

                })
            }
        })
    }

    function swap(current_id, move_id){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'swap_product_image_order', // the url where we want to POST// our data object
            dataType: 'json',
            data: {current_id: current_id, move_id: move_id},
            success: function (response) {
                if(response.Status == "OK"){
                    gambar_produk(false);
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }


    function toggle_catprod(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $('#catprod-modal').modal('toggle');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: category_url + 'get_category', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {

                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.id_web_catprod +'</td>'+
                        '                      <td>'+ data.nama_web_catprod +'</td>' +
                        '</tr>';
                })

                $('#dataTableCatprod').DataTable().destroy();
                $('#catprod-content').html(html);
                $('#dataTableCatprod').DataTable();
                  setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    function toggle_col(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('#col-modal').modal('toggle');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: category_url + 'get_color', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.ucode_web_col +'</td>'+
                        '                      <td>'+ data.nama_web_col +'</td>' +
                        '</tr>';
                })

                $('#dataTableCol').DataTable().destroy();
                $('#col-content').html(html);
                $('#dataTableCol').DataTable();
                  setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('.final-upload-excel').click(function(e){
        e.preventDefault();

        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        var formData =new FormData();
        formData.append('excel_file', $('#validatedCustomFile')[0].files[0]); //use get('files')[0]
        formData.append('tipe',$('#tipe_excel_selector').val());


        $.ajax({
            url : admin_url + 'upload_excel_product',
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
                   get_all_products();
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


    $('#dataTableCatprod').on( 'click', 'tbody tr', function () {
        ucode_catprod = $('#dataTableCatprod').DataTable().row( this ).data()[0];
        nama_web_catprod = $('#dataTableCatprod').DataTable().row( this ).data()[1];
        $('#ucode_catprod').val(ucode_catprod);
        $('#nama_web_catprod').val(nama_web_catprod);
        $('#catprod-modal').modal('hide');
    } );

    $('#dataTableCol').on( 'click', 'tbody tr', function () {
        ucode_col = $('#dataTableCol').DataTable().row( this ).data()[0];
        nama_web_col = $('#dataTableCol').DataTable().row( this ).data()[1];
        $('#ucode_col').val(ucode_col);
        $('#nama_web_col').val(nama_web_col);
        $('#col-modal').modal('hide');
    } );

    $('.add-product').click(function (e) {
        e.preventDefault();
        mode = 'add';
        ucode_web_product = 0;
        $('#ucode_web_product').val(0);
        $('#ucode_catprod').val(0);
        $('#ucode_col').val(0);
        $('.modal-button-view-only').css('display', 'none');
        $('#master-product-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('#master-product-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');
         setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        gambar_produk();

    })

    $('.upload-excel').click(function(e){
        e.preventDefault();
        $('#upload-excel-modal').modal('show');
        $('#excel-form')[0].reset();
        $('.excel-alert').html('Semua data di file excel akan ditambahkan. Data yang sudah terdaftar tidak akan ditambahkan atau diupadte.');
        $('.custom-file-label').html('Pilih file...');
        $('.excel-error').css('display', 'none');
    })

    $('.edit-product').click(function(e){
        mode = 'edit';
          setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);

    })

    $('.save-product').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_product', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-product-form').serialize() + "&rand_temporary_code=" + rand_temporary_code,
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_products();
                    $('#master-product-modal').modal('hide');
                    rand_temporary_code = '';
                    ucode_web_product = '';
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#nama_web_catprod').click(function(e){
        e.preventDefault();
        if(!$(this).attr("readonly")){
            $('#master-product-modal').modal('hide');
            setTimeout(function() {
                // needs to be in a timeout because we wait for BG to leave
                // keep class modal-open to body so users can scroll
                $('body').addClass('modal-open');
            }, 400);
            toggle_catprod();
        }

    })

    $('#nama_web_col').click(function(e){
        e.preventDefault();
        if(!$(this).attr("readonly")){
            $('#master-product-modal').modal('hide');
            setTimeout(function() {
                // needs to be in a timeout because we wait for BG to leave
                // keep class modal-open to body so users can scroll
                $('body').addClass('modal-open');
            }, 400);
            toggle_col();
        }
    })

    $('#kelola-gambar-produk').click(function(e){
        e.preventDefault();
        if(!$(this).attr("readonly")){
            $('#master-product-modal').modal('hide');
            setTimeout(function() {
                // needs to be in a timeout because we wait for BG to leave
                // keep class modal-open to body so users can scroll
                $('body').addClass('modal-open');
            }, 400);
            $('#gambar-produk-modal').modal({
                backdrop: 'static'
            });
            $('.image-control').css('display', 'block');
            $('#btnCrop').css("display", "none");
            $("#canvas").cropper('destroy');
            $("#canvas").css("display", "none");
            $('#fileInput').val('');
        }
    })

    $('#catprod-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#master-product-modal').modal('show')
    })

    $('#col-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#master-product-modal').modal('show')
    })

    $('#remove-image-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#gambar-produk-modal').modal('show')
        main_image = true;
    })

    $('#gambar-produk-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        if(main_image == true){
            $('#master-product-modal').modal('show')
            $('.image-control').css('display', 'none');
        }

        $("#canvas").cropper('destroy');
        $("#canvas").css("display", "none");
        $('#btnCrop').css("display", "none");
    })

    $('.confirm-remove-image').click(function(e){

        e.preventDefault();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'remove_gambar_produk', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {remove_product: remove_product},
            success     : function(response){
                if(response.Status == "OK"){
                    $('#remove-image-modal').modal('hide');
                    gambar_produk(false);
                } else {
                    show_snackbar(response.Message);
                }

            }
        })
    })


    var canvas  = $("#canvas"),
        context = canvas.get(0).getContext("2d"),
        $result = $('#result'),
        allow_upload = true;

    $('#fileInput').on( 'change', function(){
        $('#btnCrop').css("display", "block");
        canvas.css("display", "block");
        if (this.files && this.files[0]) {
            if ( this.files[0].type.match(/^image\//) ) {
                var reader = new FileReader();
                reader.onload = function(evt) {
                    var img = new Image();
                    img.onload = function() {
                        context.canvas.height = img.height;
                        context.canvas.width  = img.width;
                        context.drawImage(img, 0, 0);
                        var cropper = canvas.cropper({
                            aspectRatio: 1 / 1,
                            autoCropArea: 1
                        });
                        $('#btnCrop').click(function() {
                            // Get a string base 64 data url
                            var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");

                            // console.log(croppedImageDataURL);
                            // Split the base64 string in data and contentType
                            var block = croppedImageDataURL.split(";");

                            // Get the content type of the image
                            var contentType = block[0].split(":")[1];
                            // get the real base64 content of the file
                            var realData = block[1].split(",")[1];

                            // Convert it to a blob to upload
                            var blob = b64toBlob(realData, contentType);

                            console.log(blob);

                            var formDataToUpload = new FormData();
                            formDataToUpload.append("gambar_produk", blob);

                            if(mode == 'add' && rand_temporary_code == ''){
                                //generate temporary code
                                rand_temporary_code = makeid();
                                ucode_web_product = rand_temporary_code;
                            }

                            formDataToUpload.append("ucode_web_product", ucode_web_product);

                            // upload image
                            if(allow_upload == true){
                                $('.loading').css("display", "block");
                                $('.Veil-non-hover').fadeIn();
                                allow_upload = false
                                $.ajax({
                                    url: admin_url + 'upload_gambar_produk',
                                    type: "POST",
                                    data: formDataToUpload,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    success: function(response){
                                        console.log(response);
                                        if(response.Status == "OK"){
                                            canvas.cropper('destroy');
                                            canvas.css("display", "none");
                                            gambar_produk(false);
                                            allow_upload = true;
                                            $('#btnCrop').css("display", "none");
                                        } else {
                                            show_snackbar(response.Message)
                                        }

                                        $('.loading').css("display", "none");
                                        $('.Veil-non-hover').fadeOut();

                                    }
                                });
                            }

                        });
                    };
                    img.src = evt.target.result;
                };
                reader.readAsDataURL(this.files[0]);
            }
            else {
                alert("Invalid file type! Please select an image file.");
                canvas.cropper('destroy');
                canvas.css("display", "none");
                $('#btnCrop').css("display", "none");
            }
        }
        else {
            alert('No file(s) selected.');
            canvas.cropper('destroy');
            canvas.css("display", "none");
            $('#btnCrop').css("display", "none");
        }
    });


    /**
     * Convert a base64 string in a Blob according to the data and contentType.
     *
     * @param b64Data {String} Pure base64 string without contentType
     * @param contentType {String} the content type of the file i.e (image/jpeg - image/png - text/plain)
     * @param sliceSize {Int} SliceSize to process the byteCharacters
     * @see http://stackoverflow.com/questions/16245767/creating-a-blob-from-a-base64-string-in-javascript
     * @return Blob
     */
    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

        var blob = new Blob(byteArrays, {type: contentType});
        return blob;
    }

    function makeid() {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < 8; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

</script>
