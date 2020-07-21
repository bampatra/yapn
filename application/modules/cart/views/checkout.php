<div class="breadcrumbs"></div>
<div class="whitespace"></div>

<div class="main-section" style="margin-bottom: 15vh;">
    <table style="width:100%"><tr>
            <td style="width: 45%; text-align: left;" valign="top">

                <div class="alamat-pengiriman">
                    <h4 style="margin-bottom: 15px"> Alamat Pengiriman </h4>

                    <div class="alamat-pengiriman-summary checkout-summary main-alamat" id="">
                        <div class="ganti-link" style="float: right;">
                            <span style="font-size: 12px; color: #a50000; text-decoration: underline;"> Pilih Alamat Lain </span>
                        </div>
                        <h6 class="nama_penerima_main"> </h6>
                        <span style="font-size: 13px; color: #494f54" class="telp_penerima_main"> </span><br>
                        <span style="font-size: 13px; color: #494f54" class="alamat_penerima_main"> </span><br>
                        <span style="font-size: 13px; color: #494f54" class="kota_penerima_main"></span> - <span style="font-size: 13px; color: #494f54" class="kecamatan_penerima_main"></span></span><br>
                        <span style="font-size: 13px; color: #494f54" class="provinsi_penerima_main"> </span><br>

                        <button class="btn simpan-alamat-secondary" style="width: 100%; display: none; margin-top: 15px;"> Simpan </button>
                    </div>

                    <div id="daftar-alamat-lainnya"></div>
                    <span class="tambah-alamat-btn a2" style="font-size: 14px; display: none; text-decoration: underline; color: #a50000; cursor: pointer;"><br> Tambah Alamat Baru </span>



                    <div class="a2"><br></div>
                    <div class="alamat-pengiriman-form checkout-summary" style="display:none;">
                        <h5 class="a2"> Tambah Alamat Baru </h5>
                        <div class="a2"><br></div>

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
                            <input type="hidden" id="notes_penerima_form" name="notes_penerima">
                            <input type="hidden" value="0" name="is_primary">
                            <input type="hidden" value="" name="notes_penerima">
                            <input type="hidden" value="0" name="id_web_user_alamat" id="id_web_user_alamat">
                        </form>

                        <div style="width: 100%; text-align: right;"><button class="btn simpan-alamat"> Simpan </button></div>
                    </div>




                </div>



                <div class="whitespace"></div>

                <div class="payment-info" style="border-top: 1px solid #d9d8db; display: none;">
                    <div class="whitespace"></div>
                    <h4 style="margin-bottom: 15px"> Informasi Pembayaran</h4>

                    <div class="payment-summary checkout-summary">
                        <h6> Transfer ke BCA</h6>
                        <span style="font-size: 13px; color: #494f54"> No. Rekening: 2582035033 <br> A/n: Putera Rackindo Sejahtera PT</span> <br>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="email_address" class="col-form-label">Catatan Pengiriman</label>
                        <textarea id="catatan_pengiriman" name="catatan_pengiriman" class="form-control"></textarea>
                    </div>

                    <div class="payment-form">


                        <br><div style="width: 100%; text-align: right; display: none;"><button class="btn simpan-payment"> Lanjut </button></div>
                    </div>

                    <div class="mobile-only">
                        <div class="summary-box" style="width:100%; min-height: 100px; background: #f5f5f5; padding: 10px 20px; border-radius: 5px;">
                            <div class="main-cart">

                            </div>
                            <table style="width: 100%">
                                <tr>
                                    <td style="width: 40%">
                                        <span style="font-size: 14px; color: black;" >Subtotal</span><br>
                                        <!--<span style="font-size: 14px; color: black;" >Diskon</span><br>-->
                                        <span style="font-size: 14px; color: black;" >Ongkos Kirim</span><br>
                                        <br>
                                        <h5 style="color: black;">Grand Total</h5>
                                    </td>
                                    <td style="width: 5%"></td>
                                    <td style="width: 55%; text-align: right;">
                                        <span style="font-size: 14px; color: black;" class="total_so_m">...</span><br>
                                        <!-- <span style="font-size: 14px; color: black;" class="nominal_disc_so_m">...</span><br> -->
                                        <span style="font-size: 14px; color: black;" class="ongkir_so_m" >...</span><br>
                                        <br>
                                        <h5 style="color: black;" class="grand_total_so_m" >...</h5>
                                    </td>
                                </tr>

                            </table>
                            <button class="btn final-checkout final-checkout-button" style="width: 100%; font-size: 14px; margin-top: 5px; display: block"> LANJUTKAN </button>
                        </div>
                    </div>


                </div>





            </td>
            <td class="desktop-and-tablet-tablecell" style="width: 10%"></td>
            <td class="desktop-and-tablet-tablecell" valign="top" style="text-align: left; padding-top: 25px; width: 45%">

                <div class="summary-box" style="width:100%; min-height: 100px; background: #f5f5f5; padding: 10px 20px; border-radius: 5px;">
                    <div class="main-cart">

                    </div>
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 40%">
                                <span style="font-size: 14px; color: black;" >Subtotal</span><br>
                                <!--<span style="font-size: 14px; color: black;" >Diskon</span><br>-->
                                <span style="font-size: 14px; color: black;" >Ongkos Kirim</span><br>
                                <br>
                                <h5 style="color: black;">Grand Total</h5>
                            </td>
                            <td style="width: 5%"></td>
                            <td style="width: 55%; text-align: right;">
                                <span style="font-size: 14px; color: black;" class="total_so_m">...</span><br>
                                <!-- <span style="font-size: 14px; color: black;" class="nominal_disc_so_m">...</span><br> -->
                                <span style="font-size: 14px; color: black;" class="ongkir_so_m" >...</span><br>
                                <br>
                                <h5 style="color: black;" class="grand_total_so_m" >...</h5>
                            </td>
                        </tr>

                    </table>
                    <button class="btn final-checkout final-checkout-button" style="width: 100%; font-size: 14px; margin-top: 5px; display: block" > LANJUTKAN </button>
                </div>

                <br>
                <div class="alert alert-danger stock-alert" role="alert" style="display: none;">
                    Peringatan!
                    <ul class="stock-alert-content" style="font-size: 13px;">

                    </ul>
                </div>
            </td>
        </tr></table>


