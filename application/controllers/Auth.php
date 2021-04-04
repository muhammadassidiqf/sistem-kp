<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $this->form_validation->set_rules('username', 'username', 'required|trim');
        $this->form_validation->set_rules('password', 'password', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('auth/login');
        } else {
            $this->login();
        }
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // var_dump($user);
        // die;
        if ($username) {
            $user = $this->db->get_where('user', ['username' => $username])->row_array();
            if ($password == $user['password']) {
                $user = $this->db->select('user.*')->from('user')->where('user.username="' . $_POST['username'] . '" AND user.password="' . $_POST['password'] . '"')->get()->row_array();
                if (($user['role'] == 'Dosen') or ($user['role'] == 'Koordinator')) {
                    $prof = $this->db->select('dosen.nama')->from('dosen')->join('user', 'dosen.nik = user.username', 'left')->where('dosen.nik = "' . $user['username'] . '"')->get()->row_array();
                    $data = [
                        'user' => $user,
                        'name' => $prof
                    ];
                } elseif ($user['role'] == 'Mahasiswa') {
                    $prof = $this->db->select('mahasiswa.nama')->from('mahasiswa')->join('user', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = "' . $user['username'] . '"')->get()->row_array();
                    $data = [
                        'user' => $user,
                        'name' => $prof
                    ];
                }
                $this->session->set_userdata($data);
                redirect('dashboard');
            } else {
                redirect('/');
            }
            // var_dump($username);
            // die;
        } else {
            redirect('/');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}
