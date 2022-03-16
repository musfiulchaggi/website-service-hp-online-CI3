<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
        //method agar user tidak bisa mengakses auth, karena user telah login
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        //trim is for remove space at front or end words

        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $judul['title'] = 'Servisanku.com Log In';
            $this->load->view('templates/auth_header', $judul);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['email' => $email])->row_array();


            //melihat apakah email ada di database
            if ($user != null) {

                //mengecek user aktif
                if ($user['is_active'] == 1) {

                    //mengecek password
                    if (password_verify($password, $user['password'])) {
                        $data = [
                            'email' => $user['email'],
                            'role_id' => $user['role_id']
                        ];

                        $this->session->set_userdata($data);

                        if ($user['role_id'] == 2) {
                            //diarahkan kemenu user
                            redirect('user');
                        } else {
                            //diarahkan kemenu admin
                            redirect('admin');
                        }
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert
                        alert-danger" role="alert">
                        Password Is Wrong!
                        </div>');
                        //<div class="alert
                        // alert-danger" role="alert">
                        // Congratulation! your account has been created. Please Log In.
                        // </div>'
                        //adalah fungsi ci untuk alert 

                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">
                    This Email Is Not Active!
                    Please Check Your Inbox To Activation!
                    </div>');
                    //<div class="alert
                    // alert-danger" role="alert">
                    // Congratulation! your account has been created. Please Log In.
                    // </div>'
                    //adalah fungsi ci untuk alert 

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
                This Email Is Not Yet Registered!
                </div>');
                //<div class="alert
                // alert-danger" role="alert">
                // Congratulation! your account has been created. Please Log In.
                // </div>'
                //adalah fungsi ci untuk alert 

                redirect('auth');
            }
        }
    }


    public function registration()
    {
        //method agar user tidak bisa mengakses auth, karena user telah login
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        //untuk mengaktifkan form_validation harus membuat rules terlebih dahulu

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        //trim is for remove space at front or end words

        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'this email already registered!'
            ]
        );
        //valid_email fungsi untuk mengecek email pada ci
        //is_unique digunakan untuk validasi email ke database

        $this->form_validation->set_rules(
            'password1',
            'Password',
            'required|trim|min_length[8]|matches[password2]',
            [
                'matches' => 'Password dont match!',
                'min_length' => 'Password too short!'
            ]
        );
        //trim is for remove space at front or end words
        //matches for check password2 is match or not

        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        //trim is for remove space at front or end words
        //matches for check password1 is match or not

        if ($this->form_validation->run() == false) {
            //jika form validasi berjalan dan hasilnya false maka akan menampilkan lagi menu login

            $judul['title'] = 'Servisanku.com User Registration';
            $this->load->view('templates/auth_header', $judul);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                //parameter true untuk menghindari crash
                'email' => htmlspecialchars($this->input->post('email', true)),

                'image' => 'default.jpg',

                //enkripsi password menggunakan fungsi yang ada si php
                'password' => password_hash(
                    $this->input->post('password1'),
                    PASSWORD_DEFAULT
                ),

                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];
            //siapkan token menggunakan fungsi php
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $this->input->post('email', true),
                'token' => $token,
                'date_created' => time()

            ];

            //mengirim semua $data ke database
            $this->db->insert('user', $data);

            //mengirim semua $data ke database
            $this->db->insert('user_token', $user_token);


            //kirim email ke user yang baru daftar
            //method yang digunakan adalah modifier private ( _ )
            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Congratulation! your account has been created. </br>Please check your inbox to activation!.
            </div>');
            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert

            redirect('auth');
        }
    }


    public function blocked()
    {
        $this->load->view('auth/blocked');
    }

    private function _sendEmail($token, $type)
    {
        $config = [

            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'musfiulchaggi@gmail.com',
            'smtp_pass' => 'Nawaitu01',
            'smtp_port' => 465,
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'newline' => "\r\n",
            'crlf' => "\r\n"
        ];

        //panggil library email
        $this->load->library('email', $config);
        $this->email->initialize($config);
        //end config


        //membuat isi email
        $this->email->from('falahdian459@gmail.com', 'Servisanku.com');
        $this->email->to($this->input->post('email'));

        //melihat apakah untuk verify atau forgot password
        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : 
                <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') .
                '&token=' . urlencode($token)  . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : 
                <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') .
                '&token=' . urlencode($token)  . '">Reset Password</a>');
        }


        if ($this->email->send()) {
            return true;
        } else {
            $this->email->print_debugger();
        }
    }


    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $judul['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $judul);
            $this->load->view('auth/forgotpassword');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', [
                'email' => $email,
                'is_active' => 1
            ])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                //private method maka harus menggunakan this
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert
                alert-success" role="alert">
                Please check your inbox to reset your password!
                </div>');
                //<div class="alert
                // alert-success" role="alert">
                // Congratulation! your account has been created. Please Log In.
                // </div>'
                //adalah fungsi ci untuk alert

                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
                Email is not registered or activated!
                </div>');
                //<div class="alert
                // alert-success" role="alert">
                // Congratulation! your account has been created. Please Log In.
                // </div>'
                //adalah fungsi ci untuk alert

                redirect('auth/forgotpassword');
            }
        }
    }


    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                //melihat date created
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert
                    alert-success" role="alert">
                    Your email ' . $email . ' has been activated!
                   <br> Please log in.
                    </div>');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">
                    Token expired!
                    </div>');
                    //<div class="alert
                    // alert-danger" role="alert">
                    // Congratulation! your account has been created. Please Log In.
                    // </div>'
                    //adalah fungsi ci untuk alert

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
               Token invalid!
                </div>');
                //<div class="alert
                // alert-danger" role="alert">
                // Congratulation! your account has been created. Please Log In.
                // </div>'
                //adalah fungsi ci untuk alert

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">
            Account Activation Failed!
            <br> Email False!
            </div>');
            //<div class="alert
            // alert-danger" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert

            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert
        alert-success" role="alert">
        You Have Been Log Out!
        </div>');
        //<div class="alert
        // alert-success" role="alert">
        // Congratulation! your account has been created. Please Log In.
        // </div>'
        //adalah fungsi ci untuk alert

        redirect('landingpage');
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {

                //melihat date created
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert
                    alert-danger" role="alert">
                    Token expired!
                    </div>');
                    //<div class="alert
                    // alert-danger" role="alert">
                    // Congratulation! your account has been created. Please Log In.
                    // </div>'
                    //adalah fungsi ci untuk alert

                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert
                alert-danger" role="alert">
                Token invalid!
                </div>');
                //<div class="alert
                // alert-danger" role="alert">
                // Congratulation! your account has been created. Please Log In.
                // </div>'
                //adalah fungsi ci untuk alert

                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert
            alert-danger" role="alert">
            Reset Activation Failed!
            <br> Email False!
            </div>');
            //<div class="alert
            // alert-danger" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert

            redirect('auth');
        }
    }
    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Password', 'trim|required|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $judul['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $judul);
            $this->load->view('auth/changepassword');
            $this->load->view('templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');


            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert
            alert-success" role="alert">
            Password Has Been Change! <br> Please Log in
            </div>');
            //<div class="alert
            // alert-success" role="alert">
            // Congratulation! your account has been created. Please Log In.
            // </div>'
            //adalah fungsi ci untuk alert

            redirect('auth');
        }
    }
}
