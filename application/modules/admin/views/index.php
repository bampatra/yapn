

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">YAPN</h1>
          </div>


          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 ">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Beranda </h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                        <table class="desktop-and-tablet-inlinetable">
                            <tr class="tr-form">
                                <td class="td-main"> Lembaga </td>
                                <td class="td-secondary">

                                    <select name="default_lembaga" class="form-control lembaga-dropdown">
                                        <?php
                                            if($_SESSION['default_lembaga'] == 'Yayasan Ari Prshanti Nilayam'){
                                                echo("<option value='Yayasan Ari Prshanti Nilayam' selected>Yayasan Ari Prshanti Nilayam</option>
                                                      <option value='SMK Prshanti Nilayam'>SMK Prshanti Nilayam</option>"."\n");
                                            } else {
                                                echo("<option value='Yayasan Ari Prshanti Nilayam'>Yayasan Ari Prshanti Nilayam</option>
                                                      <option value='SMK Prshanti Nilayam' selected>SMK Prshanti Nilayam</option>"."\n");
                                            }

                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr class="tr-form">
                                <td class="td-main"> Awal Periode </td>
<!--                                <td> <input class="form-control" type="date" value="--><?php //echo $_SESSION['awal_periode']?><!--"> </td>-->
                                <td class="td-secondary"> <?php echo $_SESSION['awal_periode']?> </td>
                            </tr>
                            <tr class="tr-form">
                                <td class="td-main"> Akhir Periode </td>
<!--                                <td> <input class="form-control" type="te" value="--><?php //echo $_SESSION['akhir_periode']?><!--"> </td>-->
                                <td class="td-secondary akhir-periode"> <?php echo $_SESSION['akhir_periode']?> </td>
                            </tr>
                            <tr class="tr-form">
                                <td class="td-main"> Periode </td>
                                <td class="td-secondary" class="periode-summary">
                                    <?php
                                    $var = $_SESSION['awal_periode'];
                                    $date = str_replace('/', '-', $var);
                                    echo date("d-M-Y", strtotime($date) );
                                    ?>
                                    sampai dengan <span class="akhir-periode-string">
                                         <?php

                                         $var = $_SESSION['akhir_periode'];
                                         $date = str_replace('/', '-', $var);
                                         echo date("d-M-Y", strtotime($date) );

                                         ?>
                                    </span>
                                </td>
                            </tr>
                            <tr class="tr-form">
                                <td class="td-main"> Laporan Bulan </td>
                                <td class="td-secondary"> <select name="bulan" class="form-control bulan-dropdown">
                                        <?php
                                        $bulan = array("", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        for($a=1;$a<=12;$a++){
                                            if($a == $_SESSION['laporan_bulan'])
                                            {
                                                $pilih="selected";
                                            }
                                            else
                                            {
                                                $pilih="";
                                            }
                                            echo("<option value=\"$a\" $pilih>$bulan[$a]</option>"."\n");
                                        }
                                        ?>
                                    </select> </td>
                            </tr>
                            <tr class="tr-form">
                                <td class="td-main"> Laporan Tahun </td>
                                <td class="td-secondary"> <select name="tahun" class="form-control tahun-dropdown">
                                        <?php foreach ($years as $year) { ?>
                                            <?php if($year->year == $_SESSION['laporan_tahun']) {?>
                                                <option value="<?php echo $year->year; ?>" selected>
                                                    <?php echo $year->year; ?>
                                                </option>
                                            <?php } else { ?>
                                                <option value="<?php echo $year->year; ?>">
                                                    <?php echo $year->year; ?>
                                                </option>
                                        <?php }} ?>
                                        <option value="2021"> 2021 </option>
                                    </select> </td>
                            </tr>
                        </table>
                </div>
              </div>
            </div>
                <?php print_r($_SESSION) ?>
          </div>


<style>
    .tr-form{
        height: 45px;
        font-size: 16px;
    }

    .td-main{
        width: 30%;
    }

    .td-secondary{
        width: 50%;
    }

</style>
<script>

    // Set new default font family and font color to mimic Bootstrap's default styling
    Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#858796';


    $('.bulan-dropdown, .tahun-dropdown').change(function(){
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'change_akhir_periode', // the url where we want to POST// our data object
            dataType: 'json',
            data: {month: $('.bulan-dropdown').val(), year: $('.tahun-dropdown').val()},
            success: function (response) {
                if(response.Status == "OK"){
                    $('.akhir-periode').html(response.Date);
                    $('.akhir-periode-string').html(response.DateString);
                }

            }
        })
    })

    $('.lembaga-dropdown').change(function(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'change_lembaga', // the url where we want to POST// our data object
            dataType: 'json',
            data: {lembaga: $('.lembaga-dropdown').val()},
            success: function (response) {
                if(response.Status == "OK"){
                   $('.lembaga-dropdown').val(response.Value);
                    $('.loading').css("display", "none");
                    $('.Veil-non-hover').fadeOut();
                }

            }
        })
    })

</script>

