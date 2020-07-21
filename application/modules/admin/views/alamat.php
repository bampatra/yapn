

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Master Alamat</h1>
    <br>

    <!-- <button class="btn btn-primary add-user" style="background: #a50000; color: white; width: 300px;"> Tambah Alamat </button>-->
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Alamat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th>User</th>
                        <th>Penerima</th>
                        <th>Alamat</th>
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


<div class="modal fade" tabindex="-1" role="dialog" id="master-alamat-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="master-user-form">
                    <div class="form-group" >
                        <label class="col-form-label">Pemilik Alamat</label>
                        <input type="text" id="email_web_user"  name="email_web_user" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Nama Penerima</label>
                        <input type="text" id="nama_web_user_alamat" name="nama_web_user_alamat" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">No. Telepon Penerima</label>
                        <input type="text" id="telp_web_user_alamat" name="telp_web_user_alamat" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kecamatan Penerima</label>
                        <input type="text" id="kecamatan_web_user_alamat" name="kecamatan_web_user_alamat" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Kota Penerima</label>
                        <input type="text" id="kota_web_user_alamat" name="kota_web_user_alamat" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Provinsi Penerima</label>
                        <input type="text" id="provinsi_web_user_alamat" name="provinsi_web_user_alamat" class="form-control form-active-control">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Alamat Penerima</label>
                        <textarea id="alamat_web_user_alamat" name="alamat_web_user_alamat" class="form-control form-active-control"></textarea>
                    </div>

                    <input type="hidden" id="id_web_user_alamat" name="id_web_user_alamat" val="0">
                </form>
            </div>
            <div class="modal-footer">
                <!--<div class="modal-button-view-only">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary edit-user">Edit</button>
                </div>
                <div class="modal-button-save">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save-user">Simpan</button>
                </div>-->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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


<script>
    $('#collapseUser').addClass('show');
    $('#navbar-alamat').addClass('active');

    get_all_alamat();

    //get all products
    function get_all_alamat(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_alamat', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr>' +
                        ' <td style="display: none;">'+ data.id_web_user_alamat +'</td>'+
                        '                      <td style="width: 30%">'+ data.email_web_user +'</td>\n'+
                        '                      <td style="width: 25%">'+ data.nama_web_user_alamat +' <br> '+ data.telp_web_user_alamat +'</td>\n' +
                        '                      <td style="width: 45%">'+ data.alamat_web_user_alamat +'<br>'+ data.kecamatan_web_user_alamat +', '+ data.kota_web_user_alamat +', '+ data.provinsi_web_user_alamat +'</td>\n' +
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

    // get alamat by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');

        id_web_user_alamat = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_alamat_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {id_web_user_alamat: id_web_user_alamat},
            success     : function(data){



                $('#email_web_user').val(data.email_web_user + ' (ID #' + data.id_web_user + ')')
                $('#id_web_user_alamat').val(data.id_web_user_alamat);
                $('#nama_web_user_alamat').val(data.nama_web_user_alamat);
                $('#telp_web_user_alamat').val(data.telp_web_user_alamat);
                $('#kecamatan_web_user_alamat').val(data.kecamatan_web_user_alamat);
                $('#kota_web_user_alamat').val(data.kota_web_user_alamat);
                $('#provinsi_web_user_alamat').val(data.provinsi_web_user_alamat);
                $('#alamat_web_user_alamat').val(data.alamat_web_user_alamat);


                $('.form-active-control').prop('disabled', true);
                //
                // $('.modal-button-save').css('display', 'none');
                // $('.modal-button-view-only').css('display', 'block');
                $('#master-alamat-modal').modal('toggle');
                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });


</script>
