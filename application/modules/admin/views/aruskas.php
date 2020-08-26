

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Arus Kas</h1>
    <br>

    <button class="btn btn-primary add-arus-kas" style="background: #a50000; color: white; width: 300px;"> Tambah Arus Kas </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Arus Kas</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th style="width: 10%">No.</th>
                        <th style="width: 50%">Arus Kas</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="golongan-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Arus Kas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="golongan-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Arus Kas</label>
                        <input type="text" id="nama_arus_kas" name="nama_arus_kas" class="form-control form-active-control">
                    </div>

                    <input type="hidden" name="id_arus_kas" id="id_arus_kas" value="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-arus-kas">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-arus-kas">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    get_all_arus_kas();

    function get_all_arus_kas(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_arus_kas', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td style="display: none;">'+ data.id_arus_kas +'</td>' +
                        '   <td>'+ (i + 1) +'</td>' +
                        '   <td>'+ data.nama_arus_kas +'</td>' +
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

    $('.add-arus-kas').click(function (e) {
        e.preventDefault();
        setTimeout(function () {
            $('.modal-dialog').scrollTop(0);
        }, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('.modal-button-save').css('display', 'block');
        $('#golongan-form').trigger('reset');
        $('#id_arus_kas').val(0);
        $('.form-active-control').prop('disabled', false);
        $('#golongan-modal').modal('toggle');
    })

    $('#dataTable').on( 'click', 'tbody tr', function () {
        id_arus_kas = $('#dataTable').DataTable().row( this ).data()[0];
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_arus_kas_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_arus_kas: id_arus_kas},
            success: function (data) {
                $('#id_arus_kas').val(data.id_arus_kas);
                $('#nama_arus_kas').val(htmlDecode(data.nama_arus_kas));

                $('.form-active-control').prop('disabled', true);
                $('#golongan-modal').modal('toggle');
                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    $('.edit-arus-kas').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-arus-kas').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_arus_kas', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#golongan-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_arus_kas();
                    $('#golongan-modal').modal('hide');
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

</script>
