<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('model_all');
    }

    public function index()
    {
        $user = $this->session->userdata('user');
        $data = [
            'user' => $user,
            'prof' => $this->model_all->get_profil()
        ];
        $this->template->load('layouts', 'profil/mahasiswa', $data);
        // var_dump($data);
        // die;
    }
}
