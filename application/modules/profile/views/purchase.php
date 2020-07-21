<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil</a> <span style="font-size: 14px;">  > Riwayat Pesanan</span></div>
<div class="whitespace"></div>

<div class="main-section" style="text-align: left;">
    <h2 style="margin-bottom: 15px;"> Riwayat Pesanan </h2>
    <div class="form-group">
        <input type="text" class="form-control" id="order-search" name="order-search" placeholder="Cari No. Pesanan atau Nama Produk">
    </div>
    <br>
    <div style="overflow-x: auto">
    <table class="status_table"><tr>
        <td class="status_order status_selected" id="status_all"> Semua </td>
        <td class="status_order" id="status_1"> Diterima </td>
        <td class="status_order" id="status_2"> Diproses </td>
        <td class="status_order" id="status_3"> Dikirim </td>
        <td class="status_order" id="status_4"> Selesai </td>
        <td class="status_order" id="status_5"> Dibatalkan </td>
    </tr></table>
    </div>

    <div id="orders-content">

        <div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Memuat... </h5></div>

    </div>


</div>

<style>
    .status_order{
        width: 16%;
    }

    .status_selected{
        color: #a50000; border-bottom: 1px solid #a50000;
    }

    .status_order:hover{
        color: #a50000;
    }

    .status_table{
        width: 100%;
        height:50px;
        background: #f4f4f5;
        text-align: center;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .status_table{
            border-spacing: 10px;
            border-collapse: separate;
        }
    }
