<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Register_model');
        $this->load->model('cart/Cart_model');
        $this->load->model('home/Home_model');
    }

    function index()
    {
        $this->load->view('template/header');
        $this->load->view('main');
    }


    function process_register(){
        $email_web_user = strtoupper(htmlentities(trim($_REQUEST['email_address']), ENT_QUOTES));
        $telp_web_user = trim(htmlentities($_REQUEST['phone_number'], ENT_QUOTES));
        $password_web_user = htmlentities($_REQUEST['password'], ENT_QUOTES);
        $retype_password_web_user = htmlentities($_REQUEST['retype_password'], ENT_QUOTES);

        if($email_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Email masih kosong!');
            echo json_encode($return_arr);
            return;
        }

        if (!filter_var($email_web_user, FILTER_VALIDATE_EMAIL)) {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Format email tidak valid');
            echo json_encode($return_arr);
            return;
        }

        if($telp_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'No. Telepon masih kosong!');
            echo json_encode($return_arr);
            return;
        }

        if($password_web_user == ''){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Password masih kosong!');
            echo json_encode($return_arr);
            return;
        }

        if($password_web_user != $retype_password_web_user){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Mohon ketik ulang password');
            echo json_encode($return_arr);
            return;
        }


        $check = $this->Register_model->check_email_phone($email_web_user, $telp_web_user);
        if($check->num_rows() > 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'User ini sudah terdaftar!');
            echo json_encode($return_arr);
            return;
        }

        $password_web_user = md5($password_web_user);
        $data = compact("email_web_user","telp_web_user", "password_web_user");

        $this->db->trans_begin();
        $insert_id = $this->Register_model->register_to_db($data);
        if($insert_id){

            date_default_timezone_set('Asia/Jakarta');

            // add token
            $token_web_token = $this->generateRandomString(64);
            $id_web_user = $insert_id;
            $duration_web_token = 0; // in seconds
            $timestamp_web_token = date('Y-m-d H:i:s');

            $token_data = compact('token_web_token', 'id_web_user', 'duration_web_token', 'timestamp_web_token');
            if($this->Register_model->add_token($token_data)){
                // send token to email
                if($this->send_confirmation_email($token_web_token, $email_web_user)){
                    if(isset($_SESSION['id_so_m'])){
                        // update id_so_m
                        $updated_data = array("id_user_web_so_m" => $insert_id);
                        if($this->Cart_model->update_cart($updated_data, $_SESSION['id_so_m'])){
                            $user_data = array('id_web_user' => $insert_id,
                                'email_web_user' => $email_web_user,
                                'is_admin' => '0'
                            );
                            $this->session->set_userdata($user_data);

                            // set notification to activate email
                            $notifikasi = array(
                                'id_web_user' => $_SESSION['id_web_user'],
                                'isi_web_notifikasi' => "Email anda belum aktif, silahkan konfirmasi email anda dengan mengklik link yang sudah dikirimkan ke email anda.",
                                'is_read' => '0',
                                'timestamp_web_notifikasi' => date('Y-m-d H:i:s'),
                                'url_web_notifikasi' => ''
                            );
                            $this->Home_model->add_notification($notifikasi);

                            $this->db->trans_commit();
                            $return_arr = array("Status" => 'OK', "Message" => 'Kode konfirmasi telah dikirim ke email anda. Silahkan klik link untuk mengaktifkan akun anda.');
                        } else {
                            $this->db->trans_rollback();
                            $return_arr = array("Status" => 'ERROR', "Message" => 'User gagal terdaftar');
                        }
                    } else {
                        $user_data = array('id_web_user' => $insert_id,
                            'email_web_user' => $email_web_user,
                            'is_admin' => '0'
                        );
                        $this->session->set_userdata($user_data);

                        // set notification to activate email
                        $notifikasi = array(
                            'id_web_user' => $_SESSION['id_web_user'],
                            'isi_web_notifikasi' => "Email anda belum aktif, silahkan konfirmasi email anda dengan mengklik link yang sudah dikirimkan ke email anda.",
                            'is_read' => '0',
                            'timestamp_web_notifikasi' => date('Y-m-d H:i:s'),
                            'url_web_notifikasi' => ''
                        );
                        $this->Home_model->add_notification($notifikasi);

                        $this->db->trans_commit();
                        $return_arr = array("Status" => 'OK', "Message" => '');
                    }
                } else {
                    $this->db->trans_rollback();
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengirim email konfirmasi');
                }

            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal membuat token');
            }

        } else {
            $this->db->trans_rollback();
            $return_arr = array("Status" => 'ERROR', "Message" => 'User gagal terdaftar');
        }

        echo json_encode($return_arr);
        return;
    }

    function confirm(){
        $token = htmlentities($_GET['token'], ENT_QUOTES);
        $token_data = $this->Register_model->get_token($token);
        $this->load->view('template/header');

        if($token_data->num_rows() == 0){
            $this->load->view('invalid_token');
            return;
        } else {
            $token_datarow = $token_data->row();

            // IF token has validity
//            date_default_timezone_set('Asia/Jakarta');
//            $duration = (int) $token_datarow->duration_web_token;
//            $token_timestamp = $token_datarow->timestamp_web_token;
//            $time_difference = $this->timeDiff($token_timestamp, date('Y-m-d H:i:s'));

            if($token_datarow->is_valid == '1'){
                $this->Register_model->activate_user($token_datarow->id_web_user);
                $this->Register_model->deactivate_token($token);

                date_default_timezone_set('Asia/Jakarta');
                // set notification to activate email
                $notifikasi = array(
                    'id_web_user' => $token_datarow->id_web_user,
                    'isi_web_notifikasi' => "Email anda berhasil diverifikasi!",
                    'is_read' => '0',
                    'timestamp_web_notifikasi' => date('Y-m-d H:i:s'),
                    'url_web_notifikasi' => ''
                );
                $this->Home_model->add_notification($notifikasi);

                $this->load->view('activated');
                return;
            } else {
                $this->load->view('activated_warning');
                return;
            }

        }

    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function timeDiff($firstTime,$lastTime)
    {
        // convert to unix timestamps
        $firstTime=strtotime($firstTime);
        $lastTime=strtotime($lastTime);

        // perform subtraction to get the difference (in seconds) between times
        $timeDiff=$lastTime-$firstTime;

        // return the difference
        return $timeDiff;
    }

    private function send_confirmation_email($token, $email){
        $url = base_url('register/confirm?token=').$token;

        include APPPATH.'third_party/PHPMailer/src/Exception.php';
        include APPPATH.'third_party/PHPMailer/src/PHPMailer.php';
        include APPPATH.'third_party/PHPMailer/src/SMTP.php';
        include APPPATH.'third_party/PHPMailer/src/POP3.php';
        include APPPATH.'third_party/PHPMailer/src/OAuth.php';


        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->Host = "mail.pirahome.com"; // specify main and backup server
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->Username = "noreply@pirahome.com"; // SMTP username
        $mail->Password = "Putera123N"; // SMTP password
        $mail->Port = 587;

        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom("noreply@pirahome.com","PIRA HOME");
        $mail->addAddress($email);

        // set email format to HTML
        $mail->isHTML(true);

        $mail->Subject = "Konfirmasi Email Anda";
        $mail->Body = "Selamat Datang di PIRA HOME!<br>
        Konfirmasi email anda dengan mengklik link di bawah ini untuk mengaktifkan akun PIRA anda dan dapatkan furniture idamanmu dari PIRA!
        <br><br>
        <a href='".$url."' target='_blank' style='cursor: pointer'>".$url."</a>
        <br><br>
        Admin PIRA HOME
        ";

        if(!$mail->send())
        {
//            echo "Message could not be sent. <p>";
//            echo "Mailer Error: " . $mail->ErrorInfo;
//            exit;
            return false;
        }

        return true;
    }

}
?>