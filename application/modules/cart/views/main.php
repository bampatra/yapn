<!--<div class="breadcrumbs"></div>-->

<div class="whitespace"></div>

<div class="main-section" style="min-height: 60vh;">
<table style="width:100%"><tr>
    <td style="width: 58%; text-align: left;" valign="top">
        <h3> Keranjang Saya </h3>
        <div class="main-cart desktop-and-tablet-tablecell">

        </div>
        <div class="main-cart-mobile mobile-only">

        </div>
        <br>
        <div class="summary-box-mobile mobile-only" style="width:100%;">
            <div style=" min-height: 100px; background: #f5f5f5; padding: 10px 20px; border-radius: 5px;">
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
                            <!--<span style="font-size: 14px; color: black;" class="nominal_disc_so_m">...</span><br>-->
                            <span style="font-size: 14px; color: black;" class="ongkir_so_m" >...</span><br>
                            <br>
                            <h5 style="color: black;" class="grand_total_so_m" >...</h5>
                        </td>
                    </tr>

                </table>
                <button class="btn proceed" style="width: 100%; font-size: 14px; margin-top: 5px;">CHECKOUT</button>
            </div>

            <!-- <div> Butuh Bantuan ?</div> -->

        </div>

        <br>

        <h4> Rekomendasi </h4>
        <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>
        <div class="main-terlaris">
            <img style="width: 500px;
            position: relative;
            left: 50%;
            transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
        </div>

        <div>
<!--            <div class="daftar_favorit_div" style="width: 100%; border: 1px solid #e3e3e3; padding: 5px 15px; display: none;">-->
<!--               <span style="color: black; font-size: 14px;">Daftar Favorit </span>-->
<!--            </div>-->

            <div id="fav-item-list">

            </div>

        </div>

    </td>
    <td class="desktop-and-tablet-tablecell" style="width: 5%"></td>
    <td class="desktop-and-tablet-tablecell" valign="top" style="text-align: left; padding-top: 25px; width: 35%">

        <div class="summary-box" style="width:100%;">
            <div style=" min-height: 100px; background: #f5f5f5; padding: 10px 20px; border-radius: 5px;">
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
                            <!--<span style="font-size: 14px; color: black;" class="nominal_disc_so_m">...</span><br>-->
                            <span style="font-size: 14px; color: black;" class="ongkir_so_m" >...</span><br>
                            <br>
                            <h5 style="color: black;" class="grand_total_so_m" >...</h5>
                        </td>
                    </tr>

                </table>
                <button class="btn proceed" style="width: 100%; font-size: 14px; margin-top: 5px;">CHECKOUT</button>
            </div>

            <!-- <div> Butuh Bantuan ?</div> -->

        </div>

    </td>
</tr></table>


</div>

