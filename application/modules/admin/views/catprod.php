

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Master Kategori</h1>
            <br>

            <button class="btn btn-primary add-product" style="background: #a50000; color: white; width: 300px;"> Tambah Kategori </button>
            <br> <br>
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="display: none;"> ID </th>
                      <th style="width: 60%">Nama Kategori</th>
                      <th style="display: none;">Gambar</th>
                      <th>Status</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-catprod-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-category-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Kategori</label>
                        <input type="text" id="nama_web_catprod" name="nama_web_catprod" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label class="col-form-label">Gambar Kategori</label><br>
                        <a style="color: #a50000; text-decoration: underline; font-size: 12px; margin-top: -5px; cursor: pointer" id="add-catprod-img-btn"></a>
                        <input type="hidden" id="img_web_catprod" name="img_web_catprod" value="">
                        <input type="hidden" id="icon_web_catprod" name="icon_web_catprod" value="">
                        <div id="view_img_web_catprod" style="margin-top: 10px;"> </div>
                    </div>
                    <div class="form-group" >
                        <label> Aktif </label>
                        <input class="form-control form-active-control" type="checkbox" id="active_web_catprod" name="active_web_catprod">
                    </div>


                    <input type="hidden" id="ucode_catprod" name="ucode_catprod" val="0">
                </form>
                <form id="image_only">
                    <input type="file" id="img_web_catprod_input" name="img_web_catprod_input" style="display:none;">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-product">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-category">Simpan</button>
                </div>

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
</style>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    $('#collapseMaster').addClass('show');
    $('#navbar-kategori').addClass('active');

    product_url = '<?php echo base_url('product/');?>';
    category_url = '<?php echo base_url('category/');?>';

    get_all_category();

    //get all products
    function get_all_category(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_category', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                                            ' <td style="display: none;">'+ data.id_web_catprod +'</td>'+
                        '                      <td>'+ data.nama_web_catprod +'</td>\n'+
                        '                      <td style="text-align: center; display:none;"> <img style="max-height: 100px; max-width: 100px;" src="'+ data.img_web_catprod +'"></td>\n' +
                        '                      <td>'+ active_status(data.active_web_catprod) +'</td>\n' +
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

    // get category by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        ucode_catprod = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_category_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {ucode_catprod: ucode_catprod},
            success     : function(data){

                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('#ucode_catprod').val(htmlDecode(data.id_web_catprod));
                $('#nama_web_catprod').val(htmlDecode(data.nama_web_catprod));
                $('#img_web_catprod').val(htmlDecode(data.img_web_catprod));
                $('#icon_web_catprod').val(htmlDecode(data.icon_web_catprod));

                if(data.img_web_catprod != ''){
                    $('#add-catprod-img-btn').html('Ganti gambar');
                    $('#view_img_web_catprod').html('<img style="max-height: 150px; max-width: 150px;" src="'+ data.img_web_catprod +'">');
                } else {
                    $('#add-catprod-img-btn').html('Tambah gambar');
                    $('#view_img_web_catprod').html('');
                }


                if(data.active_web_catprod == '1'){
                    $('#active_web_catprod').prop('checked', true);
                } else {
                    $('#active_web_catprod').prop('checked', false);
                }

                $('.form-active-control').prop('disabled', true);

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-catprod-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );


    $('.add-product').click(function (e) {
        e.preventDefault();
        $('#add-catprod-img-btn').html('Tambah Produk');
        $('#view_img_web_catprod').html('');
        $('#ucode_catprod').val(0);
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('#img_web_catprod').val('');
        $('#icon_web_catprod').val('');
        $('.modal-button-view-only').css('display', 'none');
        $('#master-category-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('#master-catprod-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');

    })

    $('.edit-product').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);

    })

    $('.save-category').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_category', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-category-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_category();
                    $('#master-catprod-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#add-catprod-img-btn').click(function(e){
        e.preventDefault();
        $('#img_web_catprod_input').click();
    })

    $('#img_web_catprod_input').change(function(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        var formData = new FormData($('#image_only')[0]);

        $.ajax({
            url         : admin_url + 'upload_image_catprod',
            method      : "POST",
            data        : formData,
            processData : false,
            contentType : false,
            dataType    : 'json',
            success: function(response){
                if(response.Status == "OK"){
                    $('#add-catprod-img-btn').html('Ganti gambar');
                    $('#view_img_web_catprod').html('<img style="max-height: 150px; max-width: 150px;" src="'+ response.File +'">');
                    $('#img_web_catprod').val(response.File);

                } else {
                    show_snackbar(response.Message);
                }

                // $('.review-danger').html('');
                // $('.review-danger').css('display', 'none');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        });
    })


</script>
