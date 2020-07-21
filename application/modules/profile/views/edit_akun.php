<div class="breadcrumb" style="background: #f4f4f5"><a style="font-size: 14px; margin-right: 3px;" href="<?php echo base_url('profile')?>">Profil</a> <span style="font-size: 14px;">  > Edit Akun</span></div>
<div class="whitespace"></div>
<div class="main-section" style="text-align: left; max-width: 760px">
    <h3> Edit Akun </h3>
    <p style="color:black;"> Untuk mengedit akun, masukkan informasi baru pada kolom kosong lalu klik tombol 'SIMPAN'</p>
    <br>
    <form id="edit-akun-form">
        <div class="edit-akun-section" style="width: 100%; background: #f4f4f5; padding: 20px 25px; border-radius: 5px;">
            <h4> Ganti Email </h4>
            <span style="color: grey"> Email terdaftar: <span id="email_terdaftar" style="color: grey"></span></span>
            <div style="max-width: 450px">
                <div class="form-group" >
                    <label for="email_address" class="col-form-label">Email Baru</label>
                    <input type="email" id="email_baru" name="email_baru" class="form-control" autofill="off" autocomplete="off">
                </div>
                <div class="form-group" >
                    <label for="email_address" class="col-form-label">Konfirmasi Email Baru</label>
                    <input type="email" id="konfirmasi_email_baru" name="konfirmasi_email_baru" class="form-control" autofill="off" autocomplete="off">
                </div>
            </div>
        </div>
        <br>
        <div class="edit-akun-section" style="width: 100%; background: #f4f4f5; padding: 20px 25px; border-radius: 5px;">
            <h4> Ganti No. Telepon </h4>
            <span style="color: grey"> No. Telepon terdaftar: <span id="telp_terdaftar" style="color: grey"></span></span>
            <div style="max-width: 450px">
                <div class="form-group" >
                    <label for="email_address" class="col-form-label">No. Telepon Baru</label>
                    <input type="text" id="telp_baru" name="telp_baru" class="form-control" autofill="off" autocomplete="off">
                </div>
            </div>
        </div>
        <br>
        <div class="edit-akun-section" style="width: 100%; background: #f4f4f5; padding: 20px 25px; border-radius: 5px;">
            <h4> Ganti Password </h4>
            <div style="max-width: 450px">
                <div class="form-group">
                    <label for="email_address" class="col-form-label">Password Lama</label>
                    <input type="password" id="password_lama" name="password_lama" class="form-control" autofill="off" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email_address" class="col-form-label">Password Baru</label>
                    <input type="password" id="password_baru" name="password_baru" class="form-control" autofill="off" autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="email_address" class="col-form-label">Konfirmasi Password Baru</label>
                    <input type="password" id="konfirmasi_password_baru" name="konfirmasi_password_baru" class="form-control" autofill="off" autocomplete="off">
                </div>
            </div>
        </div>
    </form>
    <br>
    <div style="max-width: 450px">
        <table style="width:100%">
            <tr>
                <td style="width: 48%"> <button class="btn-white" style="width:100%"> Kembali ke Profil </button> </td>
                <td style="width: 4%"></td>
                <td style="width: 48%"> <button class="btn btn-red-hover simpan-profil" style="width:100%"> Simpan </button> </td>
            </tr>
        </table>
    </div>
</div>

<script>

    profile_url = '<?php echo base_url('profile/');?>';

    $('.simpan-profil').click(function(e){
        e.preventDefault();
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        $.ajax({
            type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'update_user_info', // the url where we want to POST
            dataType: 'json',
            data: $('#edit-akun-form').serialize(),
            success: function (response) {
                if(response.Status == "OK"){

                    show_snackbar(response.Message);
                    $('#edit-akun-form').trigger('reset');
                    get_detail_user();
                } else {
                    show_snackbar(response.Message);
                }

                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })

    function get_detail_user(){
        $.ajax({
            type: 'GET', // define the type of HTTP verb we want to use (POST for our form)
            url: profile_url + 'get_detail_user', // the url where we want to POST
            dataType: 'json',
            success: function (data) {
                $('#email_terdaftar').html(data.email_web_user);
                $('#telp_terdaftar').html(data.telp_web_user);
            }
        })
    }

    get_detail_user();

</script>