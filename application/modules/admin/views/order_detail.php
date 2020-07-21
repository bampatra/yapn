<div class="modal fade" tabindex="-1" role="dialog" id="pembayaran-diterima-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pembayaran Diterima</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pembayaran-diterima-form">
                    <div class="form-group product-form" >
                        <label  class="col-form-label">Tanggal Pembayaran</label>
                        <input type="datetime-local" id="tanggal-pembayaran"  name="tanggal-pembayaran" value="0000-00-00 00:00:00">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Catatan</label>
                        <textarea id="catatan-pembayaran" name="catatan-pembayaran" class="form-control form-active-control"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pembayaran-diterima">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="pesanan-dikirim-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: auto;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesanan Dikirim</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pesanan-dikirim-form">
                    <div class="form-group product-form" >
                        <label  class="col-form-label">Tanggal Pengiriman</label>
                        <input type="datetime-local" id="tanggal-pengiriman"  name="tanggal-pengiriman" value="0000-00-00 00:00:00">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">No. Resi</label>
                        <input type="text" id="resi-pengiriman" name="resi-pengiriman" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Ekspedisi</label>
                        <input type="text" id="nama-ekspedisi" name="nama-ekspedisi" class="form-control form-active-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pesanan-dikirim">Simpan</button>
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

<div class="modal fade" tabindex="-1" role="dialog" id="pesanan-dibatalkan-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesanan Dibatalkan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pesanan-dibatalkan-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Catatan Pembatalan</label>
                        <textarea id="catatan-pembatalan" name="catatan-pembatalan" class="form-control form-active-control"></textarea>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn pesanan-dibatalkan">Simpan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="pengembalian-dana-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pengembalian Dana</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="pengembalian-dana-form">
                    <div class="form-group product-form" >
                        <label  class="col-form-label">Tanggal Pengembalian</label>
                        <input type="datetime-local" id="tanggal-pengembalian"  name="tanggal-pengembalian" value="0000-00-00 00:00:00">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Bank Tujuan</label>
                        <input type="text" id="bank-rek-refund" name="bank-rek-refund" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">No. Rekening Tujuan</label>
                        <input type="text" id="no-rek-refund" name="no-rek-refund" class="form-control form-active-control">
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Rekening Tujuan</label>
                        <input type="text" id="nama-rek-refund" name="nama-rek-refund" class="form-control form-active-control">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn kembalikan-dana">Proses Refund</button>
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

<div style="text-align: left; padding: 20px; ">


    <div style="background: white; width: 100%; padding: 15px 30px;  box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
        <h5> Pesanan </h5>
        <div style="border-bottom: 2px solid #a50000; margin: 10px 0; width: 100%"></div>
        <strong> Status Pesanan: <span id="status_pesanan"></span></strong>
        <div id="order-header"></div>
        <br>
        <div id="status_buttons">


        </div>
    </div>
    <br>


    <table style="width: 100%">
        <tr>
            <td valign="top" style="background: white; width: 49%; padding: 15px 30px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                <h5> Alamat Pengiriman</h5>
                <div style="border-bottom: 2px solid #a50000; margin: 10px 0; width: 100%"></div>
                <span style="font-size: 14px;" id="detail-penerima">

                </span>
            </td>
            <td style="width: 2%"></td>
            <td valign="top" style="background: white; width: 49%; padding: 15px 30px; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
                <h5> Informasi User </h5>
                <div style="border-bottom: 2px solid #a50000; margin: 10px 0; width: 100%"></div>
                <span style="font-size: 14px;" id="detail-user">

                </span>
            </td>
        </tr>
    </table>


    <div style="background: white; width: 100%; padding: 15px 30px; margin: 35px 0; box-shadow: rgba(49, 53, 59, 0.12) 0px 1px 6px 0px; border-radius: 8px;">
        <div>

            <table style="border-spacing: 0 10px; border-collapse:separate; width: 100%;" id="cart-item">



            </table>

            <div style="border-bottom: 1px solid lightgrey; margin: 10px 0;"></div>
            <table style="border-spacing: 0 10px; border-collapse:separate; width: 100%;">
                <tr>
                    <td style="width: 10%"> </td>
                    <td style="text-align: right;width: 70%; font-size:13px" valign="top">
                        Subtotal
                    </td>
                    <td valign="top" style="text-align: right; width: 30%; font-size:13px" id="subtotal"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td style="text-align: right;width: 70%; font-size:13px" valign="top">
                        Kode Unik
                    </td>
                    <td valign="top" style="text-align: right; width: 30%; font-size:13px" id="kode_unik"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td style="text-align: right;width: 70%; font-size:13px" valign="top">
                        Ongkos Kirim
                    </td>
                    <td valign="top" style="text-align: right; width: 30%; font-size:13px" id="ongkir"> ... </td>
                </tr>
                <tr>
                    <td style="width: 10%"> </td>
                    <td style="text-align: right;width: 70%;" valign="top">
                        Grand Total
                    </td>
                    <td valign="top" style="text-align: right; width: 30%; color: #a50000; font-size: 18px;" id="grandtotal"> ... </td>
                </tr>


            </table>
        </div>
    </div>

