<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();

        is_log_in();
    }

    public function index()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'My Profile';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';

        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $this->form_validation->set_rules('name', 'Full Name', 'trim|required');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            //cek upload gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048'; //2000kb
                $config['upload_path'] = './assets/img/profile/'; //from root

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                } else {
                    $old_image = $data['user']['image'];

                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');

                    $this->db->set('image', $new_image);
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Edit Profile successful!
            </div>');

            redirect('user');
        }
    }

    public function changepassword()
    {

        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Change Password';

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');

        if ($this->form_validation->run() == false) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $currentpassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentpassword, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
                 Wrong Password!
                </div>');

                redirect('user/changepassword');
            } else {
                if ($currentpassword == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">
                    New Password cannot be the same as current password! 
                    </div>');

                    redirect('user/changepassword');
                } else {
                    //memasukkan password kedalam database setelah dienkripsi

                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">
                    Save Password Successful!
                    </div>');

                    redirect('user/changepassword');
                }
            }
        }
    }

    public function fixmydevice()
    {
        // menampilkan form yang dibutuhkan untuk proses pemesanan
        $data['title'] = 'Fix My Device';

        // sudah ada session email dan user_id
        // kemudian mengambil satu buah row di tabel user dengan email tersebut
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        // mengambil data dari form
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[150]');
        $this->form_validation->set_rules('nomor_wa', 'Nomor WA', 'trim|required');
        $this->form_validation->set_rules('tipe', 'Tipe', 'trim|required');
        $this->form_validation->set_rules('kerusakan', 'Kerusakan', 'trim|required|max_length[150]');
        // $this->form_validation->set_rules('image', 'Image', 'required');
        //jika kode diatas dijalankan maka file tidak akan pernah diupload


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/fixmydevice', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email');
            $alamat = $this->input->post('alamat');
            $nomor_wa = $this->input->post('nomor_wa');
            $tipe = $this->input->post('tipe');
            $kerusakan = $this->input->post('kerusakan');
            //cek upload gambar

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048'; //2000kb
                $config['upload_path'] = './assets/img/service/'; //from root

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    echo $this->upload->display_errors();
                } else {
                    $new_image = $this->upload->data('file_name');

                    $this->db->set('gambar', $new_image);
                }
            }



            $this->db->set('alamat', $alamat);
            $this->db->set('nomor_wa', $nomor_wa);
            $this->db->set('tipe', $tipe);
            $this->db->set('kerusakan', $kerusakan);
            $this->db->set('email', $email);
            $this->db->set('date_created', time());
            $this->db->insert('service');

            //melihat pengajuan servisan keberapa
            $servisan_ke = 'unknown';
            if ($this->db->get_where('service', [
                'email' => $this->session->userdata('email'),
                'bayar' => 'Lunas'
            ])->num_rows() == 0) {
                $servisan_ke = 'pertama';

                $this->db->set('servisan_ke', $servisan_ke);
                $this->db->where('email', $this->session->userdata('email'));
                $this->db->update('service');
            }


            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Permintaan Servis Terkirim.
            </div>');

            redirect('user/myorder');
        }
    }

    public function myorder()
    {
        // menampilkan form yang dibutuhkan untuk proses pemesanan
        $data['title'] = 'My Order';

        // sudah ada session email dan user_id
        // kemudian mengambil satu buah row di tabel user dengan email tersebut
        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();

        $data['service'] = $this->db->get_where(
            'service',
            ['email' => $this->session->userdata('email')]
        )->result_array();



        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/myorder', $data);
        $this->load->view('templates/footer');
    }

    public function batalkanPesanan($id)
    {
        $id_service = $id;
        $email = $this->session->userdata('email');
        $service = $this->db->get_where('service', [
            'email' => $email,
            'id_service' => $id_service
        ])->row_array();
        unlink(FCPATH . 'assets/img/service/' . $service['gambar']);
        $this->db->where('email', $email);
        $this->db->where('id_service', $id_service);
        $this->db->delete('service');
        redirect('user/myorder');
    }

    public function payment()
    {
        // menampilkan form yang dibutuhkan untuk proses pembayaran
        $data['title'] = 'Payment';
        $email = $this->session->userdata('email');

        $data['user'] = $this->db->get_where(
            'user',
            ['email' => $this->session->userdata('email')]
        )->row_array();


        $this->db->where('email', $email);
        $this->db->where('biaya !=', 0);
        $this->db->where('konfirmasi !=', "Belum Dikonfirmasi");
        $data['service'] = $this->db->get('service')->result_array();

        if ($data['service'] == null) {
            $this->session->set_flashdata('pesan', '<div class="alert
            alert-warning" role="alert">
            Belum Ada Tagihan Pembayaran!
            </div>');
        }
        // sudah ada session email dan user_id
        // kemudian mengambil satu buah row di tabel user dengan email tersebut


        $this->session->set_flashdata('pesan1', '<div class="alert
        alert-warning" role="alert">
        Bukti Pembayaran Anda Telah Berhasil Disimpan!
        <br> Tunggu Proses Validasi!
        </div>');

        $this->session->set_flashdata('pesan2', '<div class="alert
            alert-success" role="alert">
            Pembayaran Anda Telah Divalidasi!
            </div>');
        //<div class="alert
        // alert-success" role="alert">
        // Congratulation! your account has been created. Please Log In.
        // </div>'
        //adalah fungsi ci untuk alert

        $this->form_validation->set_rules('image', 'Gambar', 'callback_validate_image');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/payment', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $email;
            $id = $this->input->post('id');;
            $bukti = $this->input->post('old_image');

            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048'; //2000kb
                $config['upload_path'] = './assets/img/pembayaran/'; //from root

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $this->upload->display_errors();
                } else {
                    $new_image = $this->upload->data('file_name');

                    if ($bukti == 'default.jpg') {

                        $this->db->set('bukti_pembayaran', $new_image);
                        $this->db->where('id_service', $id);
                        $this->db->update('service');

                        redirect('user/payment');
                    } else {
                        unlink(FCPATH . 'assets/img/pembayaran/' . $bukti);

                        $this->db->set('bukti_pembayaran', $new_image);
                        $this->db->where('id_service', $id);
                        $this->db->update('service');

                        redirect('user/payment');
                    }
                }
            }
        }
    }

    public function kirim_barang($id)
    {
        $id = $id;
        $kirim = 'Sudah Dikirimkan';

        if ($id) {
            $this->db->where('id_service', $id);
            $this->db->set('dikirim', $kirim);
            $this->db->update('service');
            redirect('user/payment');
        }
    }


    public function validate_image()
    {
        $check = TRUE;
        if ((!isset($_FILES['image'])) || $_FILES['image']['size'] == 0) {
            $this->form_validation->set_message('validate_image', 'The {field} field is required');
            $check = FALSE;
        } else if (isset($_FILES['image']) && $_FILES['image']['size'] != 0) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
            $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $extension = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
            $detectedType = exif_imagetype($_FILES['image']['tmp_name']);
            $type = $_FILES['image']['type'];
            if (!in_array($detectedType, $allowedTypes)) {
                $this->form_validation->set_message('validate_image', 'Invalid Image Content!');
                $check = FALSE;
            }
            if (filesize($_FILES['image']['tmp_name']) > 2097152) {
                $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 2MB!');
                $check = FALSE;
            }
            if (!in_array($extension, $allowedExts)) {
                $this->form_validation->set_message('validate_image', "Invalid file extension {$extension}");
                $check = FALSE;
            }
        }
        return $check;
    }
}
