

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Pengaturan Media Sosial</h1>
    <br>

    <button class="btn btn-primary add-media-sosial" style="background: #a50000; color: white; width: 300px;"> Tambah Media Sosial </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Media Sosial</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th style="width: 60%">Media Sosial</th>
                        <th>Username (tanpa @)</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="media-sosial-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sosial-media-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Sosial Media</label>
                        <input type="text" id="nama_web_variable" name="nama_web_variable" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Username (tanpa @)</label>
                        <input type="text" id="isi_web_variable" name="isi_web_variable" class="form-control form-active-control">
                    </div>

                    <input type="hidden" id="id_web_variable" name="id_web_variable" value="0">
                    <input type="hidden" id="tipe_web_variable" name="tipe_web_variable" value="MEDIA_SOSIAL">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-media-sosial">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-media-sosial">Simpan</button>
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
    $('#collapseHalamanUtama').addClass('show');
    $('#navbar-media-sosial').addClass('active');

    product_url = '<?php echo base_url('product/');?>';

    get_all_variable();

    function get_all_variable(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_variable', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {tipe_web_variable: 'MEDIA_SOSIAL'},
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td style="display: none;">'+ data.id_web_variable +'</td>' +
                        '   <td>'+ data.nama_web_variable +'</td>' +
                        '   <td>'+ data.isi_web_variable +'</td>' +
                        '    </tr>';

                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 1, "asc" ]]
                } );

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('.add-media-sosial').click(function (e) {
        e.preventDefault();
        setTimeout(function () {
            $('.modal-dialog').scrollTop(0);
        }, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('.modal-button-save').css('display', 'block');
        $('#sosial-media-form').trigger('reset');
        $('#id_web_variable').val(0);
        $('#tipe_web_variable').val('MEDIA_SOSIAL');
        $('.form-active-control').prop('disabled', false);
        $('#media-sosial-modal').modal('toggle');
    })

    $('#dataTable').on( 'click', 'tbody tr', function () {
        id_web_variable = $('#dataTable').DataTable().row( this ).data()[0];
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_variable_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_web_variable: id_web_variable},
            success: function (data) {
                $('#id_web_variable').val(data.id_web_variable);
                $('#nama_web_variable').val(data.nama_web_variable);
                $('#isi_web_variable').val(data.isi_web_variable);

                $('.form-active-control').prop('disabled', true);
                $('#media-sosial-modal').modal('toggle');
                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    $('.edit-media-sosial').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-media-sosial').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_variable', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#sosial-media-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_variable();
                    $('#media-sosial-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

</script>
