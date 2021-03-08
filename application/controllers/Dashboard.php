<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        if ($user['role'] == 'Mahasiswa') {
            $data = [
                'user' => $user
            ];
            $this->template->load('layouts', 'dashboard/dashboard_mhs', $data);
        } elseif ($user['role'] == 'Dosen') {
            $data = [
                'user' => $user
            ];
            $this->template->load('layouts', 'dashboard/dashboard_dsn', $data);
        } elseif ($user['role'] == 'Koordinator') {
            $data = [
                'user' => $user
            ];
            $this->template->load('layouts', 'dashboard/dashboard_koor', $data);
        }
    }
}
