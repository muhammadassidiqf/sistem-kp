<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
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
        $this->template->load('layouts', 'perusahaan', $data);
    }
}
