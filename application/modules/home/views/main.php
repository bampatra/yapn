



<div class="main-carousel" style=" ">
    <img  class="desktop-and-tablet" style="width: 500px;
    position: relative;
    left: 50%;
    transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
</div>

<div class="main-section">
    <h2> JELAJAHI KATEGORI </h2>
    <div class="whitespace"></div>
    <div id="catprod-main-content">
                <img style="width: 500px;
            position: relative;
            left: 50%;
            transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
    </div>

</div>

<div class="main-section promosi-section" style="display: none;">
    <h2> PROMOSI </h2>
    <br>
    <div class="promosi-main-content">
        <img style="width: 500px;
            position: relative;
            left: 50%;
            transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
    </div>


    <!-- image -->
    <div class="promosi-banner">

    </div>

</div>

<div style="width:100%; min-height: 300px; background:#f4f4f5; margin-bottom: 50px; padding: 30px; display: none;" class="ig_section">
    <div class="ig-photos-divider">

    </div>
    <br><br>
    <div style="text-align: center">

        <h4> Follow Kami di Instagram! </h4>
        <div id="ig_link"></div>

    </div>
</div>

<div class="main-section">
    <h2> TREN </h2>
    <br>
    <div class="tren-main-content">
        <img style="width: 500px;
            position: relative;
            left: 50%;
            transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
    </div>
</div>

<div class="main-section">
    <h2> TERLARIS </h2>
    <br>
    <div class="main-terlaris">
        <img style="width: 500px;
            position: relative;
            left: 50%;
            transform: translateX(-50%); " src="<?php echo base_url('assets/images/load.gif');?>">
    </div>

</div>
<style>
    .card-group > .card {
        margin: 0 auto !important;
        margin-bottom: 15px;
    }

    .ranking-num{
        z-index: 100;
        -webkit-box-align: end;
        -ms-flex-align: end;
        align-items: flex-end;
        background-color: #000000;
        color: #ffffff;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        height: 40px;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: absolute;
        top: -20px;
        width: 20px;
        padding-bottom: 2px;
        line-height: 1em;
        font-weight: bold;
    }
</style>

