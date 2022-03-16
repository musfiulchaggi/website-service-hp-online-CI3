<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_log_in();
    }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Menu Management';

        $data['menu'] = $this->db->get('user_menu')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function addmenu()
    {

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {

            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">
            The Field Must be Filled.
            </div>');
            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert
            redirect('Menu');
        } else {

            $this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Menu Has Been Added.
            </div>');
            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert
            redirect('Menu');
        }
    }

    public function submenu()
    {

        $this->load->model('menu_model');
        $data['title'] = 'Sub Menu Management';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['submenu'] = $this->menu_model->getSubMenu();
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function addsubmenu()
    {
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu_id', 'required');
        $this->form_validation->set_rules('url', 'Url', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">
            The Field Must be Filled.
            </div>');

            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert
            redirect('menu/submenu');
        } else {

            if ($this->input->post('is_active') == 1) {
                $angka = 1;
            } else {
                $angka = 0;
            }

            $this->db->insert(
                'user_sub_menu',
                [
                    'title' => $this->input->post('title'),
                    'menu_id' => $this->input->post('menu_id'),
                    'url' => $this->input->post('url'),
                    'icon' => $this->input->post('icon'),
                    'is_active' => $angka

                ]
            );

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Sub Menu Has Been Added.
            </div>');
            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert
            redirect('menu/submenu');
        }
    }
}
