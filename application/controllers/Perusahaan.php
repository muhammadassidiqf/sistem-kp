<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perusahaan extends CI_Controller
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
        $data = [
            'user' => $user,
            'num_kp' => $riwayat
        ];
        $this->template->load('layouts', 'perusahaan', $data);
    }

    public function tambah()
    {
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('perusahaan');
        } else {
            $data = [
                'nama' => $_POST['nama'],
                'alamat' => $_POST['alamat'],
                'email' => $_POST['email'],
                'no_telp' => $_POST['no_telp'],
            ];
            $this->db->insert('perusahaan', $data);
            redirect('dashboard');
            // var_dump($data);
            // die;
        }
    }
}
