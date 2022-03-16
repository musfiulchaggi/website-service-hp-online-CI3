<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Landingpage extends CI_Controller
{
    public function __construct()
    {

        parent::__construct();
        // untuk mengambil fungsi yang ada di construct

        $this->load->library('form_validation');
        //memanggil form validation

    }

    public function index()
    {
        $data = ['title' => 'Home'];
        $this->load->view('landingpage/v_header', $data);
        $this->load->view('landingpage/v_landing_page');
        $this->load->view('landingpage/v_footer');
    }
}
