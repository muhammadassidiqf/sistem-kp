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
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'perusahaan' => $this->model_all->get_perusahaan(),
            'mhs' => $this->model_all->get_mahasiswaid(),
            'dosen' => $this->model_all->get_dosen(),
            'num_kp' => $riwayat
        ];
        $this->template->load('layouts', 'kp/aju_kp', $data);
    }

    public function aju_sidang()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'mhs' => $this->model_all->get_mahasiswaid(),
            'kp' => $this->model_all->get_kp(),
            'num_kp' => $riwayat
        ];
        $this->template->load('layouts', 'kp/aju_sidang', $data);
        // var_dump($data);
        // die;
    }

    public function bimbingan()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat
        ];
        $this->template->load('layouts', 'kp/bimbingan', $data);
    }

    public function sidang()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
        ];
        $this->template->load('layouts', 'kp/sidang', $data);
    }

    public function tambah_kp()
    {
        $this->form_validation->set_rules('nrp', 'nrp', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('no_telp', 'no_telp', 'required');
        $this->form_validation->set_rules('perusahaan', 'perusahaan', 'required');
        $this->form_validation->set_rules('penugasan', 'penugasan', 'required');
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
                $this->model_all->pengirim();
                $this->model_all->pemeriksa();
                $this->model_all->pemeriksa2();
                redirect('dashboard');
            }
        }
    }

    public function edit_kp()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->model_all->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->model_all->masuk(),
        ];
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data['prof'] = $this->model_all->get_profil_dsn();
        }
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/edit_kp', $data);
    }

    function acc_pemeriksa($id)
    {
        $updpeng = $this->db->set('status', 'Disetujui')->where('id_kp', $id)->update('kp');
        if ($updpeng) {
            $this->db->set('statuspemeriksa', 'Disetujui')->where('id_kp', $id)->update('pemeriksa');
            $this->db->set('statuspemeriksa2', 'Menunggu')->where('id_kp', $id)->update('pemeriksa2');
        }
        $this->session->set_flashdata('sukses_pemeriksa', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    function acc_pemeriksa2($id)
    {
        $updpeng = $this->db->set('status2', 'Disetujui')->where('id_kp', $id)->update('kp');
        if ($updpeng) {
            $this->db->set('statuspemeriksa2', 'Disetujui')->where('id_kp', $id)->update('pemeriksa2');
            $this->db->set('statuspengirim', 'Disetujui')->where('id_kp', $id)->update('pengirim');
        }
        $this->session->set_flashdata('sukses_pemeriksa', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    function dec_pemeriksa($id)
    {
        $updpeng = $this->db->set('status', 'Tidak Disetujui')->where('id_kp', $id)->update('kp');
        $updpeng1 = $this->db->set('status2', 'Tidak Disetujui')->where('id_kp', $id)->update('kp');
        if ($updpeng && $updpeng1) {
            $this->db->set('statuspemeriksa2', 'Tidak Disetujui')->where('id_kp', $id)->update('pemeriksa2');
            $this->db->set('statuspemeriksa', 'Tidak Disetujui')->where('id_kp', $id)->update('pemeriksa');
            $this->db->set('statuspengirim', 'Tidak Disetujui')->where('id_kp', $id)->update('pengirim');
        }
        $this->session->set_flashdata('gagal_pemeriksa', "Pengajuan tidak disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }
}
