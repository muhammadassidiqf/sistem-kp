<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Model_All');
    }

    public function index()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        if ($user['role'] == 'Mahasiswa') {
            $data = [
                'user' => $user,
                'num_kp' => $riwayat,
                'num_sidang' => $this->Model_All->num_sidang(),
                'sidang' => $this->Model_All->get_sidang(),
                'kp' => $this->Model_All->get_kp(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_mhs', $data);
        } elseif ($user['role'] == 'Dosen') {
            $data = [
                'user' => $user,
                'num_kp_dsn' => $this->Model_All->num_row_kp(),
                'num_sidang_dsn' => $this->Model_All->num_row_sidang(),
                'kp' => $this->Model_All->get_kp_dsn(),
                'sidang' => $this->Model_All->get_sidang_dsn(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_dsn', $data);
        } elseif ($user['role'] == 'Koordinator') {
            $data = [
                'user' => $user,
                'num' => $this->Model_All->dsn_koor(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_koor', $data);
        }
    }
}
