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

        if ($username == 'admin' and $password == 'admin') {
            redirect('dashboard');
        }
    }

    public function logout()
    {
        redirect('/');
    }
}
