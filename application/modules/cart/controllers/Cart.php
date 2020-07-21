<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cart extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Cart_model');
        $this->load->model('product/Product_model');
        $this->load->model('home/Home_model');
        $this->load->model('profile/Profile_model');
    }

    function index()
    {
        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');
    }

    function checkout(){
        if(isset($_SESSION['id_web_user'])){
            $this->load->view('template/header');
            $this->load->view('checkout');
        } else {
            $this->load->helper('url');
            redirect(base_url('cart'), 'refresh');
        }

        // if cart is empty, redirect to cart
    }

    function proceed_to_checkout(){
        if(isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'OK', "Message" => '');
        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => '');
        }
        echo json_encode($return_arr);
        return;
    }

    function get_so_m_summary(){
        if(isset($_SESSION['id_web_user'])){
            $unapproved_cart = $this->Home_model->get_user_cart($_SESSION['id_web_user']);
            if($unapproved_cart->num_rows() > 0){
                $id_web_so_m = $unapproved_cart->row()->id_web_so_m;
            } else {
                $id_web_so_m = 0;
            }

        } else {
            if(isset($_SESSION['id_so_m'])){
                $id_web_so_m = $_SESSION['id_so_m'];
            } else {
                $id_web_so_m = 0;
            }
        }

        $data = $this->Cart_model->get_so_m_summary($id_web_so_m);
        echo json_encode($data->row());
        return;
    }

    function get_main_address(){
        $data = $this->Cart_model->get_main_address($_SESSION['id_web_user']);
        echo json_encode($data->row());
        return;
    }

    function get_all_address(){
        $data = $this->Cart_model->get_all_address($_SESSION['id_web_user'], htmlentities($_REQUEST['selected_address'], ENT_QUOTES));
        echo json_encode($data->result_object());
        return;
    }

    function get_cart(){
        // check if pricelist and disc is the same as unit_price_so_d
        // update price is difference is found

        $id_web_so_m = $this->get_id_so_m();

        $data = $this->cart_adjustment($id_web_so_m);

        echo json_encode($data->result_object());
        return;
    }


    function add_to_cart()
    {

        $qty_so_d = htmlentities($_REQUEST['qty_item'], ENT_QUOTES);
        $ucode_web_product = htmlentities($_REQUEST['ucode_web_product'], ENT_QUOTES);
        $new_cart = true;


        if(isset($_SESSION['id_web_user'])){
            $id_web_user = $_SESSION['id_web_user'];
        } else {
            $id_web_user = 0;
        }

        //check if qty is number
        if(!preg_match('/^[0-9]+$/', $qty_so_d)){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Jumlah produk tidak valid!');
            echo json_encode($return_arr);
            return;
        }

        if($qty_so_d == '0' || $qty_so_d == 0){
            $return_arr = array(
                "Status" => 'ERROR',
                "Message" => 'Jumlah produk tidak boleh kosong'
            );
            echo json_encode($return_arr);
            return;
        }

        // check if product exists
        $prod = $this->Product_model->get_product_by_id($ucode_web_product, $id_web_user);


        if($prod->num_rows() == 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Produk tidak ditemukan!');
            echo json_encode($return_arr);
            return;
        }

        $data_row = $prod->row();
        $nama_product_so_d = $data_row->nama_web_product;
        $warna_product_so_d = $data_row->nama_web_col;


        // check stock
        if((int) $qty_so_d > (int) $data_row->stok_web_product){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Jumlah produk melebihi stok yang tersedia');
            echo json_encode($return_arr);
            return;
        }

        // handle price
        $nominal_web_promosi = $data_row->nominal_web_promosi;
        $persen_web_promosi = $data_row->persen_web_promosi;

        if(!empty($nominal_web_promosi)){
            $unit_price_so_d = $nominal_web_promosi;
        } else {
            $unit_price_so_d = $data_row->nominal_web_pricelist;
        }


        $nominal_disc_so_d = 0.0;
        $percent_disc_so_d = 0.0;
        $total_price_so_d = $qty_so_d * $unit_price_so_d;

        $this->db->trans_begin();

        $unapproved_cart = $this->Cart_model->get_so_m_summary($this->get_id_so_m());

        // determine id_web_so_m
        if(isset($_SESSION['id_web_user'])){
            $id_web_user = $_SESSION['id_web_user'];


            // check if so_m in database is present
            if($unapproved_cart->num_rows() > 0){
                // add to so_m in database
                $id_web_so_m = $unapproved_cart->row()->id_web_so_m;
                $new_cart = false;
            } else {
                // create new so_m and store in database
                $id_web_so_m = $this->create_so_m($id_web_user);
                $new_cart = true;
            }

        } else {
            $id_web_user = 0;

            // check if so_m in session is present
            if(isset($_SESSION['id_so_m'])){
                // add to so_m in session
                $id_web_so_m = $_SESSION['id_so_m'];
                $new_cart = false;
            } else {
                // create new so_m and store in session
                $id_web_so_m = $this->create_so_m($id_web_user);
                $_SESSION['id_so_m'] = $id_web_so_m;
                $new_cart = true;
            }
        }

        // check if product exists in this cart
        $exists = $this->Cart_model->exists_in_cart($id_web_so_m, $ucode_web_product);
        if($exists->num_rows() > 0){
            $cart_item = $exists->row();
            $cart_item_id = $cart_item->id_web_so_d;
            $cart_item_qty = $cart_item->qty_so_d;
            $cart_item_total_price = $cart_item->total_price_so_d;

            $new_qty = $cart_item_qty + $qty_so_d;
            $total_price_so_d = $new_qty * $unit_price_so_d;

            $updated_data = array('qty_so_d' => $new_qty, 'total_price_so_d' => $total_price_so_d);
            if($this->Cart_model->update_cart_item($updated_data, $cart_item_id)){

                $new_total_so_m = $unapproved_cart->row()->total_web_so_m - $cart_item_total_price + $total_price_so_d;
                $new_grand_total_so_m = $unapproved_cart->row()->grand_total_web_so_m - $cart_item_total_price + $total_price_so_d;

                // update so_m
                $update_so_m = array(
                    'total_web_so_m' => $new_total_so_m,
                    'grand_total_web_so_m' => $new_grand_total_so_m
                );

                $this->Cart_model->update_cart($update_so_m, $id_web_so_m);

                $this->db->trans_commit();
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal memasukkan produk ke keranjang (1)');
            }
            echo json_encode($return_arr);
            return;


        } else {
            $data = compact('id_web_so_m','ucode_web_product','nama_product_so_d','warna_product_so_d','qty_so_d','unit_price_so_d', 'nominal_disc_so_d', 'percent_disc_so_d', 'total_price_so_d');

            $insert_id = $this->Cart_model->add_to_cart($data);
            if($insert_id){
                // get so m
                if($new_cart){
                    $new_total_so_m = $total_price_so_d;
                    $new_grand_total_so_m = $total_price_so_d;
                } else {

                    $new_total_so_m = $unapproved_cart->row()->total_web_so_m + $total_price_so_d;
                    $new_grand_total_so_m = $unapproved_cart->row()->grand_total_web_so_m + $total_price_so_d;
                }

                // update so_m
                $update_so_m = array(
                    'total_web_so_m' => $new_total_so_m,
                    'grand_total_web_so_m' => $new_grand_total_so_m
                );

                $this->Cart_model->update_cart($update_so_m, $id_web_so_m);

                $this->db->trans_commit();
                $return_arr = array("Status" => 'OK', "Message" => '');
            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal memasukkan produk ke keranjang (2)');
            }
            echo json_encode($return_arr);
            return;
        }
    }

    function final_checkout(){
        $id_web_so_m = $this->get_id_so_m();
        date_default_timezone_set('Asia/Jakarta');
        $date  = date('Y-m-d H:i:s');

        if($id_web_so_m == 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Keranjang tidak valid');
            echo json_encode($return_arr);
            return;
        }

        if(!isset($_SESSION['id_web_user'])){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Anda harus login terlebih dahulu');
            echo json_encode($return_arr);
            return;
        }

        $payment_unique_code = rand(100,1000);

        $update = array(
            'tgl_web_so_m' => $date,
            'status_web_so_m' => '1',
            'payment_unique_code' => $payment_unique_code,
            'grand_total_web_so_m' => $this->Cart_model->get_so_m_summary($id_web_so_m)->row()->grand_total_web_so_m + $payment_unique_code
        );

        // get alamat
        $web_alamat = htmlentities($_REQUEST['selected_address'], ENT_QUOTES);
        $filter = "id_web_user_alamat = '$web_alamat'";

        // get notes
        if(isset($_REQUEST['notes'])){
            $delivery_notes = htmlentities($_REQUEST['notes'], ENT_QUOTES);
        } else {
            $delivery_notes = '';
        }

        // check latest product price and validity
        if($this->cart_adjustment($id_web_so_m, true)){
            $return_arr = array("Status" => 'Warning', "Message" => 'Terdapat perubahan pada keranjang anda. Silahkan refresh halaman ini.');
            echo json_encode($return_arr);
            return;
        }

        $stock_check = $this->final_stock_check($id_web_so_m);
        if(!empty($stock_check)){
            $return_arr = array("Status" => 'STOCK_WARNING', "Message" => $stock_check);
            echo json_encode($return_arr);
            return;
        }


        $data_alamat = $this->Profile_model->get_alamat($filter);

        $this->db->trans_begin();

        if($data_alamat->num_rows() > 0){
            $data_row = $data_alamat->row();

            if($data_row->id_web_user != $_SESSION['id_web_user']){
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Alamat yang anda pilih tidak valid!');
                echo json_encode($return_arr);
                return;
            }

            // insert web info so
            $data = array(
                'id_web_so_m' => $id_web_so_m,
                'nama_web_user_alamat' => $data_row->nama_web_user_alamat,
                'telp_web_user_alamat' => $data_row->telp_web_user_alamat,
                'provinsi_web_user_alamat' => $data_row->provinsi_web_user_alamat,
                'kota_web_user_alamat' => $data_row->kota_web_user_alamat,
                'kecamatan_web_user_alamat' => $data_row->kecamatan_web_user_alamat,
                'alamat_web_user_alamat' => $data_row->alamat_web_user_alamat,
                'payment_date' => '0000-00-00 00:00:00',
                'payment_ref' => '',
                'payment_notes' => '',
                'delivery_notes_web_so_info' => $delivery_notes
            );

            $insert_id = $this->Cart_model->create_so_info($data);
            if($insert_id){
                if($this->Cart_model->update_cart($update, $id_web_so_m)){

                    // update stok
                    $data_stok = $this->Cart_model->get_cart($id_web_so_m);
                    foreach($data_stok->result_object() as $prod){
                        $this->Cart_model->decrease_stock($prod->ucode_web_product, (int) $prod->qty_so_d);
                    }

                    $bukti_web_so_m = $this->Cart_model->get_so_m_summary($id_web_so_m)->row()->bukti_web_so_m;
                    $notifikasi = array(
                        'id_web_user' => $_SESSION['id_web_user'],
                        'isi_web_notifikasi' => "Pesanan $bukti_web_so_m telah diterima. Silahkan lakukan pembayaran",
                        'is_read' => '0',
                        'timestamp_web_notifikasi' => $date,
                        'url_web_notifikasi' => 'profile/purchase_detail?id='.$bukti_web_so_m
                    );

                    $this->Home_model->add_notification($notifikasi);
                    $this->db->trans_commit();
                    $return_arr = array("Status" => 'OK', "Message" => '');
                } else {
                    $this->db->trans_rollback();
                    $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate alamat');
                }

            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menyimpan alamat');
            }

        } else {
            $this->db->trans_rollback();
            $return_arr = array("Status" => 'ERROR', "Message" => 'Alamat tidak ditemukan');
        }

        echo json_encode($return_arr);
        return;
    }

    function change_qty(){

        $change_id = htmlentities($_REQUEST['change_id'], ENT_QUOTES);
        $change_qty = htmlentities($_REQUEST['change_qty'], ENT_QUOTES);

        //check if qty is number
        if(!preg_match('/^[0-9]+$/', $change_qty)){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Jumlah produk tidak valid!');
            echo json_encode($return_arr);
            return;
        }


        // get so d
        $get_so_d = $this->Cart_model->get_so_d($change_id);

        if($change_qty == '0' || $change_qty == 0){
            $return_arr = array(
                            "Status" => 'ERROR',
                            "Message" => 'Jumlah produk tidak boleh kosong',
                            "Qty" => $get_so_d->row()->qty_so_d
                        );
            echo json_encode($return_arr);
            return;
        }


        if($get_so_d->num_rows() == 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Item tidak ditemukan di keranjang');
            echo json_encode($return_arr);
            return;
        }

        // get product id
        $product = $get_so_d->row()->ucode_web_product;
        // get latest unit price
        $price = $this->Cart_model->get_pricelist($product);

        // get stock
        $get_stock = $this->Cart_model->get_stock($product);

        // check stock
        if((int) $change_qty > (int) $get_stock->row()->stok_web_product){
            $return_arr = array(
                "Status" => 'ERROR',
                "Message" => 'Jumlah produk melebihi stok yang tersedia',
                "Qty" => $get_so_d->row()->qty_so_d);
            echo json_encode($return_arr);
            return;
        }

        if($price->row()->nominal_web_promosi != null)
        {
            $new_nominal = $price->row()->nominal_web_promosi;
            $new_total = $change_qty * $new_nominal;
            $undiscounted_nominal = $change_qty * $price->row()->nominal_web_pricelist;
        } else {
            $new_nominal = $price->row()->nominal_web_pricelist;
            $new_total = $change_qty * $new_nominal;
            $undiscounted_nominal = 0;
        }



        // get previous so_d total price
        $prev_price = $get_so_d->row()->total_price_so_d;


        // update so d unit price & total price
        $update_cart_item = array (
            'qty_so_d'  => $change_qty,
            'unit_price_so_d' => $new_nominal,
            'total_price_so_d' => $new_total
        );

        $this->db->trans_begin();
        if($this->Cart_model->update_cart_item($update_cart_item, $change_id)){
            // update so m total & grand total
            $get_cart = $this->Cart_model->get_so_m_summary($this->get_id_so_m());

            $calc = $get_cart->row()->total_web_so_m - $prev_price + $new_total;
            $grand_calc = $get_cart->row()->grand_total_web_so_m - $prev_price + $new_total;
            $updated_data = array(
                'total_web_so_m' => $calc,
                'grand_total_web_so_m' => $grand_calc
            );

            if($this->Cart_model->update_cart($updated_data, $this->get_id_so_m())){
                $this->db->trans_commit();
                $return_arr = array("Status" => 'OK', "NewTotal" => $new_total, "Undiscounted" => $undiscounted_nominal);
            } else {
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate harga keranjang');
                $this->db->trans_rollback();
            }

        } else {
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal mengupdate item');
            $this->db->trans_rollback();
        }

        echo json_encode($return_arr);

    }

    function remove_from_cart(){
        $return_arr = array();

        $this->db->trans_begin();

        $remove_id = htmlentities($_REQUEST['remove_id'], ENT_QUOTES);

        // update so_m price
        $get_cart = $this->Cart_model->get_so_m_summary($this->get_id_so_m());
        $get_so_d = $this->Cart_model->get_so_d($remove_id);

        if($get_so_d->num_rows() == 0){
            $return_arr = array("Status" => 'ERROR', "Message" => 'Item di keranjang tidak ditemukan');
            echo json_encode($return_arr);
            return;
        }

        if($this->Cart_model->remove_from_cart($remove_id, $this->get_id_so_m())){

            // update harga so_m
            $updated_data = array(
                'total_web_so_m' => $get_cart->row()->total_web_so_m - $get_so_d->row()->total_price_so_d,
                'grand_total_web_so_m' => $get_cart->row()->grand_total_web_so_m - $get_so_d->row()->total_price_so_d
            );

            if($this->Cart_model->update_cart($updated_data, $this->get_id_so_m())){
                $this->db->trans_commit();
                 $return_arr = array("Status" => 'OK', "Message" => '');

            } else {
                $this->db->trans_rollback();
                $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menghapus dari keranjang');
            }

        } else {
            $this->db->trans_rollback();
            $return_arr = array("Status" => 'ERROR', "Message" => 'Gagal menghapus dari keranjang');
        }

        echo json_encode($return_arr);


    }

    function create_so_m($id_web_user)
    {
        date_default_timezone_set('Asia/Jakarta');

        $bukti_web_so_m = $id_web_user.strtotime(date('Y-m-d H:i:s'));
        $id_user_web_so_m = $id_web_user;
        $tgl_web_so_m = date('Y-m-d H:i:s');
        $total_web_so_m = 0.0;
        $perc_disc_web_so_m = 0.0;
        $nominal_disc_web_so_m = 0.0;
        $ongkir_web_so_m = 0.0;
        $ppn_web_so_m = 0.0;
        $grand_total_web_so_m = 0.0;
        $status_web_so_m = '0';

        $data = compact('bukti_web_so_m','id_user_web_so_m','tgl_web_so_m', 'total_web_so_m', 'perc_disc_web_so_m', 'nominal_disc_web_so_m',
                        'ongkir_web_so_m', 'ppn_web_so_m', 'grand_total_web_so_m', 'status_web_so_m');

        $insert_id = $this->Cart_model->create_so_m($data);
        return $insert_id;

    }

    private function get_id_so_m(){
        if(isset($_SESSION['id_web_user'])){
            $unapproved_cart = $this->Home_model->get_user_cart($_SESSION['id_web_user']);
            if($unapproved_cart->num_rows() > 0){
                $id_web_so_m = $unapproved_cart->row()->id_web_so_m;
            } else {
                $id_web_so_m = 0;
            }

        } else {
            if(isset($_SESSION['id_so_m'])){
                $id_web_so_m = $_SESSION['id_so_m'];
            } else {
                $id_web_so_m = 0;
            }
        }

        return $id_web_so_m;
    }


    private function cart_adjustment($id_web_so_m, $return_boolean = false){
        $data = $this->Cart_model->get_cart($id_web_so_m);
        $this->db->trans_begin();
        $different = false;
        $commit = true;


        foreach($data->result_object() as $prod){


            // if there's an inactive product, remove product from cart
            if($prod->active_web_product == '0' || $prod->active_web_catprod == '0' || $prod->active_web_col == '0' || $prod->stok_web_product == 0){
                // update so_m price

                $get_cart = $this->Cart_model->get_so_m_summary($this->get_id_so_m());
                $get_so_d = $this->Cart_model->get_so_d($prod->id_web_so_d);

                if($this->Cart_model->remove_from_cart($prod->id_web_so_d, $this->get_id_so_m())){

                    // update harga so_m
                    $updated_data = array(
                        'total_web_so_m' => $get_cart->row()->total_web_so_m - $get_so_d->row()->total_price_so_d,
                        'grand_total_web_so_m' => $get_cart->row()->grand_total_web_so_m - $get_so_d->row()->total_price_so_d
                    );

                    if($this->Cart_model->update_cart($updated_data, $this->get_id_so_m())){
                    // delete from so_d
                        $different = true;

                    } else {
                        $commit = false;
                    }

                } else {
                    $commit = false;
                }

                $data = $this->Cart_model->get_cart($id_web_so_m);


            } else {
                // if the product's price is different
                if(($prod->unit_price_so_d != $prod->nominal_web_pricelist && is_null($prod->nominal_web_promosi))
                    || ($prod->unit_price_so_d != $prod->nominal_web_promosi && !is_null($prod->nominal_web_promosi))){
                    // if the product is on promotion
                    if($prod->nominal_web_promosi != null && $prod->persen_web_promosi != null){

                        $new_unit_price = $prod->nominal_web_promosi;
                        $new_total_price = $prod->nominal_web_promosi * $prod->qty_so_d;

                    } else {
                        // change unit_price_so_d

                        $new_unit_price = $prod->nominal_web_pricelist;
                        $new_total_price = $prod->nominal_web_pricelist * $prod->qty_so_d;

                    }

                    $update_so_d_price = array(
                        'unit_price_so_d' => $new_unit_price,
                        'total_price_so_d' => $new_total_price
                    );

                    $get_cart = $this->Cart_model->get_so_m_summary($this->get_id_so_m());

                    $calc = $get_cart->row()->total_web_so_m - $prod->total_price_so_d + $new_total_price;
                    $grand_calc = $get_cart->row()->grand_total_web_so_m - $prod->total_price_so_d + $new_total_price;

                    $update_so_m_price = array(
                        'total_web_so_m' => $calc,
                        'grand_total_web_so_m' => $grand_calc
                    );

                    if($this->Cart_model->update_cart_item($update_so_d_price, $prod->id_web_so_d) &&
                        $this->Cart_model->update_cart($update_so_m_price, $id_web_so_m)){
                        $different = true;
                    } else {
                        $commit = false;
                    }

                    $data = $this->Cart_model->get_cart($id_web_so_m);

                }
            }
        }

        if($commit == true){
            $this->db->trans_commit();
        } else {
            $this->db->trans_rollback();
        }

        if($return_boolean){
            return $different;
        } else {
            return $data;
        }

    }

    private function final_stock_check($id_web_so_m){
        $data = $this->Cart_model->get_cart($id_web_so_m);
        $notice = array();

        foreach($data->result_object() as $prod){
            if($prod->qty_so_d > $prod->stok_web_product){
                array_push($notice, "Produk <strong>".$prod->nama_web_product."</strong> tidak memiliki stok yang cukup!");
            }
        }

        return $notice;
    }

}
?>