<script>
    home_url = '<?php echo base_url('home/');?>';

    $(document).ready(function(){
        get_ig_feed();
        get_promosi();
        get_banner();
        get_category();
        get_tren();
        get_terlaris();
        get_promosi_banner();
        // if(mobile){
        //     setTimeout(function(){$('.flickity-viewport').css('height', '400px')}, 1500);
        // }
    })

    function get_promosi(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'get_promosi', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){

                if(data.length > 0){
                    $('.promosi-section').css('display','block');
                }

                var $mainDivider = $('.promosi-main-content');
                html = '';
                rank = '1'
                data.forEach(function(data){
                    img = data.file_web_image;
                    html += '<a target="_blank" href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'"">' +
                        '<div class="carousel-cell product-image" style="max-width: 200px; height: 400px; margin: 0px 10px;">' +
                        '<img style="max-height: 200px; max-width: 200px;" src="'+img+'">' +
                        '<div style="max-width: 200px; text-align: left;">' +
                        '<p style="font-size: 14px; height: 100px; margin-bottom: -5px;">'+ data.nama_web_product +'</p>';

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


                    html +=        '</div>' +
                        '</div></a>';


                    rank++;
                })

                $mainDivider.html(html);

                $mainDivider.flickity({
                    imagesLoaded:true,
                    prevNextButtons: false,
                    pageDots:false,
                    contain: true,
                    autoPlay: 1500,
                    groupCells: 4
                });

            }
        })
    }

    function get_promosi_banner(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: home_url + 'get_promosi_banner', // the url where we want to POST
            dataType: 'json',
            success: function (data) {

                if(data.length > 0){
                    $('.promosi-section').css('display','block');
                }

                data.forEach(function(data){
                    html = '<img style="max-width: 100%" src="'+ data.file_web_banner +'">'
                    $('.promosi-banner').append(html);
                })
            }
        })
    }

    function get_terlaris(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'get_terlaris', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){

                var $mainDivider = $('.main-terlaris');
                html = '';
                rank = '1'
                data.forEach(function(data){
                    img = data.file_web_image;
                    html += '<a target="_blank" href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'"">' +
                        '<div class="carousel-cell product-image" style="max-width: 200px; height: 400px; margin: 0px 10px;">' +
                        '<div class="ranking-num">'+rank+'</div>' +
                        '<img style="max-height: 200px; max-width: 200px;" src="'+img+'">' +
                            '<div style="max-width: 200px; text-align: left;">' +
                                '<p style="font-size: 14px; height: 100px; margin-bottom: -5px;">'+ data.nama_web_product +'</p>';

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


                    html +=        '</div>' +
                        '</div></a>';
                    rank++;
                })

                $mainDivider.html(html);

                $mainDivider.flickity({
                    imagesLoaded:true,
                    prevNextButtons: false,
                    pageDots:false,
                    contain: true,
                    autoPlay: 3000
                });
            }
        })
    }

    function get_tren(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'get_tren', // the url where we want to POST
            dataType    : 'json',
            success     : function(data){

                html = ' <div class="card-group">';
                data.forEach(function(data, i){
                    i++;
                    html += '<a href="<?php echo base_url('product');?>' + '?prod='+ data.art_number_web_product +'&color='+ data.nama_web_col +'">' +
                        '<div class="card"  style="width: 100%">\n'+
                        '<img class="card-img-top" src="'+ data.file_web_image +'">' +
                        '   <div class="card-body" style="text-align: left;"><span style="margin-bottom: 5px; height: 90px;">'+ data.nama_web_product + '<br><br></span><br>';

                    if(data.nominal_web_promosi != null && data.persen_web_promosi != null){
                        if(mobile || tablet){
                            html +=  '<br><br><div style="position: absolute; bottom: 0;"> <div style="margin-top: 10px;"><span class="persen_web_promosi_box" style="margin-left: -2px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span><br>' +
                                '      <span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span> </div>' +
                                '<h5 style="color: #a50000">'+ convertToRupiah(data.nominal_web_promosi) +'</h5>' +
                                '</div>\n';
                        } else {
                            html +=  '  <div style="position: absolute; bottom: 0;"><span class="strikethrough">'+ convertToRupiah(data.nominal_web_pricelist) +'</span> ' +
                                '<span class="persen_web_promosi_box" style="margin-left: -2px; font-size: 12px;">'+ data.persen_web_promosi +'% OFF</span>  ' +
                                '<h5 style=" color: #a50000">'+ convertToRupiah(data.nominal_web_promosi) +'</h5>' +
                                '</div>\n';
                        }

                    } else {
                        html +=  '         <span style="visibility: hidden;">'+ convertToRupiah(data.nominal_web_pricelist) +'</span>       ' +
                            '<h5 style="position: absolute; bottom: 0;">'+ convertToRupiah(data.nominal_web_pricelist) +'</h5>\n';
                    }

                    html +=    '</a></div>'+
                        '        </div>';

                    if(mobile && (i % 2 === 0)){
                        html += '</div><br> <div class="card-group">';
                    }


                })

                if(mobile || tablet){
                    if(data.length % 2 === 1){
                        html += '<div class="card link-card" style="visibility: hidden;"></div>'
                    }
                } else {
                    if(data.length % 4 === 3){
                        html += '<div class="card" style="visibility: hidden;"></div>'
                    } else if(data.length % 4 === 2) {
                        html += '<div class="card" style="visibility: hidden;"></div>' +
                            '<div class="card" style="visibility: hidden;"></div>';
                    } else if (data.length % 4 === 1 ) {
                        html += '<div class="card" style="visibility: hidden;"></div>' +
                            '<div class="card" style="visibility: hidden;"></div>' +
                            '<div class="card" style="visibility: hidden;"></div>'
                    }
                }

                html += ' </div>';

                $('.tren-main-content').html(html);
            }
        })

    }

    function get_ig_feed(){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: home_url + 'get_media_sosial', // the url where we want to POST
            dataType: 'json',
            data: {nama_media_sosial: 'INSTAGRAM'},
            success: function (data) {
                if(data != undefined || data != null){
                    load_ig_feed(data.isi_web_variable);
                }
            }
        })

    }

    function load_ig_feed(account){
        $('#ig_link').html('<a href="https://www.instagram.com/'+account+'" target="_blank">@'+account+'</a>');
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : 'https://www.instagram.com/'+ account +'/?__a=1', // the url where we want to POST
            dataType    : 'json',
            success     : function(response){
                var $mainDivider = $('.ig-photos-divider');
                $('.ig_section').css('display', 'block');
                $html = '';
                ig_photo_data = response.graphql.user.edge_owner_to_timeline_media.edges;
                ig_photo_data.forEach(function(data){
                    img = data.node.display_url;
                    $html += '<div class="carousel-cell product-image" style="max-height: 300px; max-width: 300px; margin: 0px 15px;"><img src="'+img+'"></div>';
                })

                $mainDivider.append($html);

                $mainDivider.flickity({
                    imagesLoaded:true,
                    prevNextButtons: false,
                    pageDots:false,
                    autoPlay: 1500,
                    contain: true,
                    wrapAround: true
                });
            }
        })
    }

    function get_category(){
        $.ajax({
            type        : 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'get_category', // the url where we want to POST
            dataType    : 'json',
            success     : function(response){

                let row_length = 0;
                if(mobile || tablet){
                    row_length = response.length/6;
                } else {
                    row_length = response.length/2;
                }

                let count = 0,
                    new_row = true;
                let html = '<div class="card-group">';
                response.forEach(function(cat){
                    html +=    '<div class="card">' +
                        '<a href="<?php echo base_url('category');?>' + '?cat='+ cat.id_web_catprod +'" style="text-decoration:none;">'+
                        '<img class="card-img-top card-cat" src="'+ cat.img_web_catprod +'">'+
                        '<div class="card-block">'+
                        '<h6 class="card-title">'+ cat.nama_web_catprod +'</h6>' +
                        '</div></a>' +
                        '</div>';

                    count++;
                    if(count % row_length === 0){
                        html += '</div><div class="card-group">';
                        // new_row = false;
                    }
                })
                html += '</div>';
                $('#catprod-main-content').html(html);
            }
        })
    }

    function get_banner(){
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : home_url + 'get_banner', // the url where we want to POST
            dataType    : 'json',
            data        : {tipe: 'MAIN'},
            success     : function(data){

                // make this dynamic
                html = '<div id="carouselExample1" class="carousel slide z-depth-1-half" data-ride="carousel" data-interval="3500">\n' +
                    '        <ol class="carousel-indicators">\n';


                data.forEach(function(data, i){
                    if(i == 0){
                        html +=  ' <li data-target="#carouselExampleIndicators" data-slide-to="'+ i +'" class="active"></li>\n';

                    } else {
                        html += '            <li data-target="#carouselExampleIndicators" data-slide-to="'+i+'"></li>\n';
                    }

                })

                html += '        </ol>\n' +
                    '        <div class="carousel-inner">\n';

                data.forEach(function(data, i){
                    if(i == 0){
                        html += '  <div class="carousel-item active">\n' +
                            '                <a href="'+ data.url_web_banner +'"><img class="d-block w-100 main-carousel-img" src="'+ data.file_web_banner +'" alt="First slide"></a>\n' +
                            '      </div>\n';

                    } else {
                        html += '   <div class="carousel-item">\n' +
                            '          <a href="'+ data.url_web_banner +'"><img class="d-block w-100 main-carousel-img" src="'+ data.file_web_banner +'" alt="First slide"></a>\n' +
                            '       </div>\n';
                    }

                })


                html +=   '        </div>\n' +
                    '        <a class="carousel-control-prev" href="#carouselExample1" role="button" data-slide="prev">\n' +
                    '            <span class="carousel-control-prev-icon" aria-hidden="true"></span>\n' +
                    '            <span class="sr-only">Previous</span>\n' +
                    '        </a>\n' +
                    '        <a class="carousel-control-next" href="#carouselExample1" role="button" data-slide="next">\n' +
                    '            <span class="carousel-control-next-icon" aria-hidden="true"></span>\n' +
                    '            <span class="sr-only">Next</span>\n' +
                    '        </a>\n' +
                    '    </div>';

                $('.main-carousel').html(html);
            }
        })
    }


</script>

