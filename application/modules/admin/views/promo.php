

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Promo</h1>
    <br>

    <button class="btn btn-primary add-promo" style="background: #a50000; color: white; width: 300px;"> Tambah Promo </button>
    <button class="btn btn-primary upload-excel" style="background: #a50000; color: white; "> <i class="fas fa-upload"></i> </button>
    <a href="<?php echo base_url('admin/download_excel_promosi')?>"><button class="btn btn-primary download-excel" style="background: #a50000; color: white; "> <i class="fas fa-download"></i> </button></a>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Promo</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID Promosi </th>
                        <th style="display: none;"> ID Product </th>
                        <th>Nama Produk</th>
                        <th> Promosi </th>
                        <th> Masa Aktif </th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-promo-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="max-height: 90vh; overflow: scroll; width: 45vw;">
            <div class="modal-header">
                <h5 class="modal-title">Promosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <form id="master-promo-form">
                    <div class="form-group product-form" >
                        <label  class="col-form-label">Nama Produk</label>
                        <textarea id="nama_web_product" class="form-control" disabled></textarea>
                        <input type="hidden" id="ucode_web_product"  name="ucode_web_product">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Harga</label>
                        <input type="number" id="nominal_web_pricelist" class="form-control" disabled>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Final Harga Promosi (Rp)</label>
                        <input type="number" id="nominal_web_promosi" name="nominal_web_promosi" class="form-control form-active-control numbers-only">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Persentase Promosi (%)</label>
                        <input type="number" id="persen_web_promosi" name="persen_web_promosi" class="form-control form-active-control numbers-only">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label  class="col-form-label">Dari</label>
                            <input type="datetime-local" id="start_web_promosi" name="start_web_promosi" class="form-control form-active-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label  class="col-form-label"> Sampai dengan</label>
                            <input type="datetime-local" id="end_web_promosi" name="end_web_promosi" class="form-control form-active-control">
                        </div>
                    </div>


                    <input type="hidden" id="id_web_promosi" name="id_web_promosi" val="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-primary edit-promo">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-secondary delete-promo">Hapus</button>
                    <button type="button" class="btn btn-primary save-promo">Simpan</button>
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
            <div class="modal-body" style="overflow: scroll; max-height: 80vh;">
                <table class="table table-bordered" id="dataTableProd" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="display: none;"> Harga </th>
                        <th style="display: none;"> Nama Produk </th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="delete-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Promosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="overflow: scroll; max-height: 80vh;">
                Apakah anda yakin ingin menghapus promosi ini?
            </div>
            <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary delete-promo-confirm">Hapus</button>
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
                <div style="margin-bottom: 5px;"><a href="<?php echo base_url('admin/download_template_promosi')?>" style="font-size: 13px; text-decoration: underline; color: #a50000; cursor: pointer;"> Download Template </a></div>
                <br>
                <form id="excel-form">
                    <label for="exampleFormControlSelect1">Tipe Excel</label>
                    <select class="form-control" id="tipe_excel_selector">
                        <option value="tambah">Tambah</option>
                        <option value="tambah_update">Tambah & Update</option>
                    </select>
                    <div class="alert alert-primary excel-alert" role="alert" style="font-size: 13px; margin-top: 10px;">
                        Semua data di file excel akan ditambahkan. Data yang sama tidak akan ditambahkan.
                    </div>
                    <label for="exampleFormControlSelect1">Tipe Promosi</label>
                    <select class="form-control" id="tipe_promo_selector">
                        <option value="persen">Persen</option>
                        <option value="harga_akhir">Harga Akhir</option>
                    </select>
                    <div class="alert alert-primary promo-alert" role="alert" style="font-size: 13px; margin-top: 10px;">
                        Harga akhir promo dihitung berdasarkan persentase yang tertulis di file
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

    .product-form{
        cursor: pointer;
    }
</style>

