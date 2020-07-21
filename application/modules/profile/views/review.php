<div class="pop-up-content" style="width: 50vw;">
    <div class="close-popup"></div>
    <h5 style="margin-top: 10px;"> Ulasan </h5>
    <div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
        <table style="width: 100%">
            <tr>
                <td style="width: 20%; text-align: left;" id="popup_image">
                    <!-- <img style="max-width: 50px" src="<?php echo base_url('assets/images/real_category/RAK SEPATU.png');?>" >-->
                </td>
                <td style="width: 80%; text-align: left;" class="popup-product-name"></td>
            </tr>
        </table>
    </div>

    <div class="alert alert-danger review-danger" role="alert" style="text-align: left; display: none;"></div>

    <form style="text-align: left;" id="ulasan-form">

        <fieldset class="rating" style="float:left;">
            <input class="star-rating" type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
            <input class="star-rating" type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
            <input class="star-rating" type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
            <input class="star-rating" type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
            <input class="star-rating" type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
        </fieldset>
        <br><br>
        <div class="form-group">
            <label for="detail_web_ulasan" style="font-size: 14px;">Detail Ulasan</label>
            <textarea class="form-control" id="detail_web_ulasan" name="detail_web_ulasan"></textarea>
        </div>

        <span class="upload-img-link" ><i class="fas fa-plus"></i> Unggah Gambar</span><br>
        <table style="border-spacing: 10px; border-collapse: separate; margin-bottom: 15px;">
            <tr>
                <td class="main-img-form" id="img1_form"><div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div></td>
                <td class="main-img-form" id="img2_form"><div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div></td>
                <td class="main-img-form" id="img3_form"><div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div></td>
                <td class="main-img-form" id="img4_form"><div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div></td>
                <td class="main-img-form" id="img5_form"><div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div></td>
            </tr>
        </table>

        <input type="hidden" id="img1_web_ulasan" name="img_ulasan[1]">
        <input type="hidden" id="img2_web_ulasan" name="img_ulasan[2]">
        <input type="hidden" id="img3_web_ulasan" name="img_ulasan[3]">
        <input type="hidden" id="img4_web_ulasan" name="img_ulasan[4]">
        <input type="hidden" id="img5_web_ulasan" name="img_ulasan[5]">

        <input type="hidden" id="id_so_d" name="id_so_d" value="0">
        <input type="hidden" id="ucode_web_product" name="ucode_web_product" value="0">
        <input type="hidden" id="id_web_ulasan" name="id_web_ulasan" value="0">

    </form>
    <form id="image_only">
        <input type="file" accept="image/*" class="img_ulasan_input" name="img_ulasan" value="" style="display: none">
    </form>
    <div style="text-align: right; margin-bottom: 25px;">
        <button class="btn submit-review" style="text-align: left"> Simpan </button>
    </div>


</div>
<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil</a> <span style="font-size: 14px;">  > Ulasan</span></div>
<div class="whitespace"></div>


<div class="main-section" style="text-align: left;">
    <h2 style="margin-bottom: 20px;"> Ulasan Produk </h2>
    <div class="form-group">
        <input type="text" class="form-control" id="order-search" name="order-search" placeholder="Cari berdasarkan No. Pesanan atau Nama Produk">
    </div>
    <br>
    <table style="width: 100%; height:50px; background: #f4f4f5; text-align: center; cursor: pointer;"><tr>
        <td class="status_order status_selected" id="status_1"> Menunggu Diulas </td>
        <td class="status_order" id="status_2"> Ulasan Saya </td>
        <td class="desktop-and-tablet-tablecell">  </td>
        <td class="desktop-and-tablet-tablecell">  </td>
        <td class="desktop-and-tablet-tablecell">  </td>
        <td class="desktop-and-tablet-tablecell">  </td>
    </tr></table>

    <div id="orders-content"></div>


</div>

