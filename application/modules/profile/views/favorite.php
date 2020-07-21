<div class="pop-up-content">
    <div class="close-popup"></div>
    <h5 style="margin-top: 10px;"> Tambahkan ke Keranjang </h5>

        <div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
            <table style="width: 100%">
                <tr>
                    <td style="width: 20%; text-align: left;" id="popup_image">
                        <!-- <img style="max-width: 50px" src="<?php echo base_url('assets/images/real_category/RAK SEPATU.png');?>" >-->
                    </td>
                    <td style="width: 80%; text-align: left;" id="popup_nama_product">   </td>
                </tr>
            </table>
        </div>

        <h5 style="color:#c4113f; text-align: left;" id="popup_price">  </h5>

        <form id="add-to-cart-form">
            <table style="width: 100%; margin-top: 15px;"><tr>
                    <td style="width:60%">
                        <select class="form-control qty_item" name="qty_item">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                        </select>
                    </td>
                    <input type="hidden" id="ucode_web_product" name="ucode_web_product" value="0">

                    <td style="width:30%"> <button type="button" class="btn add-product" style="width:100%"><i class="fas fa-cart-plus"></i></button> </td>
                </tr> </table>
        </form>
    <br>
    <div class="alert alert-danger" role="alert" style="display:none;"></div>
</div>

<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil</a> <span style="font-size: 14px;">  > Favorit</span></div>
<div class="whitespace"></div>

<div class="main-section" style="text-align: left; min-height: 60vh">
    <h2>Daftar Favorit</h2>
    <br>
    <div id="item-favorit">
        <div style="text-align: center;">Memuat item....</div>

    </div>
</div>

<style>


</style>

