<div class="pop-up-content">
    <div class="close-popup"></div>
    <h5 style="margin-top: 10px;"> Produk Berhasil Ditambahkan </h5>
    <div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
        <table style="width: 100%">
            <tr>
                <td style="width: 20%; text-align: left;">
                    <img style="max-width: 50px" src="<?php echo  $img_web_product;?>" >
                </td>
                <td style="width: 80%; text-align: left;">  <?php echo $nama_web_product; ?> </td>
            </tr>
        </table>
    </div>
</div>

<div class="show-image-popup-product" style="padding-bottom: 20px;display: none; text-align: left; max-height: 90vh; overflow: auto;">
    <button class="kembali-image-popup-product btn" style="margin-bottom: 10px; padding: 2px 5px;"> <a style="font-size: 12px;"> Kembali </a> </button>
    <div id="show-image-content-product"></div>
</div>

<div class="pop-up-review" style="padding-bottom: 23px">
    <div class="close-review-popup"></div>
    <h5 style="margin-top: 10px;"> Review Produk </h5>
    <div class="review-content">
    </div>

</div>

<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('category?cat=').$ucode_catprod?>"><?php echo  $nama_web_catprod;?></a> <span style="font-size: 14px;">  > <?php echo  $nama_web_product;?></span></div>
<div class="whitespace"></div>

<div class="main-section">
<table style="width:100%"><tr>
        <div class="mobile-only" style="text-align: left;">
            <h2 style="margin-bottom: 20px;"> <?php echo $nama_web_product; ?> </h2>
            <div class="avg_review" style="font-size: 13px; margin-bottom: 5px;"></div>
        </div>

    <td style="width: 48%">
    <div id="image-render">
        <div class="carousel carousel-main">
        </div>
        <div class="carousel carousel-nav desktop-and-tablet">
        </div>

    </div>
    <br>
    <div class="mobile-only" style="text-align: left">
        <?php if($nominal_web_promosi != '' && $persen_web_promosi != ''){ ?>

            <span class="strikethrough"> Rp. <?php echo number_format($pricelist, 2, ',', '.'); ?> </span>
            <span class="persen_web_promosi_box"> <?php echo $persen_web_promosi; ?>% OFF</span>
            <h3 style="color:#c4113f"> Rp. <?php echo number_format($nominal_web_promosi,2,',','.'); ?></h3>

        <?php } else { ?>

            <h3 style="color:#c4113f"> Rp. <?php echo number_format($pricelist,2,',','.'); ?></h3>

        <?php } ?>

        <div style="margin-top: 15px">
            <span style="color:#757575"> Warna: <?php echo $nama_web_warna; ?><span/>
            <br>
            <p style="color:#757575; font-size: 13px"> Stok: <?php echo $stok_web_product; ?></p>
        </div>
        <p style="color:#757575; font-size: 13px"> GRATIS ONGKIR untuk area Pulau Jawa</p>
        <form class="add-to-cart-form">
            <table style="width: 100%"><tr>
                <td style="width:60%">
                    <!-- <select class="form-control qty_item" name="qty_item">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                    </select>-->
                    <input type="text" class="form-control qty_item" name="qty_item" value="1">
                </td>
                <input type="hidden" id="ucode_web_product" name="ucode_web_product" value="<?php echo $ucode_web_product; ?>">
                <td style="width:10%">
                    <?php if(empty($id_web_user_favorite)){ ?>
                        <button type="button" class="btn add-to-fav"><i class="fas fa-heart"></i></button>
                        <button type="button" class="btn remove-from-fav" style="background: white; color: #a50000; border: 1px solid #a50000; display: none;"><i class="fas fa-heart"></i></button>
                    <?php } else { ?>
                        <button type="button" class="btn add-to-fav" style="display: none;"><i class="fas fa-heart"></i></button>
                        <button type="button" class="btn remove-from-fav" style="background: white; color: #a50000; border: 1px solid #a50000;"><i class="fas fa-heart"></i></button>
                    <?php } ?>
                </td>
                <td style="width:30%"> <button type="button" class="btn add-to-cart" style="width:100%"><i class="fas fa-cart-plus"></i></button> </td>
            </tr> </table>
        </form>


    </div>
    </td>
    <td class="desktop-and-tablet-tablecell" style="width: 4%"></td>
    <td class="desktop-and-tablet-tablecell" valign="top" style="text-align: left; padding-top: 25px; width: 48%">
        <h2> <?php echo $nama_web_product; ?> </h2>
        <p style="color:#757575; font-size: 12px"> Art No. : <?php echo $art_number_web_product; ?></p>
        <div class="avg_review" style="font-size: 13px;">

        </div>
        <br>
        <div class="item_price">

            <?php if($nominal_web_promosi != '' && $persen_web_promosi != ''){ ?>

            <span class="strikethrough"> Rp. <?php echo number_format($pricelist, 2, ',', '.'); ?> </span>
            <span class="persen_web_promosi_box"> <?php echo $persen_web_promosi; ?>% OFF</span>
            <h2 style="color:#c4113f"> Rp. <?php echo number_format($nominal_web_promosi,2,',','.'); ?></h2>

            <?php } else { ?>

            <h2 style="color:#c4113f"> Rp. <?php echo number_format($pricelist,2,',','.'); ?></h2>

            <?php } ?>


        </div>
        <div style="margin-top: 15px">
            <span style="color:#757575"> Warna: <?php echo $nama_web_warna; ?><span/><br>
                <img style="max-height: 75px; max-width: 75px; border: 1px solid #757575; border-radius: 3px; margin: 10px 0px" src="<?php echo $img_web_warna; ?>" alt="Card image cap">
            <br>
            <p style="color:#757575; font-size: 13px"> Stok: <?php echo $stok_web_product; ?></p>
        </div>
        <p style="color:#757575; font-size: 13px"> Pengiriman: GRATIS ONGKIR untuk area Pulau Jawa</p>
        <form class="add-to-cart-form">
            <table style="width: 80%"><tr>
                <td style="width:60%">
                    <!-- <select class="form-control qty_item" name="qty_item">
                         <option>1</option>
                         <option>2</option>
                         <option>3</option>
                         <option>4</option>
                         <option>5</option>
                         <option>6</option>
                         <option>7</option>
                         <option>8</option>
                         <option>9</option>
                     </select>-->
                    <input type="text" class="form-control qty_item" name="qty_item" value="1">
                </td>
                <input type="hidden" id="ucode_web_product" name="ucode_web_product" value="<?php echo $ucode_web_product; ?>">
                <td style="width:10%">
                    <?php if(empty($id_web_user_favorite)){ ?>
                        <button type="button" class="btn add-to-fav"><i class="fas fa-heart"></i></button>
                        <button type="button" class="btn remove-from-fav" style="background: white; color: #a50000; border: 1px solid #a50000; display: none;"><i class="fas fa-heart"></i></button>
                    <?php } else { ?>
                        <button type="button" class="btn add-to-fav" style="display: none;"><i class="fas fa-heart"></i></button>
                        <button type="button" class="btn remove-from-fav" style="background: white; color: #a50000; border: 1px solid #a50000;"><i class="fas fa-heart"></i></button>
                    <?php } ?>
                </td>
                <td style="width:30%"> <button type="button" class="btn add-to-cart" style="width:100%"><i class="fas fa-cart-plus"></i></button> </td>
            </tr> </table>
        </form>
    </td>
