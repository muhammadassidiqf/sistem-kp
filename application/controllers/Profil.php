<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function index()
    {
        $user = $this->session->userdata('user');
        $data = [
            'user' => $user
        ];
        $this->template->load('layouts', 'profil/mahasiswa', $data);
    }
}
