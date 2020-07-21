<!--<div class="breadcrumbs"></div>-->
<div class="whitespace"></div>

<div class="main-section">
    <table style="width: 100%; text-align: left;">
        <tr>
            <td valign="top" class="left-td-profile">
                <h1> Halo! </h1>
                <div class="whitespace"></div>

                <a style="text-decoration: none;" href="<?php echo base_url('profile/terakhir_dilihat');?>">
                <div class="link-card" style="background: #f4f4f5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%; text-align: center;"> <i class="fas fa-history" aria-hidden="true"></i> </td>
                            <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Terakhir Dilihat </span></td>
                            <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                        </tr>
                    </table>
                </div>
                </a>

                <a class="mobile-only" style="text-decoration: none;" href="<?php echo base_url('profile/purchase');?>">
                    <div class="link-card" style="background: #f4f4f5">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 15%; text-align: center;"> <i class="fas fa-shopping-cart" aria-hidden="true"></i> </td>
                                <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Riwayat Pesanan </span></td>
                                <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                            </tr>
                        </table>
                    </div>
                </a>

                <a class="mobile-only" style="text-decoration: none;" href="<?php echo base_url('profile/favorite');?>">
                    <div class="link-card" style="background: #f4f4f5">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 15%; text-align: center;"> <i class="fas fa-heart" aria-hidden="true"></i> </td>
                                <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Favorit </span></td>
                                <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                            </tr>
                        </table>
                    </div>
                </a>

                <br>
                <p style="color:black;">Informasi Pribadi</p>

                <a style="text-decoration: none;" href="<?php echo base_url('profile/edit_akun');?>">
                <div class="link-card" style="background: #f4f4f5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%; text-align: center;"> <i class="fas fa-user-edit" aria-hidden="true"></i> </td>
                            <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Edit Akun </span> </td>
                            <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                        </tr>
                    </table>
                </div>
                </a>

                <a style="text-decoration: none;" href="<?php echo base_url('profile/daftar_alamat');?>">
                <div class="link-card" style="background: #f4f4f5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%; text-align: center;"> <i class="fas fa-home" aria-hidden="true"></i> </td>
                            <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Kelola Alamat </span> </td>
                            <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                        </tr>
                    </table>
                </div>
                </a>

                <br>
                <p style="color:black;">Ulasan Produk</p>

                <a style="text-decoration: none;" href="<?php echo base_url('profile/review');?>">
                <div class="link-card" style="background: #f4f4f5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%; text-align: center;"> <i class="fas fa-hand-paper" aria-hidden="true"></i> </td>
                            <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Kelola Ulasan </span> </td>
                            <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                        </tr>
                    </table>
                </div>
                </a>

                <br>
                <p style="color:black;">Perlu Bantuan?</p>
                <div class="link-card" style="background: #f4f4f5">
                    <table style="width: 100%">
                        <tr>
                            <td style="width: 15%; text-align: center;"> <i class="fas fa-hands-helping" aria-hidden="true"></i> </td>
                            <td style="width: 70%"> <span style="color: black; font-size: 15px;"> Pusat Bantuan </span> </td>
                            <td style="width: 15%; text-align: right"> <i class="fas fa fa-arrow-right" aria-hidden="true"></i> </td>
                        </tr>
                    </table>
                </div>

                <div class="mobile-only">
                    <br>
                    <a style="text-decoration: none;" href="<?php echo base_url('home/logout');?>">
                    <div class="link-card" style="background: #a50000; text-align: center;">
                    <table style="width: 100%">
                        <tr>
                            <td> <span style="color: white; font-size: 15px;"> KELUAR </span> </td>
                        </tr>
                    </table>
                    </div>
                    </a>
                </div>

            </td>
            <td></td>
            <td style="width: 65%" valign="top" class="desktop-only-tablecell">
                <div class="whitespace"></div>
                <h4> Riwayat Pesanan </h4>
                <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>
                <div id="riwayat-pesanan" >
                    <div style="text-align: center;">Memuat pesanan....</div>
                </div>


                <div class="whitespace"></div>
                <h4> Produk Favorit </h4>
                <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>
                <div id="item-favorit">
                    <div style="text-align: center;">Memuat item....</div>

                </div>

                <div class="whitespace"></div>
                <!--<h4> Direkomendasikan! </h4>
                <div style="border-bottom: 2px solid #a50000; margin: 20px 0; width: 100%"></div>
                <div class="card-group">
                    <div class="card" style="background: white; width: 100%; padding: 15px; margin: 25px 10px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text" style="font-size: 14px;">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        </div>
                    </div>
                    <div class="card" style="background: white; width: 100%; padding: 15px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text" style="font-size: 14px;">This card has supporting text below as a natural lead-in to additional content.</p>
                        </div>
                    </div>
                    <div class="card" style="background: white; width: 100%; padding: 15px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text" style="font-size: 14px;">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                    </div>
                    <div class="card" style="background: white; width: 100%; padding: 15px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text" style="font-size: 14px;">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                        </div>
                    </div>
                </div>-->
            </td>
        </tr>
    </table>

