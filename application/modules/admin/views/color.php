

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Warna</h1>
    <br>

    <button class="btn btn-primary add-warna" style="background: #a50000; color: white; width: 300px;"> Tambah Warna </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Warna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th style="width: 60%">Nama Warna</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-color-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-warna-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Warna</label>
                        <input type="text" id="nama_web_col" name="nama_web_col" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label> Aktif </label>
                        <input class="form-control form-active-control" type="checkbox" id="active_web_col" name="active_web_col">
                    </div>

                    <input type="hidden" id="ucode_web_col" name="ucode_web_col" val="0">
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
    $('#navbar-warna').addClass('active');

    product_url = '<?php echo base_url('product/');?>';

    get_all_color();

    //get all products
    function get_all_color(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_color', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.ucode_web_col +'</td>'+
                        '                      <td>'+ data.nama_web_col +'</td>\n'+
                        '                      <td>'+ active_status(data.active_web_col) +'</td>\n' +
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

    // get warna by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        ucode_web_col = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_color_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {ucode_web_col: ucode_web_col},
            success     : function(data){

                 setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('#ucode_web_col').val(htmlDecode(data.ucode_web_col));
                $('#nama_web_col').val(htmlDecode(data.nama_web_col));

                if(data.active_web_col == '1'){
                    $('#active_web_col').prop('checked', true);
                } else {
                    $('#active_web_col').prop('checked', false);
                }

                $('.form-active-control').prop('disabled', true);

                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('#master-color-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );


    $('.add-warna').click(function (e) {
        e.preventDefault();
        $('#ucode_web_col').val(0);
         setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('#master-warna-form').trigger('reset');
        $('.form-active-control').prop('disabled', false);
        $('#master-color-modal').modal('toggle');
        $('.modal-button-save').css('display', 'block');
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
            url: admin_url + 'add_warna', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#master-warna-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_color();
                    $('#master-color-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })
    


</script>
