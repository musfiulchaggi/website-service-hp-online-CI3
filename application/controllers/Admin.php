<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_log_in();
    }
    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role';

        //mendapatkan role
        $data['role'] = $this->db->get('user_role')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role', $data);
        $this->load->view('templates/footer');
    }

    public function roleaccess($role_id)
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Role Access';


        //mendapatkan role
        $data['role'] = $this->db->get_where('user_role', ['id_role' => $role_id])->row_array();


        $this->db->where('id !=', 1);
        //fungsi $this->db->where('id !=', 1); merupakan fungsi untuk method dibawah nya
        $data['menu'] = $this->db->get('user_menu')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/roleaccess', $data);
        $this->load->view('templates/footer');
    }

    public function changeaccess()
    {
        $menu_id = $this->input->post('menuId');
        $role_id = $this->input->post('roleId');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];

        $result = $this->db->get_where('user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('user_access_menu', $data);
        } else {
            $this->db->delete('user_access_menu', $data);
        }

        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">
        Access Change!
        </div>');
    }
    public function permintaan_service()
    {
        $data['title'] = 'Permintaan Service';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['permintaan'] = $this->db->get_where('service', ['konfirmasi' => 'Belum Dikonfirmasi'])->result_array();

        $data['diterima'] = $this->db->get_where('service', ['konfirmasi' => 'Diterima'])->result_array();
        $data['ditolak'] = $this->db->get_where('service', ['konfirmasi' => 'Ditolak'])->result_array();


        if ($data['permintaan'] == null) {
            $this->session->set_flashdata('message', '<div class="alert
            alert-warning" role="alert">
            Tidak Ada Permintaan Service.
            </div>');
        }

        $this->form_validation->set_rules('biaya', 'Biaya', 'required|trim');
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('service/permintaan_service', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->where('id_service', $this->input->post('id'));
            $this->db->set('konfirmasi', 'Diterima');
            $this->db->set('biaya', $this->input->post('biaya'));

            $this->db->update('service');

            redirect('admin/permintaan_service');
        }
    }

    public function konfirmasi($perintah, $id)
    {
        $perintah = $perintah;
        if ($perintah == 'ditolak') {
            $this->db->where('id_service', $id);
            $this->db->set('konfirmasi', 'Ditolak');
            $this->db->update('service');

            redirect('admin/permintaan_service');
        } else {
            $this->db->where('id_service', $id);
            $this->db->set('konfirmasi', 'Belum Dikonfirmasi');
            $this->db->update('service');

            redirect('admin/permintaan_service');
        }
    }

    public function sedang_dikerjakan()
    {
        $data['title'] = 'Sedang Dikerjakan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['belum_dikerjakan'] = $this->db->get_where('service', ['selesai' => 'Belum Dikerjakan', 'konfirmasi' => 'Diterima'])->result_array();

        $data['dikerjakan'] = $this->db->get_where('service', ['selesai' => 'Sedang Dikerjakan'])->result_array();
        $data['selesai_dikerjakan'] = $this->db->get_where('service', ['selesai' => 'Selesai Dikerjakan'])->result_array();

        if ($data['belum_dikerjakan'] == null) {
            $this->session->set_flashdata('pesan1', '<div class="alert
            alert-warning" role="alert">
            Tidak Ada Pelanggan Yang Mengirimkan Barang Servisan!
            </div>');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('service/sedang_dikerjakan', $data);
        $this->load->view('templates/footer');

        $method = $this->input->post('method');
        if ($method == 'kerjakan') {
            $id = $this->input->post('id');
            $this->db->set('selesai', 'Sedang Dikerjakan');
            $this->db->where('id_service', $id);
            $this->db->update('service');
            redirect('admin/sedang_dikerjakan');
        } else if ($method == 'selesai') {
            $id = $this->input->post('id');
            $this->db->set('selesai', 'Selesai Dikerjakan');
            $this->db->where('id_service', $id);
            $this->db->update('service');
            redirect('admin/sedang_dikerjakan');
        }
    }

    public function pembayaran()
    {
        $data['title'] = 'Pembayaran';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['selesai_dikerjakan'] = $this->db->get_where('service', [
            'selesai' => 'Selesai Dikerjakan',
            'bayar' => 'Belum Dibayar'
        ])->result_array();

        $data['lunas'] = $this->db->get_where('service', ['bayar' => 'Lunas', 'pengiriman_barang_servisan' => 'Belum Dikirim'])->result_array();

        $data['dikirimkan'] = $this->db->get_where('service', ['pengiriman_barang_servisan' => 'Sudah Dikirimkan'])->result_array();


        if ($data['selesai_dikerjakan'] == null) {
            $this->session->set_flashdata('pesan', '<div class="alert
            alert-warning" role="alert">
            Belum ada Servisan Yang selesai Dikerjakan!
            <br> Harap Segera menyelesaikan Pekerjaan!
            <br> Semangat!!!
            </div>');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('service/selesai_dikerjakan', $data);
        $this->load->view('templates/footer');

        $method = $this->input->post('method');
        if ($method == 'validasi') {
            $id = $this->input->post('id');
            $this->db->set('bayar', 'Lunas');
            $this->db->where('id_service', $id);
            $this->db->update('service');
            redirect('admin/pembayaran');
        } else if ($method == 'kirim') {
            $id = $this->input->post('id');
            $this->db->set('pengiriman_barang_servisan', 'Sudah Dikirimkan');
            $this->db->where('id_service', $id);
            $this->db->update('service');
            redirect('admin/pembayaran');
        }
    }
}
