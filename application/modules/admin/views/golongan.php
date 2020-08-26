

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Golongan</h1>
    <br>

    <button class="btn btn-primary add-golongan" style="width: 300px;"> Tambah Golongan </button>
    <br> <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Golongan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none">ID</th>
                        <th style="width: 10%">No.</th>
                        <th style="width: 50%">Golongan</th>
                        <th> S/N </th>
                        <th> Neraca </th>
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
                <h5 class="modal-title">Golongan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="golongan-form">
                    <div class="form-group" >
                        <label  class="col-form-label">No. Golongan</label>
                        <input type="text" id="no_golongan" name="no_golongan" onkeydown="isNumber(e)" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Golongan</label>
                        <input type="text" id="nama_golongan" name="nama_golongan" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">S/N</label>
                        <select id="s_n_golongan" name="s_n_golongan" class="form-control form-active-control">
                            <option value="Debet">Debet</option>
                            <option value="Kredit">Kredit</option>
                        </select>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Neraca</label>
                        <select id="neraca" name="neraca" class="form-control form-active-control">
                            <option value="Aset Lancar">Aset Lancar</option>
                            <option value="Aset Tetap">Aset Tetap</option>
                            <option value="Kewajiban">Kewajiban</option>
                            <option value="Modal">Modal</option>
                            <option value="Laba Rugi">Laba Rugi</option>
                        </select>
                    </div>

                    <input type="hidden" name="id_golongan" id="id_golongan" value="0">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-golongan">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-golongan">Simpan</button>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    get_all_golongan();

    function get_all_golongan(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_golongan', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td style="display: none;">'+ data.id_golongan +'</td>' +
                        '   <td>'+ data.no_golongan +'</td>' +
                        '   <td>'+ data.nama_golongan +'</td>' +
                        '   <td>'+ data.s_n_golongan +'</td>' +
                        '   <td>'+ data.neraca +'</td>' +
                        '    </tr>';

                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 1, "asc" ]],
                    "scrollX": true
                } );

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    $('.add-golongan').click(function (e) {
        e.preventDefault();
        setTimeout(function () {
            $('.modal-dialog').scrollTop(0);
        }, 200);
        $('.modal-button-view-only').css('display', 'none');
        $('.modal-button-save').css('display', 'block');
        $('#golongan-form').trigger('reset');
        $('#id_golongan').val(0);
        $('.form-active-control').prop('disabled', false);
        $('#golongan-modal').modal('toggle');
    })

    $('#dataTable').on( 'click', 'tbody tr', function () {
        id_golongan = $('#dataTable').DataTable().row( this ).data()[0];
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_golongan_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_golongan: id_golongan},
            success: function (data) {
                $('#id_golongan').val(data.id_golongan);
                $('#no_golongan').val(data.no_golongan);
                $('#s_n_golongan').val(data.s_n_golongan);
                $('#nama_golongan').val(htmlDecode(data.nama_golongan));
                $('#neraca').val(data.neraca);

                $('.form-active-control').prop('disabled', true);
                $('#golongan-modal').modal('toggle');
                $('.modal-button-save').css('display', 'none');
                $('.modal-button-view-only').css('display', 'block');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    $('.edit-golongan').click(function(e){
        setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
        $('.modal-button-save').css('display', 'block');
        $('.modal-button-view-only').css('display', 'none');
        $('.form-active-control').prop('disabled', false);
    })

    $('.save-golongan').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_golongan', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#golongan-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_golongan();
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
