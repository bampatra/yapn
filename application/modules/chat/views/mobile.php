<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PIRA</title>
    <link rel="icon" href="<?php echo base_url('assets/images/logo/logo 400 x 400.png');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap/bootstrap.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/flickity/flickity.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome/all.css');?>">

    <script src="<?php echo base_url('assets/js/jquery-3.4.1.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/flickity/flickity.pkgd.js');?>"></script>
    <script src="<?php echo base_url('assets/js/font-awesome/all.js');?>"></script>

</head>

<div>
    <div class="chat-window-mobile col-xs-5 " id="chat_window_1">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading top-bar panel-collapsed">
                    <div class="col-md-8 col-xs-8">
                        <span class="glyphicon glyphicon-comment"></span> Chat
                    </div>
                </div>

                <?php if(isset($_SESSION['id_web_user'])){ ?>
                    <div id="chat_feature" style="width: 100%; background: white; padding: 3px; display: none;">
                        <button id="upload_img_chat"> <i class="fas fa-image"></i> </button>
                        <button id="attach_product_chat"> <i class="fas fa-shopping-cart"></i> </button>
                    </div>
                <?php }  ?>



                <div class="panel-body msg_container_base" style="display: none">
                    <?php if(!isset($_SESSION['id_web_user'])){ ?>
                        <div style="margin-top: 15px;"> Silahkan login untuk menggunakan fitur ini</div>
                    <?php }  ?>

                    <span class="loading-chat"  style="position: absolute;left: 0;z-index: 5000; display: none;"><img src="<?php echo base_url('assets/images/load.gif');?>"></span>
                </div>



                <div id="attached_product" style="width: 100%; background: white; padding: 3px; display:none;">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%;">
                                <img style="max-width: 50px" src="<?php echo base_url('assets/images/real_category/RAK SEPATU.png');?>" >
                            </td>
                            <td style="width: 80%; text-align: left; font-size: 13px;" class="product_attachment_name"> </td>
                            <td style="width: 5%; text-align: right; cursor: pointer;" valign="top" class="remove_attachment"> <i class="fas fa-times"></i> </td>
                        </tr>
                    </table>
                </div>


                <div class="panel-footer">
                    <?php if(isset($_SESSION['id_web_user'])){ ?>
                        <form id="chat-form">
                            <div class="input-group">
                                <input type="text" class="form-control input-sm chat_input" name="message_chat" placeholder="...">
                                <input type="hidden" class="ref_input" name="ref_chat" value="0">
                                <input type="file" accept="image/*" class="img_input" name="img_chat" value="" style="display: none">
                                <input type="hidden" class="product_input" name="product_chat" value="0">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary btn-sm" id="submit-chat">Kirim</button>
                                </span>
                            </div>
                        </form>
                    <?php } else { ?>
                        <div class="input-group">
                            <input type="text" class="form-control input-sm" name="message_chat" placeholder="..." disabled>
                            <span class="input-group-btn">
                                <button class="btn btn-primary btn-sm" id="submit-chat" disabled>Kirim</button>
                            </span>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>

</div>

<div class="chat-popup" style="max-height: 80vh">
    <div class="close-chat-popup"></div>
    <h5 style="margin: 10px 0 25px 0;"> Tambahkan Link Produk </h5>
    <input style="margin-bottom: 15px;" class="form-control" type="text" placeholder="Cari Nama Produk atau Art No. Produk" name="search_product_attachment" id="search_product_attachment">
    <div class="product-lists" style="max-height: 55vh; overflow: auto;">

    </div>

</div>

<div class="show-image-popup" style="padding-bottom: 20px;display: none;">
    <div class="close-image-popup"></div>
    <div id="show-image-content"></div>
</div>

<div class="Veil-non-hover" style="z-index: 4998"></div>
<img class="loading" style="width: 600px; position: fixed; z-index: 5000; display: none; left: 50%; top: 50%; transform: translate(-50%, -50%);" src="<?php echo base_url('assets/images/load.gif');?>">

<script>

    // var viewportHeight = $('.msg_container_base').outerHeight();
    // $('.msg_container_base').css({ height: viewportHeight });

    var chats_array = [];
    chat_url = '<?php echo base_url('chat/');?>';
    product_url = '<?php echo base_url('product/');?>';
    home_url = '<?php echo base_url('home/');?>';
    let send = true;

    let mobile = false, tablet = false;

    let limit_product_attachment = 16,
        offset_product_attachment = 0,
        load_product_attachment = false;

    function reset_loadmore_product_attachment(){
        limit_product_attachment = 16;
        offset_product_attachment = 0;
        load_product_attachment = false;
    }

    function checkVisibleProductAttachment(elm) {
        var rect = elm.getBoundingClientRect();
        var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    $('.product-lists').scroll(function() {
        elem = $(this);
        if (elem[0].scrollHeight - elem.scrollTop() == parseInt(elem.outerHeight()) ||
            elem[0].scrollHeight - elem.scrollTop() == parseInt(elem.outerHeight()) + 1 ||
            elem[0].scrollHeight - elem.scrollTop() == parseInt(elem.outerHeight()) - 1) {
            loadmore_product_attachment();
        }
    });

    function loadmore_product_attachment(){
        if(load_product_attachment){
            load_product_attachment = false;
            offset_product_attachment += limit_product_attachment;
            $('.loading').css('display', 'block');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : product_url + 'get_all_products', // the url where we want to POST
                data        : {search: search_product_attachment, limit: limit_product_attachment, offset: offset_product_attachment}, // our data object
                dataType    : 'json',
                success     : function(data){
                    if(data.length > 0){
                        loadDataProductAttachment(data, false);
                        load_product_attachment = true;
                    }
                    $('.loading').css('display', 'none');
                }
            })
        }

    }

    if($(window).width() < 992){
        tablet = true;
    }

    if($(window).width() < 576) {
        mobile = true;
    }

    let search_product_attachment = '';

    $(window).scroll(function (event) {
        var scroll = $(window).scrollTop();
        if(scroll > 120){
            $('.secondary-navbar').slideDown(350);
        } else {
            $('.secondary-navbar').slideUp(350);
        }
    });

    $(".mini-cat").hover(
        function(e){ $('.Veil').fadeIn(150); $('.mini-cat-div').fadeIn(150); }, // over
        function(e){ $('.Veil').fadeOut(150); $('.mini-cat-div').fadeOut(150);}  // out
    );

    $('#search_product_attachment').keyup(function(e){
        reset_loadmore_product_attachment();
        search_product_attachment = $(this).val();
        get_product_attachments(true);
    })



    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : home_url + 'get_category', // the url where we want to POST
        dataType    : 'json',
        success     : function(response){
            html = '';
            response.forEach(function(cat){
                html += '<tr style=" border: 1px solid #f4f4f5; border-radius: 8px;" onclick="window.location=\' <?php echo base_url('category?cat=');?>'+ cat.id_web_catprod +' \';">' +
                    '<td><img style="max-width: 50px; max-height: 50px;" class="card-img-top" src="'+ cat.img_web_catprod +'"></td>' +
                    '<td style="color: black;">' + cat.nama_web_catprod + '</td>' +
                    '</tr>';
            })
            $('.mini-cat-content').html(html);
        }
    })

    $(document).on('click', '.panel-heading ', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $('#chat_feature').css('display', 'none');
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $('#chat_feature').css('display', 'block');
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
        setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300);


    });
    $(document).on('focus', '.panel-footer input.chat_input', function (e) {
        var $this = $(this);
        if ($('.panel-heading').hasClass('panel-collapsed')) {
            $('#chat_feature').css('display', 'block');
            $this.parents('.panel').find('.panel-body').slideDown();
            $('.panel-heading').removeClass('panel-collapsed');
            $('.panel-heading').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
        setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300);
    });

    $('.chat_input').on('keypress',function(e) {
        if(e.which === 13 && $(this).val().length !== 0 && send) {
            e.preventDefault();
            send_message($(this));
        }
    });

    $('#submit-chat').click(function(e){
        e.preventDefault();
        if($('.chat_input').val().length !== 0 && send) {
            send_message($(this));
        }
    })

    $('#upload_img_chat').click(function(e){
        e.preventDefault();
        $('.img_input').click();
    })

    $('#attach_product_chat').click(function(e){
        e.preventDefault();
        get_product_attachments(false);
        $('.Veil-non-hover').fadeIn();
        $('.chat-popup').fadeIn();
    })

    $('.close-chat-popup').click(function(e){
        $('.chat-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.close-image-popup').click(function(e){
        $('.show-image-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.img_input').change(function(e){
        $('.loading').css("display", "block");
        $('.Veil').fadeIn();
        e.preventDefault();
        var formData = new FormData($('form')[0]);

        $.ajax({
            url         : chat_url + 'upload_image',
            method      : "POST",
            data        : formData,
            processData : false,
            contentType : false,
            dataType    : 'json',
            success: function(response){
                console.log(response);
                chats_array.push(response.ID.toString());
                if(response.Status == "OK"){
                    html = '<div class="row msg_container base_sent">\n' +
                        '                        <div class="col-md-10 col-xs-10">\n' +
                        '                            <div class="messages msg_sent" style="background:#d7e4ff;">\n' +
                        '                                <img src="' + response.File + '">' +
                        '                                    <time>'+ response.Timestamp +'</time>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                    </div>';

                    $('.msg_container_base').append(html);
                    $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil').fadeOut();
                $('#chat-form').trigger("reset");

            }
        });
    })

    function send_message(element){
        send = false;
        $('.chat_input').attr('readonly', true);
        $('.loading-chat').css('display', 'block');
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : chat_url + 'send_chat', // the url where we want to POST
            data        : $('#chat-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status === "OK"){
                    //chats_array.push(response.ID.toString());
                    //html = '';
                    //
                    ////if($('.product_input').val() != '0'){
                    ////    html += '<div class="row msg_container base_sent" style="cursor: pointer; margin-bottom: 5px;">\n' +
                    ////        '                        <div class="col-md-10 col-xs-10">\n' +
                    ////        '                            <div class="messages msg_sent" style="background:#d7e4ff;">\n';
                    ////
                    ////    html += '<table style="width: 100%;">\n'+
                    ////        '                        <tr>\n'+
                    ////        '                            <td style="width: 15%;">\n'+
                    ////        '                                <img style="max-width: 50px" src="<?php ////echo base_url('assets/images/real_category/RAK SEPATU.png');?>////" >\n'+
                    ////        '                            </td>\n'+
                    ////        '        <td style="width:5%"></td>   '+
                    ////        '                            <td style="width: 80%; text-align: left; font-size: 13px;"> '+ $('.product_attachment_name').html() +'</td>\n'+
                    ////        '                        </tr>\n'+
                    ////        '                    </table>';
                    ////
                    ////    html +=  '                            <time style="color: #a50000; text-decoration: underline;"> Lihat Produk </time></div>\n' +
                    ////        '                        </div>\n' +
                    ////        '                    </div>';
                    ////}
                    //
                    //html += '<div class="row msg_container base_sent">\n' +
                    //    '                        <div class="col-md-10 col-xs-10">\n' +
                    //    '                            <div class="messages msg_sent" style="background:#d7e4ff;">\n';
                    //
                    //
                    //if($('.product_input').val() != '0'){
                    //    html += '<a href="" target="_blank"><table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;">\n'+
                    //        '                        <tr>\n'+
                    //        '                            <td style="width: 15%;">\n'+
                    //        '                                <img style="max-width: 50px" src="<?php //echo base_url('assets/images/real_category/RAK SEPATU.png');?>//" >\n'+
                    //        '                            </td>\n'+
                    //        '        <td style="width:5%"></td>   '+
                    //        '                            <td style="width: 80%; text-align: left; font-size: 13px; "> <p> '+ $('.product_attachment_name').html() +' </p></td>\n'+
                    //        '                        </tr>\n'+
                    //        '                    </table></a>';
                    //}
                    //
                    //html +=    '                                <p>'+ $('.chat_input').val() +'</p>\n' +
                    //    '                                <time>'+ response.Timestamp +'</time>\n' +
                    //    '                            </div>\n' +
                    //    '                        </div>\n' +
                    //    '                    </div>'
                    //
                    //$('.msg_container_base').append(html);
                    //$('.chat_input').val('');
                    //$(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

                    refresh_chat();


                } else {
                    show_snackbar(response.Message);
                }

                send = true;
                $('.loading-chat').css('display', 'none');
                $('.chat_input').attr('readonly', false);
                $('#chat-form').trigger("reset");
                $('#attached_product').css('display', 'none');
                $('.product_input').val(0);

            }
        })
    }

    function refresh_chat(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : chat_url + 'get_all_messages', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    if(!chats_array.includes(data.id_web_chat)){
                        chats_array.push(data.id_web_chat);
                        if(data.id_admin === "0"){

                            html += '<div class="row msg_container base_sent">\n' +
                                '                        <div class="col-md-10 col-xs-10">\n' +
                                '                            <div class="messages msg_sent" style="background:#d7e4ff;">\n';



                            if(data.ucode_product_web_chat != '0'){

                                if(data.active_web_catprod == '0' || data.active_web_col == '0' || data.file_web_image == '' || data.active_web_product == '0'){
                                    html +=  '<table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;"> <tr>\n'+
                                        '        <td style="width:5%"></td>   '+
                                        '                            <td style="width: 80%; text-align: left; font-size: 10px; "> Produk tidak aktif</td>\n'+
                                        '                        </tr>\n'+
                                        '                    </table>';
                                } else {
                                    html += '<a href="<?php echo base_url('product?prod=');?>'+ data.art_number_web_product +'&color='+ data.nama_web_col +'" target="_blank"><table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;">\n'+
                                        '                        <tr>\n'+
                                        '                            <td style="width: 15%;">\n'+
                                        '                                <img style="max-width: 50px" src="'+ data.file_web_image +'" >\n'+
                                        '                            </td>\n'+
                                        '        <td style="width:5%"></td>   '+
                                        '                            <td style="width: 80%; text-align: left; font-size: 13px; "> <p> '+ data.nama_web_product +' </p></td>\n'+
                                        '                        </tr>\n'+
                                        '                    </table></a>';
                                }

                            }

                            if(data.img_web_chat == ''){
                                html +=   '                                <p>'+ data.message_web_chat +'</p>\n';
                            } else {
                                html += '<div style="cursor: pointer" class="show-image"><img src="' + data.img_web_chat + '"></div>';
                            }


                            html += '                                <time>'+ data.timestamp_web_chat +'</time>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>';
                        } else {
                            html += '<div class="row msg_container base_receive">\n' +
                                '                        <div class="col-md-10 col-xs-10">\n' +
                                '                            <div class="messages msg_receive">\n' +
                                '                                <p>'+ data.message_web_chat +'</p>\n' +
                                '                                <time>'+ data.timestamp_web_chat +'</time>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>';
                        }
                    }
                })

                $('.msg_container_base').append(html);
                $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight);

                $('.show-image').click(function(e){
                    e.preventDefault();
                    $('#show-image-content').html('<img src="'+ $(this).find('img').attr('src') +'">');
                    $('.show-image-popup').css('display', 'block');
                    $('.Veil-non-hover').fadeIn();
                })

            }
        })
    }
    refresh_chat();
    // setInterval(function(){ refresh_chat() }, 5000);


    function get_product_attachments(reset = false){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : product_url + 'get_all_products', // the url where we want to POST
            dataType    : 'json',
            data        : {search: search_product_attachment, limit: limit_product_attachment, offset: offset_product_attachment},
            success     : function(data) {
                loadDataProductAttachment(data, reset);
                load_product_attachment = true;
            }
        })

    }

    function loadDataProductAttachment(data, reset){
        html = ''
        data.forEach(function(data){
            html += '<div class="prod_row" id="'+ data.ucode_web_product +'" style="border: 1px solid #f4f4f5; background: white; width: 100%; padding: 10px; margin-bottom: 10px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">\n'+
                '            <table style="width: 100%">\n'+
                '                <tr style="cursor:pointer;">\n'+
                '                    <td style="width: 15%;">\n'+
                '                        <img style="max-width: 50px" src="'+ data.file_web_image +'" >\n'+
                '                    </td>\n'+
                '                    <td style="width: 85%; text-align: left;" class="nama_product_row">'+ data.nama_web_product +' </td>\n'+
                '                </tr>\n'+
                '            </table>\n'+
                '        </div>';


        })

        if(reset == false){
            $('.product-lists').append(html);
        } else {
            $('.product-lists').html(html);
        }



        $('.prod_row').click(function(e){
            e.preventDefault();
            $('.chat-popup').css('display', 'none');
            $('.Veil-non-hover').fadeOut();
            $('.product_input').val($(this).attr('id'));
            $('.product_attachment_name').html($(this).find('table').find('tr').find('.nama_product_row').html());
            $('#attached_product').css('display', 'block');
        })
    }

    $('.remove_attachment').click(function(e){
        e.preventDefault();
        $('#attached_product').css('display', 'none');
        $('.product_input').val(0);
    })

</script>