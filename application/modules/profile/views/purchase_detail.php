
<div class="modal fade" tabindex="-1" role="dialog" id="confirm-payment-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="confirm-payment-form">
                    <div class="form-group" >
                        <label  class="col-form-label">No. Rekening</label>
                        <input type="text" id="payment_ref" name="payment_ref" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Rekening</label>
                        <input type="text" id="payment_ref" name="payment_ref_name" class="form-control form-active-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn confirm-payment">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="pesanan-selesai-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesanan Selesai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menyelesaikan pesanan ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pesanan-selesai">Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="track-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lacak Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body lacak-modal-body">

            </div>
        </div>
    </div>
</div>

<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil > </a><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile/purchase')?>">Riwayat Pesanan</a> <span style="font-size: 14px;">  > Detail Pesanan</span></div>
<div class="whitespace"></div>

<div class="main-section purchase_detail" style="text-align: left;">

    <table style="width: 100%">
        <tr>
            <td valign="top" style="width: 50%">
                <h5> Alamat Pengiriman</h5>
                <div class="red-line"></div>
                <span style="font-size: 14px;" class="detail-penerima">

                </span>
                <br>
                <div class="mobile-only">
                    <br>
                    <h5> Status Pesanan</h5>
                    <div class="red-line"></div>
                    <span style="font-size: 14px;" class="status-view">

                    </span>
                </div>
            </td>
            <td class="desktop-and-tablet-tablecell" valign="top" style="width: 50%">
                <h5> Status Pesanan</h5>
                <div class="red-line"></div>
                <span style="font-size: 14px;" class="status-view">

                </span>
            </td>
        </tr>
    </table>

    <div style="background: white; width: 100%; padding: 15px 30px; margin: 35px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
        <div>
            <table style="width: 100%">
                <tr id="order-header">

                </tr>
            </table>

            <div style="border-bottom: 1px solid lightgrey; margin: 10px 0;"></div>
            <table style="border-spacing: 0 10px; border-collapse:separate; width: 100%;" id="cart-item">



            </table>

            <div style="border-bottom: 1px solid lightgrey; margin: 10px 0;"></div>
            <table style="border-spacing: 0 10px; border-collapse:separate; width: 100%;">
                <tr>
                    <td style="width: 10%"> </td>
                    <td class="pd-title" valign="top">
                        Subtotal
                    </td>
                    <td valign="top" class="pd-nominal" id="subtotal"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td class="pd-title" valign="top">
                        Kode Unik
                    </td>
                    <td valign="top" class="pd-nominal" id="kode_unik"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td class="pd-title" valign="top">
                        Ongkos Kirim
                    </td>
                    <td valign="top" class="pd-nominal" id="ongkir"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td class="pd-title" style="font-size: 18px;" valign="top">
                        Grand Total
                    </td>
                    <td valign="top" class="pd-nominal" style="color: #a50000; font-size: 18px;" id="grandtotal"> ... </td>
                </tr>


            </table>
        </div>
    </div>
</div>

