<div class="modal fade" tabindex="-1" role="dialog" id="warna-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Warna </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="warna-filter-form">

                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="harga-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Harga </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="harga-filter-form">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Min Harga</label>
                            <input min="0" type="number" name="filter[harga][min-harga]" class="form-control category-filter" id="min-harga-filter" value="0">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Max Harga</label>
                            <input min="0" type="number" name="filter[harga][max-harga]" class="form-control category-filter" id="max-harga-filter">
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="ukuran-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ukuran </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ukuran-filter-form">
                    <table style="border-spacing: 0 15px; border-collapse:separate; ">
                        <tr>
                            <td style="width: 23%"></td>
                            <td style="width: 35%; text-align: center">Min</td>
                            <td style="width: 7%;"></td>
                            <td style="width: 35%; text-align: center">Max</td>
                        </tr>
                        <tr>
                            <td>Panjang</td>
                            <td><input min="0" type="number" name="filter[ukuran][min-panjang]" class="form-control category-filter" id="min-panjang-filter"></td>
                            <td style="text-align: center; font-size: 12px"> s/d </td>
                            <td><input min="0" type="number" name="filter[ukuran][max-panjang]" class="form-control category-filter" id="max-panjang-filter"></td>
                        </tr>
                        <tr>
                            <td>Lebar</td>
                            <td><input min="0" type="number" name="filter[ukuran][min-lebar]" class="form-control category-filter" id="min-lebar-filter"></td>
                            <td style="text-align: center; font-size: 12px"> s/d </td>
                            <td><input min="0" type="number" name="filter[ukuran][max-lebar]" class="form-control category-filter" id="max-lebar-filter"></td>
                        </tr>
                        <tr>
                            <td>Tinggi</td>
                            <td><input min="0" type="number" name="filter[ukuran][min-tinggi]" class="form-control category-filter" id="min-tinggi-filter"></td>
                            <td style="text-align: center; font-size: 12px"> s/d </td>
                            <td><input min="0" type="number" name="filter[ukuran][max-tinggi]" class="form-control category-filter" id="max-tinggi-filter"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="sortir-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sortir </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="sortir-filter-form">
                    <select class="custom-select category-filter" name="filter[sortir]">
                        <option value="a.nama_web_product ASC">Nama Produk: A ke Z</option>
                        <option value="a.nama_web_product DESC">Nama Produk: Z ke A</option>
                        <option value="d.nominal_web_pricelist ASC">Harga: Rendah ke Tinggi</option>
                        <option value="d.nominal_web_pricelist DESC">Harga: Tinggi ke Rendah</option>
                    </select>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="whitespace"></div>
<br>
<div class="main-section">
    <div class="nama_kategori"></div>
</div>
<div class="filter-div product-lists">

    <div class="product-filters">
        <div class="card-group" style="text-align: center;">
            <div class="card link-card filter filter-warna">
                <div style="padding: 0.2rem">
                    <span class="filter-title"> Warna </span>
                </div>
            </div>
            <div class="card link-card filter filter-harga">
                <div style="padding: 0.2rem">
                    <span class="filter-title"> Harga </span>
                </div>
            </div>
            <div class="card link-card filter filter-ukuran">
                <div style="padding: 0.2rem">
                    <span class="filter-title"> Ukuran </span>
                </div>
            </div>
            <div class="card link-card filter filter-sortir">
                <div style="padding: 0.2rem">
                    <span class="filter-title"> Sortir </span>
                </div>
            </div>
        </div>
    </div>
    <div class="whitespace"></div>

    <div class="alert alert-secondary filter-info" role="alert" style="font-size: 12px;">
        Warna: <span class="warna-info">SEMUA</span><br>
        Harga: <span class="harga-awal-info"></span> s/d <span class="harga-akhir-info"></span><br>
        Ukuran: Panjang [<span class="panjang-awal-info"></span> s/d <span class="panjang-akhir-info"></span>],
        Lebar [<span class="lebar-awal-info"></span> s/d <span class="lebar-akhir-info"></span>],
        Tinggi [<span class="tinggi-awal-info"></span> s/d <span class="tinggi-akhir-info"></span>]<br>
    </div>

    <div id="product-content"></div>

    <div id="end-content"></div>
</div>

