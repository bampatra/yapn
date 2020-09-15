

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Mutasi Rekening Bulanan</h1>
    <br>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4 ">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Rekening</h6>
                </div>
                <div class="card-body">

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9">
                            <select id="tahun_mutasi" name="tahun_mutasi" class="form-control form-active-control selectpicker" data-container="body" style="padding: 0.3rem; font-size: inherit;">
                                <?php foreach ($years as $year) { ?>
                                    <option value="<?php echo $year->year; ?>">
                                        <?php echo $year->year; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Rekening</label>
                        <div class="col-sm-9">
                            <select id="rekening_mutasi" name="rekening_mutasi" class="form-control form-active-control selectpicker" data-live-search="true" data-container="body" style="padding: 0.3rem; font-size: inherit;">
                                <?php foreach ($rekening_list as $rekening) { ?>
                                    <option data-tokens="<?php echo $rekening->no_rekening; ?>" value="<?php echo $rekening->id_rekening; ?>">
                                        <?php echo $rekening->nama_rekening; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">No. Rek.</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control no_rek" value="Loading...">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">S/N</label>
                        <div class="col-sm-9">
                            <input type="text" disabled class="form-control s_n" value="Loading...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">

        </div>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mutasi</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th style="width: 10%">No</th>
                        <th style="width: 30%">Bulan</th>
                        <th> Debet </th>
                        <th> Kredit </th>
                        <th> Mutasi </th>
                        <th> Saldo </th>
                    </tr>
                    </thead>
                    <tbody id="main-content">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chart</h6>
        </div>
        <div class="card-body">
            <div class="chart-bar wrapper" style="height: 500px !important;">
                <canvas id="myBarChart"></canvas>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Page level custom scripts -->

<!-- <script src="<?php echo base_url('assets/js/startbootstrap/demo/datatables-demo.js');?>"></script>-->

<script>

    product_url = '<?php echo base_url('product/');?>';

    $(document).ready(function(){
        get_rekening_detail();
    })

    let no_rekening = 0,
        s_n_golonga = '';


    function get_mutasi(no_rekening, s_n){
        let total_debet = 0,
            total_kredit = 0,
            total_mutasi = 0;

        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : admin_url + 'get_mutasi', // the url where we want to POST// our data object
            dataType    : 'json',
            data        : {no_rek: no_rekening, s_n: s_n, year: $('#tahun_mutasi').val()},
            success     : function(data){
                length = data.length;
                html = '';
                data.forEach(function(data, i){

                    html += '<tr class="tr-hover">' +
                        '   <td>'+ i +'</td>' +
                        '   <td>'+ data.months +'</td>' +
                        '   <td>'+ convertToRupiah(data.DEBET) +'</td>' +
                        '   <td>'+ convertToRupiah(data.KREDIT) +'</td>' +
                        '   <td>'+ convertToRupiah(data.MUTASI) +'</td>' +
                        '   <td>'+ convertToRupiah(data.SALDO) +'</td>' +
                        '    </tr>';

                    total_debet += parseFloat(data.DEBET);
                    total_kredit += parseFloat(data.KREDIT);
                    total_mutasi += parseFloat(data.MUTASI);

                })

                // Additional row for TOTAL
                html += '<tr>' +
                    '   <td> <span style="visibility: hidden;">14</span> </td>' +
                    '   <td> <strong> TOTAL </strong> </td>' +
                    '   <td><strong>'+ convertToRupiah(total_debet) +'</strong></td>' +
                    '   <td><strong>'+ convertToRupiah(total_kredit) +'</strong></td>' +
                    '   <td><strong>'+ convertToRupiah(total_mutasi) +'</strong></td>' +
                    '   <td></td>' +
                    '    </tr>';

                // Additional row for AVERAGE
                html += '<tr>' +
                    '   <td> <span style="visibility: hidden;">15</span> </td>' +
                    '   <td> <strong> AVERAGE </strong> </td>' +
                    '   <td><strong>'+ convertToRupiah(parseInt(parseInt(total_debet) / parseInt(<?php echo $_SESSION["laporan_bulan"]?>))) +'</strong></td>' +
                    '   <td><strong>'+ convertToRupiah(parseInt(parseInt(total_kredit) / parseInt(<?php echo $_SESSION["laporan_bulan"]?>))) +'</strong></td>' +
                    '   <td><strong>'+ convertToRupiah(parseInt(parseInt(total_mutasi) / parseInt(<?php echo $_SESSION["laporan_bulan"]?>))) +'</strong></td>' +
                    '   <td></td>' +
                    '    </tr>';

                // $('.daterangepicker').remove();
                $('#dataTable').DataTable().destroy();
                $('#main-content').html(html);
                $('#dataTable').DataTable({
                    "order": [[ 0, "asc" ]],
                    "pageLength": 16,
                    // "scrollX": true,
                } );
                mutasi_chart(data);
                // datatable_init(1, true);

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();

            }
        })
    }

    function get_rekening_detail(){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: admin_url + 'get_rekening_by_id', // the url where we want to POST// our data object
            dataType: 'json',
            data: {id_rekening: $('#rekening_mutasi').val()},
            success: function (data) {
                $('.no_rek').val(data.no_rekening);
                $('.s_n').val(data.s_n_golongan);

                no_rekening = data.no_rekening;
                s_n_golongan = data.s_n_golongan;

                get_mutasi(data.no_rekening, data.s_n_golongan);
            }
        })
    }


    $('#rekening_mutasi').change(function(){
        $('.no_rek').val('Loading...');
        $('.s_n').val('Loading...');
        get_rekening_detail();
    })

    $('#tahun_mutasi').change(function(){
        get_mutasi(no_rekening, s_n_golongan);
    })


    function mutasi_chart(data){
        let debet_data = [],
            kredit_data = [],
            mutasi_data = [];

        data.forEach(function(data, i){
            debet_data.push(data.DEBET);
            kredit_data.push(data.KREDIT);
            mutasi_data.push(data.MUTASI);
        })

        document.getElementById("myBarChart").remove();
        $('.chart-bar').append('<canvas id="myBarChart"></canvas>');
        var ctx = document.getElementById("myBarChart");
        var myBarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: ["Saldo Awal","January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December", "Penyesuaian"],
                datasets: [
                    {
                        label: "Debet",
                        backgroundColor: "#4e73df",
                        hoverBackgroundColor: "#2e59d9",
                        borderColor: "#4e73df",
                        // data: [4215, 5312, -6251, 7841, 9821, -14984],
                        data: debet_data,
                    },
                    {
                        label: "Kredit",
                        backgroundColor: "#a50000",
                        hoverBackgroundColor: "#850001",
                        borderColor: "#4e73df",
                        // data: [1000, 1000, -1000, 1000, 1000, -1000],
                        data: kredit_data,
                    },
                    {
                        label: "Mutasi",
                        backgroundColor: "#A56C00",
                        hoverBackgroundColor: "#8B5E00",
                        borderColor: "#4e73df",
                        // data: [1000, 1000, -1000, 1000, 1000, -1000],
                        data: mutasi_data,
                    },
                ],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return convertToRupiah(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                    yAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        maxBarThickness: 25,

                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': ' + convertToRupiah(tooltipItem.xLabel);
                        }
                    }
                },
            }
        });
    }

</script>