</div>

<script>
    profile_url = '<?php echo base_url('profile/');?>';

    function get_riwayat_pesanan(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'get_riwayat_pesanan', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){
                html = '';
                prev_so_m  = 0;
                so_count = 0;
                start = true;
                length = data.length;
                console.log(data);
                if(length == 0){
                   html = '<div style="text-align: center; margin-top: 20px;"> Tidak ada pesanan </div>'
                } else {
                    data.forEach(function(data){
                        console.log(data);
                        if(data.id_web_so_m != prev_so_m & so_count < 3 & start === false){
                            html +=    ' </div></div>';
                            so_count ++;
                        }

                        if(data.id_web_so_m != prev_so_m & so_count < 3){
                            html += '<div onclick="location.href=\'<?php echo base_url('profile/purchase_detail?id=');?>'+ data.bukti_web_so_m +'\'" style="text-decoration: none;"><div class="link-card" style="background: white; width: 100%; padding: 20px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">\n' +
                                '                        <h6 class="card-title">Pesanan #'+ data.bukti_web_so_m +' <span style="font-size: 12px">('+ data.tgl_web_so_m +')</span> </h6>\n';

                        }

                        if(so_count < 3){
                            html +=    '<span class="card-text" style="font-size: 13px;"> ('+ data.qty_so_d +'x) '+ data.nama_product_so_d +'</span><br>\n';
                        }



                        prev_so_m = data.id_web_so_m;
                        start = false;

                    });
                    html +=    '  </div></div><div style="text-align: right; font-size: 14px; text-decoration: underline"> <a style="color: #a50000;" href="<?php echo base_url('profile/purchase/');?>">Lihat semua pesanan</a></div>';

                }
                $('#riwayat-pesanan').html(html);

            }
        })
    }


    function get_favorites(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'get_favorites', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                console.log(data);
                html = '<div class="card-group">';
                length = data.length;
                count = 0;
                if(length == 0){
                    html = '<div style="text-align: center; margin-top: 20px;"> Tidak ada produk favorit </div>'
                } else {
                    data.forEach(function(data){
                        if(count < 4){
                            html += '<div class="card link-card" style="background: white; width: 100%; padding: 15px; margin: 25px 10px !important; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;"><a style="text-decoration: none" href="<?php echo base_url('product?prod=');?>'+ data.art_number_web_product +'\&color='+ data.nama_web_col +'">\n'+
                                '                        <div class="card-body" style="padding: 0.5rem">\n'+
                                '                            <div style="text-align: center"><img src="'+ data.file_web_image +'" alt="Card image cap"></div>\n'+
                                '                            <p class="card-text" style="font-size: 14px;">'+ data.nama_web_product +'</p>\n'+
                                '                        </div>\n'+
                                '                   </a> </div>';
                            count++;
                        }


                    })

                    if(length === 1){
                        html += '<div class="card"></div><div class="card"></div><div class="card"></div>';
                    }
                    else if(length === 2){
                        html += '<div class="card"></div><div class="card"></div>';
                    } else if (length === 3){
                        html += '<div class="card"></div>';
                    }

                    html += '</div><div style="text-align: right; font-size: 14px; text-decoration: underline"> <a style="color: #a50000;" href="<?php echo base_url('profile/favorite/');?>">Lihat daftar favorit</a></div>';

                }
                $('#item-favorit').html(html);
            }
        })
    }

    get_riwayat_pesanan();
    get_favorites();

</script>