</tr></table>
</div>
<div style="background: #f4f4f5; padding: 30px 8vw">
    <table style="width: 100%"><tr>
    <td style="width:58%" valign="top">
        <div class="mobile-only" style="background: white; width: 100%; padding: 20px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
            <h6> Spesifikasi Produk </h6>
            <div style="border-bottom: 2px solid #a50000; margin: 10px 0; width: 100%"></div>
            <table class="table-border" style="width: 100%; text-align: left; border-collapse: collapse">
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px; "> Panjang</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $length_web_product; ?> cm</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Lebar</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"><?php echo $width_web_product; ?> cm</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Tinggi</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $height_web_product; ?> cm </td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Volume</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $vol_web_product; ?> m3</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Berat Kotor </td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $wg_web_product; ?> kg</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Berat Bersih</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"><?php echo $wn_web_product; ?> kg</td>
                </tr>
            </table>
        </div>
        <br>
        <div class="accordion" id="accordionExample">
        <div class="card z-depth-0 bordered" style="width: 100%">
            <div class="card-header" type="button"  id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                 aria-expanded="true" aria-controls="collapseOne" style="background: #a50000; border-radius: 8px; ">
                <h5 class="mb-0">

                        <table style="width:100%; text-align: left; color: white;">
                            <tr>
                                <td> Deskripsi Produk</td>
                                <td style="float:right;"> <i class="fas fa-angle-down"></i> </td>
                            </tr>
                        </table>

                </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                 data-parent="#accordionExample">
                <div class="card-body" style="font-size: 14px">
                    <?php echo $desc_web_product; ?>

                </div>
            </div>
        </div>
        <br>
        <div class="card z-depth-0 bordered" style="width: 100%">
            <div class="card-header" type="button" data-toggle="collapse"
                 data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" id="headingThree" style="background: #a50000; border-radius: 8px;">
                <h5 class="mb-0">
                        <table style="width:100%; text-align: left; color: white;">
                            <tr>
                                <td> Cara Perawatan </td>
                                <td style="float:right;"> <i class="fas fa-angle-down"></i> </td>
                            </tr>
                        </table>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body" style="font-size: 14px">
                    <?php echo $maintenance_web_product; ?>
                </div>
            </div>
        </div>
    </div>
    </td>
    <td style="width: 4%">

    </td>
    <td class="desktop-and-tablet-tablecell" style="width: 38%" valign="top">
        <div style="background: white; width: 100%; padding: 20px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
            <h6> Spesifikasi Produk </h6>
            <div style="border-bottom: 2px solid #a50000; margin: 10px 0; width: 100%"></div>
            <table class="table-border" style="width: 100%; text-align: left; border-collapse: collapse">
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px; "> Panjang</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $length_web_product; ?> cm</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Lebar</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"><?php echo $width_web_product; ?> cm</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Tinggi</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $height_web_product; ?> cm </td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Volume</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $vol_web_product; ?> m3</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Berat Kotor </td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"> <?php echo $wg_web_product; ?> kg</td>
                </tr>
                <tr class="table-border">
                    <td class="table-border" style="width: 50%; background: lightgrey; padding: 5px 10px"> Berat Bersih</td>
                    <td class="table-border" style="width: 50%; padding: 5px 10px;"><?php echo $wn_web_product; ?> kg</td>
                </tr>
            </table>
        </div>
    </td>
    </tr></table>


