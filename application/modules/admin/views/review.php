

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Ulasan Produk</h1>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Ulasan Produk</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="display: none;"> ID </th>
                        <th>User dan Produk</th>
                        <th>Rating</th>
                        <th>Detail Ulasan</th>
                        <th>Balasan Admin</th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<div class="modal fade" tabindex="-1" role="dialog" id="review-modal" style="z-index: 5000">
    <div class="modal-dialog" role="document" style="max-height: 90vh; overflow: scroll;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Balas Ulasan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="review-form">
                    <div class="form-group" >
                        <label  class="col-form-label">Nama Produk <a class="product_link" style="margin-left: 3px; color: #a50000; text-decoration: underline; cursor: pointer; font-size: 10px;" target="_blank">Lihat Produk</a>  </label>
                        <textarea type="text" id="nama_web_product" name="nama_web_product" class="form-control form-active-control" disabled></textarea>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">User</label>
                        <input type="text" id="user_web_ulasan" name="user_web_ulasan" class="form-control form-active-control" disabled>
                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Ulasan</label>
                        <textarea type="text" id="detail_web_ulasan" name="detail_web_ulasan" class="form-control form-active-control" disabled></textarea>
                    </div>
                    <div id="gambar_ulasan">

                    </div>
                    <div class="form-group" >
                        <label  class="col-form-label">Balasan Admin</label>
                        <textarea type="text" id="reply_web_ulasan" name="reply_web_ulasan" class="form-control form-active-control"></textarea>
                    </div>

                    <input type="hidden" id="id_web_ulasan" name="id_web_ulasan" val="0">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save-review-reply">Balas</button>
            </div>
        </div>
    </div>
</div>

<style>
    .tr-hover:hover{
        cursor: pointer;
        background: #ffe1dd;
    }

    .btn-primary{
        background: #a50000;
        color: white;
        border: 1px solid white;
        transition: .2s;
    }

    .btn-primary:hover{
        background: white;
        color: #a50000;
        border: 1px solid #a50000;
    }

</style>

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>
    $('#collapseCS').addClass('show');
    $('#navbar-review').addClass('active');

    get_all_review();

    //get all products
    function get_all_review(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_all_review', // the url where we want to POST// our data object
            dataType    : 'json',
            success     : function(data){
                html = '';
                data.forEach(function(data){

                    html += '<tr class="tr-hover">' +
                        '     <td style="display: none;">'+ data.id_web_ulasan +'</td>'+
                        '     <td><strong>'+ data.email_web_user +'</strong><br>' +
                        '     '+ data.nama_web_product +'</td>\n'+
                        '     <td>';

                    // star rating
                    for (i = 1; i <= 5; i++) {
                        if(i <= data.rating_web_ulasan){
                            html += '<span class="fa fa-star checked" style="color: orange"></span>\n';
                        } else {
                            html += '<span class="fa fa-star"></span>\n';
                        }
                    }

                    html +='</td>\n' +
                        '     <td>'+ data.detail_web_ulasan +'<br><span style="font-size: 10px;">'+ data.tgl_web_ulasan +'</span></td>\n';

                    if(data.reply_web_ulasan != null && data.reply_web_ulasan != ''){
                        html +=    '     <td>'+ data.reply_web_ulasan +'<br>' +
                            '<span style="font-size: 10px;"> Dibalas oleh: '+ data.admin +'</span><br>' +
                            '<span style="font-size: 10px;">'+ data.tgl_reply_web_ulasan +'</span></td>\n' +
                            '   </tr>';
                    } else {
                        html += "<td></td></tr>"
                    }


                })

                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable();

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    }

    // get warna by id
    $('#dataTable').on( 'click', 'tbody tr', function () {
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $('body').addClass('modal-open');
        id_web_ulasan = $('#dataTable').DataTable().row( this ).data()[0];
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_review_by_id', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {id_web_ulasan: id_web_ulasan},
            success     : function(data){

                setTimeout(function() {$('.modal-dialog').scrollTop(0);}, 200);
                html_ulasan = '<table style="border-spacing: 10px; border-collapse: separate;"><tr>';
                product_link = '<?php echo base_url('product?prod=')?>' + data.art_number_web_product + '&color=' + data.nama_web_col;
                $('.product_link').attr("href", product_link);


                // review images
                for (i = 1; i <= 5; i++) {
                    if(data['img'+i+'_web_ulasan'] != ''){
                        html_ulasan += '<td style="cursor: pointer;" onclick="showImage(this)"><img style="max-width: 75px; max-height: 75px;" src="<?php echo base_url()?>'+ data['img'+i+'_web_ulasan'] +'"></td>';
                    }

                }

                html_ulasan += '</tr></table>';

                $('#gambar_ulasan').html(html_ulasan);

                $('#id_web_ulasan').val(data.id_web_ulasan);
                $('#nama_web_product').val(data.nama_web_product);
                $('#user_web_ulasan').val(data.email_web_user);
                $('#detail_web_ulasan').val(data.detail_web_ulasan);
                $('#reply_web_ulasan').val(data.reply_web_ulasan);



                $('#review-modal').modal('toggle');

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })

    } );



    $('.save-review-reply').click(function(e){
        e.preventDefault();
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'add_review_reply', // the url where we want to POST// our data object
            dataType: 'json',
            data: $('#review-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){
                    get_all_review();
                    $('#review-modal').modal('hide');
                    $('#review-form').trigger('reset');
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })
    


</script>
