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
        if ($user['role'] == 'Mahasiswa') {
            $mhs = $this->model_all->get_mahasiswaid();
            $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
                ->get('kp')->num_rows();
            $data = [
                'user' => $user,
                'num_kp' => $riwayat,
                'sidang' => $this->model_all->get_sidang(),
                'kp' => $this->model_all->get_kp(),
            ];
            // var_dump($data);
            // die;
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