</div>

<script>

    let base_url = '<?php echo base_url('cart/');?>';
    let selected_address = 0;
    let bukti_so_m = '';

    get_virtual_account('va-checkout');

    // $(window).on("scroll", function() {
    //     if ($(window).scrollTop() > 185) {
    //         $('.summary-box').addClass("fix-cart-summary");
    //     } else {
    //         $('.summary-box').removeClass("fix-cart-summary");
    //     }
    //
    // });


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


    $('.final-checkout-button').click(function(e){

        if(selected_address == 0){
            show_snackbar('Belum ada alamat pengiriman!')
            return;
        }
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'final_checkout', // the url where we want to POST
            dataType    : 'json',
            data        : {selected_address: selected_address, notes: $('#catatan_pengiriman').val()},
            success     : function(response){
                if(response.Status === "OK"){
                    window.location.href = '<?php echo base_url('profile/purchase_detail?id=');?>' + bukti_so_m;
                } else if(response.Status === "Warning") {
                    show_snackbar(response.Message);
                } else if(response.Status === "STOCK_WARNING"){
                    console.log(response.Message);
                    $('.stock-alert').css("display", "block");
                    $('.stock-alert-content').html('');
                    response.Message.forEach(function(data){
                        $('.stock-alert-content').append('<li>'+ data +'</li>')
                    })

                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    });

    function refresh_summary(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'get_so_m_summary', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){
                bukti_so_m = data.bukti_web_so_m;
                $('.total_so_m').html(convertToRupiah(data.total_web_so_m));
                $('.nominal_disc_so_m').html(convertToRupiah(data.nominal_disc_web_so_m));
                $('.ongkir_so_m').html(convertToRupiah(data.ongkir_web_so_m));
                $('.grand_total_so_m').html(convertToRupiah(data.grand_total_web_so_m));
            }
        })
    }

    function load_cart(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'get_cart', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){
                data.forEach(function(data){

                    let html = '<table valign="top" style="margin: 15px 0px">\n'+
                        '                <tr>\n'+
                        '                    <td style="width: 10%" valign="top">\n'+
                        '                        <img style="max-height: 50px; border: 1px solid #d9d8db; border-radius: 5px;" src="<?php echo base_url()?>'+ data.file_web_image +'">\n'+
                        '                    </td>\n'+
                        '                    <td style="width:5%"></td>\n'+
                        '                    <td style="width: 45%" valign="top">\n'+
                        '                        <p style="color: black; font-size: 14px"> '+ data.nama_web_product +' </p>\n'+
                        '                        <p style="color:#757575; font-size: 13px; margin-top: -15px;"> Warna: '+data.nama_web_col+' </p>\n'+
                        '                    </td>\n'+
                        '                    <td style="width:5%"></td>\n'+
                        '                    <td style="width: 35%; text-align: right;" valign="top">\n'+
                        '                        <p style="color: black; font-size: 14px"> '+ convertToRupiah(data.total_price_so_d)+' </p>';


                             html += '                \n' +
                        '                    </td>\n' +
                        '                </tr>\n' +
                        '            </table>'

                    $('.main-cart').append(html);
                })

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }

    function getMainAddress(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'get_main_address', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){

                if(data != null){
                    selected_address = data.id_web_user_alamat;
                    $('.main-alamat').attr("id","alamat_" + selected_address);
                    $('.nama_penerima_main').html(data.nama_web_user_alamat);
                    $('.alamat_penerima_main').html(data.alamat_web_user_alamat);
                    $('.kota_penerima_main').html(data.kota_web_user_alamat);
                    $('.kecamatan_penerima_main').html(data.kecamatan_web_user_alamat);
                    $('.provinsi_penerima_main').html(data.provinsi_web_user_alamat);
                    $('.telp_penerima_main').html(data.telp_web_user_alamat);

                    $('.alamat-pengiriman-summary').fadeIn();
                    $('.payment-info').fadeIn();
                    $('.payment-summary').fadeIn();
                    getAllAddress();
                } else {
                    console.log('no main address');
                    $('.alamat-pengiriman-form').fadeIn();
                }
            }
        })
    }

    function getAllAddress(){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'get_all_address', // the url where we want to POST
            data        : {selected_address: selected_address},
            dataType    : 'json',
            success     : function(data){

                html = '';
                data.forEach(function(data){
                    console.log(data);
                    html += ' <div class="alamat-pengiriman-summary checkout-summary a2" style="margin-top: 15px;" id="alamat_'+ data.id_web_user_alamat +'">\n' +
                        '                        <div class="ganti-link" style="float: right;">\n' +
                        '                            <span style="font-size: 12px; color: #a50000; text-decoration: underline;"> Ganti </span>\n' +
                        '                        </div>\n' +
                        '                        <h6 class="nama_penerima">'+ data.nama_web_user_alamat +'</h6>\n' +
                        '                        <span style="font-size: 13px; color: #494f54" class="telp_penerima">'+ data.telp_web_user_alamat +'</span><br>\n' +
                        '                        <span style="font-size: 13px; color: #494f54" class="alamat_penerima">'+ data.alamat_web_user_alamat +'</span><br>\n' +
                        '                        <span style="font-size: 13px; color: #494f54" class="kota_penerima">'+ data.kota_web_user_alamat +'</span> - <span style="font-size: 13px; color: #494f54" class="kecamatan_penerima">'+ data.kecamatan_web_user_alamat +'</span></span><br>\n' +
                        '                        <span style="font-size: 13px; color: #494f54" class="provinsi_penerima">'+ data.provinsi_web_user_alamat +'</span><br>\n' +
                        '\n' +
                        '                        <button class="btn simpan-alamat-secondary" style="width: 100%; display: none; margin-top: 15px;"> Simpan </button>\n' +
                        '                    </div>';

                })
                $('#daftar-alamat-lainnya').html(html);

                $('.alamat-pengiriman-summary').click(function(e){
                    $('.alamat-pengiriman-summary').css("border", "");
                    $('.simpan-alamat-secondary').css("display","none");
                    $(this).find('.simpan-alamat-secondary').fadeIn();
                    $('.alamat-pengiriman-form').css("display", "none");
                    $(this).css("border", "1px solid #a50000");
                    $('.ganti-link').css("display","none");
                    $('.a2').fadeIn();
                })

                $('.simpan-alamat-secondary').click(function(e){
                    e.preventDefault();
                    e.stopPropagation();
                    selected_address = $(this).parent().attr('id').split("alamat_")[1];
                    // summary view
                    $('.main-alamat').attr("id","alamat_" + selected_address);
                    $('.nama_penerima_main').html($(this).parent().find('.nama_penerima').html());
                    $('.alamat_penerima_main').html($(this).parent().find('.alamat_penerima').html());
                    $('.kota_penerima_main').html($(this).parent().find('.kota_penerima').html());
                    $('.kecamatan_penerima_main').html($(this).parent().find('.kecamatan_penerima').html());
                    $('.provinsi_penerima_main').html($(this).parent().find('.provinsi_penerima').html());
                    $('.telp_penerima_main').html($(this).parent().find('.telp_penerima').html());

                    // main view
                    $('.alamat-pengiriman-form').css("display", "none");
                    $('.ganti-link').fadeIn();
                    $('.a2').css("display","none");
                    $('.simpan-alamat-secondary').css("display","none");
                    $('.alamat-pengiriman-summary').css("border", "");
                    console.log(selected_address);
                    getAllAddress();
                })
            }
        })
    }

    $('.tambah-alamat-btn').click(function(){
        $('#id_web_user_alamat').val(0);
        $('.alamat-pengiriman-summary').css("border", "");
        $('.tambah-alamat-btn').css('display','none');
        $('.alamat-pengiriman-form').slideDown();
        $('.alamat-pengiriman-form').css("border", "1px solid #a50000");
    })



    $('.simpan-alamat').click(function(e){
        e.preventDefault();
        //
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
        $('.Veil-non-hover').fadeIn();

        // engine
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'add_new_address', // the url where we want to POST
            dataType    : 'json',
            data        : $('#new-address-form').serialize(),
            success     : function(response){

                if(response.Status == 'OK'){
                    // make this primary address
                    selected_address = response.ID;
                    console.log(selected_address);
                    $('.main-alamat').attr("id","alamat_" + selected_address);
                    $('.nama_penerima_main').html($('#nama_penerima_form').val());
                    $('.alamat_penerima_main').html($('#alamat_penerima_form').val());
                    $('.kota_penerima_main').html($('#kota_penerima_form').val());
                    $('.kecamatan_penerima_main').html($('#kecamatan_penerima_form').val());
                    $('.provinsi_penerima_main').html($('#provinsi_penerima_form').val());
                    $('.telp_penerima_main').html($('#telp_penerima_form').val());
                    // reset form
                    $('.form-group').find("input[type=text], textarea").val("");

                    $('.alamat-pengiriman-form').slideUp();
                    $('.simpan-alamat-secondary').css("display", "none");
                    $('.payment-info').fadeIn();
                    $('.payment-summary').fadeIn();
                    $('.alamat-pengiriman-summary').fadeIn();
                    $('.ganti-link').fadeIn();
                    $('.a2').css("display","none");
                    $('.alamat-pengiriman-summary').css("border", "");
                    getAllAddress();

                } else if(response.Status == 'ERROR'){
                    $('.invalid-feedback').css('display', 'none');
                    console.log(response.Error);
                    response.Error.forEach(function(error){
                       $('.'+ error +'').css('display', 'block');
                    })

                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })


        // view

    })

    $('.simpan-payment').click(function(e){
        e.preventDefault();
        $('.payment-form').css("display", "none");
        $('.final-checkout').fadeIn();
    })

    load_cart();
    getMainAddress();
    refresh_summary();


</script>