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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/flickity/flickity.css');?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome/all.css');?>">

    <script src="<?php echo base_url('assets/js/jquery-3.4.1.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-migrate.js');?>"></script>
    <script src="<?php echo base_url('assets/js/jquery-ui-1.10.3.js');?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap/bootstrap.min.js');?>"></script>
    <script src="<?php echo base_url('assets/js/flickity/flickity.pkgd.js');?>"></script>
    <script src="<?php echo base_url('assets/js/font-awesome/all.js');?>"></script>

</head>


<style>
    .breadcrumb{
        display: none;
    }

    .btn-chat{
        background-color: #a50000;
        border: medium none;
        border-radius: 50%;
        bottom: 10px;
        font-size: 22px;
        height: 50px;
        line-height: 50px;
        position: relative;
        float: right;
        right: 30px;
        text-align: center;
        width: 50px;
        z-index: 2;
        display: block;
        outline: 0;
        pointer-events: auto;
    }
    .ui-autocomplete {
        z-index: 4999;
    }

    #snackbar{
        z-index: 4999;
    }

    .totalNotifHeader{
        min-width: 20px;
        min-height: 20px;
        color: rgb(255, 255, 255);
        font-size: 10px;
        font-weight: 700;
        line-height: 1.6;
        text-align: center;
        background-color: rgb(239, 20, 74);
        position: absolute;
        top: 10px;
        border-width: 2px;
        border-style: solid;
        border-color: rgb(255, 255, 255);
        border-image: initial;
        border-radius: 18px;
        padding: 0px 4px;
        display: none;
    }

    .notifDot{
        height: 10px;
        width: 10px;
        background-color: #a50000;
        border-radius: 50%;
        display: block;
        float: left;
    }

</style>


<body>

<div class="mobile-only" style="position: fixed;bottom: 0px;z-index: 10;width: 100%; pointer-events: none;">
    <a style="cursor: pointer;" onclick="javascript:window.open('<?php echo base_url('chat/mobile')?>')" class="btn-chat" title="">
        <i style="color: white;" class="fa fa-comments" aria-hidden="true"></i>
    </a>
</div>



<div class="secondary-navbar" style="width: 100%; position: fixed; top:0; background: #a50000; z-index:1002; display: none;">
    <table style="width: 100%">
        <tr>
            <td style="width: 5%"></td>
            <td class="mini-cat desktop-and-tablet tablecell" style="width: 10%; color: white; cursor: pointer;">
                Kategori <i style="margin-left: 5px;" class="fas fa-angle-down"></i>
                <div  class="mini-cat-div" style="background: white;
                            min-height: 100px;
                            position: absolute;
                            min-width: 300px;
                            z-index: 1002;
                            margin-top: 18px;
                            margin-left: -8px;
                            padding: 10px 20px;
                            max-height: 60vh; overflow: auto;
                            display: none;">
                    <table  class="mini-cat-content" style="width: 100%; border-collapse:separate; border-spacing:0 5px; ">

                    </table>

                </div>
            </td>
            <td style="width: 35%;" class="mobile-full-width">
                <div class="input-group" style="height: 100%; padding: 10px;">
                    <input type="text" class="form-control search-form search-form1" placeholder="PENCARIAN">
                    <div class="input-group-append">
                        <button class="btn cari-btn" type="button" style="border: 1px solid white;">Cari</button>
                    </div>
                </div>
            </td>
            <td style="width: 40%">

            </td>
        </tr>
    </table>

</div>

