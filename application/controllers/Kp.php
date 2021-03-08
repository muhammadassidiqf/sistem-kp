<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kp extends CI_Controller
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
            'perusahaan' => $this->model_all->get_perusahaan(),
            'mhs' => $this->model_all->get_mahasiswaid(),
            'dosen' => $this->model_all->get_dosen()
        ];
        $this->template->load('layouts', 'kp/aju_kp', $data);
    }

    public function aju_sidang()
    {
        $user = $this->session->userdata('user');
        $data = [
            'user' => $user
        ];
        $this->template->load('layouts', 'kp/aju_sidang', $data);
    }

    public function bimbingan()
    {
        $user = $this->session->userdata('user');
        $data = [
            'user' => $user
        ];
        $this->template->load('layouts', 'kp/bimbingan', $data);
    }

    public function sidang()
    {
        $user = $this->session->userdata('user');
        $data = [
            'user' => $user
        ];
        $this->template->load('layouts', 'kp/sidang', $data);
    }

    public function tambah_kp()
    {
        $this->form_validation->set_rules('nrp', 'nrp', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');
        $this->form_validation->set_rules('perusahaan', 'perusahaan', 'required');
        $this->form_validation->set_rules('penugasan', 'nama', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('pengajuan');
        } else {
            $mhs = $this->model_all->get_mahasiswaid();
            $data = [
                'id_mahasiswa' => $mhs['id_mahasiswa'],
                'id_perusahaan' => $_POST['perusahaan'],
                'penugasan' => $_POST['penugasan'],
                'tanggal' => date('Y-m-d'),
                'status' => 'Menunggu',
                'status2' => 'Menunggu'
            ];
            $kp = $this->db->insert('kp', $data);
            // var_dump($data);
            // die;
            if ($kp) {
                $this->model_all->pemeriksa();
                $this->model_all->pemeriksa2();
                redirect('dashboard');
            }
        }
    }
}
