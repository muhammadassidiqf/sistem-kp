<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        if ($user['role'] == 'Mahasiswa') {
            $data = [
                'user' => $user,
                'num_kp' => $riwayat,
                'num_sidang' => $this->model_all->num_sidang(),
                'sidang' => $this->model_all->get_sidang(),
                'kp' => $this->model_all->get_kp(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_mhs', $data);
        } elseif ($user['role'] == 'Dosen') {
            $data = [
                'user' => $user,
                'num_kp_dsn' => $this->model_all->num_row_kp(),
                'num_sidang_dsn' => $this->model_all->num_row_sidang(),
                'kp' => $this->model_all->get_kp_dsn(),
                'sidang' => $this->model_all->get_sidang_dsn(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_dsn', $data);
        } elseif ($user['role'] == 'Koordinator') {
            $data = [
                'user' => $user,
                'num' => $this->model_all->dsn_koor(),
            ];
            // var_dump($data);
            // die;
            $this->template->load('layouts', 'dashboard/dashboard_koor', $data);
        }
    }
}
