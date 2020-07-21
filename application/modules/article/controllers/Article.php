<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Article extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Article_model');
    }

    function index(){

    }

    function find(){
        $article_url = htmlentities(func_get_arg(0), ENT_QUOTES);

        $this->load->view('template/header');
        $this->load->view($article_url);
        $this->load->view('template/footer');
    }


}
?>