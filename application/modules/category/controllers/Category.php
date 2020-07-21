<?php


class Category extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Category_model');
        $this->load->model('profile/Profile_model');
    }

    function index(){
        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');
    }

    function get_category(){
        $data = $this->Category_model->get_category();
        echo json_encode($data->result_object());
        return;
    }

    function get_color(){
        $data = $this->Category_model->get_color();
        echo json_encode($data->result_object());
        return;
    }

    function get_all_products(){

        if($this->session->userdata('email_web_user')){
            $id_web_user = $this->session->userdata('id_web_user');
        } else {
            $id_web_user = 0;
        }

        $filters = array();
        $group_by = null;
        $warna_filter = '';
        $ukuran_filter = '';
        $sort_by = 'a.nama_web_product ASC';
        $limit = null;
        $offset = null;


        if(isset($_REQUEST['filter'])){
            if(isset($_REQUEST['filter']['warna'])){
                foreach($_REQUEST['filter']['warna'] as $warna){
                    if(empty($warna_filter)){
                        $warna_filter .= "(c.ucode_web_col = '".htmlentities($warna, ENT_QUOTES)."'";
                    } else {
                        $warna_filter .= " OR c.ucode_web_col = '".htmlentities($warna, ENT_QUOTES)."'";
                    }
                }
                $warna_filter .= ")";
                array_push($filters, $warna_filter);
            }

            if(isset($_REQUEST['filter']['harga'])){
                $harga_filter = "(IF(h.nominal_web_promosi IS NULL, d.nominal_web_pricelist, h.nominal_web_promosi) 
                                BETWEEN ".htmlentities($_REQUEST['filter']['harga']['min-harga'], ENT_QUOTES)." 
                                AND ".htmlentities($_REQUEST['filter']['harga']['max-harga'], ENT_QUOTES).")";


                array_push($filters, $harga_filter);
            }

            if(isset($_REQUEST['filter']['ukuran'])){
                $ukuran_filter .= "(a.length_web_product BETWEEN ".htmlentities($_REQUEST['filter']['ukuran']['min-panjang'], ENT_QUOTES)." AND ".htmlentities($_REQUEST['filter']['ukuran']['max-panjang'], ENT_QUOTES).")";

                $ukuran_filter .= " AND (a.width_web_product BETWEEN ".htmlentities($_REQUEST['filter']['ukuran']['min-lebar'], ENT_QUOTES)." AND ".htmlentities($_REQUEST['filter']['ukuran']['max-lebar'], ENT_QUOTES).")";

                $ukuran_filter .= " AND (a.height_web_product BETWEEN ".htmlentities($_REQUEST['filter']['ukuran']['min-tinggi'], ENT_QUOTES)." AND ".htmlentities($_REQUEST['filter']['ukuran']['max-tinggi'], ENT_QUOTES).")";
                array_push($filters, $ukuran_filter);
            }
        }

        if(isset($_REQUEST['group_by'])){
            if($_REQUEST['group_by'] == 'color'){
                $group_by = 'c.ucode_web_col';
            }
        }

        if(isset($_REQUEST['filter']['sortir'])){
            $sort_by = htmlentities($_REQUEST['filter']['sortir'], ENT_QUOTES);
        }

        if(isset($_REQUEST['limit']) && isset($_REQUEST['offset'])) {
            $limit = htmlentities($_REQUEST['limit'], ENT_QUOTES);
            $offset = htmlentities($_REQUEST['offset'], ENT_QUOTES);
        }

        $data = $this->Category_model->get_all_products(
            htmlentities($_REQUEST['cat'], ENT_QUOTES), $id_web_user, $filters, $group_by, $sort_by, $limit, $offset
        );


        if($id_web_user && isset($_REQUEST['activity'])) {
            // add to activity
            $this->add_to_activity($id_web_user, $data->row()->nama_web_catprod);
        }
        echo json_encode($data->result_object());
        return;
    }

    private function add_to_activity($id_web_user, $nama_web_catprod){

        date_default_timezone_set('Asia/Jakarta');

        // check if activity exists in database
        $check = $this->Profile_model->get_activity_plain($id_web_user, 'CATEGORY', trim($nama_web_catprod));

        if($check->num_rows() > 0){
            //update
            $id_web_user_activity = $check->row()->id_web_user_activity;
            $new_count = (int) $check->row()->count_web_user_activity + 1;
            $updated_data = array(
                'count_web_user_activity' => $new_count,
                'timestamp_web_user_activity' => date('Y-m-d H:i:s')
            );

            $this->Profile_model->update_user_activity($id_web_user_activity, $updated_data);
        } else {
            $activity_data = array(
                'id_web_user' => $id_web_user,
                'tipe_web_user_activity' => 'CATEGORY',
                'detail_web_user_activity' => $nama_web_catprod,
                'count_web_user_activity' => 1,
                'timestamp_web_user_activity' => date('Y-m-d H:i:s')
            );

            $insert_id = $this->Profile_model->add_user_activity($activity_data);
            if(!$insert_id){
                $return_arr = array("Status" => 'ERROR', "Message" => 'Error User Activity');
                echo json_encode($return_arr);
            }


            return;
        }


    }


    function get_max_min(){
        $data = $this->Category_model->get_all_products($_REQUEST['cat'], 0);

        $final_array = array();
        $harga_array = array();
        $panjang_array = array();
        $lebar_array = array();
        $tinggi_array = array();

        foreach($data->result_object() as $prod){
            array_push($harga_array, $prod->final_price);
            array_push($panjang_array, $prod->length_web_product);
            array_push($lebar_array, $prod->width_web_product);
            array_push($tinggi_array, $prod->height_web_product);
        }

        if(!empty($harga_array)){
            $final_array['min_harga'] = min($harga_array);
            $final_array['max_harga'] = max($harga_array);

        } else {
            $final_array['min_harga'] = 0;
            $final_array['max_harga'] = 0;
        }

        if(!empty($panjang_array)){
            $final_array['min_panjang'] = min($panjang_array);
            $final_array['max_panjang'] = max($panjang_array);

        } else {
            $final_array['min_panjang'] = 0;
            $final_array['max_panjang'] = 0;
        }

        if(!empty($lebar_array)){
            $final_array['min_lebar'] = min($lebar_array);
            $final_array['max_lebar'] = max($lebar_array);

        } else {
            $final_array['min_lebar'] = 0;
            $final_array['max_lebar'] = 0;
        }

        if(!empty($tinggi_array)){
            $final_array['min_tinggi'] = min($tinggi_array);
            $final_array['max_tinggi'] = max($tinggi_array);

        } else {
            $final_array['min_tinggi'] = 0;
            $final_array['max_tinggi'] = 0;
        }

        echo json_encode($final_array);
        return;
    }

    function get_category_name(){
        $data = $this->Category_model->get_category_name(htmlentities($_REQUEST['cat'], ENT_QUOTES));
        echo json_encode($data->result_object());
        return;
    }

}