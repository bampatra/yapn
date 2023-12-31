

<div id="deleteModal" class="modal fade">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header flex-column">
                <h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>Do you really want to delete this record? This process cannot be undone.</p>
            </div>
            <div class="alert alert-danger alert-delete" role="alert" style="display: none;">
                FAILED TO DELETE RECORD
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger confirm-delete">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Rekening</h1>
    <br>

    <button class="btn btn-primary add-rekening" style="background: #a50000; color: white; width: 300px;"> Tambah Rekening </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rekening</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th style="width: 10%">No.</th>
                        <th style="width: 50%">Rekening</th>
                        <th> Golongan </th>
                        <th> S/N </th>
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
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rekening</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rekening-form">
                    <div class="form-group" >
                        <label  class="col-form-label">No. Rekening</label>
                        <input type="text" id="no_rekening" name="no_rekening" onkeydown="isNumber(e)" class="form-control form-active-control">
                        <div class="invalid-feedback invalid-norek">Required</div>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Rekening</label>
                        <input type="text" id="nama_rekening" name="nama_rekening" class="form-control form-active-control">
                        <div class="invalid-feedback invalid-namarekening">Required</div>
                    </div>

                    <div class="form-group" >
                        <label  class="col-form-label">Golongan</label>
                        <select id="id_golongan" name="id_golongan" class="form-control form-active-control selectpicker" data-live-search="true">
                            <option value="0"> -- Pilih Golongan --</option>
                            <?php foreach ($golongan_list as $golongan) { ?>
                                <option value="<?php echo $golongan->id_golongan; ?>">
                                    <?php echo $golongan->nama_golongan; ?> (<?php echo $golongan->no_golongan; ?>)
                                </option>


                            <?php } ?>
                        </select>
                        <div class="invalid-feedback invalid-golongan">Required</div>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">S/N</label>
                        <input id="s_n_golongan" name="s_n_golongan" class="form-control form-active-control" readonly>
                    </div>

                    <input type="hidden" name="id_rekening" id="id_rekening" value="0">
                </form>

                <div class="alert alert-danger alert-exist" role="alert" style="display: none;">
                    Data already exists in database.
                </div>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger delete-rekening">Hapus</button>
                    <button type="button" class="btn btn-primary edit-rekening">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-rekening">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    get_all_rekening();

    $('.delete-rekening').click(function(e){
        e.preventDefault();

        $('#rekening-modal').modal('hide')
        $('#deleteModal').modal('show')
    })

    $('.confirm-delete').click(function(e){
        $('.loading').css("display", "block");
        e.preventDefault();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'delete_rekening', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_rekening: $('#id_rekening').val()},
            success: function (response) {

                if(response.Status == "OK"){
                    $('#deleteModal').modal('hide')
                    get_all_rekening();
                } else if(response.Status == "ERROR"){
                    $('.alert-delete').css("display", "block");
                }

                $('.loading').css("display", "none");
            }
        })
    })

    function get_all_rekening(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_rekening', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td style="display: none;">'+ data.id_rekening +'</td>' +
                        '   <td>'+ data.no_rekening +'</td>' +
                        '   <td>'+ data.nama_rekening +'</td>' +
                        '   <td><strong>'+ data.nama_golongan + '</strong><br>No. Golongan: <span>'+ data.no_golongan +'</span>' +'</td>' +
                        '   <td>'+ data.s_n_golongan +'</td>' +
                        '    </tr>';

                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 1, "asc" ]],
                    "scrollX": true,
                    pagingType: "simple",
                } );

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('.add-rekening').click(function (e) {
        $('.invalid-feedback').css('display', 'none');
        $('.alert-danger').css('display', 'none');
        e.preventDefault();
        setTimeout(function () {
            $('.modal-dialog').scrollTop(0);
        }, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('.modal-button-save').css('display', 'block');
        $('#rekening-form').trigger('reset');
        $('#id_rekening').val(0);
        $('.form-active-control').prop('disabled', false);
        $('#rekening-modal').modal('toggle');
    })

    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.invalid-feedback').css('display', 'none');
        $('.alert-danger').css('display', 'none');
        id_rekening = $('#dataTable').DataTable().row( this ).data()[0];
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_rekening_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_rekening: id_rekening},
            success: function (data) {
                $('#id_rekening').val(data.id_rekening);
                $('#no_rekening').val(data.no_rekening);
                $('#nama_rekening').val(htmlDecode(data.nama_rekening));
                $('#id_golongan').val(data.id_golongan);
                $('#s_n_golongan').val(data.s_n_golongan);

                $('.form-active-control').prop('disabled', true);
                $('#rekening-modal').modal('toggle');
                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    $('.edit-rekening').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-rekening').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_rekening', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#rekening-form').serialize(),
            success: function (response) {
                $('.invalid-feedback').css('display', 'none');
                $('.alert-exist').css('display', 'none');
                if(response.Status == "OK"){
                    get_all_rekening();
                    $('#rekening-modal').modal('hide');
                } else if(response.Status == "ERROR"){
                    $('.invalid-feedback').css('display', 'none');
                    response.Error.forEach(function(error){
                        $('.'+ error +'').css('display', 'block');
                    })
                } else if(response.Status == "EXIST"){
                    $('.alert-exist').css('display', 'block');
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('#id_golongan').change(function(){
        id_golongan = $(this).val();
        $('#s_n_golongan').val('Loading...');
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_golongan_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_golongan: id_golongan},
            success: function(data){
                $('#s_n_golongan').val(data.s_n_golongan);
            }
        })
    })

</script>
