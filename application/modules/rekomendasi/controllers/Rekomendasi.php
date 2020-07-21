<?php


class Rekomendasi extends MX_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Rekomendasi_model');
    }

    function index(){
        $this->load->view('template/header');
        $this->load->view('main');
        $this->load->view('template/footer');
    }

    function get_rekomendasi(){
        $limit = null;
        $offset = null;

        if(isset($_REQUEST['limit']) && isset($_REQUEST['offset'])) {
            $limit = htmlentities($_REQUEST['limit'], ENT_QUOTES);
            $offset = htmlentities($_REQUEST['offset'], ENT_QUOTES);
        }

        if(isset($_SESSION['id_web_user'])){
            $data = $this->Rekomendasi_model->get_rekomendasi_by_user(0, $limit, $offset);
        } else {
            $data = $this->Rekomendasi_model->get_all_rekomendasi(0, $limit, $offset);
        }


        echo json_encode($data->result_object());
        return;
    }

}