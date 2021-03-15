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
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'prof' => $this->model_all->get_profil(),
            'num_kp' => $riwayat,
        ];
        $this->template->load('layouts', 'profil/mahasiswa', $data);
        // var_dump($data);
        // die;
    }

    public function edit()
    {
        $this->form_validation->set_rules('newpass', 'password', 'required|matches[confirm_pass]');
        $this->form_validation->set_rules('confirm_pass', 'confirm_password', 'required|matches[newpass]');
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('gagalubah', "Data Gagal Di Diubah");
            redirect('profil');
        } else {
            $user = $this->session->userdata('user');
            if ($user['role'] == 'Mahasiswa') {
                $password = [
                    'password' => $_POST['newpass']
                ];
                $this->db->where('username', $user['username']);
                $this->db->update('user', $password);
                $data = [
                    'email' => $_POST['email'],
                    'no_telp' => $_POST['no_telp'],
                ];
                $this->db->where('nrp', $_POST['nrp']);
                $this->db->update('mahasiswa', $data);
            }
            $this->session->set_flashdata('suksesubah', "Data Berhasil Diubah");
            redirect('profil');
        }
    }
}