</div>

<style>
    .table-border{
        border: 1px solid black;
        font-size: 14px;
    }


</style>


<script>

    cart_url = '<?php echo base_url('cart/');?>';
    product_url = '<?php echo base_url('product/');?>';

    $('[data-toggle="collapse"]').on('click',function(e){
        if ( $(this).parents('.accordion').find('.collapse.show') ){
            var idx = $(this).index('[data-toggle="collapse"]');
            if (idx == $('.collapse.show').index('.collapse')) {
                e.stopPropagation();
            }
        }
    })


    //get average review
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : product_url + 'get_average_review', // the url where we want to POST
        data        : {ucode_web_product: $('#ucode_web_product').val()}, // our data object
        dataType    : 'json',
        success     : function(data){

            if(data.round_rating != null){
                html = '';

                for (i = 1; i <= 5; i++) {
                    if(i <= data.round_rating){
                        html += '<span class="fa fa-star checked"></span>'
                    } else {
                        html += '<span class="fa fa-star"></span>'
                    }

                }

                html += '<span style="margin-left: 5px;">' + data.rating + '<span> | <a style="color: #a50000; text-decoration: underline;" class="lihat_review">Lihat Review</a>';
            } else {
                html = '<span> Belum ada review </span> ';
            }


            $('.avg_review').html(html);
            $('.lihat_review').click(function(e){
                e.preventDefault();
                $('.review-content').html('<div style="margin-top: 20px"> Memuat... </div>');
                $('.pop-up-review').css('display', 'block');
                $('.Veil-non-hover').fadeIn();
                loadReview();

            })

        }
    })

    // get all review
    function loadReview(reset = true){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : product_url + 'get_all_review', // the url where we want to POST
            data        : {ucode_web_product: $('#ucode_web_product').val()}, // our data object
            dataType    : 'json',
            success     : function(data){
                console.log(data);
                html = ''
                data.forEach(function(data){
                    html += '<div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px; text-align: left;">\n' +
                        '<div class="avg_review" style="font-size: 18px; margin: 8px 0;">';


                    for (i = 1; i <= 5; i++) {
                        if (i <= data.rating_web_ulasan) {
                            html += '<span class="fa fa-star checked"></span>\n';
                        } else {
                            html += '<span class="fa fa-star"></span>\n';
                        }
                    }

                    html +=                         '        </div>'+
                        '        <span>"'+ data.detail_web_ulasan +'"</span><br><br>  ';
                    html += '<table style="border-spacing: 10px; border-collapse: separate;"><tr>';

                    // review images
                    for (i = 1; i <= 5; i++) {
                        if(data['img'+i+'_web_ulasan'] != ''){
                            html += '<td style="cursor: pointer;" onclick="showImage(this)"><img style="max-width: 75px; max-height: 75px;" src="'+ data['img'+i+'_web_ulasan'] +'"></td>';
                        }

                    }

                    html += '</tr></table>';

                     html += '</div>';
                })

                if(reset){
                    $('.review-content').html(html);
                } else {
                    $('.review-content').append(html);
                }

            }
        })

    }

    // pop up problem
    function showImage(el){

        $('#show-image-content-product').html('<img style="max-height: 600px; max-width:450px" src="'+ $(el).find('img').attr('src') +'">');
        $('.pop-up-review').css('display', 'none');
        $('.show-image-popup-product').css('display', 'block');
        $('.Veil-non-hover').fadeIn();


    }

    $('.kembali-image-popup-product').click(function(e){
        e.preventDefault();
        $('.pop-up-review').css('display', 'block');
        $('.show-image-popup-product').css('display', 'none');
    })

    $('.close-review-popup, .Veil-non-hover').click(function(e){
        $('.pop-up-review').css('display', 'none');
        $('.show-image-popup-product').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
        $('.pop-up-content').fadeOut();
    })

    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : product_url + 'get_product_images', // the url where we want to POST
        data        : {ucode_web_product: $('#ucode_web_product').val()}, // our data object
        dataType    : 'json',
        success     : function(data){

            console.log(data);
            var $carouselMain = $('.carousel-main');
            var $carouselNav = $('.carousel-nav');

            $html = '';
            $htmlNav = '';

            data.forEach(function(data){
                $html += '<div class="carousel-cell product-image" style=""><img src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"></div>';
                $htmlNav += '<div class="carousel-cell"><img style="max-height: 75px; max-width: 75px; padding: 1px; margin: 1px;" src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"></div>';
            })


            $carouselMain.append($html);
            $carouselNav.append($htmlNav);

            $carouselMain.flickity({
                imagesLoaded:true,
                prevNextButtons: false,
                pageDots:false
            });

            $carouselNav.flickity({
                asNavFor: ".carousel-main",
                contain: true,
                pageDots: false,
                prevNextButtons: false,
                imagesLoaded: true
            });
        }
    })

    $('.add-to-fav').click(function(e){
        $('.loading').css("display", "block");
       $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : product_url + 'add_to_favorite', // the url where we want to POST
            data        : {product: $('#ucode_web_product').val()}, // our data object
            dataType    : 'json',
            success     : function(response){

                if(response.Status === 'OK'){
                    show_snackbar(response.Message);
                    $('.add-to-fav').css('display', 'none');
                    $('.remove-from-fav').css('display', 'block');
                } else if(response.Status === "ERROR"){
                    show_snackbar(response.Message);
                } else if(response.Status === "UNAUTHORIZED") {
                    $('#login-modal').modal("toggle");
                }

                $('.loading').css("display", "none");
               $('.Veil-non-hover').fadeOut();

            }
        })
    })

    $('.remove-from-fav').click(function(e){
        $('.loading').css("display", "block");
       $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : product_url + 'remove_from_favorite', // the url where we want to POST
            data        : {product: $('#ucode_web_product').val()}, // our data object
            dataType    : 'json',
            success     : function(response){

                if(response.Status === 'OK'){
                    show_snackbar(response.Message);
                    $('.remove-from-fav').css('display', 'none');
                    $('.add-to-fav').css('display', 'block');
                } else if(response.Status === "ERROR"){
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
               $('.Veil-non-hover').fadeOut();

            }
        })
    })

    $('.add-to-cart').click(function(e){
        $('.loading').css("display", "block");
       $('.Veil-non-hover').fadeIn();

        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : cart_url + 'add_to_cart', // the url where we want to POST
            data        : $('.add-to-cart-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == 'OK'){
                    $('.pop-up-content').css('display', 'block');
                    $('.Veil-non-hover').css('display', 'block');
                } else if(response.Status == 'ERROR'){
                    show_snackbar(response.Message);
                    $('.Veil-non-hover').fadeOut();
                }

                $('.loading').css("display", "none");
            }
        })
    })

    $('.close-popup').click(function(e){
        $('.pop-up-content').fadeOut();
        $('.Veil-non-hover').fadeOut();
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
        $('.qty_item').val($(this).val());
    })

</script>