<script>
    profile_url = '<?php echo base_url('profile/');?>';
    let id_so_m = 0;
    let va = '';
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    function status_view(status, data){
        switch(status) {
            case '1':
                if(data[0].paid_by_user == '0'){
                    $html = '<strong> Diterima - Belum Bayar </strong><br>\n' +
                        '                    <span> Segera bayar melalui transfer ke rekening BCA<br>' +
                        '<strong> No. Rekening: 2582035033 (Putera Rackindo Sejahtera PT) </strong><br>' +
                        '<strong>Jumlah: '+ convertToRupiah(data[0].grand_total_web_so_m) +'</strong></span><br><br>\n' +
                        '<span> Jika sudah melakukan pembayaran, silahkan klik tombol "Sudah Bayar" dan tunggu konfirmasi dari Admin PIRA </span><br><br>' +
                        '<button class="btn confirm-payment" onclick="confirmPayment()" style="font-size:13px; margin-top: 10px;"> Sudah Bayar </button>';

                    get_virtual_account('va-purchase-detail');
                } else {
                    $html = '<strong> Diterima - Menunggu Pengecekan </strong><br>\n' +
                        '    <span> Silahkan tunggu konfirmasi dari Admin PIRA untuk pemrosesan pesanan </span><br><br>' +
                        '   <span> Telah dibayar oleh: </span><br>' +
                        '   No. Rekening Pembayaran: <strong>'+ data[0].payment_ref +'</strong><br>' +
                        '   Nama Rekening Pembayaran: <strong>'+ data[0].payment_ref_name +'</strong>';
                }

                return $html;
                break;
            case '2':
                $html = '<strong> Diproses </strong><br>' +
                    '   <span> Pembayaran anda sudah dikonfirmasi PIRA pada <span id="payment-date">'+ data[0].payment_date +'</span><br>' +
                    '   <span> Pesanan anda akan dikirim sebentar lagi! </span>';
                return $html;
                break;
            case '3':
                $html = '<strong> Dikirimkan </strong><br>\n' +
                    '                    <span> No. Resi: '+ data[0].no_resi_web_so_info +'</span><a style="color: #a50000; font-size: 12px; text-decoration: underline; cursor: pointer;" onclick="lacak(\''+data[0].no_resi_web_so_info+'\')"> Lacak </a><br>\n' +
                    '                    <span> Nama Ekspedisi: '+ data[0].nama_ekspedisi_web_so_info +'</span><br>' +
                    '                    <span> Tanggal Pengiriman: '+ data[0].delivery_date +'</span><br>' +
                    '                    <span> Silahkan selesaikan pesanan anda jika pesanan sudah diterima. </span><br>' +
                    '                    <button class="btn" onclick="selesaiPesanan()" > Selesai </button> \n';

                return $html;
                break;
            case '4':
                $html = '<strong> Selesai </strong><br>' +
                    '   <span> Pesanan anda sudah diselesaikan pada <br class="mobile-only"> '+ data[0].selesai_date +' </span>';
                return $html;
                break;
            case '5':
                if(data[0].is_refunded == '0'){
                    $html = '<strong> Dibatalkan </strong><br>' +
                        '   <span> Pesanan anda dibatalkan pada: '+ data[0].pembatalan_date +'</span><br>' +
                        '   <span> Alasan pembatalan: '+ data[0].pembatalan_notes_web_so_info +'</span>';
                } else {
                    $html = '<strong> Dibatalkan - Dana Dikembalikan</strong><br>' +
                        '   <span> Pesanan anda dibatalkan pada: '+ data[0].pembatalan_date +'</span><br>' +
                        '   <span> Alasan pembatalan: '+ data[0].pembatalan_notes_web_so_info +'</span><br><br>' +
                        '<span style="font-size: 14px;">No. Rekening Pengembalian Dana: '+ data[0].no_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Nama Rekening Pengembalian Dana: '+ data[0].nama_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Bank Pengembalian Dana: '+ data[0].bank_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Tanggal Pengembalian Dana: '+ data[0].refund_date +'</span>';
                }

                return $html;
                break;
        }
    }

    function confirmPayment(){
        $('#confirm-payment-modal').modal('show');
    }

    function selesaiPesanan(){
        $('#pesanan-selesai-modal').modal('show');
    }

    function lacak(resi){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();

        // Create a request variable and assign a new XMLHttpRequest object to it.
        var proxyUrl = 'https://cors-anywhere.herokuapp.com/',
            targetUrl = 'https://www.dakotacargo.co.id/api/api_trace_package.asp?b=' + resi
        fetch(proxyUrl + targetUrl)
            .then(blob => blob.json())
            .then(data => {
                track_data = data.detail[0];
                html = '<h5>No. Resi: '+ resi +'</h5>' +
                    '<span> Tanggal: '+ track_data.tanggal +'</span><br>' +
                    '   <span> Posisi: '+ track_data.posisi +'</span><br>' +
                    '   <span> Status: '+ track_data.status +'</span><br>' +
                    '   <span> Keterangan: '+ track_data.keterangan +'</span><br>';
                $('.lacak-modal-body').html(html);
                $('#track-modal').modal('show');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            })
            .catch(e => {
                console.log(e);
                return e;
            });
    }

    $('.pesanan-selesai').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'pesanan_selesai', // the url where we want to POST
            data: {id_so_m: id_so_m}, // our data object
            dataType: 'json',
            success: function (response) {
                if(response.Status == "OK"){
                    $('#pesanan-selesai-modal').modal('hide');
                    location.reload();
                } else {
                    // show error
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('.confirm-payment').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'sudah_bayar', // the url where we want to POST
            data: $('#confirm-payment-form').serialize() + "&id_so_m=" + id_so_m,
            dataType: 'json',
            success: function (response) {
                if(response.Status == "OK"){
                    $('#confirm-payment-modal').modal('hide');
                    location.reload();
                } else {
                    show_snackbar(response.Message);
                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    $('.loading').css("display", "block");
    $('.Veil-non-hover').fadeIn();

    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : profile_url + 'get_detail_pesanan', // the url where we want to POST
        data        : {id: urlParams.get('id')}, // our data object
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if(data.Status == 'UNAUTHORIZED'){
                window.location.href = '<?php echo base_url('profile/purchase');?>';
                return;
            }
            id_so_m = data[0].id_web_so_m;
            // change with user's phone number

            html_prod = '';
            html_penerima = ' <strong> '+ data[0].nama_web_user_alamat +' </strong><br>\n' +
                '                    <span> '+ data[0].telp_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].alamat_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].kecamatan_web_user_alamat +', '+ data[0].kota_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].provinsi_web_user_alamat +' </span><br>';

            if(data[0].delivery_notes_web_so_info != ''){
                html_penerima += ' <span> [Catatan pengiriman: '+ data[0].delivery_notes_web_so_info +'] </span>';
            }


            html_header = ' <td>' +
                '               <span style="font-size: 14px;">No. Pesanan: '+ data[0].bukti_web_so_m +'</span> ' +
                '               <span class="mobile-only" style="font-size: 14px;">'+ data[0].tgl_web_so_m +'</span>' +
                '           </td>\n' +
'                           <td style="text-align: right;" class="desktop-and-tablet-tablecell"><span style="font-size: 14px;">'+ data[0].tgl_web_so_m +'</span></td>';

            data.forEach(function(data){
                html_prod += '<tr>\n'+
'                    <td style="width: 10%" valign="top">  <img style="max-width: 75px;" src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"></td>\n'+
'                    <td style="width: 75%" valign="top">\n'+
'                        <span style="color: black; font-size:14px">'+ data.nama_product_so_d +'</span><br>\n'+
'                        <span style="color: black; font-size:12px;"> Qty: '+ data.qty_so_d +' </span><br>\n' +
                    '    <span class="mobile-only" style="color: #a50000; float: right;">'+ convertToRupiah(data.total_price_so_d) +'</span>'+
'                    </td>\n'+
'                    <td class="desktop-and-tablet-tablecell" valign="top" style="text-align: right; width: 25%">'+ convertToRupiah(data.total_price_so_d) +'</td>\n'+
'                </tr>';
            })

            $('#cart-item').append(html_prod);
            $('.detail-penerima').append(html_penerima);
            $('#order-header').append(html_header);

            $('#subtotal').html(convertToRupiah(data[0].total_web_so_m));
            $('#kode_unik').html(data[0].payment_unique_code);
            $('#ongkir').html(convertToRupiah(data[0].ongkir_web_so_m));
            $('#grandtotal').html(convertToRupiah(data[0].grand_total_web_so_m));

            $('.status-view').html(status_view(data[0].status_web_so_m,data));
            console.log(data[0]);

            $('.loading').css("display", "none");
            $('.Veil-non-hover').fadeOut();
        }
    })



</script>