<div>
    <div class="row chat-window col-xs-5 " id="chat_window_1" style="margin-left:10px; width: 350px;">
        <div class="col-xs-12 col-md-12 desktop-only">
            <div class="panel panel-default">
                <div class="panel-heading top-bar panel-collapsed">
                    <div class="col-md-8 col-xs-8">
                        <span class="glyphicon glyphicon-comment"></span> <div class="pesan_baru">Chat</div>
                    </div>
                </div>

                <?php if(isset($_SESSION['id_web_user'])){ ?>
                    <div id="chat_feature" style="width: 100%; background: white; padding: 3px; display: none;">
                        <button id="upload_img_chat"> <i class="fas fa-image"></i> </button>
                        <button id="attach_product_chat"> <i class="fas fa-shopping-cart"></i> </button>
                        <button id="attach_order_chat"> <i class="fas fa-shopping-bag"></i> </button>
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
                            <td style="width: 15%;" class="product_attachment_img">

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

<div class="order-popup" style="max-height: 80vh">
    <div class="close-order-popup"></div>
    <h5 style="margin: 10px 0 25px 0;"> Daftar Pesanan </h5>
    <input style="margin-bottom: 15px;" class="form-control" type="text" placeholder="Cari Nama Produk atau No. Pesanan" name="search_order_attachment" id="search_order_attachment">
    <div class="order-lists" style="max-height: 55vh; overflow: auto; text-align: left;">

    </div>

</div>

<div class="show-image-popup" style="padding-bottom: 20px;display: none;">
    <div class="close-image-popup"></div>
    <div id="show-image-content"></div>
</div>

<img class="loading" style="width: 600px; position: fixed; z-index: 5000; display: none; left: 50%; top: 50%; transform: translate(-50%, -50%);" src="<?php echo base_url('assets/images/load.gif');?>">
<div class="Veil"></div>
<div class="Veil-non-hover" style="z-index: 4998"></div>
<div id="snackbar"></div>
<div class="right-menu" style="display: none; height:100%; width: 40vw; background: white; color: black; z-index: 1002; position: fixed; right: 0; ">
    <div style="text-align: center; padding: 15px; ">
        <h5 class="close-right-menu"> Title </h5>
    </div>
</div>



<div class="modal fade" tabindex="-1" role="dialog" id="login-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masuk ke Akun PIRA </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" role="alert" id="login-error-message" style="display:none">

                </div>
                <form id="login-form">
                    <div class="form-group row">
                        <label for="email_address" class="col-md-4 col-form-label text-md-right">Email / No. Telp </label>
                        <div class="col-md-6">
                            <input type="text" id="creds" class="form-control" name="creds" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input type="password" id="password" class="form-control" name="password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <p style="color:black; font-size: 12px"> Belum mempunyai akun? <br><a style="text-decoration: underline; color: #a50000;" href="<?php echo base_url('/register');?>">Daftar sekarang!</a></p>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" id="login-btn">Masuk</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="notification-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Notifikasi </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <img class="loading-notifikasi" style="width: 450px; display: none;" src="<?php echo base_url('assets/images/load.gif');?>">
                <div class="notification-detail" >


                </div>

            </div>
        </div>
    </div>
</div>

<div style="width:100%; background: #a50000; height: 80px; z-index: 1002" class="main-navbar desktop-and-tablet">
    <table style="width:100%" class="vertical-center"><tr>

            <td valign="middle" style="width: 5%"><span> <a href="<?php echo base_url('home');?>"><img style="max-height: 75px; margin-left: -2vw" src="<?php echo base_url('assets/images/logo/logo 400 x 400.png');?>"></a> </span></td>
            <td valign="middle" style="width: 40%">
                <div class="input-group">
                    <input type="text" class="form-control search-form search-form2" placeholder="PENCARIAN">
                    <div class="input-group-append">
                        <button class="btn cari-btn" type="button" style="border: 1px solid white;">Cari</button>
                    </div>
                </div>
            </td>
            <td style="width: 2%"></td>
            <td style="width: 15%"><a href="<?php echo base_url('rekomendasi')?>"><span style=" color: white; cursor: pointer"> Rekomendasi </span></a> </td>
            <td style="width: 37%">
                <table class="navbar-rightmost" style="float:right; width: 40%">
                    <tr>
                        <?php if(isset($_SESSION['id_web_user'])){ ?>
                            <!--<td valign="middle"><a style="color:white;"> <?php echo $_SESSION['email_web_user'] ?> </a></td>-->
                            <td valign="middle" style="text-align: right;">
                                <a style="color:white;" id="navbar-profile" href="<?php echo base_url('profile');?>"> <i class="fas fa-user navbar-icon"></i> </a>
                                <div class="navbar-content" id="navbar-profile-content" style="width: 300px; position: fixed; right: 120px; border-radius: 3px; background: white; display: none;">
                                    <div style="text-align: center; margin: 10px 0; border-bottom: 1px solid lightgrey">  <p style="color:black; font-size: 13px;"> <?php echo $_SESSION['email_web_user'] ?> </p> </div>
                                    <div style=" text-align: left; padding: 10px 15px;">
                                        <a style="text-decoration: none" href="<?php echo base_url('profile');?>"><p style="color:black;"> Akun Saya </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/purchase');?>"><p style="color:black;"> Pesanan Saya </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/daftar_alamat');?>"><p style="color:black; "> Kelola Alamat </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/favorite');?>"><p style="color:black; "> Favorit </p></a>
                                        <div style="width: 100%; padding: 15px;">
                                            <a href="<?php echo base_url('home/logout');?>"><button class="btn" style="width: 100%"> Keluar </button></a>
                                        </div>
                                    </div>

                                </div>

                            </td>
                        <?php } else { ?>
                            <td valign="middle" style="text-align: right;"><a style="color:white;" class="login-modal-toggle">
                                <i class="fas fa-sign-in-alt"></i> </a>
                            </td>
                        <?php } ?>
                        <td style="width: 5%"></td>
                        <td valign="middle" style="text-align: right;">
                            <a id="navbar-notification" style="color:white;">
                                <i class="fas fa-bell navbar-icon"></i>
                                <span data-testid="totalNotifHeader" class="totalNotifHeader"></span>
                            </a>

                            <div class="navbar-content notification-content">
                                <div class="navbar-main-title">  <h6> Notifikasi </h6> </div>
                                <div style="padding: 10px; margin-top: 50px; ">
                                    <img class="loading-notifikasi" style="width: 450px; display: none;" src="<?php echo base_url('assets/images/load.gif');?>">
                                    <div class="notification-detail">


                                    </div>
                                </div>
                            </div>
                        </td>

                        <td valign="middle" style="text-align: right;">
                            <span id="navbar-cart" style=" color: white;"> <i class="fas fa-shopping-cart navbar-icon"></i></span>

                            <div class="navbar-content" id="navbar-cart-content">
                                <div class="navbar-main-title">
                                    <h6> Keranjang </h6>
                                    <a href="<?php echo base_url('cart')?>"><span style="color: #a50000; text-decoration: underline; font-size: 11px; float: right; margin-top: -15px; cursor: pointer;"> Lihat semua </span></a>
                                </div>
                                <div style="padding: 10px; margin-top: 55px; ">
                                    <img class="loading-cart" style="width: 450px; display: none;" src="<?php echo base_url('assets/images/load.gif');?>">

                                    <div id="navbar-cart-detail">



                                    </div>
                                </div>

                                <div class="lihat-keranjang-button" style="text-align: center; padding: 10px ;width: inherit; background: white; display: none">
                                    <a href="<?php echo base_url('cart');?>"> <button class="btn" style="width: 100%"> Lihat Keranjang </button> </a>
                                </div>
                            </div>
                        </td>


                    </tr>
                </table>

            </td>


        </tr></table>
