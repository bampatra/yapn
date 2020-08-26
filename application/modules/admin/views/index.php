

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
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Lembaga</label>
                        <div class="col-sm-10">
                            <select name="default_lembaga" class="form-control lembaga-dropdown" style="width: auto">
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
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Awal Periode</label>
                        <div class="col-sm-10">
                            <?php echo $_SESSION['awal_periode']?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Akhir Periode</label>
                        <div class="col-sm-10">
                            <?php echo $_SESSION['akhir_periode']?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-10">
                            <?php
                            $var = $_SESSION['awal_periode'];
                            $date = str_replace('/', '-', $var);
                            echo date("d-M-Y", strtotime($date) );
                            ?>
                            sampai dengan <span class="akhir-periode-string">
                                     <?php

                                     if($_SESSION['laporan_bulan'] != '13'){
                                         $var = $_SESSION['akhir_periode'];
                                         $date = str_replace('/', '-', $var);
                                         echo date("d-M-Y", strtotime($date) );
                                     } else {
                                         echo "31-Jan-".((int)$_SESSION['laporan_tahun'] + 1);
                                     }

                                     ?>
                                </span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Laporan Bulan</label>
                        <div class="col-sm-10">
                            <select name="bulan" class="form-control bulan-dropdown" style="width: auto">
                                <?php
                                $bulan = array("Saldo Awal", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember", "Penyesuaian");
                                for($a=0;$a<=13;$a++){
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
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Laporan Tahun</label>
                        <div class="col-sm-10">
                            <select name="tahun" class="form-control tahun-dropdown" style="width: auto">
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
                            </select>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>


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