<script>

    base_url = '<?php echo base_url('cart/');?>';
    profile_url = '<?php echo base_url('profile/');?>';
    rekomendasi_url = '<?php echo base_url('rekomendasi/');?>';

    prev_qty_html = 0;

    $(window).on("scroll", function() {
        if ($(window).scrollTop() > 106) {
            $('.summary-box').addClass("fix-cart-summary ");
        } else {
            $('.summary-box').removeClass("fix-cart-summary");
        }

    });

    get_rekomendasi();

    $('.proceed').click(function(e){
        e.preventDefault();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'proceed_to_checkout', // the url where we want to POST
            dataType    : 'json',
            success     : function(response){
                if(response.Status === "OK"){
                    window.location.href = '<?php echo base_url('cart/checkout');?>';
                } else {
                    $('#login-modal').modal("toggle");
                }

            }
        })
    })

    function get_favorite_in_cart(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'get_favorites', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                html = '<h4 class="daftar_favorit_div"> Daftar Favorit </h4>\n' +
                    '            <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>';

                if(data.length == 0){
                    return;
                }
                $('.daftar_favorit_div').css('display', 'block');
                data.forEach(function(data){
                    html += '<div class="cart-fav-item" style="width: 100%; border: 1px solid #e3e3e3; padding: 20px;">\n'+
        '                <table>\n'+
        '                    <tr>\n'+
        '                        <td style="width: 10%" valign="top">\n'+
        '                            <img style="max-height: 100px;" src="'+ data.file_web_image +'">\n'+
        '                        </td>\n'+
        '                        <td style="width:3%"></td>\n'+
        '                        <td style="width: 40%" valign="top">\n'+
        '                            <p style="color: black; font-size: 14px">'+ data.nama_web_product +'</p>\n' +
                        '               <div class="mobile-only">';

                    if(data.nominal_web_promosi != null && data.persen_web_promosi != null) {
                        html += '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>' +
                            '<span class="persen_web_promosi_box" style="margin-left:3px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span><br> ' +
                            '<p style="color: #a50000; font-size: 16px">'+ convertToRupiah(data.nominal_web_promosi) +'</p>\n';

                    } else {
                        html += ' <p style="color: black; font-size: 16px">' + convertToRupiah(data.nominal_web_pricelist) + '</p>\n';
                    }
        html +=      '                            <button class="btn add-from-fav add_fav_'+ data.ucode_web_product +'" style="font-size: 14px"> Tambah </button>\n'+
                        '</div>'+
        '                        </td>\n'+
        '                        <td class="desktop-and-tablet-tablecell" style="width:8%"></td>\n'+
        '                        <td class="desktop-and-tablet-tablecell" style="width: 40%; text-align: right;" valign="top">\n';

                    if(data.nominal_web_promosi != null && data.persen_web_promosi != null) {
                        html +=  '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span> ' +
                            '<span class="persen_web_promosi_box" style="margin-left: -2px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span>         ' +
                            '<p style="color: #a50000;font-size: 16px">'+ convertToRupiah(data.nominal_web_promosi) +'</p>\n';

                    } else {
                        html +=  '<p style="color: black; font-size: 16px">'+ convertToRupiah(data.nominal_web_pricelist) +'</p>\n';
                    }


        html += '        <button class="btn add-from-fav add_fav_'+ data.ucode_web_product +'" style="font-size: 14px"> Tambah </button>\n'+
        '                        </td>\n'+
        '                    </tr>\n'+
        '                </table>\n'+
        '            </div>'
                });

                $('#fav-item-list').html(html);

                $('.add-from-fav').click(function(e){
                    $('.loading').css("display", "block");
                    $('.Veil-non-hover').fadeIn();

                    let ucode_web_product = $(this).attr('class').split('add_fav_')[1];

                    e.preventDefault();
                    $.ajax({
                        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                        url         : base_url + 'add_to_cart', // the url where we want to POST
                        data        : {qty_item: 1, ucode_web_product: ucode_web_product}, // our data object
                        dataType    : 'json',
                        success     : function(response){
                            if(response.Status == 'OK'){
                                show_snackbar('Produk ditambahkan ke keranjang!');
                                load_cart();
                            } else if(response.Status == 'ERROR'){
                                show_snackbar(response.Message);

                            }
                            $('.loading').css("display", "none");
                            $('.Veil-non-hover').fadeOut();
                        }
                    })
                })
            }
        })
    }

    function refresh_summary(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'get_so_m_summary', // the url where we want to POST
            dataType    : 'json',
            success     : function(data) {
                if (data !== null) {
                    $('.total_so_m').html(convertToRupiah(data.total_web_so_m));
                    $('.nominal_disc_so_m').html(convertToRupiah(data.nominal_disc_web_so_m));
                    $('.ongkir_so_m').html(convertToRupiah(data.ongkir_web_so_m));
                    $('.grand_total_so_m').html(convertToRupiah(data.grand_total_web_so_m));
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
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

              console.log(data);

                if(data.length === 0){
                    html = '<div style="text-align: center; padding-top: 15vh; height: 30vh;"><h5> Keranjang Anda Kosong </h5></div>'
                    $('.main-cart').append(html);
                    $('.main-cart-mobile').append(html);
                    refresh_summary();
                } else {
                    html = '';
                    html_mobile = '';
                    data.forEach(function(data){

                        html += '<table valign="top" style="margin: 25px 0px" class="table_'+ data.id_web_so_d +'">\n'+
                            '                <tr>\n'+
                            '                    <td style="width: 10%" valign="top">\n'+
                            '                        <img style="max-height: 150px; border: 1px solid #d9d8db; border-radius: 5px;" src="'+ data.file_web_image +'">\n'+
                            '                    </td>\n'+
                            '                    <td style="width:5%"></td>\n'+
                            '                    <td style="width: 50%" valign="top">\n'+
                            ' <a href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'" target="_blank">  <p style="color: black; font-size: 16px"> '+ data.nama_web_product +' </p></a>\n'+
                            '                        <p style="color:#757575; font-size: 13px;"> Art No. : '+ data.art_number_web_product +' </p>\n'+
                            '                        <p style="color:#757575; font-size: 13px; margin-top: -15px;"> Warna: '+data.nama_web_col+' </p>\n'+
                            '                        <a style="color:#a50000; font-size: 13px; text-decoration: underline" class="remove_from_cart hapus_'+data.id_web_so_d+'"> Hapus </a>\n'+
                            '                    </td>\n'+
                            '                    <td style="width:5%"></td>\n'+
                            '                    <td style="width: 30%; text-align: right;" valign="top">\n';

                        html_mobile += '<table valign="top" style="margin: 25px 0px" class="table_'+ data.id_web_so_d +'">\n' +
                            '                <tbody><tr>\n' +
                            '                    <td style="width: 30%" valign="top">\n' +
                            '                        <img style="max-height: 150px; border: 1px solid #d9d8db; border-radius: 5px; margin-bottom: 15px;" src="'+ data.file_web_image +'">\n' +
                            '                        <p style="color:#757575; font-size: 13px;"> Qty: </p>\n'+
                            '                        <select class="form-control qty_item change_'+data.id_web_so_d+'" name="qty_item"  style="width: 100%; margin-top: -15px;">' ;

                        for (let i = 1; i < 10; i++) {
                            if(i == data.qty_so_d){
                                html_mobile += '<option selected="selected">'+i+'</option>';
                            } else {
                                html_mobile += '<option>'+i+'</option>';
                            }

                        }


                        html_mobile +=    '</select><br>\n' +
                            '                    </td>\n' +
                            '                    <td style="width:5%"></td>\n' +
                            '                    <td style="width: 65%" valign="top">\n' +
                            '                        <p style="color: black; font-size: 16px"> '+ data.nama_web_product +' </p>\n'+
                            '                        <p style="color:#757575; font-size: 13px;"> Art No. : '+ data.art_number_web_product +' </p>\n'+
                            '                        <p style="color:#757575; font-size: 13px; margin-top: -15px;"> Warna: '+data.nama_web_col+' </p>\n';


                        if(data.nominal_web_promosi != null && data.persen_web_promosi != null){
                            html_mobile +=  '      <span class="strikethrough undiscounted">'+ convertToRupiah(data.nominal_web_pricelist * data.qty_so_d) +'</span> ' +
                                '<span class="persen_web_promosi_box" style="margin-left: -2px;">'+ data.persen_web_promosi +'% OFF</span> ' +
                                '<p style="color: #a50000; font-size: 20px;" class="total_so_d">'+ convertToRupiah(data.total_price_so_d) +'</p>\n' +
                                '<p style="font-size: 12px;color: grey; margin-top: -15px;">'+ convertToRupiah(data.unit_price_so_d) +' per item </p>';
                        } else {
                            html_mobile +=  ' <p style="color: black; font-size: 20px" class="total_so_d"> '+ convertToRupiah(data.total_price_so_d)+' </p>\n' +
                                '<p style="font-size: 12px;color: grey; margin-top: -15px;">'+ convertToRupiah(data.unit_price_so_d) +' per item </p>';
                        }

                        html_mobile +=    '                        <a style="color:#a50000; font-size: 13px; text-decoration: underline" class="remove_from_cart hapus_'+data.id_web_so_d+'"> Hapus </a>\n' +
                            '                    </td>\n' +
                            '                </tr>\n' +
                            '                </tbody></table>';


                        if(data.nominal_web_promosi != null && data.persen_web_promosi != null){
                            html +=  '      <span class="strikethrough undiscounted">'+ convertToRupiah(data.nominal_web_pricelist * data.qty_so_d) +'</span> ' +
                                '<span class="persen_web_promosi_box" style="margin-left: -2px;">'+ data.persen_web_promosi +'% OFF</span>         ' +
                                '<p style="color: #a50000; font-size: 20px;" class="total_so_d">'+ convertToRupiah(data.total_price_so_d) +'</p>\n' +
                                '<p style="font-size: 12px;color: grey; margin-top: -15px;">'+ convertToRupiah(data.unit_price_so_d) +' per item </p>';
                        } else {
                            html +=  ' <p style="color: black; font-size: 20px" class="total_so_d"> '+ convertToRupiah(data.total_price_so_d)+' </p>\n' +
                                '<p style="font-size: 12px; color: grey; margin-top: -15px;">'+ convertToRupiah(data.unit_price_so_d) +' per item </p>';
                        }

                        html +=    '                        <p style="color:#757575; font-size: 13px;"> Qty: </p>\n'+
                            // '                        <select class="form-control qty_item change_'+data.id_web_so_d+'" name="qty_item" style="width: 70%; float: right; margin-top: -15px;">';
                            '                        <input type="text" value="'+data.qty_so_d+'"  class="form-control qty_item change_'+data.id_web_so_d+'" name="qty_item" style="width: 70%; float: right; margin-top: -15px;">';

                        // drop down input
                        // for (let i = 1; i < 10; i++) {
                        //     if(i == data.qty_so_d){
                        //         html += '<option selected="selected">'+i+'</option>';
                        //     } else {
                        //         html += '<option>'+i+'</option>';
                        //     }
                        //
                        // }

                        html += '                </select><br>\n' +
                            '                    </td>\n' +
                            '                </tr>\n' +
                            '            </table>'

                    })

                    $('.main-cart').html(html);
                    $('.main-cart-mobile').html(html_mobile);

                    refresh_summary();

                    $('.remove_from_cart').click(function(e){
                        e.preventDefault();
                        e.stopPropagation();
                        remove_from_cart($(this).attr('class').split('hapus_')[1]);
                    })

                    $('.qty_item').keydown(function(event){
                        var key = window.event ? event.keyCode : event.which;
                        if (event.keyCode == 8 || event.keyCode == 46
                            || event.keyCode == 37 || event.keyCode == 39) {
                            return true;
                        }
                        else if ( key < 48 || key > 57 ) {
                            return false;
                        }
                        else return true;
                    })


                    $('.qty_item').change(function(e){
                        change_qty($(this).attr('class').split('change_')[1], $(this).val(), $(this));
                    })
                }



            }
        })
    }

    function change_qty(id, qty, el){

        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'change_qty', // the url where we want to POST
            data        : {change_id: id, change_qty: qty},
            dataType    : 'json',
            success     : function(response) {
                if(response.Status === "OK"){
                    refresh_summary();
                    el.parent().find('.total_so_d').html(convertToRupiah(response.NewTotal))
                    if(response.Undiscounted != 0){
                        el.parent().find('.undiscounted').html(convertToRupiah(response.Undiscounted))
                    }
                } else {
                    $(el).val(response.Qty);
                    show_snackbar(response.Message);
                    $('.Veil-non-hover').fadeOut();
                    $('.loading').css("display", "none");
                }
            }
        })
    }

    function remove_from_cart(id){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'remove_from_cart', // the url where we want to POST
            data        : {remove_id: id},
            dataType    : 'json',
            success     : function(response) {
               if(response.Status === "OK"){
                   $('.main-cart').html('');
                   load_cart();
               } else {
                   show_snackbar(response.Message);
                   $('.Veil-non-hover').fadeOut();
                   $('.loading').css("display", "none");
               }
            }
        })
    }

    load_cart();
    get_favorite_in_cart();


    function get_rekomendasi(){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : rekomendasi_url + 'get_rekomendasi', // the url where we want to POST
            data        : {limit: 15, offset: 0},
            dataType    : 'json',
            success     : function(data){

                var $mainDivider = $('.main-terlaris');
                html = '';
                data.forEach(function(data){
                    img = data.file_web_image;
                    html += '<a target="_blank" href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'"">' +
                        '<div class="carousel-cell product-image" style="max-width: 200px; height: 400px; margin: 0px 10px;">' +
                        '<img style="max-height: 200px; max-width: 200px;" src="'+img+'">' +
                        '<div style="max-width: 200px; text-align: left;">' +
                        '<p style="font-size: 14px; height: 100px; margin-bottom: -5px;">'+ data.nama_web_product +'</p>';

                    if(data.nominal_web_promosi != null && data.persen_web_promosi != null){
                        if(mobile || tablet){
                            html +=  '<span class="persen_web_promosi_box" style="margin-left: -2px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span><br>' +
                                '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span> ' +
                                '<h5 style="color: #a50000">'+ convertToRupiah(data.nominal_web_promosi) +'</h5>\n';
                        } else {
                            html +=  '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span> ' +
                                '<span class="persen_web_promosi_box" style="margin-left: -2px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span>         ' +
                                '<h5 style="color: #a50000">'+ convertToRupiah(data.nominal_web_promosi) +'</h5>\n';
                        }

                    } else {
                        html +=  '         <span style="visibility: hidden;">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>       ' +
                            '<h5>'+ convertToRupiah(data.nominal_web_pricelist) +'</h5>\n';
                    }


                    html +=        '</div>' +
                        '</div></a>';

                })

                $mainDivider.html(html);

                $mainDivider.flickity({
                    imagesLoaded:true,
                    prevNextButtons: false,
                    pageDots:false,
                    contain: true,
                    autoPlay: 1500
                });
            }
        })
    }

</script>