</div>

<style>
    .btn{
        display: inline-block;
        font-weight: 400;
        color: white;
        text-align: center;
        vertical-align: middle;
        cursor: pointer;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #a50000;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 0.9rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }
</style>

<script>
    profile_url = '<?php echo base_url('profile/');?>';
    let id_so_m = 0;
    let va = '';
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    $('.loading').css("display", "block");
    $('.Veil').fadeIn();

    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : admin_url + 'get_order_by_id', // the url where we want to POST
        data        : {id: urlParams.get('no')}, // our data object
        dataType    : 'json',
        success     : function(data){
            console.log(data);
            if(data.Status == 'UNAUTHORIZED'){
                window.location.href = '<?php echo base_url('profile/purchase');?>';
                return;
            }
            id_so_m = data[0].id_web_so_m;

            html_prod = '';
            html_penerima = ' <strong> '+ data[0].nama_web_user_alamat +' </strong><br>\n' +
                '                    <span> '+ data[0].telp_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].alamat_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].kecamatan_web_user_alamat +', '+ data[0].kota_web_user_alamat +' </span><br>\n' +
                '                    <span> '+ data[0].provinsi_web_user_alamat +' </span><br>';

            if(data[0].delivery_notes_web_so_info != ''){
                html_penerima += ' <span> [Catatan pengiriman: '+ data[0].delivery_notes_web_so_info +'] </span>';
            }


            html_header = ' <span style="font-size: 14px;">No. Pesanan: '+ data[0].bukti_web_so_m +'</span>\n' +
                '                           <br><span style="font-size: 14px;">Tanggal Pesanan: '+ data[0].tgl_web_so_m +'</span><br>';

            data.forEach(function(data){
                html_prod += '<tr>\n'+
                    '                    <td style="width: 10%">  <img style="max-width: 75px;" src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap"></td>\n'+
                    '                    <td style="width: 75%" valign="top">\n'+
                    '                        <span style="color: black; font-size:14px">'+ data.nama_product_so_d +'</span><br>\n'+
                    '                        <span style="color: black; font-size:12px"> Qty: '+ data.qty_so_d +' </span>\n'+
                    '                    </td>\n'+
                    '                    <td valign="top" style="text-align: right; width: 25%">'+ convertToRupiah(data.total_price_so_d) +'</td>\n'+
                    '                </tr>';
            })

            $('#cart-item').append(html_prod);
            $('#detail-penerima').append(html_penerima);
            $('#order-header').append(html_header);

            $('#subtotal').html(convertToRupiah(data[0].total_web_so_m));
            $('#kode_unik').html(data[0].payment_unique_code);
            $('#ongkir').html(convertToRupiah(data[0].ongkir_web_so_m));
            $('#grandtotal').html(convertToRupiah(data[0].grand_total_web_so_m));

            $('#status_pesanan').html(status_pesanan(data[0].status_web_so_m, data[0].paid_by_user, data[0].is_refunded));
            status_buttons(data);

            html_user = '<span> ID# '+ data[0].id_web_user +'</span><br>' +
                '       <strong>'+ data[0].email_web_user +'</strong><br>' +
                '       <span>'+ data[0].telp_web_user +'</span>' +
                '<br><a target="_blank" href="<?php echo base_url('admin/chat?user=')?>'+ data[0].email_web_user +'&order='+ data[0].bukti_web_so_m +'">' +
                '<button class="btn go_to_chat" style="padding: 1px 6px; margin-top: 5px;">' +
                '<i class="fa fa-comment" style="font-size: 12px;"></i> Chat ' +
                '</button></a>';
            $('#detail-user').html(html_user);

            va = '12345' + data[0].telp_web_user;

            $('.loading').css("display", "none");
            $('.Veil').fadeOut();
        }
    })

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
                show_snackbar('Terdapat kesalahan pada resi');
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            });
    }

    function status_buttons(data){
        switch(data[0].status_web_so_m) {
            case '1':
                if(data[0].paid_by_user == '0') {
                    html = ' <button class="btn pesanan-dibatalkan-modal"> Batalkan Pesanan </button>';
                } else {
                    html = '<button class="btn pembayaran-diterima-modal"> Pembayaran Diterima </button>\n' +
                        '            <button class="btn pesanan-dibatalkan-modal"> Batalkan Pesanan </button>';
                }

                if(data[0].paid_by_user == '1'){
                    html_ref = '<span style="font-size: 14px;">No. Rekening Pembayaran: '+ data[0].payment_ref +'</span><br>' +
                        '       <span style="font-size: 14px;">Nama Rekening Pembayaran: '+ data[0].payment_ref_name +'</span>';
                    $('#order-header').append(html_ref);
                }

                $('#status_buttons').html(html);
                break;
            case '2':
                html = '<span style="font-size: 14px;">Tanggal Pembayaran: '+ data[0].payment_date +'</span><br>' +
                    '<span style="font-size: 14px;">No. Rekening Pembayaran: '+ data[0].payment_ref +'</span><br>' +
                    '<span style="font-size: 14px;">Nama Rekening Pembayaran: '+ data[0].payment_ref_name +'</span><br>' +
                    '<span style="font-size: 14px;">Catatan Pembayaran: '+ data[0].payment_notes +'</span><br>';

                $('#order-header').append(html);

                html = '<button class="btn pesanan-dikirim-modal"> Pesanan Dikirim </button>\n' +
                    '            <button class="btn pesanan-dibatalkan-modal"> Batalkan Pesanan </button>';

                $('#status_buttons').html(html);
                break;
            case '3':
                html = '<span style="font-size: 14px;">Tanggal Pembayaran: '+ data[0].payment_date +'</span><br>' +
                    '<span style="font-size: 14px;">No. Rekening Pembayaran: '+ data[0].payment_ref +'</span><br>' +
                    '<span style="font-size: 14px;">Nama Rekening Pembayaran: '+ data[0].payment_ref_name +'</span><br>' +
                    '<span style="font-size: 14px;">Catatan Pembayaran: '+ data[0].payment_notes +'</span><br>'+
                    '<span style="font-size: 14px;">Tanggal Pengiriman: '+ data[0].delivery_date +'</span><br>'+
                    '<span style="font-size: 14px;">No. Resi: '+ data[0].no_resi_web_so_info +' <a style="color:#a50000; text-decoration: underline; cursor: pointer;" onclick="lacak(\''+data[0].no_resi_web_so_info+'\')"> Lacak Pesanan </a></span><br>' +
                    '<span style="font-size: 14px;">Nama Ekspedisi: '+ data[0].nama_ekspedisi_web_so_info +'</span><br>';

                $('#order-header').append(html);

                html = '<button class="btn pesanan-selesai-modal"> Pesanan Selesai </button>\n';

                $('#status_buttons').html(html);
                break;
            case '4':
                html = '<span style="font-size: 14px;">Tanggal Pembayaran: '+ data[0].payment_date +'</span><br>' +
                    '<span style="font-size: 14px;">No. Rekening Pembayaran: '+ data[0].payment_ref +'</span><br>' +
                    '<span style="font-size: 14px;">Nama Rekening Pembayaran: '+ data[0].payment_ref_name +'</span><br>' +
                    '<span style="font-size: 14px;">Catatan Pembayaran: '+ data[0].payment_notes +'</span><br>'+
                    '<span style="font-size: 14px;">Tanggal Pengiriman: '+ data[0].delivery_date +'</span><br>'+
                    '<span style="font-size: 14px;">No. Resi: '+ data[0].no_resi_web_so_info +' <a style="color:#a50000; text-decoration: underline; cursor: pointer;" onclick="lacak(\''+data[0].no_resi_web_so_info+'\')"> Lacak Pesanan </a></span><br>' +
                    '<span style="font-size: 14px;">Nama Ekspedisi: '+ data[0].nama_ekspedisi_web_so_info +'</span><br>';

                $('#order-header').append(html);
                break;
            case '5':
                if(data[0].is_refunded == '0'){
                    html = '<span style="font-size: 14px;">Tanggal Pembatalan: '+ data[0].pembatalan_date +'</span><br>' +
                            '<span style="font-size: 14px;">Catatan Pembatalan: '+ data[0].pembatalan_notes_web_so_info +'</span><br>';

                    html_button = '<button class="btn pengembalian-dana-modal"> Proses Pengembalian Dana </button>\n';

                    $('#status_buttons').html(html_button);

                } else {
                    html = '<span style="font-size: 14px;">Tanggal Pembatalan: '+ data[0].pembatalan_date +'</span><br>' +
                        '<span style="font-size: 14px;">Catatan Pembatalan: '+ data[0].pembatalan_notes_web_so_info +'</span><br><br>' +
                        '<span style="font-size: 14px;">No. Rekening Pengembalian Dana: '+ data[0].no_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Nama Rekening Pengembalian Dana: '+ data[0].nama_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Bank Pengembalian Dana: '+ data[0].bank_rek_refund +'</span><br>' +
                        '<span style="font-size: 14px;">Tanggal Pengembalian Dana: '+ data[0].refund_date +'</span>';
                }


                $('#order-header').append(html);
                break;
        }

        $('.batalkan-pesanan-modal').click(function(e){
            e.preventDefault();

        })

        $('.pengembalian-dana-modal').click(function(e){
            e.preventDefault();
            $('#pengembalian-dana-modal').modal('show');
        })

        $('.pembayaran-diterima-modal').click(function(e){
            e.preventDefault();
            $('#pembayaran-diterima-modal').modal('show');
        })

        $('.pesanan-dikirim-modal').click(function(e){
            e.preventDefault();
            $('#pesanan-dikirim-modal').modal('show');
        })

        $('.pesanan-selesai-modal').click(function(e){
            e.preventDefault();
            $('#pesanan-selesai-modal').modal('show');
        })

        $('.pesanan-dibatalkan-modal').click(function(e){
            e.preventDefault();
            $('#pesanan-dibatalkan-modal').modal('show');
        })

        $('.pembayaran-diterima').click(function(e){
            $('.loading').css("display", "block");
            $('.Veil').fadeIn();
            e.preventDefault();
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'pembayaran_diterima', // the url where we want to POST
                data: $('#pembayaran-diterima-form').serialize() + "&id_so_m=" + id_so_m, // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        $('#pembayaran-diterima-modal').modal('hide');
                        location.reload();
                    } else {
                        show_snackbar(response.Message);
                    }

                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                }
            })
        })

        $('.pesanan-dikirim').click(function(e){
            $('.loading').css("display", "block");
            $('.Veil').fadeIn();
            e.preventDefault();
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'pesanan_dikirim', // the url where we want to POST
                data: $('#pesanan-dikirim-form').serialize() + "&id_so_m=" + id_so_m, // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        $('#pesanan-dikirim-modal').modal('hide');
                        location.reload();
                    } else {
                        show_snackbar(response.Message);
                    }

                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                }
            })
        })

        $('.pesanan-selesai').click(function(e){
            $('.loading').css("display", "block");
            $('.Veil').fadeIn();
            e.preventDefault();
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'pesanan_selesai', // the url where we want to POST
                data: {id_so_m: id_so_m}, // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        $('#pesanan-selesai-modal').modal('hide');
                        location.reload();
                    } else {
                        show_snackbar(response.Message);
                    }

                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                }
            })
        })

        $('.pesanan-dibatalkan').click(function(e){
            $('.loading').css("display", "block");
            $('.Veil').fadeIn();
            e.preventDefault();
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'pesanan_dibatalkan', // the url where we want to POST
                data: $('#pesanan-dibatalkan-form').serialize() + "&id_so_m=" + id_so_m, // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        $('#pesanan-selesai-modal').modal('hide');
                        location.reload();
                    } else {
                        show_snackbar(response.Message);
                    }

                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                }
            })
        })

        $('.kembalikan-dana').click(function(e){
            $('.loading').css("display", "block");
            $('.Veil').fadeIn();
            e.preventDefault();
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: admin_url + 'pengembalian_dana', // the url where we want to POST
                data: $('#pengembalian-dana-form').serialize() + "&id_so_m=" + id_so_m, // our data object
                dataType: 'json',
                success: function (response) {
                    if(response.Status == "OK"){
                        $('#pengembalian-dana-modal').modal('hide');
                        location.reload();
                    } else {
                        show_snackbar(response.Message);
                    }

                    $('.loading').css("display", "none");
                    $('.Veil').fadeOut();
                }
            })
        })
    }


    window.addEventListener("load", function() {
        var now = new Date();
        var year = now.getFullYear();
        var month = now.getMonth() + 1;
        var day = now.getDate();
        var hour = now.getHours();
        var minute = now.getMinutes();
        var localDatetime = year + "-" +
            (month < 10 ? "0" + month.toString() : month) + "-" +
            (day < 10 ? "0" + day.toString() : day) + "T" +
            (hour < 10 ? "0" + hour.toString() : hour) + ":" +
            (minute < 10 ? "0" + minute.toString() : minute);
        var datetimeField = document.getElementById("tanggal-pengiriman");
        datetimeField.value = localDatetime;
    });


</script>