</style>
<script>
    profile_url = '<?php echo base_url('profile/');?>';

    let order_status = 'all';
    let search = '';

    $('.status_order').click(function(){

        $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Memuat... </h5></div>');
        $('.status_order').removeClass('status_selected');
        $(this).addClass('status_selected');

        order_status = $(this).attr('id').split('status_')[1];
        mainLoad(true);
    })

    $('#order-search').keyup(function(){
        search = $(this).val();
        $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Memuat... </h5></div>');
        mainLoad(true);

    })

    function mainLoad(reset = false){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : profile_url + 'get_riwayat_pesanan', // the url where we want to POST
            dataType    : 'json',
            data        : {status: order_status, search: search, tipe: 'PURCHASE'},
            success     : function(data){
                if(data.length > 0){
                    loadData(data, reset);
                } else {
                    $('#orders-content').html('<div style="text-align: center; margin-top: 40px; height: 40vh"><h5> Tidak ada data </h5></div>')
                }

                $('.loading').css("display", "none");
                $('.Veil').fadeOut();
            }
        })
    }

    function loadData(data, reset = false){
        prev_so_m  = 0;
        html = '';
        start = true;
        count = data.length;
        prev_bukti = '';
        prev_tgl = '';
        prev_status = '';

        data.forEach(function(data, i){

            if(data.id_web_so_m != prev_so_m && start === false){
                html += '                        </table>\n'+
                    '                    </td>\n'+
                    '                    <td class="desktop-and-tablet-tablecell" style="text-align: center;">\n'+
                    '                        <a href="<?php echo base_url('profile/purchase_detail?id=');?>'+ prev_bukti+'"><button class="btn" style="font-size: 14px;">Lihat Detail Pesanan</button></a><br>\n';


                html +=    '                    </td>\n'+
                    '                </tr>\n'+
                    '            </table>\n'+
                    '            <br>\n' +
                    '<a class="mobile-only" href="<?php echo base_url('profile/purchase_detail?id=');?>'+ prev_bukti+'"><button class="btn" style="font-size: 14px;">Lihat Detail Pesanan</button></a><br>'+
                    '            <span style="font-size: 13px; color: black">'+ prev_tgl+'</span>\n'+
                    '        </div>\n'+
                    '       </div>';
            }

            if(data.id_web_so_m != prev_so_m){
                html += '<div style="background: white; width: 100%; padding: 15px 30px; margin: 25px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">' +
                    '<table class="desktop-and-tablet-inlinetable" style="width: 100%;">\n'+
                    '            <tr>\n'+
                    '                <td style="width: 50%"><span style="color: black; font-size:13px"> No. Pesanan: </span></td>\n'+
                    '                <td style="width: 30%"><span style="color: black; font-size:13px"> Status Pesanan: </span></td>\n'+
                    '                <td style="width: 20%; text-align: right;"><span style="color: black; font-size:13px;"> Total Belanja: </span></td>\n'+
                    '            </tr>\n'+
                    '            <tr>\n'+
                    '                <td> <h6>'+ data.bukti_web_so_m +'</h6> </td>\n'+
                    '                <td> <h6>'+ status_pesanan(data.status_web_so_m, data.paid_by_user) +'</h6> </td>\n'+
                    '                <td style="text-align: right; color: #a50000"> <h6>'+ convertToRupiah(data.grand_total_web_so_m) +'</h6> </td>\n'+
                    '            </tr>\n'+
                    '        </table>\n'+
                        '<div class="mobile-only">' +
                    '      <span style="color: black; font-size:13px"> No. Pesanan: '+ data.bukti_web_so_m +'</span><br> ' +
                    '      <span style="color: black; font-size:13px"> Status Pesanan: '+ status_pesanan(data.status_web_so_m, data.paid_by_user) +'</span><br>' +
                '          <span style="color: black; font-size:13px;"> Total Belanja: <span style="color: #a50000; font-size: 15px;">'+ convertToRupiah(data.grand_total_web_so_m) +'</span></span>  ' +
                    '    </div> '+
                    '        <div style="border-bottom: 1px solid lightgrey; margin: 10px 0;"></div>\n'+
                    '        <h6> Daftar Produk </h6>\n'+
                    '        <div>\n'+
                    '            <table style="width: 100%">\n'+
                    '                <tr>\n'+
                    '                    <td valign="top" class="purchase-border-right">\n'+
                    '                        <table style="border-spacing: 0 10px; border-collapse:separate;">\n';
            }

            html +=   '                      <tr>\n'+
                '                                <td style="width: 15%" valign="top">  <img style="max-width: 75px;" src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"> </td>\n' +
                '                               <td class="mobile-only" style="width: 1%"></td>'+
                '                                <td style="width: 75%" valign="top">  \n'+
                '                                    <span style="color: black; font-size:14px"> ('+data.qty_so_d+'x) '+data.nama_product_so_d+'</span><br>\n'+
                '                                    <span style="color: black; font-size:12px">'+ convertToRupiah(data.total_price_so_d) +'</span>\n';

                if(data.status_web_so_m == '4'){
                    html += '<a href="<?php echo base_url('profile/review');?>" target="_blank"><span style="color: #a50000; font-size: 11px; text-decoration: underline; font-weight: bold; cursor: pointer;">(Tulis Ulasan)</span></a>';
                }

            html +=    '                                </td>\n'+
                '                            </tr>\n';



            prev_so_m = data.id_web_so_m;
            prev_bukti = data.bukti_web_so_m;
            prev_tgl = data.tgl_web_so_m;
            prev_status = data.status_web_so_m;
            start = false;

            if(i == count- 1){
                html += '                        </table>\n'+
                    '                    </td>\n'+
                    '                    <td class="desktop-and-tablet-tablecell" style="text-align: center;">\n'+
                    '                        <a href="<?php echo base_url('profile/purchase_detail?id=');?>'+ data.bukti_web_so_m +'"><button class="btn" style="font-size: 14px;">Lihat Detail Pesanan</button></a><br>\n';

                html +=    '                    </td>\n'+
                    '                </tr>\n'+
                    '            </table>\n'+
                    '            <br>\n' +
                    '<a class="mobile-only" href="<?php echo base_url('profile/purchase_detail?id=');?>'+ data.bukti_web_so_m +'"><button class="btn" style="font-size: 14px;">Lihat Detail Pesanan</button></a><br>'+
                    '            <span style="font-size: 13px; color: black">'+ data.tgl_web_so_m +'</span>\n'+
                    '        </div>\n'+
                    '       </div>';
            }
        })

        if(reset === false){
            $('#orders-content').append(html);
        } else {
            $('#orders-content').html(html);
        }

    }

    mainLoad(true);
    $('.loading').css("display", "block");
    $('.Veil').fadeIn();

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


</script>