<script>

    $('#tipe_excel_selector').change(function(){
        if($(this).val() == 'tambah'){
            $('.excel-alert').html('Semua data di file excel akan ditambahkan. Data yang sudah terdaftar tidak akan ditambahkan atau diupadte.');
        } else {
            $('.excel-alert').html('Data baru akan ditambahkan. Data yang sudah terdaftar akan diupdate berdasarkan <strong> Nama Produk. </strong>');
        }
    });

    $('#tipe_promo_selector').change(function(){
        if($(this).val() == 'persen'){
            $('.promo-alert').html('Harga akhir promo dihitung berdasarkan persentase yang tertulis di file');
        } else {
            $('.promo-alert').html('Harga akhir promo adalah harga akhir yang tertulis di file');
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
        $('.promo-alert').html('Harga akhir promo dihitung berdasarkan persentase yang tertulis di file');
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
        formData.append('tipe_promo',$('#tipe_promo_selector').val());


        $.ajax({
            url : admin_url + 'upload_excel_promosi',
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
                    get_all_promo();
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

    $('#collapseHargaPromo').addClass('show');
    $('#navbar-promo').addClass('active');

    mode = '';

    function toggle_prod(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $('#product-modal').modal('toggle');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_product_not_in_promo', // the url where we want to POST// our data object
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '';
                data.forEach(function(data){

                    html += '<tr class="tr-hover">' +
                        ' <td style="display: none;">'+ data.ucode_web_product +'</td>'+
                        ' <td style="display: none;">'+ data.nominal_web_pricelist +'</td>'+
                        ' <td style="display: none;">'+ data.nama_web_product +'</td>'+
                        '                      <td>'+ data.nama_web_product +' <br> '+ convertToRupiah(data.nominal_web_pricelist) +'</td>' +
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
        nominal_web_pricelist = $('#dataTableProd').DataTable().row( this ).data()[1];
        nama_web_product = $('#dataTableProd').DataTable().row( this ).data()[2];
        $('#ucode_web_product').val(ucode_web_product);
        $('#nominal_web_pricelist').val(nominal_web_pricelist);
        $('#nama_web_product').val(nama_web_product);
        $('#product-modal').modal('hide');
    } );

    get_all_promo();

    //get all promo
    function get_all_promo(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_promo', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr class="tr-hover">' +
                        ' <td style="display: none;">'+ data.id_web_promosi +'</td>'+
                        ' <td style="display: none;">'+ data.ucode_web_product +'</td>'+
                        ' <td>'+ data.nama_web_product +'</td>\n'+
                        ' <td> Final Harga: '+ convertToRupiah(data.nominal_web_promosi) +'<br> Persentase: '+ data.persen_web_promosi +'%</td>\n' +
                        ' <td> Start: '+ data.start_web_promosi +'<br>End: '+ data.end_web_promosi +'<br> <strong>'+ promo_status(data) +'</strong></td>\n' +
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


    // get promo by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        id_web_promosi = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_promo_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {id: id_web_promosi},
            success     : function(data){

                mode = 'view';
                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
                $('.delete-promo').css('display', 'none');

                $('#id_web_promosi').val(htmlDecode(data.id_web_promosi));
                $('#ucode_web_product').val(htmlDecode(data.ucode_web_product));
                $('#nama_web_product').val(htmlDecode(data.nama_web_product));
                $('#nominal_web_pricelist').val(htmlDecode(data.nominal_web_pricelist));
                $('#nominal_web_promosi').val(htmlDecode(data.nominal_web_promosi));
                $('#persen_web_promosi').val(htmlDecode(data.persen_web_promosi));

                $('#start_web_promosi').val(data.custom_start_date);
                $('#end_web_promosi').val(data.custom_end_date);

                $('.form-active-control').prop('disabled', true);

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-promo-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );


    $('.add-promo').click(function (e) {
        e.preventDefault();
        mode = 'add';
        $('#id_web_promosi').val(0);
        $('#ucode_web_product').val(0);
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

        $('.delete-promo').css('display', 'none');
        $('.modal-button-view-only').css('display', 'none');
        $('#master-promo-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('#master-promo-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');
    })

    $('.edit-promo').click(function(e){
        mode = 'edit';
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.delete-promo').css('display', '');
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.delete-promo').click(function(e){
        e.preventDefault();
        $('#master-promo-modal').modal('hide');
        setTimeout(function() {
            // needs to be in a timeout because we wait for BG to leave
            // keep class modal-open to body so users can scroll
            $('body').addClass('modal-open');
        }, 400);
        $('#delete-modal').modal('show');
    })

    $('.delete-promo-confirm').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'delete_promosi', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-promo-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_promo();
                    $('#master-promo-modal').modal('hide');
                    $('#delete-modal').modal('hide');
                    show_snackbar(response.Message);
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('.save-promo').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_promo', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-promo-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_promo();
                    $('#master-promo-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#product-modal, #delete-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#master-promo-modal').modal('show')

    })

    $('.product-form').click(function(e){
        e.preventDefault();
        if(mode == 'add'){
            $('#master-promo-modal').modal('hide');
            setTimeout(function() {
                // needs to be in a timeout because we wait for BG to leave
                // keep class modal-open to body so users can scroll
                $('body').addClass('modal-open');
            }, 400);
            toggle_prod();
        }
    })

    $('#nominal_web_promosi, #persen_web_promosi').keydown(function(e){
        if($('#ucode_web_product').val() == '0'){
            e.preventDefault();
            alert('Silahkan pilih produk terlebih dahulu')
        }
    })

    $('#nominal_web_promosi').keyup(function(e){
        if($('#ucode_web_product').val() != '0'){
            percentage = (100 * parseInt($(this).val())) / parseInt($('#nominal_web_pricelist').val())
            final_percentage = 100 - percentage;
            $('#persen_web_promosi').val(parseInt(final_percentage));
        }
    })

    $('#persen_web_promosi').keyup(function(e){
        if($('#ucode_web_product').val() != '0'){
            nominal = (parseInt($(this).val()) / 100) * parseInt($('#nominal_web_pricelist').val());
            final_nominal = parseInt($('#nominal_web_pricelist').val()) - nominal;
            $('#nominal_web_promosi').val(parseInt(final_nominal));
        }
    })

    function promo_status(data){
        var start_date = new Date(Date.parse(data.start_web_promosi.replace(/[-]/g,'/')));
        var end_date = new Date(Date.parse(data.end_web_promosi.replace(/[-]/g,'/')));
        var todaysDate = new Date();

        if(start_date < todaysDate && todaysDate < end_date){
            return "Status: AKTIF"
        } else if (todaysDate < start_date){
            return "Status: AKAN DATANG"
        } else {
            return "Status: NON AKTIF"
        }

    }



</script>