<script>
    search_url = '<?php echo base_url('search/');?>';
    product_url = '<?php echo base_url('product/');?>';

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);

    var color_array = [];

    let limit = 16,
        offset = 0,
        load = false;

    function reset_loadmore_state(){
        limit = 16;
        offset = 0;
        load = false;
    }

    function checkVisible(elm) {
        var rect = elm.getBoundingClientRect();
        var viewHeight = Math.max(document.documentElement.clientHeight, window.innerHeight);
        return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
    }

    $(window).scroll(function() {
        if(checkVisible(document.getElementById('end-content'))){
           loadmore();
        }
    });

    $('.filter-warna').click(function(){
        $('#warna-modal').modal("toggle");
    });

    $('.filter-ukuran').click(function(){
        $('#ukuran-modal').modal("toggle");
    });

    $('.filter-harga').click(function(){
        $('#harga-modal').modal("toggle");
    });

    $('.filter-sortir').click(function(){
        $('#sortir-modal').modal("toggle");
    });

    $('.harga-filter').change(function(){

    })

    $('.loading').css("display", "block");
    $('.Veil-non-hover').fadeIn();

    function loadmore(){
        if(load){
            load = false;
            offset += limit;
            $('.loading').css('display', 'block');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : search_url + 'get_all_products', // the url where we want to POST
                data        : $('form').serialize() + "&q=" + urlParams.get('q') + "&limit=" + limit + "&offset=" + offset, // our data object
                dataType    : 'json',
                success     : function(data){
                    if(data.length > 0){
                        mainLoad(data, false, true);
                        load = true;
                    }
                    $('.loading').css('display', 'none');
                }
            })
        }

    }

    $.ajax({
        type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url: search_url + 'get_all_products', // the url where we want to POST
        data: {q: urlParams.get('q'), group_by: 'color', activity: true}, // our data object
        dataType: 'json',
        success: function (data) {
            data.forEach(function(data){
                $('#warna-filter-form').append(
'                   <div class="form-check">\n' +
'                        <input type="checkbox" class="form-check-input category-filter color-filter" name="filter[warna][]" value="'+ data.ucode_web_col +'">\n' +
'                        <label class="form-check-label" for="exampleCheck1">'+ data.nama_web_col +'</label>\n' +
'                   </div>'
                )
            })

            $('.color-filter').click(function(e){
                if($(this).is(':checked')){
                    color_array.push($(this).parent().find('.form-check-label').html());
                } else {
                    const index = color_array.indexOf($(this).parent().find('.form-check-label').html());
                    color_array.splice(index, 1);
                }

                if(color_array.length == 0){
                    $('.warna-info').html('SEMUA');
                } else {
                    $('.warna-info').html('');
                    warna_length = color_array.length;
                    color_array.forEach(function(data, i){
                        if(i == warna_length - 1){
                            $('.warna-info').append('[' + data + ']');
                        } else {
                            $('.warna-info').append('[' + data + '], ');
                        }
                    })
                }
            })

            $('.category-filter').change(function(e){
                $('.loading').css('display', 'block');
                reset_loadmore_state();
                $.ajax({
                    type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                    url: search_url + 'get_all_products', // the url where we want to POST
                    data: $('form').serialize() + "&q=" + urlParams.get('q') + "&limit=" + limit + "&offset=" + offset, // our data object
                    dataType: 'json',
                    success: function (data) {
                        mainLoad(data, true);
                        load = true;
                        $('.loading').css('display', 'none');

                        $('.harga-awal-info').html(convertToRupiah($('#min-harga-filter').val()));
                        $('.harga-akhir-info').html(convertToRupiah($('#max-harga-filter').val()));
                        $('.panjang-awal-info').html($('#min-panjang-filter').val() + 'mm');
                        $('.panjang-akhir-info').html($('#max-panjang-filter').val() + 'mm');
                        $('.lebar-awal-info').html($('#min-lebar-filter').val() + 'mm');
                        $('.lebar-akhir-info').html($('#max-panjang-filter').val() + 'mm');
                        $('.tinggi-awal-info').html($('#min-tinggi-filter').val() + 'mm');
                        $('.tinggi-akhir-info').html($('#max-panjang-filter').val() + 'mm');
                    }
                });
            })
        }
    })

    $('.nama_kategori').html('<h2> Hasil pencarian untuk "'+ urlParams.get('q') +'"</h2>');
    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : search_url + 'get_all_products', // the url where we want to POST
        data        : {q: urlParams.get('q'), limit: limit, offset: offset}, // our data object
        dataType    : 'json',
        success     : function(data){
            mainLoad(data);
            load = true;
        }
    })

    $.ajax({
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : search_url + 'get_max_min', // the url where we want to POST
        data        : {q: urlParams.get('q')}, // our data object
        dataType    : 'json',
        success     : function(data){
            $('#min-harga-filter').val(data.min_harga);
            $('#max-harga-filter').val(data.max_harga);
            $('#min-panjang-filter').val(data.min_panjang);
            $('#max-panjang-filter').val(data.max_panjang);
            $('#min-lebar-filter').val(data.min_lebar);
            $('#max-lebar-filter').val(data.max_lebar);
            $('#min-tinggi-filter').val(data.min_tinggi);
            $('#max-tinggi-filter').val(data.max_tinggi);

            $('.harga-awal-info').html(convertToRupiah(data.min_harga));
            $('.harga-akhir-info').html(convertToRupiah(data.max_harga));
            $('.panjang-awal-info').html(data.min_panjang + 'mm');
            $('.panjang-akhir-info').html(data.max_panjang + 'mm');
            $('.lebar-awal-info').html(data.min_lebar + 'mm');
            $('.lebar-akhir-info').html(data.max_lebar + 'mm');
            $('.tinggi-awal-info').html(data.min_tinggi + 'mm');
            $('.tinggi-akhir-info').html(data.max_tinggi + 'mm');
        }
    })


    function mainLoad(data, reset = false, load_more = false){
        if(data.length === 0 && load_more == false){
            html = '<div style="text-align: center; padding-top: 15vh; height: 40vh;"><h5> Pencarian tidak ditemukan </h5></div>'
            $('#product-content').html(html);
            $('#end-content').remove();
            $('.loading').css("display", "none");
            $('.Veil-non-hover').fadeOut();
            return;
        }
        html = '<div class="card-group" style="margin-bottom: 15px;">';
        count  = 0;
        data.forEach(function(data){
            count++;
            html += '        <div class="card link-card" style="margin: 0 5px !important;">\n'+
                '        <div class="fav-btn" id="fav_'+ data.ucode_web_product +'" style="position: absolute; right: 10px; width: 40px;height: 40px; z-index: 20;">';

            if(data.id_web_user_favorite){
                html +=     '<i class="fas fa-heart loved" style="border: 1px solid #a50000; border-radius: 50%; padding: 5px; width:30px; height: 30px; color: #a50000; left: 50%;top: 50%;transform: translate(-50%, -50%); position: absolute"></i>';
            } else {
                html +=     '<i class="far fa-heart" style="border: 1px solid #a50000; border-radius: 50%; padding: 5px; width:30px; height: 30px; color: #a50000; left: 50%;top: 50%;transform: translate(-50%, -50%); position: absolute"></i>';
            }

            html+=        '       </div>'+
                '        <a href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'" style="text-decoration:none;">'+
                '            <img class="card-img-top" src="<?php echo base_url()?>'+ data.file_web_image +'" alt="Card image cap">\n'+
                '            <div class="card-body">\n'+
                '                <h6 class="card-title" style="min-height:110px;">\n'+
                '                    '+ data.nama_web_product +'</h6>\n'+
                '                <div class="whitespace"></div>\n';


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
                html +=  '         <span style="visibility: hidden;">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>       ' +
                    '<h5>'+ convertToRupiah(data.nominal_web_pricelist) +'</h5>\n';
            }


            html +=    '                <div class="avg_review" style="font-size: 10px;">\n';

            if(data.round_rating != null){

                for (i = 1; i <= 5; i++) {
                    if(i <= data.round_rating){
                        html += '<span class="fa fa-star checked"></span>'
                    } else {
                        html += '<span class="fa fa-star"></span>'
                    }

                }

                html += '<span style="margin-left: 5px;">(' + data.rating + ')<span>';
            }

           html +=     '                </div>\n'+
                '            </div>\n'+
                '        </a></div>\n';


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
        if(reset){
            $('#product-content').html(html);
        } else {
            $('#product-content').append(html);
        }

        $('.loading').css("display", "none");
        $('.Veil-non-hover').fadeOut();

        $('.fav-btn').click(function(e){
            e.preventDefault();
            e.stopPropagation();

            $('.loading').css("display", "block");
            $('.Veil-non-hover').fadeIn();

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
                        $('.Veil-non-hover').fadeOut();

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
                        $('.Veil-non-hover').fadeOut();

                    }
                })
            }
        });
    }
</script>