<script>

    profile_url = '<?php echo base_url('profile/');?>';
    cart_url = '<?php echo base_url('cart/');?>';
    product_url = '<?php echo base_url('product/');?>';

    function get_favorites(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'get_favorites', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '<div class="card-group" style="margin-bottom: 15px;">';
                count = 0;
                if(data.length == 0){
                    html = '<div style="text-align: center; margin-top: 40px; margin-bottom: 60px;"> Tidak ada data </div>';
                    $('#item-favorit').html(html);
                } else {
                    data.forEach(function(data){
                        count++;
                        html += '<div class="card link-card" style="box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px;  margin: 25px 10px !important;"><a style="text-decoration: none" href="<?php echo base_url('product?prod=');?>'+ data.art_number_web_product +'\&color='+ data.nama_web_col +'">\n'+
                            '        <div class="fav-btn" id="fav_'+ data.ucode_web_product +'" style="position: absolute; right: 10px; width: 40px;height: 40px; z-index: 20;">' +
                            '           <i class="fas fa-heart loved" style="border: 1px solid #a50000; border-radius: 50%; padding: 5px; width:30px; height: 30px; color: #a50000; left: 50%;top: 50%;transform: translate(-50%, -50%); position: absolute"></i>'+
                            '       </div>'+
                            '                            <div style="text-align: center" class="img_product"><img src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"></div>\n'+
                            '                        <div class="card-body" style="padding: 0.5rem">\n'+
                            '                            <p class="card-text nama_product" style="font-size: 15px; text-align: left; height: 76px;">'+ data.nama_web_product +'</p>\n';

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
                            if(mobile || tablet){
                                html +=  ' <span style="visibility: hidden;"> 0%</span> <br> <span style="visibility: hidden;">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>       ' +
                                    '<h5>'+ convertToRupiah(data.nominal_web_pricelist) +'</h5>\n';
                            } else {
                                html +=  '         <span style="visibility: hidden;">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>       ' +
                                    '<h5>'+ convertToRupiah(data.nominal_web_pricelist) +'</h5>\n';
                            }

                        }

                        html +=                               '<div class="avg_review" style="font-size: 10px;">\n';

                        if(data.round_rating != null){

                            for (i = 1; i <= 5; i++) {
                                if(i <= data.round_rating){
                                    html += '<span class="fa fa-star checked"></span>'
                                } else {
                                    html += '<span class="fa fa-star"></span>'
                                }

                            }

                            html += '<span style="margin-left: 5px;"> (' + data.rating + ')<span>';
                        } else {
                            html += '<span class="fa fa-star" style="visibility: hidden;"></span>';
                        }

                        html += '                </div>\n'+
                                                    '<br><button class="btn add-to-cart" style="width: 100%" id="add_'+ data.ucode_web_product +'"> <i class="fas fa-cart-plus"></i> </button>'+
                            '                        </div>\n'+
                            '                   </a> </div>';

                        if(mobile || tablet){
                            if(count % 2 === 0){
                                html += '</div><div class="card-group" style="margin-bottom: 15px;">';
                            }
                        } else {
                            if(count % 4 === 0){
                                html += '</div><div class="card-group" style="margin-bottom: 15px;">';
                            }
                        }

                    })

                    if(mobile || tablet){
                        if(data.length % 2 === 1){
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
                    $('#item-favorit').html(html);

                    $('.add-to-cart').click(function(e){
                        e.stopPropagation();
                        e.preventDefault();
                        $('#popup_nama_product').html($(this).parent().find('.nama_product').html());
                        $('#ucode_web_product').val($(this).attr('id').split('add_')[1]);
                        $('.pop-up-content').css('display', 'block');
                        $('.Veil-non-hover').fadeIn();

                        img_html = '<img style="max-width:60px" src="'+$(this).parent().parent().find('img').attr('src')+ '">';
                        $('#popup_image').html(img_html);
                        // $('#popup_image').html(convertToRupiah(711000));
                    })

                    // $('.fav-btn').hover(function(e){
                    //     if($(this).find('.fa-heart').hasClass('loved')){
                    //         $(this).find('.fa-heart').attr('data-prefix', 'far');
                    //     } else {
                    //         $(this).find('.fa-heart').attr('data-prefix', 'fas');
                    //     }
                    //
                    // });
                    //
                    // $('.fav-btn').mouseleave(function(e){
                    //     if($(this).find('.fa-heart').hasClass('loved')){
                    //         $(this).find('.fa-heart').attr('data-prefix', 'fas');
                    //     } else {
                    //         $(this).find('.fa-heart').attr('data-prefix', 'far');
                    //     }
                    // });

                    $('.fav-btn').click(function(e){
                        e.preventDefault();
                        e.stopPropagation();

                        $('.loading').css("display", "block");
                        $('.Veil').fadeIn();

                        let ucode_web_product = $(this).attr('id').split('fav_')[1];
                        let element = $(this).find('.fa-heart');

                        if($(this).find('.fa-heart').hasClass('loved')){
                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : product_url + 'remove_from_favorite', // the url where we want to POST
                                data        : {product: ucode_web_product}, // our data object
                                dataType    : 'json',
                                success     : function(response){

                                    if(response.Status === 'OK'){
                                        show_snackbar(response.Message);
                                        element.attr('data-prefix', 'far');
                                        element.removeClass('loved');
                                    } else if(response.Status === "ERROR"){
                                        show_snackbar(response.Message);
                                    }

                                    $('.loading').css("display", "none");
                                    $('.Veil').fadeOut();

                                }
                            })

                        } else {

                            $.ajax({
                                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url         : product_url + 'add_to_favorite', // the url where we want to POST
                                data        : {product: ucode_web_product}, // our data object
                                dataType    : 'json',
                                success     : function(response){

                                    if(response.Status === 'OK'){
                                        show_snackbar(response.Message);
                                        element.attr('data-prefix', 'fas');
                                        element.addClass('loved');
                                    } else if(response.Status === "ERROR"){
                                        show_snackbar(response.Message);
                                    } else if(response.Status === "UNAUTHORIZED") {
                                        $('#login-modal').modal("toggle");
                                    }

                                    $('.loading').css("display", "none");
                                    $('.Veil').fadeOut();

                                }
                            })


                        }
                    });


                }

            }
        })
    }
    $('.add-product').click(function(e){

        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : cart_url + 'add_to_cart', // the url where we want to POST
            data        : $('#add-to-cart-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == 'OK'){
                    $('.pop-up-content').fadeOut();
                    $('.Veil-non-hover').fadeOut();
                    $('.alert-danger').css('display', 'none');
                    show_snackbar('Berhasil ditambahkan');
                } else if(response.Status == 'ERROR'){
                    $('.alert-danger').html(response.Message);
                    $('.alert-danger').css('display', 'block');

                }
            }
        })

    })


    $('.close-popup').click(function(e){
        $('.pop-up-content').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.add-to-cart').click(function(e){

    })

    get_favorites();

</script>