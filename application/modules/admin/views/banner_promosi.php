

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengaturan Banner Promosi</h1>
    <br>

    <button class="btn btn-primary add-warna" style="background: #a50000; color: white; width: 300px;"> Tambah Banner </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Banner Promosi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="display: none;"> Order </th>
                        <th style="width: 60%">Banner</th>
                        <th>Controls</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-banner-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Banner Promosi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-banner-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Gambar Banner</label>
                        <div id="gambar-banner"></div>
                        <input type="hidden" id="file_web_banner" name="file_web_banner" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">URL Banner</label>
                        <input type="text" id="url_web_banner" name="url_web_banner" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label> Aktif </label>
                        <input type="checkbox" id="active_web_banner" name="active_web_banner" class="form-control form-active-control">
                    </div>

                    <input type="hidden" id="id_web_banner" name="id_web_banner" val="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-warna">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-warna">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="gambar-produk-modal" style="z-index: 5001">
    <div class="modal-dialog" role="document" style="max-height: 90vh; max-width: 70vw">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input style="visibility: hidden"  type="file" id="fileInput" accept="image/*" />
                <input type="button" id="btnCrop" value="Crop" />
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
    $('#collapseHalamanUtama').addClass('show');
    $('#navbar-banner-promosi').addClass('active');

    product_url = '<?php echo base_url('product/');?>';
    banner_type = 'PROMOSI'

    get_all_banner();

    function get_all_banner(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_banner', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {type: banner_type},
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){
                    html += '<tr class="tr-hover">' +
                        ' <td style="display: none;" class="id_banner">'+ data.id_web_banner +'</td>'+
                        ' <td style="display: none;">'+ data.order_web_banner +'</td>'+
                        '                      <td><img style="max-width: 450px; max-height: 191px" src="<?php echo base_url()?>'+ data.file_web_banner +'">';

                    if(data.active_web_banner == '0'){
                        html += '<br><br><div class="alert alert-secondary" role="alert">\n' +
                            ' Banner tidak aktif' +
                            '</div>';
                    }

                    html+=   '</td>\n'+
                        '                       <td class="controls" style="vertical-align: middle;text-align: center;">';

                        // controls


                    if(length > 1){
                        if(i == 0){
                            html += '<i style="font-size: 36px" class="fa fa-angle-down">';
                        } else if(i ==  (length - 1)) {
                            html += '<i style="font-size: 36px" class="fa fa-angle-up">';
                        } else {
                            html += '<i style="font-size: 36px" class="fa fa-angle-down"></i><span style="margin: 0px 20px;"></span><i style="font-size: 36px" class="fa fa-angle-up"></i>';
                        }
                    }




                    html +=    '</td>' +
                        '                    </tr>';

                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 1, "asc" ]]
                } );

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

                $('.controls').click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                })

                $('.fa-angle-down').click(function(e){
                    current_id = $(this).parent().parent().find('.id_banner').html();
                    move_id = $(this).parent().parent().next('tr').find('.id_banner').html();
                    // console.log('current id: ' + current_id + ' / move id : ' + move_id);
                    swap(current_id, move_id);

                })

                $('.fa-angle-up').click(function(e){
                    current_id = $(this).parent().parent().find('.id_banner').html();
                    move_id = $(this).parent().parent().prev('tr').find('.id_banner').html();
                    // console.log('current id: ' + current_id + ' / move id : ' + move_id);

                    swap(current_id, move_id);
                })
            }
        })
    }

    function swap(current_id, move_id){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'swap_banner_order', // the url where we want to POST// our data object
            dataType: 'json',
            data: {current_id: current_id, move_id: move_id},
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_banner();
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }


    // get warna by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        id_web_banner = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_banner_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {id_web_banner: id_web_banner},
            success     : function(data){

                 setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('#gambar-banner').html('<img style="max-width: 450px; max-height: 191px" src="<?php echo base_url()?>'+ data.file_web_banner +'">' +
                                        '<br><a style="color: #a50000; text-decoration: underline; cursor: pointer; font-size: 12px;" onclick="tambah_gambar()"> Ganti </a>');

                $('#id_web_banner').val(data.id_web_banner);
                $('#file_web_banner').val(data.file_web_banner);
                $('#url_web_banner').val(data.url_web_banner);

                if(data.active_web_banner == '1'){
                    $('#active_web_banner').prop('checked', true);
                } else {
                    $('#active_web_banner').prop('checked', false);
                }

                $('.form-active-control').prop('disabled', true);

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-banner-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );

    function tambah_gambar(){
        $('#fileInput').click();
        $('#master-banner-modal').modal('hide');
        setTimeout(function() {
            // needs to be in a timeout because we wait for BG to leave
            // keep class modal-open to body so users can scroll
            $('body').addClass('modal-open');
        }, 200);
        $('#gambar-produk-modal').modal({
            backdrop: 'static'
        });
        $('#btnCrop').css("display", "none");
        $("#canvas").cropper('destroy');
        $("#canvas").css("display", "none");
        $('#fileInput').val('');
    }

    $('.add-warna').click(function (e) {
        e.preventDefault();
        $('#ucode_web_col').val(0);
         setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('#master-warna-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('#master-banner-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');
        $('#gambar-banner').html('<a style="color: #a50000; text-decoration: underline; cursor: pointer; font-size: 12px;" onclick="tambah_gambar()"> Tambah Gambar </a>')
    })

    $('.edit-warna').click(function(e){
         setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-warna').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_banner', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-banner-form').serialize() + "&type=" + banner_type,
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_banner();
                    $('#master-banner-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    var canvas  = $("#canvas"),
        context = canvas.get(0).getContext("2d"),
        $result = $('#result'),
        allow_upload = true;

    $('#fileInput').on( 'change', function(){

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
                            aspectRatio: 1125 / 464
                        });
                        $('#btnCrop').css("display", "block");
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
                            formDataToUpload.append("gambar_banner", blob);

                            // upload image
                            if(allow_upload == true){
                                $('.loading').css("display", "block");
                                $('.Veil-non-hover').fadeIn();
                                allow_upload = false
                                $.ajax({
                                    url: admin_url + 'upload_gambar_banner',
                                    type: "POST",
                                    data: formDataToUpload,
                                    processData: false,
                                    contentType: false,
                                    dataType: 'json',
                                    success: function(response){
                                        if(response.Status == "OK"){
                                            canvas.cropper('destroy');
                                            canvas.css("display", "none");
                                            allow_upload = true;
                                            $('#gambar-produk-modal').modal('hide');
                                            $('#gambar-banner').html('<img style="max-width: 450px; max-height: 191px" src="<?php echo base_url()?>'+ response.File +'">');

                                            $('#file_web_banner').val(response.File)
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


    $('#gambar-produk-modal').on('hidden.bs.modal', function () {
        // Load up a new modal...
        $('#master-banner-modal').modal('show')
        $("#canvas").cropper('destroy');
        $("#canvas").css("display", "none");
    })


</script>
