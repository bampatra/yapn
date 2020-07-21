
<div class="whitespace"></div>
<div class="cotainer">
    <div class="justify-content-center" style="display: flex;">
        <div class="col-md-8">
            <div class="card" style="width: 100%">
                <div class="card-header">Pendaftaran Akun Baru PIRA</div>
                <div class="card-body">
                    <div class="alert alert-danger" role="alert" id="registration-error-message" style="display:none"> </div>
                    <div class="alert alert-success" role="alert" id="registration-success-message" style="display:none"> </div>

                    <form name="register-form" id="register-form">

                        <div class="form-group row">
                            <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail</label>
                            <div class="col-md-6">
                                <input type="text" id="register_email_address" name="email_address" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">No. Telepon</label>
                            <div class="col-md-6">
                                <input type="text" id="register_phone_number" name="phone_number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input type="password" id="register_password" name="password" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">Ketik Ulang Password</label>
                            <div class="col-md-6">
                                <input type="password" id="register_retype_password" name="retype_password" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 offset-md-4">
                            <button class="btn" id="register-btn">
                                Register
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<script>

    base_url = '<?php echo base_url('register/');?>';

    $('#register-btn').click(function(e){
        $('.loading').css("display", "block");
        $('.Veil-non-hover').fadeIn();
        e.preventDefault();
        $.ajax({
            type        : 'POST', // define the type of HTTP verb we want to use (POST for our form)
            url         : base_url + 'process_register', // the url where we want to POST
            data        : $('#register-form').serialize(), // our data object
            dataType    : 'json',
            success     : function(response){
                console.log(response);
                if(response.Status == 'OK'){
                    window.location.href = "<?php echo base_url('home/');?>";
                    // $('#registration-error-message').css('display', 'none');
                    // $('#registration-success-message').css('display', 'block');
                    // $('#registration-success-message').html(response.Message);
                } else if(response.Status == 'ERROR'){
                    $('#registration-success-message').css('display', 'none');
                    $('#registration-error-message').css('display', 'block');
                    $('#registration-error-message').html(response.Message);

                }
                $('.loading').css("display", "none");
                $('.Veil-non-hover').fadeOut();
            }
        })
    })


</script>