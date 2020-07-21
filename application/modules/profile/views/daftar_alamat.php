<div class="modal fade" tabindex="-1" role="dialog" id="delete-address-dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Alamat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="delete-address-error" style="display:none"></div>
                <p>Apakah anda ingin menghapus alamat ini?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn confirm-hapus">Hapus</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div style="max-height: 80vh; width: 50vw; overflow: auto; text-align: left;" class="pop-up-content">
    <div class="close-popup"></div>
    <h5 id="popup-title" style="margin-top: 10px;"> </h5>
    <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>
    <div class="alert alert-danger" role="alert" style="display:none;"></div>
    <form id="new-address-form">
        <div class="form-group" >
            <label for="email_address" class="col-form-label">Nama Penerima</label>
            <input type="text" id="nama_penerima_form" name="nama_penerima" class="form-control">
            <div class="invalid-feedback invalid-nama-penerima">Nama Penerima tidak boleh kosong</div>
        </div>
        <div class="form-group" >
            <label for="email_address" class="col-form-label">No. Telepon Penerima</label>
            <input type="text" id="telp_penerima_form" name="telp_penerima" class="form-control">
            <div class="invalid-feedback invalid-telp-penerima">Nama Penerima tidak boleh kosong</div>
        </div>
        <div class="form-group" >
            <label for="email_address" class="col-form-label">Provinsi</label>
            <input type="text" id="provinsi_penerima_form" name="provinsi_penerima" class="form-control">
            <input type="hidden" id="id_provinsi_penerima_form" name="id_provinsi" class="form-control" value="0">
            <div class="invalid-feedback invalid-provinsi">Provinsi tidak valid</div>
        </div>
        <div class="form-group" >
            <label for="email_address" class="col-form-label">Kota</label>
            <input type="text" id="kota_penerima_form" name="kota_penerima" class="form-control">
            <input type="hidden" id="id_kota_penerima_form" name="id_kota" class="form-control" value="0">
            <div class="invalid-feedback invalid-kota">Kota tidak valid</div>
        </div>
        <div class="form-group" >
            <label for="email_address" class="col-form-label">Kecamatan</label>
            <input type="text" id="kecamatan_penerima_form" name="kecamatan_penerima" class="form-control">
            <input type="hidden" id="id_kecamatan_penerima_form" name="id_kecamatan" class="form-control" value="0">
            <div class="invalid-feedback invalid-kecamatan">Kecamatan tidak valid</div>
        </div>
        <div class="form-group" >
            <label for="email_address" class="col-form-label">Alamat Lengkap</label>
            <input type="text" id="alamat_penerima_form" name="alamat_penerima" class="form-control">
            <div class="invalid-feedback invalid-alamat">Alamat tidak boleh kosong</div>
        </div>
        <input type="hidden" value="0" name="is_primary">
        <input type="hidden" value="" name="notes_penerima">
        <input type="hidden" value="0" name="id_web_user_alamat" id="id_web_user_alamat">
        <button class="btn btn-secondary kembali">Kembali</button>
        <button class="btn simpan-address">Simpan</button>

    </form>
    <br>

</div>

<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil</a> <span style="font-size: 14px;">  > Alamat Pengiriman</span></div>
<div class="whitespace"></div>

<div class="main-section" style="text-align: left; min-height: 60vh">
    <h2>Kelola Alamat Pengiriman</h2>
    <p style="font-size: 14px">Untuk proses checkout yang lebih cepat, simpan alamat pengiriman anda di daftar alamat</p>
    <button class="btn add-address"> Tambah Alamat Baru </button>
    <br><br>
    <div id="daftar-alamat">
        <div style="text-align: center;">Memuat item....</div>

    </div>
</div>

<style>
    .address-span{
        font-size: 13px;
        color: #615c65;
    }

    #snackbar{
        z-index: 6000
    }

</style>