<style>
    .upload-img-link{
        padding: 5px;
        border: 1px solid #a50000;
        width: 15px;
        height: 15px;
        border-radius: 5px;
        color: #a50000;
        cursor: pointer;

    }
    .img_form{
        padding: 25px;
        background: #f4f4f5;
        color: #a5a4a4;
        cursor: pointer;
        display: none;
    }

    .status_order{
        width: 16%;
    }

    .status_selected{
        color: #a50000; border-bottom: 1px solid #a50000;
    }

    .status_order:hover{
        color: #a50000;
    }

    rating {
        border: none;
        float: left;
    }

    .rating > input { display: none; }
    .rating > label:before {
        margin: 5px;
        font-size: 1.25em;
        font-family: "Font Awesome 5 Free";
        display: inline-block;
        content: "\f005";
        font-weight: 900;
    }

    .rating > label {
        color: #ddd;
        float: right;
    }

    /***** CSS Magic to Highlight Stars on Hover *****/

    .rating > input:checked ~ label, /* show gold star when clicked */
    .rating:not(:checked) > label:hover, /* hover current star */
    .rating:not(:checked) > label:hover ~ label { color: #FFD700;  } /* hover previous stars in list */

    .rating > input:checked + label:hover, /* hover current star when changing rating */
    .rating > input:checked ~ label:hover,
    .rating > label:hover ~ input:checked ~ label, /* lighten current selection */
    .rating > input:checked ~ label:hover ~ label { color: #FFED85;  }

</style>
<script>
    profile_url = '<?php echo base_url('profile/');?>';

    let ulasan_status = '1';
    let search = '';
    let id_web_ulasan = 0;


    $('.status_order').click(function(){

        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Memuat... </h5></div>');
        $('.status_order').removeClass('status_selected');
        $(this).addClass('status_selected');

        ulasan_status = $(this).attr('id').split('status_')[1];
        get_all_review(true);
    })

    $('#order-search').keyup(function(){
        search = $(this).val();
        $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Memuat... </h5></div>');
        get_all_review(true);

    })


    get_all_review(true);
    $('.loading').css("display", "block");
    $('.Veil-non-hover').fadeIn();

    function get_all_review(reset = false){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'get_riwayat_pesanan', // the url where we want to POST
            dataType    : 'json',
            data        : {status: ulasan_status, search: search, tipe: 'REVIEW'},
            success     : function(data){
                if(data.length > 0){
                    loadData(data, reset);
                } else {
                    $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Tidak ada data </h5></div>')
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }

    function loadData(data, reset){
        prev_so_m  = 0;
        html = '';
        start = true;
        count = data.length;
        data.forEach(function(data, i){


            html += '<div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">' +
                '<table class="desktop-and-tablet-inlinetable" style="width: 100%">\n'+
                '            <tr>\n'+
                '                <td> <span style="color: black;"> No. Pesanan: '+ data.bukti_web_so_m +'</span></td>\n'+
                '                <td style="text-align: right;"><span style="color: black; font-size:13px;"> Pesanan Diterima: '+ data.tgl_web_so_m +'</span></td>\n'+
                '            </tr>\n'+
                '        </table>\n'+
                '<div class="mobile-only">' +
                '      <span style="color: black; font-size:13px"> No. Pesanan: '+ data.bukti_web_so_m +'</span><br> ' +
                '          <span style="color: black; font-size:13px;"> Pesanan Diterima: '+ data.tgl_web_so_m +'</span>  ' +
                '    </div> '+
                '        <div style="border-bottom: 1px solid lightgrey; margin: 10px 0;"></div>\n'+
                '        <div>\n'+
                '                        <table style="border-spacing: 0 10px; border-collapse:separate; width: 100%">\n';

            if(data.id_web_ulasan === null){
                html +=   '                      <tr id="review_'+ data.id_web_so_d +'">\n'+
                    '                                <td style="text-align: center;" valign="top">  <img style="max-width: 75px;" src="<?php echo base_url()?>'+ data.file_web_image +'"> </td>\n'+
                    '                                <td style="width: 70%">\n'+
                    '                                    <span style="color: black; font-size:14px"> ('+data.qty_so_d+'x) <span>'+data.nama_product_so_d+'</span></span><br>\n'+
                    '                                    <span style="color: black; font-size:12px">'+ convertToRupiah(data.total_price_so_d) +'</span>\n'+
                    '                                </td>\n'+
                    '                       <td class="desktop-and-tablet-tablecell" style="text-align: right; width: 20%">\n'+
                    '                        <button class="btn add-ulasan prod_'+ data.ucode_web_product +'" style="font-size: 14px;" >Tulis Ulasan</button><br>\n'+
                    '                            </td>' +
                    '                           <td class="mobile-only" valign="middle"><button class="mobile-only btn add-ulasan prod_'+ data.ucode_web_product +'" style="font-size: 14px;" ><i class="fa fa-plus"></button></td></tr>' ;
            } else {
                html +=   '                      <tr id="review_'+ data.id_web_so_d +'">\n'+
                    '                                <td style="text-align: center;" valign="top">  <img style="max-width: 75px;" src="<?php echo base_url()?>'+ data.file_web_image +'"> </td>\n'+
                    '                                <td  style="width: 70%">\n'+
                    '                                    <span style="color: black; font-size:14px;"> ('+data.qty_so_d+'x) '+data.nama_product_so_d+'</span>\n';


                if(mobile || tablet){
                    html += '</td></tr></table>';
                }

                html+=    '<div  style="background: white; width: 100%; padding: 15px 30px; margin: 20px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">'+
                    '                                    <div class="avg_review" style="font-size: 18px; margin: 8px 0;">\n';

                // star rating
                for (i = 1; i <= 5; i++) {
                    if(i <= data.rating_web_ulasan){
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
                        html += '<td style="cursor: pointer;" onclick="showImage(this)"><img style="max-width: 75px; max-height: 75px;" src="<?php echo base_url()?>'+ data['img'+i+'_web_ulasan'] +'"></td>';
                    }

                }

                html += '</tr></table>';

                html +=    '        <span style="font-size: 10px">'+ data.tgl_web_ulasan +'</span>  '+
                    '               <a class="mobile-only show-ulasan review_'+ data.id_web_ulasan +'" style="font-size: 14px; color: #a50000; text-decoration: underline">Edit</a><br>\n'+
                    '</div>';

                if(!mobile && !tablet){
                    html +=    '        </td>'+
                        '           <td class="desktop-and-tablet-tablecell" valign="top" style="text-align: right; width: 20%">\n'+
                        '               <a class="show-ulasan review_'+ data.id_web_ulasan +'" style="font-size: 14px; color: #a50000; text-decoration: underline">Edit</a><br>\n'+
                        '                            </tr>\n';
                }


            }




            html += '                        </table>\n'+
                '                    </td>\n'+
                '            <br>\n';

            // if(data.id_web_ulasan !== null){
            //
            //     html +=  '<a class="mobile-only show-ulasan review_'+ data.id_web_ulasan +'" style="font-size: 14px; color: #a50000; text-decoration: underline">Edit</a>';
            // }

            html +=    '        </div>\n'+
                '       </div>';

            prev_so_m = data.id_web_so_m;
            start = false;




        })

        if(reset){
            $('#orders-content').html(html);
        } else {
            $('#orders-content').append(html);
        }


        $('.show-ulasan').click(function(e){
            e.preventDefault();

            id_web_ulasan = $(this).attr('class').split('review_')[1];
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : profile_url + 'get_row_ulasan', // the url where we want to POST
                data        : {ulasan: id_web_ulasan}, // our data object
                dataType    : 'json',
                success     : function(data){
                    console.log(data);
                    $('#star' + data.rating_web_ulasan).attr("checked", "checked");
                    $('.popup-product-name').html(data.nama_web_product);
                    $('#detail_web_ulasan').val(htmlDecode(data.detail_web_ulasan));
                    $('#ucode_web_product').val(data.ucode_web_product);
                    $('#id_so_d').val(data.id_so_d);
                    $('#id_web_ulasan').val(data.id_web_ulasan);
                    $('.pop-up-content').fadeIn(150);
                    $('.Veil-non-hover').fadeIn(150);
                    img_html = '<img style="max-width:60px" src="<?php echo base_url()?>'+ data.file_web_image + '">';
                    $('#popup_image').html(img_html);

                    //show_image
                    for (i = 1; i <= 5; i++) {
                        if(data['img'+i+'_web_ulasan'] != ''){
                            html = '<img style="width: 75px; height: 75px;" src="<?php echo base_url()?>'+ data['img'+i+'_web_ulasan'] +'"> <i class="fas fa-trash remove-image-form" style="cursor: pointer;"></i>';
                            $('#img' + i + '_web_ulasan').val(data['img'+i+'_web_ulasan']);
                            $('#img' + i +'_form').html(html);

                        }
                    }

                }
            })
        })

        $('.add-ulasan').click(function(e){
            e.preventDefault();
            $('#ucode_web_product').val($(this).attr('class').split('prod_')[1]);
            $('#id_so_d').val($(this).closest('tr').attr('id').split('review_')[1]);
            $('#id_web_ulasan').val(0);
            $('.popup-product-name').html($(this).closest('tr').find("td:eq(1)").find('span').find('span').html());
            $('.pop-up-content').fadeIn(150);
            $('.Veil-non-hover').fadeIn(150);

            img_html = '<img style="max-width:60px" src="'+$(this).parent().parent().find('img').attr('src')+ '">';
            $('#popup_image').html(img_html);

        })

    }


    $('.main-img-form').on('click', '.remove-image-form', function(e){
        e.preventDefault();
        i = $(this).parent('td').attr('id').split('img')[1].split('_form')[0];
        $(this).parent().html('');
        $(this).parent().css('display', 'none');
        $('#img' + i + '_web_ulasan').val('');

    })

    function showImage(el){

        $('#show-image-content').html('<img style="max-height: 600px; max-width:450px" src="'+ $(el).find('img').attr('src') +'">');
        $('.show-image-popup').css('display', 'block');
        $('.Veil-non-hover').fadeIn();

    }

    $('.close-popup, .Veil-non-hover').click(function(e){

        $('.pop-up-content').css('display', 'none');
        $('.show-image-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut(150);
        clean_form();
    })

    $('.submit-review').click(function(e){
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'add_review', // the url where we want to POST
            data        : $('#ulasan-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == "OK"){

                    show_snackbar(response.Message);
                    $('#ulasan-form').trigger('reset');
                    clean_form();
                    get_all_review(reset = true);
                    $('.pop-up-content').css('display', 'none');
                    $('.Veil-non-hover').fadeOut(150);
                } else {
                    show_snackbar(response.Message);
                }
            }
        })
    })

    $('.upload-img-link').click(function(e){
        e.preventDefault();
        $('.img_ulasan_input').click();
    })

    $('.img_ulasan_input').change(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        let empty = false;
        //check if there's an empty slot
        for (i = 1; i <= 5; i++) {
            if($('#img' + i + '_web_ulasan').val() == ''){
                empty = true;
            }
        }

        if(!empty){
            review_form_error_show('Maksimal 5 gambar per ulasan!');
            $('.loading').css("display", "none");
            $('.Veil-non-hover').fadeOut();
            return;
        }

        e.preventDefault();
        var formData = new FormData($('#image_only')[0]);

        $.ajax({
            url         : profile_url + 'upload_image',
            method      : "POST",
            data        : formData,
            processData : false,
            contentType : false,
            dataType    : 'json',
            success: function(response){
                if(response.Status == "OK"){
                    for (i = 1; i <= 5; i++) {
                        // find an empty slot
                        if($('#img' + i + '_web_ulasan').val() == ''){
                            html = '<img style="width: 75px; height: 75px;" src="<?php echo base_url()?>'+ response.File+'"><i class="fas fa-trash remove-image-form" style="cursor: pointer;"></i>';
                            $('#img' + i + '_web_ulasan').val(response.File);
                            $('#img' + i +'_form').html(html);
                            // $('#img' + i +'_form').find('.img_form').html(html);
                            // $('#img' + i +'_form').find('.img_form').css('display', 'block');
                            break;
                        }
                    }

                } else {
                    console.log(response);
                    show_snackbar(response.Message);
                }

                $('.review-danger').html('');
                $('.review-danger').css('display', 'none');
                $('.loading').css("display", "none");
                // $('.Veil-non-hover').fadeOut();

            }
        });
    })

    function clean_form(){
        $('.star-rating').removeAttr('checked');
        $('#ulasan-form').trigger('reset');
        $('#ucode_web_product').val(0);
        $('#id_so_d').val(0);
        $('#id_web_ulasan').val(0);
        $('.review-danger').html('');
        $('.review-danger').css('display', 'none');
        for (i = 1; i <= 5; i++) {
            html = '<div class="img_form" ><i class="fas fa-file" style="height: 25px; width: 25px;"></i></div>';
            $('#img' + i + '_web_ulasan').val('');
            $('#img' + i +'_form').html(html);
            // $('#img' + i +'_form').find('.img_form').html(html);
            // $('#img' + i +'_form').find('.img_form').css('display', 'none');
        }
    }

    function review_form_error_show(message){
        $('.review-danger').html(message);
        $('.review-danger').css('display', 'block');
    }


</script>