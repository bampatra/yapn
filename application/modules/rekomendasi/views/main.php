
<div class="whitespace"></div>
<br>
<div class="main-section">
    <div><h2>Rekomendasi </h2> </div>
</div>
<div class="product-lists">


    <div class="whitespace"></div>

    <div id="product-content"></div>

    <div id="end-content"></div>

</div>

<script>
    rekomendasi_url = '<?php echo base_url('rekomendasi/');?>';
    product_url = '<?php echo base_url('product/');?>';
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);


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


    $('.loading').css("display", "block");
    $('.Veil-non-hover').fadeIn();

    function loadmore(){
        if(load){
            load = false;
            offset += limit;
            $('.loading').css('display', 'block');
            $.ajax({
                type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url         : rekomendasi_url + 'get_rekomendasi', // the url where we want to POST
                data        :  {limit: limit, offset: offset}, // our data object
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
        type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
        url         : rekomendasi_url + 'get_rekomendasi', // the url where we want to POST
        data        : {limit: limit, offset: offset}, // our data object
        dataType    : 'json',
        success     : function(data){
            mainLoad(data);
            load = true;
        }
    })




    function mainLoad(data, reset = false, load_more = false){
        if(data.length === 0 && load_more == false){
            html = '<div style="text-align: center; padding-top: 15vh; height: 40vh;"><h5> Tidak ada data</h5></div>';
            $('#product-content').html(html);
            return;
        }
        html = '<div class="card-group" style="margin-bottom: 15px;">';
        count  = 0;
        data.forEach(function(data){
            count++;
            html += '        <div class="card link-card product-card" style="margin: 0 5px !important;">\n'+
                '        <div class="fav-btn" id="fav_'+ data.ucode_web_product +'" style="position: absolute; right: 10px; width: 40px;height: 40px; z-index: 20;">';

            if(data.id_web_user_favorite){
                html +=     '<i class="fas fa-heart loved" style="border: 1px solid #a50000; border-radius: 50%; padding: 5px; width:30px; height: 30px; color: #a50000; left: 50%;top: 50%;transform: translate(-50%, -50%); position: absolute"></i>';
            } else {
                html +=     '<i class="far fa-heart" style="border: 1px solid #a50000; border-radius: 50%; padding: 5px; width:30px; height: 30px; color: #a50000; left: 50%;top: 50%;transform: translate(-50%, -50%); position: absolute"></i>';
            }



            html += '       </div>'+
                    '        <a href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'" style="text-decoration:none;">'+
                '            <img class="card-img-top" src="'+ data.file_web_image +'" alt="Card image cap">\n'+
                '            <div class="card-body">\n'+
                '                <h6 class="card-title" style="min-height:110px;">\n'+
                '                    '+ data.nama_web_product +'</h6>\n';

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


            html +=    '<div class="avg_review" style="font-size: 10px;">';



            if(data.round_rating != null){

                for (i = 1; i <= 5; i++) {
                    if(i <= data.round_rating){
                        html += '<span class="fa fa-star checked"></span>'
                    } else {
                        html += '<span class="fa fa-star"></span>'
                    }

                }

                html += '<span style="margin-left: 5px;"> (' + data.rating + ')<span>';
            }

           html+=     '                </div>\n'+
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