<script>

    profile_url = '<?php echo base_url('profile/');?>';
    cart_url = '<?php echo base_url('cart/');?>';

    let delete_address_id = 0;


    $('#provinsi_penerima_form').keyup(function(e){
        if(e.keyCode != 13){
            $('#id_provinsi_penerima_form').val(0);
            $('#id_kota_penerima_form').val(0);
            $('#id_kecamatan_penerima_form').val(0);

            $('#kota_penerima_form').val('');
            $('#kecamatan_penerima_form').val('');
        }


    })

    $('#kota_penerima_form').keyup(function(e){
        if(e.keyCode != 13) {
            $('#id_kota_penerima_form').val(0);
            $('#id_kecamatan_penerima_form').val(0);

            $('#kecamatan_penerima_form').val('');
        }
    })

    $('#kecamatan_penerima_form').keyup(function(e){
        if(e.keyCode != 13) {
            $('#id_kecamatan_penerima_form').val(0);
        }
    })

    $( "#provinsi_penerima_form" ).focusout(function(){
        if($('#id_provinsi_penerima_form').val() == '0'){
            $('#provinsi_penerima_form').val('');
        }
    })


    $( "#kota_penerima_form" ).focusout(function(){
        if($('#id_kota_penerima_form').val() == '0'){
            $('#kota_penerima_form').val('');
        }
    })

    $( "#kecamatan_penerima_form" ).focusout(function(){
        if($('#id_kecamatan_penerima_form').val() == '0'){
            $('#kecamatan_penerima_form').val('');
        }
    })

    $( "#provinsi_penerima_form" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: profile_url + 'get_suggest_provinsi',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#provinsi_penerima_form').val(ui.item.label);
            $('#id_provinsi_penerima_form').val(ui.item.id);
        },
        focus: function(event, ui) {
            $(this).val(ui.item.label);
        }
    });


    $( "#kota_penerima_form" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: profile_url + 'get_suggest_kota',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    provinsi: $('#id_provinsi_penerima_form').val()
                },
                success: function( data ) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#provinsi_penerima_form').val(ui.item.provinsi);
            $('#id_provinsi_penerima_form').val(ui.item.kode_provinsi);
            $('#kota_penerima_form').val(ui.item.value);
            $('#id_kota_penerima_form').val(ui.item.id);
            return false;
        },
        focus: function(event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
        }
    });


    $( "#kecamatan_penerima_form" ).autocomplete({
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: profile_url + 'get_suggest_kecamatan',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term,
                    kota: $('#id_kota_penerima_form').val()
                },
                success: function( data ) {
                    response(data);
                }
            });
        },
        select: function (event, ui) {
            // Set selection
            $('#provinsi_penerima_form').val(ui.item.provinsi);
            $('#id_provinsi_penerima_form').val(ui.item.kode_provinsi);
            $('#kota_penerima_form').val(ui.item.kota);
            $('#id_kota_penerima_form').val(ui.item.kode_kota);
            $('#kecamatan_penerima_form').val(ui.item.label);
            $('#id_kecamatan_penerima_form').val(ui.item.id);
            return false;
        },
        focus: function(event, ui) {
            event.preventDefault();
            $(this).val(ui.item.label);
        }
    });



    function get_address(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'get_alamat', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '<div class="card-group">';
                count = 0;
                if(data.length == 0){
                    html = '<div style="text-align: center; margin-top: 40px; margin-bottom: 60px;"> Tidak ada alamat terdaftar </div>';
                    $('#daftar-alamat').html(html);
                } else {
                    data.forEach(function(data){
                        count++;
                        html +=  '<div class="card link-card" style="background: white; width: 100%; padding: 15px; margin: 25px 10px !important; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;"><a style="text-decoration: none">\n'+
                            '                        <div class="card-body" style="padding: 0.3rem 0.5rem 0.5rem 0.5rem; height: 170px;">\n';

                        if(data.is_primary === '1'){
                            html +=    '<span style="font-size: 13px; color: #a50000"> Alamat Utama </span><br>';
                        } else {
                            html +=    '<span style="font-size: 13px; color: #a50000; visibility: hidden;"></span><br>';
                        }



                        html +=    '                            <span class="card-text nama_penerima" style="font-size: 16px; text-align: left;">'+ data.nama_web_user_alamat +'</span><br>\n'+
                                '                        <span class="address-span alamat_penerima">'+ data.alamat_web_user_alamat +'</span><br>'+
                                '                        <span class="address-span kecamatan_penerima">'+ data.kecamatan_web_user_alamat +'</span><span class="address-span">, </span> ' +
                            '                           <span class="address-span kota_penerima">'+ data.kota_web_user_alamat +'</span><span class="address-span">, </span>'+
                            '                           <span class="address-span provinsi_penerima">'+ data.provinsi_web_user_alamat +'</span><br>'+
                            '                           <span class="address-span telp_penerima">'+ data.telp_web_user_alamat +'</span><br>'+
                                                    '</div><br>' +
                            '<button class="btn edit-address" style="border-radius: 150px; margin-right: 5px;" id="edit_'+ data.id_web_user_alamat +'"> <i class="fas fa-edit"></i> </button>';

                        if(data.is_primary === '0'){
                            html +=    '<button class="btn delete-address" style="border-radius: 150px; margin-right: 5px;" id="delete_'+ data.id_web_user_alamat +'"> <i class="fas fa-trash"></i> </button>'+
                                '<button class="btn choose-as-main" style="border-radius: 150px;" id="main_'+ data.id_web_user_alamat +'"> <i class="fas fa-home"></i> </button>';
                        }

                        html+=    '                   </a> </div>';

                        if(mobile || tablet){
                            if(count % 1 === 0){
                                html += '</div><div class="card-group" ">';
                            }
                        } else {
                            if(count % 4 === 0){
                                html += '</div><div class="card-group" style="margin-bottom: 15px;">';
                            }
                        }

                    })

                    if(mobile || tablet){
                        if(data.length % 1 === 1){
                            html += '<div class="card link-card" style="visibility: hidden;"></div>'
                        }
                    } else {
                        if(data.length % 4 === 3){
                            html += '<div class="card link-card" style="visibility: hidden;"></div>'
                        } else if(data.length % 4 === 2) {
                            html += '<div class="card link-card" style="visibility: hidden;"></div>' +
                                '<div class="card link-card" style="visibility: hidden;"></div>';
                        } else if (data.length % 4 === 1 ) {
                            html += '<div class="card link-card" style="visibility: hidden;"></div>' +
                                '<div class="card link-card" style="visibility: hidden;"></div>' +
                                '<div class="card link-card" style="visibility: hidden;"></div>'
                        }
                    }

                    html += '</div>';
                    $('#daftar-alamat').html(html);

                    $('.edit-address').click(function(e){

                        e.stopPropagation();
                        e.preventDefault();
                        $('#popup-title').html('Sunting Alamat');

                        $('#id_web_user_alamat').val($(this).attr('id').split('edit_')[1]);
                        $('#nama_penerima_form').val($(this).parent().find('.card-body').find('.nama_penerima').html())
                        $('#telp_penerima_form').val($(this).parent().find('.card-body').find('.telp_penerima').html())
                        $('#alamat_penerima_form').val($(this).parent().find('.card-body').find('.alamat_penerima').html())
                        $('#kecamatan_penerima_form').val($(this).parent().find('.card-body').find('.kecamatan_penerima').html())
                        $('#kota_penerima_form').val($(this).parent().find('.card-body').find('.kota_penerima').html())
                        $('#provinsi_penerima_form').val($(this).parent().find('.card-body').find('.provinsi_penerima').html())

                        $('.pop-up-content').css('display', 'block');
                        $('.Veil-non-hover').fadeIn();

                    })

                    $('.delete-address').click(function(e){
                        e.stopPropagation();
                        e.preventDefault();

                        $('#delete-address-dialog').modal('toggle');
                        delete_address_id = $(this).attr('id').split('delete_')[1];

                    })

                    $('.choose-as-main').click(function(e){
                        $('.loading').css("display", "block");
                        $('.Veil').fadeIn();
                        e.preventDefault();
                        address = $(this).attr('id').split('main_')[1];
                        $.ajax({
                            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                            url         : profile_url + 'change_main_address', // the url where we want to POST
                            dataType    : 'json',
                            data        : {address: address},
                            success     : function(response){
                                if(response.Status == 'OK'){
                                    get_address();
                                }
                                show_snackbar(response.Message);
                                $('.loading').css("display", "none");
                                $('.Veil').fadeOut();
                            }
                        })
                    })
                }
            }
        })
    }

    $('.confirm-hapus').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'delete_address', // the url where we want to POST
            data        : {id_web_user_alamat: delete_address_id}, // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == 'OK'){
                    $('#delete-address-dialog').modal('hide');
                    $('.Veil-non-hover').fadeOut();
                    $('.alert-danger').css('display', 'none');
                    get_address();
                    show_snackbar('Alamat dihapus');
                } else if(response.Status == 'ERROR'){
                    $('#delete-address-error').html(response.Message);
                    $('#delete-address-error').css('display', 'block');
                }

                $('.loading').css("display", "none");
                $('.Veil').fadeOut();

            }
        })



    })

    $('.simpan-address').click(function(e){
        e.preventDefault();
        // if($('#id_provinsi_penerima_form').val() == '0'){
        //     show_snackbar('Provinsi tidak valid. Silahkan periksa dan ketik ulang.');
        //     return;
        // }
        //
        // if($('#id_kota_penerima_form').val() == '0'){
        //     show_snackbar('Kota tidak valid. Silahkan periksa dan ketik ulang.');
        //     return;
        // }
        //
        // if($('#id_kecamatan_penerima_form').val() == '0'){
        //     show_snackbar('Kecamatan tidak valid. Silahkan periksa dan ketik ulang.');
        //     return;
        // }


        $('.loading').css("display", "block");
        $('.Veil').fadeIn();

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'add_new_address', // the url where we want to POST
            data        : $('#new-address-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == 'OK'){
                    $('.pop-up-content').fadeOut();
                    $('.Veil-non-hover').fadeOut();
                    $('.alert-danger').css('display', 'none');
                    get_address();
                    show_snackbar('Alamat berhasil disimpan');
                    $(".pop-up-content").scrollTop(0);
                } else if(response.Status == 'ERROR'){
                    $('.invalid-feedback').css('display', 'none');
                    console.log(response.Error);
                    response.Error.forEach(function(error){
                        $('.'+ error +'').css('display', 'block');
                    })
                }

                $('.loading').css("display", "none");
                $('.Veil').fadeOut();
            }
        })

    })

    $('.add-address').click(function(e){
        e.preventDefault();
        $('#popup-title').html('Tambah Alamat');
        $('#id_web_user_alamat').val(0);
        $('#new-address-form').trigger("reset");
        $('.pop-up-content').css('display', 'block');
        $('.Veil-non-hover').fadeIn();

    })

    $('.close-popup, .kembali, .Veil-non-hover').click(function(e){
        e.preventDefault();
        $('#id_web_user_alamat').val(0);
        $(".pop-up-content").scrollTop(0);
        $('.pop-up-content').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
        $('#new-address-form').trigger("reset");
    })


    get_address();

</script>