</div>


<div class="mobile-navbar mobile-only" style=" background: #a50000; padding: 5px">
    <table style="width: 100%; border-collapse: separate;">
        <tr>
            <td>
                <a href="<?php echo base_url('home');?>"> <img style="height: 60px; width: 60px; margin-left: -2vw" src="<?php echo base_url('assets/images/logo/logo 400 x 400.png');?>"></a>
            </td>
            <td style="text-align: right;">
                <table class="navbar-rightmost" style="float:right; width: 70%;">
                    <tr>
                        <?php if(isset($_SESSION['id_web_user'])){ ?>

                            <td valign="middle" style="text-align: center;">
                                <a style="color:white;" id="navbar-profile" href="<?php echo base_url('profile');?>"> <i class="fas fa-user navbar-icon"></i> </a>
                                <div class="navbar-content" id="navbar-profile-content" style="width: 300px; position: fixed; right: 120px; border-radius: 3px; background: white; overflow: scroll; display: none;">
                                    <div style="text-align: center; margin: 10px 0; border-bottom: 1px solid lightgrey">  <p style="color:black; font-size: 13px;"> <?php echo $_SESSION['email_web_user'] ?> </p> </div>
                                    <div style=" text-align: left; padding: 10px 15px;">
                                        <a style="text-decoration: none" href="<?php echo base_url('profile');?>"><p style="color:black;"> Akun Saya </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/purchase');?>"><p style="color:black;"> Pesanan Saya </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/daftar_alamat');?>"><p style="color:black; "> Kelola Alamat </p></a>
                                        <a style="text-decoration: none" href="<?php echo base_url('profile/favorite');?>"><p style="color:black; "> Favorit </p></a>
                                        <div style="width: 100%; padding: 15px;">
                                            <a href="<?php echo base_url('home/logout');?>"><button class="btn" style="width: 100%"> Keluar </button></a>
                                        </div>
                                    </div>

                                </div>

                            </td>
                        <?php } else { ?>
                            <td valign="middle" style="text-align: right;"><a style="color:white;" class="login-modal-toggle">
                                    <i class="fas fa-sign-in-alt"></i> </a>
                            </td>
                        <?php } ?>
                        <td style="width: 5%"></td>
                        <td valign="middle" style="text-align: center;">
                            <a id="navbar-notification-mobile" style="color:white;">
                                <i class="fas fa-bell navbar-icon"></i>
                                <span data-testid="totalNotifHeader" class="totalNotifHeader"></span>

                            </a>

                            <div class="navbar-content notification-content">
                                <div class="navbar-main-title">  <h6> Notifikasi </h6> </div>
                                <div style="padding: 10px; margin-top: 50px; ">
                                    <img class="loading-notifikasi" style="width: 450px; display: none;" src="<?php echo base_url('assets/images/load.gif');?>">
                                    <div class="notification-detail">


                                    </div>
                                </div>
                            </div>

                        </td>

                        <td valign="middle" style="text-align: center;">
                            <a style="color:white;" href="<?php echo base_url('cart');?>"><i class="fas fa-shopping-cart navbar-icon"></i></a>
                        </td>


                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style="width: 100%; border-collapse: separate; border-spacing: 5px; margin-top: -10px">
        <tr>

            <td>
                <div class="input-group">

                    <input type="text" class="form-control search-form search-form3" placeholder="PENCARIAN">
                    <div class="input-group-append">
                        <button class="btn cari-btn" type="button" style="border: 1px solid white;">Cari</button>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    
    var chat_url =  '<?php echo base_url('chat/');?>';
    var product_url = '<?php echo base_url('product/');?>';
    var home_url = '<?php echo base_url('home/');?>';
    var profile_url = '<?php echo base_url('profile/');?>';

    let mobile = false, tablet = false;

    let search_product_attachment = '';
    let search_order_attachment = '';

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

    function htmlDecode(input){
        var e = document.createElement('textarea');
        e.innerHTML = input;
        // handle case of empty input
        return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
    }


    if($(window).width() < 992){
        tablet = true;
    }

    if($(window).width() < 576) {
        mobile = true;
    }



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


    $('#search_order_attachment').keyup(function(e){
        search_order_attachment = $(this).val();
        get_order_attachments();
    })

    var chats_array = [];
    let send = true;


    $.ajax({
        type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
        url         : home_url + 'get_category', // the url where we want to POST
        dataType    : 'json',
        success     : function(response){
            html = '';
            response.forEach(function(cat){
                html += '<tr style=" border: 1px solid #f4f4f5; border-radius: 8px;" onclick="window.location=\' <?php echo base_url("category?cat=");?>'+ cat.id_web_catprod +' \';">' +
                    '<td><img style="max-width: 50px; max-height: 50px;" class="card-img-top" src="'+ cat.img_web_catprod +'"></td>' +
                    '<td style="color: black;">' + cat.nama_web_catprod + '</td>' +
                    '</tr>';
            })
            $('.mini-cat-content').html(html);
        }
    })

    $(document).on('click', '.panel-heading', function (e) {
        setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300)
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
            $.ajax({
                type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url: chat_url + 'is_read', // the url where we want to POST
                dataType: 'json',
                success: function (response) {
                    if(response.Status == 'OK'){
                        $('.pesan_baru').html('Chat')
                    }
                }
            })

        }
    });
    $(document).on('focus', '.panel-footer input.chat_input', function (e) {
        setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300)
        var $this = $(this);
        if ($('.panel-heading').hasClass('panel-collapsed')) {
            $('#chat_feature').css('display', 'block');
            $this.parents('.panel').find('.panel-body').slideDown();
            $('.panel-heading').removeClass('panel-collapsed');
            $('.panel-heading').removeClass('glyphicon-plus').addClass('glyphicon-minus');
            $.ajax({
                type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
                url: chat_url + 'is_read', // the url where we want to POST
                dataType: 'json',
                success: function (response) {
                    if(response.Status == 'OK'){
                        $('.pesan_baru').html('Chat')
                    }
                }
            })
        }
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
        get_product_attachments(true);
        $('.Veil-non-hover').fadeIn();
        $('.chat-popup').fadeIn();
    })

    $('#attach_order_chat').click(function(e){
        e.preventDefault();
        get_order_attachments();
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('.order-popup').fadeIn();
    })

    $('.close-chat-popup').click(function(e){
        $('.chat-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.close-order-popup').click(function(e){
        $('.order-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.close-image-popup').click(function(e){
        $('.show-image-popup').css('display', 'none');
        $('.Veil-non-hover').fadeOut();
    })

    $('.img_input').change(function(e){
        e.preventDefault();
        var formData = new FormData($('form')[0]);
        $('.loading-chat').css('display', 'block');
        $('.chat_input').attr('readonly', true);
        $.ajax({
            url         : chat_url + 'upload_image',
            method      : "POST",
            data        : formData,
            processData : false,
            contentType : false,
            dataType    : 'json',
            success: function(response){
                chats_array.push(response.ID.toString());
                if(response.Status == "OK"){
                    html = '<div class="row msg_container base_sent">\n' +
                        '                        <div class="col-md-10 col-xs-10">\n' +
                        '                            <div class="messages msg_sent" style="background:#d7e4ff;">\n' +
                        '                                <img src="<?php echo base_url()?>' + response.File + '">' +
                        '                                    <time>'+ response.Timestamp +'</time>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                    </div>';

                    $('.msg_container_base').append(html);
                    setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300);
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading-chat').css('display', 'none');
                $('.chat_input').attr('readonly', false);
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
                    //setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300);

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

    function refresh_chat(reset = true){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : chat_url + 'get_all_messages', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){
                html = '';
                pesan_baru = 0;


                data.forEach(function(data){

                    if(data.is_read == '0' && data.id_admin != '0' && $('.panel-heading').hasClass('panel-collapsed')){
                        pesan_baru++;
                        $('.pesan_baru').html('Chat ('+ pesan_baru +')')
                    }

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
                                    html += '<a href="<?php echo base_url("product?prod=");?>'+ data.art_number_web_product +'&color='+ data.nama_web_col +'" target="_blank"><table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;">\n'+
                                        '                        <tr>\n'+
                                        '                            <td style="width: 15%;">\n'+
                                        '                                <img style="max-width: 50px" src="<?php echo base_url()?>'+ data.file_web_image +'" >\n'+
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
                                html += '<div style="cursor: pointer" class="show-image"><img src="<?php echo base_url()?>' + data.img_web_chat + '"></div>';
                            }


                            html += '                                <time>'+ data.timestamp_web_chat +'</time>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>';
                        } else {
                            html += '<div class="row msg_container base_receive">\n' +
                                '                        <div class="col-md-10 col-xs-10">\n' +
                                '                            <div class="messages msg_receive">\n';

                            if(data.ucode_product_web_chat != '0'){

                                if(data.active_web_catprod == '0' || data.active_web_col == '0' || data.file_web_image == '' || data.active_web_product == '0'){
                                    html +=  '<table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;"> <tr>\n'+
                                        '        <td style="width:5%"></td>   '+
                                        '                            <td style="width: 80%; text-align: left; font-size: 10px; "> Produk tidak aktif</td>\n'+
                                        '                        </tr>\n'+
                                        '                    </table>';
                                } else {
                                    html += '<a href="<?php echo base_url("product?prod=");?>'+ data.art_number_web_product +'&color='+ data.nama_web_col +'" target="_blank"><table style="width: 100%; margin-bottom: 10px; border-bottom: 1px solid #c1c1c1; border-spacing: 5px; border-collapse: separate;">\n'+
                                        '                        <tr>\n'+
                                        '                            <td style="width: 15%;">\n'+
                                        '                                <img style="max-width: 50px" src="<?php echo base_url()?>'+ data.file_web_image +'" >\n'+
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
                                html += '<div style="cursor: pointer" class="show-image"><img src="<?php echo base_url()?>' + data.img_web_chat + '"></div>';
                            }


                            html +=    '                                <time>'+ data.timestamp_web_chat +' dari ADMIN PIRA</time>\n' +
                                '                            </div>\n' +
                                '                        </div>\n' +
                                '                    </div>';
                        }
                    }
                })

                if(reset == true){
                    $('.msg_container_base').append(html);
                    setTimeout(function(){ $(".msg_container_base").scrollTop($(".msg_container_base")[0].scrollHeight) }, 300);
                } else {
                    $('.msg_container_base').append(html);
                }



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


    setInterval(function(){ refresh_chat(false) }, 5000);


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

    function get_order_attachments(){

        let prev = 0;

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'get_riwayat_pesanan_chat', // the url where we want to POST
            dataType    : 'json',
            data        : {search: search_order_attachment},
            success     : function(data) {
                length = data.length;

                if(data.length === 0){
                    html = '<p style="text-align: center; font-size: 16px;"> Tidak ada pesanan </p>';
                    $('.order-lists').html(html);
                    $('.loading').css("display", "none");
                } else {
                    html = '';
                    first = true;

                    data.forEach(function(data, i){

                        if(data.id_web_so_m != prev && first == false){
                            html += '             <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n' +
                                '                    <div style="text-align: right; ">\n' +
                                '                        <button class="btn attach_order" style="padding: 5; font-size: 13px;" id="'+ prev +'"> Kirim </button>\n' +
                                '                    </div>\n' +
                                '\n' +
                                '                </div></div><br>';
                        }


                        if(data.id_web_so_m != prev){
                            html += '<div style="width: 100%; padding: 10px; border: 1px solid darkgrey; border-radius: 5px;">\n' +
                                '                    <table style="width: 100%">\n' +
                                '                        <tr>\n' +
                                '                            <td style="width: 50%">\n' +
                                '                                <span style="font-size: 14px;">'+ data.bukti_web_so_m +'</span><br>\n' +
                                '                                <div style="font-size:12px; margin-top: 5px;">'+ status_pesanan(data.status_web_so_m, data.paid_by_user) +'</div>\n' +
                                '                            </td>\n' +
                                '                            <td style="width: 50%; text-align: right" valign="top">\n' +
                                '                                <div style="font-size:12px; color: darkgrey;">'+ data.tgl_web_so_m +'</div>\n' +
                                '                            </td>\n' +
                                '                        </tr>\n' +
                                '                    </table>\n' +
                                '                    <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n';
                        }

                        html +=    '              <table style="margin-bottom: 10px;">\n' +
                            '                        <tr>\n' +
                            '                            <td style="width: 15%">\n' +
                            '                                <img style="max-width: 50px; max-height: 50px;" src="<?php echo base_url()?>'+ data.file_web_image +'">\n' +
                            '                            </td>\n' +
                            '                            <td style="width: 2%"></td>\n' +
                            '                            <td style="width: 50%; font-size: 13px; vertical-align: top;" >'+ data.nama_product_so_d +'</td>\n' +
                            '                            <td style="width: 2%"></td>\n' +
                            '                            <td style="width: 31%; font-size: 13px; text-align: right; vertical-align: top" >'+ convertToRupiah(data.total_price_so_d) +'</td>\n' +
                            '                        </tr>\n' +
                            '                    </table>\n';



                        if(i == (length-1)){
                            html += '             <div style="border-bottom: 1px solid lightgrey; margin: 10px 0; width: 100%"></div>\n' +
                                '                    <div style="text-align: right; ">\n' +
                                '                        <button class="btn attach_order" style="padding: 5; font-size: 13px;" id="'+ data.id_web_so_m +'"> Kirim </button>\n' +
                                '                    </div>\n' +
                                '\n' +
                                '                </div><br>';
                        }


                        prev = data.id_web_so_m;
                        first = false;
                    })

                    $('.order-lists').html(html);
                    $('.loading').css("display", "none");

                    $('.attach_order').click(function(e){
                        $('.loading').css("display", "block");

                        e.preventDefault();
                        id_web_so_m = $(this).attr('id');


                        $.ajax({
                            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                            url: chat_url + 'send_order_via_chat', // the url where we want to POST// our data object
                            dataType: 'json',
                            data: $('#chat-form').serialize() + "&id_web_so_m=" + id_web_so_m,
                            success: function (response) {
                                $('.loading').css("display", "none");
                                $('.order-popup').fadeOut();
                                $('.Veil-non-hover').fadeOut();
                                refresh_chat(false)
                            }
                        })
                    });
                }


            }
        })
    }

    function status_pesanan(status, confirm_payment){
        switch(status) {
            case '1':
                if(confirm_payment == 0){
                    return "Diterima - Belum Bayar";
                } else {
                    return "Diterima - Menunggu Pengecekan";
                }

                break;
            case '2':
                return "Diproses";
                break;
            case '3':
                return "Dikirim";
                break;
            case '4':
                return "Selesai";
                break;
            case '5':
                return "Dibatalkan";
                break;
        }
    }

    function loadDataProductAttachment(data, reset){
        html = ''
        data.forEach(function(data){
            html += '<div class="prod_row" id="'+ data.ucode_web_product +'" style="border: 1px solid #f4f4f5; background: white; width: 100%; padding: 10px; margin-bottom: 10px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">\n'+
                '            <table style="width: 100%">\n'+
                '                <tr style="cursor:pointer;">\n'+
                '                    <td style="width: 15%;" class="img_product_row">\n'+
                '                        <img style="max-width: 50px" src="<?php echo base_url()?>'+ data.file_web_image +'" >\n'+
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
            $('.product_attachment_img').html($(this).find('table').find('tr').find('.img_product_row').html());
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

<script>
    home_url = '<?php echo base_url('home/');?>';
    should_load_notifikasi = true;
    should_load_cart = true;
    unread_notif_array = [];

    function show_snackbar(message){
        $('#snackbar').html(message);
        $('#snackbar').addClass('show');
        setTimeout(function(){ $('#snackbar').removeClass('show'); }, 3000);
    }

    $('.login-modal-toggle').click(function(){
        $('#login-modal').modal("toggle");
    });

    $('#login-btn').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'login', // the url where we want to POST
            data        : $('#login-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                console.log(response);
                if(response.Status == 'OK'){
                    location.reload();
                } else if(response.Status == 'ERROR'){
                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                    $('#login-error-message').css('display', 'block');
                    $('#login-error-message').html(response.Message);

                }
            }
        })
    })

    $(document).ready(function(){
        loadNotification();
    })

    function loadNotification(read_notif = false){
        $('.loading-notifikasi').css('display', 'block');
        $('.notification-detail').html('');
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: '<?php echo base_url('home/get_notification');?>', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                html = '';
                unread_count = 0;

                if (data.length > 0) {
                    data.forEach(function (data) {
                        if(data.is_read == '0'){
                            unread_count++;
                            unread_notif_array.push(data.id_web_notifikasi);
                            html += '<div style="text-align: left; padding: 5px; cursor: pointer" onclick="window.location.href=\'<?php echo base_url()?>'+ data.url_web_notifikasi +'\'"><span class="notifDot"></span><p>' + data.isi_web_notifikasi + '</p><p style="margin-top: -15px; font-size: 10px; color: lightgrey">'+ data.timestamp_web_notifikasi +'</p></div>'
                        } else {
                            html += '<div style="text-align: left; padding: 5px; cursor: pointer" onclick="window.location.href=\'<?php echo base_url()?>'+ data.url_web_notifikasi +'\'"><p>' + data.isi_web_notifikasi + '</p><p style="margin-top: -15px; font-size: 10px; color: lightgrey">'+ data.timestamp_web_notifikasi +'</p></div>'
                        }



                    })

                    if(unread_count > 0){
                        $('.totalNotifHeader').html(unread_count);
                        $('.totalNotifHeader').css('display', 'initial')
                    } else {
                        $('.totalNotifHeader').css('display', 'none')
                    }

                } else {
                    html += '<div style="text-align: center; margin-top: 20px;"> Tidak ada notifikasi</div>';
                }

                $('.notification-detail').html(html);
                $('.loading-notifikasi').css('display', 'none');

                if((unread_notif_array !== undefined || unread_notif_array.length > 0) && read_notif) {
                    readNotification();
                }
                should_load_cart = true;
            }
        })
    }

    function readNotification(){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'read_notification', // the url where we want to POST
            data        : {data: unread_notif_array}, // our data object
            dataType    : 'json',
            success     : function(response){
                if(response.Status == "OK"){
                    unread_notif_array = [];
                    $('.totalNotifHeader').css('display', 'none');
                }
            }
        })
    }

    function loadNavCart(){
        $('#navbar-cart-detail').html('');
        $('.loading-cart').css('display', 'block');
        $('.lihat-keranjang-button').css('display', 'none');
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?php echo base_url('cart/get_cart');?>', // the url where we want to POST
            dataType    : 'json',
            success     : function(data) {
                html = '';
                if (data.length > 0) {
                    data.forEach(function (data) {
                        html += '<table style="width:100%; text-align: left; margin-bottom: 10px;">\n' +
                            '                                                <tr>\n' +
                            '                                                    <td style="width: 25%"><img style="max-height: 100px; border: 1px solid #d9d8db; border-radius: 5px;" src="<?php echo base_url()?>'+ data.file_web_image +'"></td>\n' +
                            '                                                    <td style="2%"></td>' +
                    '                                                           <td style="width: 73%" valign="top">\n' +
                            '                                                        <span style="color: black; font-size: 13px;">' + data.nama_web_product + ' </span><br>\n';

                                if(data.nominal_web_promosi != null && data.persen_web_promosi != null){
                                    html +=  '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist * data.qty_so_d) +'</span> ' +
                                        '<span class="persen_web_promosi_box" style="margin-left: -2px;">'+ data.persen_web_promosi +'% OFF</span>         ' +
                                        '<p style="color: #a50000; font-size: 16px;">'+ convertToRupiah(data.total_price_so_d) +'</p>\n';
                                } else {
                                    html +=  '<span style="color: black; font-size: 16px;">' + convertToRupiah(data.nominal_web_pricelist) + ' <span style="font-size: 12px; color: darkgrey"> (x' + data.qty_so_d + ')</span> </span>\n';
                                }


                       html +=     '                                                    </td>\n' +
                            '                                                </tr>\n' +
                            '                                            </table>';
                    })

                    $('.lihat-keranjang-button').css('display', 'block');
                } else {
                    html += '<div style="text-align: center; margin-top: 20px;"> Keranjang anda kosong </div>';
                    $('.lihat-keranjang-button').css('display', 'none');
                }
                $('#navbar-cart-detail').html(html);
                $('.loading-cart').css('display', 'none');
            }
        })
    }


    // $('#navbar-fav').click(function(){
    //     $('.right-menu').animate({width:'toggle'},350);
    //     $('.Veil').fadeIn();
    //     $('body').css("overflow","hidden");
    // })

    $('.close-right-menu').click(function(){
        $('.right-menu').animate({width: 'hide'}, 350);
        $('.Veil').fadeOut();
        $('body').css("overflow","auto");
    })

    function convertToRupiah(angka)
    {
        var rupiah = '';
        var angkarev = angka.toString().split('').reverse().join('');
        for(var i = 0; i < angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
        return 'Rp. '+rupiah.split('',rupiah.length-1).reverse().join('')+',00';
    }

    $('#navbar-cart').hover(function(){
        if(should_load_cart){
            $('.loading-cart').css('display', 'block');
            loadNavCart();
            should_load_cart = false;
        }
        should_load_notifikasi = true;
        $('#navbar-profile-content').fadeOut(150);
        $('#navbar-cart-content').fadeIn(150);
        $('.notification-content').fadeOut(150);
        $('.Veil').fadeIn(150);
    })

    $('#navbar-notification').hover(function(){
        if(should_load_notifikasi){
            $('.loading-notifikasi').css('display', 'block');
            loadNotification(true);
            should_load_notifikasi = false;
        }

        $('#navbar-profile-content').fadeOut(150);
        $('#navbar-cart-content').fadeOut(150);
        $('.notification-content').fadeIn(150);
        $('.Veil').fadeIn(150);
    })

    $('#navbar-notification-mobile').click(function(e){
        e.preventDefault();
        if(should_load_notifikasi){
            $('.loading-notifikasi').css('display', 'block');
            loadNotification(true)
            should_load_notifikasi = false;
        }

        $('#navbar-profile-content').fadeOut(150);
        $('#navbar-cart-content').fadeOut(150);
        $('#notification-modal').modal('show');
    })

    $('#navbar-profile').hover(function(){
        should_load_notifikasi = true;
        should_load_cart = true;
        $('#navbar-cart-content').fadeOut(150);
        $('#navbar-profile-content').fadeIn(150);
        $('.notification-content').fadeOut(150);
        $('.Veil').fadeIn(150);
    })


    $('.Veil, #navbar-fav').hover(function(){
        should_load_notifikasi = true;
        should_load_cart = true;
        $('.navbar-content').fadeOut(150);
        $('.Veil').fadeOut(150);
    })

    $('.navbar-rightmost').mouseleave(function(){
        $('.navbar-content').fadeOut(150);
        $('.Veil').fadeOut(150);
    })

    $('.search-form').keypress(function(e) {
        if (e.which == 13) {
            window.location.href = "<?php echo base_url('search/?q=');?>" + $(this).val();
        }

    })

    $('.search-form').keyup(function(e) {
        $('.search-form').val($(this).val())
    })


    $('.cari-btn').click(function(e){
        e.preventDefault();
        window.location.href = "<?php echo base_url('search/?q=');?>" + $('.search-form').val();
    })

    function get_virtual_account(className){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : '<?php echo base_url('profile/get_virtual_account');?>', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){

               $('.' + className).html(data);

            }
        })
    }

    $( ".search-form1" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: home_url + 'get_suggest_product',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    // response(data);
                    response($.map(data, function (item) {
                        return {
                            value: item.value,
                            url: item.url,
                            image: item.image,
                            nominal_web_pricelist: item.nominal_web_pricelist,
                            nominal_web_promosi: item.nominal_web_promosi,
                            persen_web_promosi: item.persen_web_promosi
                        };
                    }))
                }
            });
        },
        select: function (event, ui) {
            $('.search-form').val(ui.item.value);
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item){
        var inner_html = '<table style="width: 100%; margin-bottom: 5px;" onclick="window.location.href=\''+ item.url +'\'"><tr>' +
            '            <td style="width: 10%">  <img style="max-width: 70px;max-height: 70px;" src="<?php echo base_url()?>'+ item.image +'"></td>' +
            '<td style="font-size: 13px;"><span style="text-align: left">' + item.value + '<br>';

        if(item.nominal_web_promosi != null && item.persen_web_promosi != null){
            inner_html += '<div>' +
                '<span style="color: #a50000;">'+ convertToRupiah(item.nominal_web_promosi) +'</span>' +
                '<span class="persen_web_promosi_box" style="margin-left: 2px; margin-right: 2px; font-size: 13px;">'+ item.persen_web_promosi +'% OFF</span><br>' +
                '<span class="strikethrough undiscounted" style="margin-right: 2px; font-size: 11px;">' + convertToRupiah(item.nominal_web_pricelist) + '</span>' +
                '</div>';
        } else {
            inner_html += '<div style="font-size: 13px;">' + convertToRupiah(item.nominal_web_pricelist) + '</div>';
        }


        inner_html += '</span></td>' +
            '</tr></table>';

        return $("<li>")
            .data("item.autocomplete", item)
            .append(inner_html)
            .appendTo(ul);
    };

    $( ".search-form2" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: home_url + 'get_suggest_product',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    // response(data);
                    response($.map(data, function (item) {
                        return {
                            value: item.value,
                            url: item.url,
                            image: item.image,
                            nominal_web_pricelist: item.nominal_web_pricelist,
                            nominal_web_promosi: item.nominal_web_promosi,
                            persen_web_promosi: item.persen_web_promosi
                        };
                    }))
                }
            });
        },
        select: function (event, ui) {
            $('.search-form').val(ui.item.value);
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item){
        //var inner_html = '<table style="width: 100%; margin-bottom: 5px;" onclick="window.location.href=\''+ item.url +'\'"><tr>' +
        //    '            <td style="width: 10%">  <img style="max-width: 50px;max-height: 50px;" src="<?php //echo base_url()?>//'+ item.image +'"></td>' +
        //    '<td style="font-size: 13px;"><span style="text-align: left">' + item.value + '</span></td>' +
        //    '</tr>' +
        //    '<tr><td></td>';
        //
        //
        //if(item.nominal_web_promosi != null && item.persen_web_promosi != null){
        //    inner_html += '<td style="font-size: 13px;">' +
        //        '<span style="color: #a50000;">'+ convertToRupiah(item.nominal_web_promosi) +'</span>' +
        //        '<span class="persen_web_promosi_box" style="margin-left: 2px; margin-right: 2px; font-size: 13px;">'+ item.persen_web_promosi +'% OFF</span><br>' +
        //        '<span class="strikethrough undiscounted" style="margin-right: 2px; font-size: 11px;">' + convertToRupiah(item.nominal_web_pricelist) + '</span>' +
        //        '</td>';
        //} else {
        //    inner_html += '<td style="font-size: 13px;">' + convertToRupiah(item.nominal_web_pricelist) + '</td>';
        //}
        //
        //inner_html += '</tr></table>';

        var inner_html = '<table style="width: 100%; margin-bottom: 5px;" onclick="window.location.href=\''+ item.url +'\'"><tr>' +
            '            <td style="width: 10%">  <img style="max-width: 70px;max-height: 70px;" src="<?php echo base_url()?>'+ item.image +'"></td>' +
            '<td style="font-size: 13px;"><span style="text-align: left">' + item.value + '<br>';

        if(item.nominal_web_promosi != null && item.persen_web_promosi != null){
            inner_html += '<div>' +
                '<span style="color: #a50000;">'+ convertToRupiah(item.nominal_web_promosi) +'</span>' +
                '<span class="persen_web_promosi_box" style="margin-left: 2px; margin-right: 2px; font-size: 13px;">'+ item.persen_web_promosi +'% OFF</span><br>' +
                '<span class="strikethrough undiscounted" style="margin-right: 2px; font-size: 11px;">' + convertToRupiah(item.nominal_web_pricelist) + '</span>' +
                '</div>';
        } else {
            inner_html += '<div style="font-size: 13px;">' + convertToRupiah(item.nominal_web_pricelist) + '</div>';
        }


        inner_html += '</span></td>' +
            '</tr></table>';

        return $("<li>")
            .data("item.autocomplete", item)
            .append(inner_html)
            .appendTo(ul);
    };

    $( ".search-form3" ).autocomplete({
        minLength: 3,
        source: function( request, response ) {
            // Fetch data
            $.ajax({
                url: home_url + 'get_suggest_product',
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                    // response(data);
                    response($.map(data, function (item) {
                        return {
                            value: item.value,
                            url: item.url,
                            image: item.image,
                            nominal_web_pricelist: item.nominal_web_pricelist,
                            nominal_web_promosi: item.nominal_web_promosi,
                            persen_web_promosi: item.persen_web_promosi
                        };
                    }))
                }
            });
        },
        select: function (event, ui) {
            $('.search-form').val(ui.item.value);
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item){
        //var inner_html = '<table style="width: 100%; margin-bottom: 5px;" onclick="window.location.href=\''+ item.url +'\'"><tr>' +
        //    '            <td style="width: 10%">  <img style="max-width: 50px;max-height: 50px;" src="<?php //echo base_url()?>//'+ item.image +'"></td>' +
        //    '<td style="font-size: 13px;"><span style="text-align: left">' + item.value + '</span></td>' +
        //    '</tr>' +
        //    '<tr><td></td>';
        //
        //
        //if(item.nominal_web_promosi != null && item.persen_web_promosi != null){
        //    inner_html += '<td style="font-size: 13px;">' +
        //        '<span style="color: #a50000;">'+ convertToRupiah(item.nominal_web_promosi) +'</span>' +
        //        '<span class="persen_web_promosi_box" style="margin-left: 2px; margin-right: 2px; font-size: 13px;">'+ item.persen_web_promosi +'% OFF</span><br>' +
        //        '<span class="strikethrough undiscounted" style="margin-right: 2px; font-size: 11px;">' + convertToRupiah(item.nominal_web_pricelist) + '</span>' +
        //        '</td>';
        //} else {
        //    inner_html += '<td style="font-size: 13px;">' + convertToRupiah(item.nominal_web_pricelist) + '</td>';
        //}
        //
        //inner_html += '</tr></table>';

        var inner_html = '<table style="width: 100%; margin-bottom: 5px;" onclick="window.location.href=\''+ item.url +'\'"><tr>' +
            '            <td style="width: 10%">  <img style="max-width: 70px;max-height: 70px;" src="<?php echo base_url()?>'+ item.image +'"></td>' +
            '<td style="font-size: 13px;"><span style="text-align: left">' + item.value + '<br>';

        if(item.nominal_web_promosi != null && item.persen_web_promosi != null){
            inner_html += '<div>' +
                '<span style="color: #a50000;">'+ convertToRupiah(item.nominal_web_promosi) +'</span>' +
                '<span class="persen_web_promosi_box" style="margin-left: 2px; margin-right: 2px; font-size: 13px;">'+ item.persen_web_promosi +'% OFF</span><br>' +
                '<span class="strikethrough undiscounted" style="margin-right: 2px; font-size: 11px;">' + convertToRupiah(item.nominal_web_pricelist) + '</span>' +
                '</div>';
        } else {
            inner_html += '<div style="font-size: 13px;">' + convertToRupiah(item.nominal_web_pricelist) + '</div>';
        }


        inner_html += '</span></td>' +
            '</tr></table>';

        return $("<li>")
            .data("item.autocomplete", item)
            .append(inner_html)
            .appendTo(ul);
    };



</script>

