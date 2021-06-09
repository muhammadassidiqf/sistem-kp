<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kp extends CI_Controller
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
        $data = [
            'user' => $user,
            'perusahaan' => $this->Model_All->get_perusahaan(),
            'mhs' => $this->Model_All->get_mahasiswaid(),
            'kp' => $this->Model_All->get_kp(),
            'num_kp' => $riwayat,
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/aju_kp', $data);
    }

    public function aju_sidang()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'mhs' => $this->Model_All->get_mahasiswaid(),
            'kp' => $this->Model_All->get_kp(),
            'num_kp' => $riwayat,
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        $this->template->load('layouts', 'kp/aju_sidang', $data);
        // var_dump($data);
        // die;
    }

    public function bimbingan()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kp_dsn(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/bimbingan', $data);
    }

    public function bimbingan_mhs()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kp(),
            'bimbingan' => $this->Model_All->get_bimbmhs(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/edit_bimbingan_mhs', $data);
    }

    public function edit_bimbingan($id)
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kp(),
            'bimbingan' => $this->Model_All->get_bimbid($id),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/edit_bimbingan', $data);
    }

    public function sidang()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kp(),
            'sidang' => $this->Model_All->get_sidang_dsn(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/sidang', $data);
    }

    public function sidang_mhs()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kp(),
            'sidang' => $this->Model_All->get_sidang_mhs(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/sidang', $data);
    }

    public function tambah_kp()
    {
        $this->form_validation->set_rules('nrp', 'nrp', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        // $this->form_validation->set_rules('no_telp', 'no_telp', 'required');
        $this->form_validation->set_rules('perusahaan', 'perusahaan', 'required');
        $this->form_validation->set_rules('penugasan', 'penugasan', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Anda Gagal mengajukan Kerja Praktik");
            redirect('pengajuan');
        } else {
            $mhs = $this->Model_All->get_mahasiswaid();
            $data = [
                'id_mahasiswa' => $mhs['id_mahasiswa'],
                'id_perusahaan' => $_POST['perusahaan'],
                'penugasan' => $_POST['penugasan'],
                // 'dosen' => $_POST['dosen'],
                'tanggal' => date('Y-m-d'),
                'status' => 'Menunggu',
                'status2' => 'Menunggu'
            ];
            $kp = $this->db->insert('kp', $data);
            // var_dump($data);
            // die;
            if ($kp) {
                $this->Model_All->pengirim();
                $this->Model_All->pemeriksa();
                $this->Model_All->pemeriksa2();
                $this->session->set_flashdata('success', "Anda berhasil mengajukan Kerja Praktik");
                redirect('dashboard');
            }
        }
    }

    public function tambah_sidang()
    {
        $this->form_validation->set_rules('id_kp', 'id_kp', 'required');
        $this->form_validation->set_rules('dosen_pemb', 'dosen_pemb', 'required');
        $this->form_validation->set_rules('tgl_pengajuan', 'tgl_pengajuan', 'required');
        $this->form_validation->set_rules('judul', 'judul', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', "Anda Gagal menambahkan pengejuan");
            redirect('pengajuan_sidang');
        } else {
            $mhs = $this->Model_All->get_mahasiswaid();
            $data = [
                'id_mahasiswa' => $mhs['id_mahasiswa'],
                'id_kp' => $_POST['id_kp'],
                'tanggal' => date('Y-m-d'),
                'tgl_pengajuan' => date('Y-m-d', strtotime($_POST['tgl_pengajuan'])),
                'judul' => $_POST['judul'],
                'status' => 'Menunggu',
                'status2' => 'Menunggu'
            ];
            // var_dump($data);
            // die;
            $sidang = $this->db->insert('sidang', $data);
            if ($sidang) {
                $this->Model_All->pengirim_sidang();
                $this->Model_All->pemeriksa_sidang();
                $this->Model_All->pemeriksa2_sidang();
                $this->session->set_flashdata('success', "Anda berhasil menambahkan pengejuan");
                redirect('dashboard');
            }
        }
    }

    public function edit_kp($id)
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'kp' => $this->Model_All->get_kpid($id),
            'dosen' => $this->Model_All->get_dosen(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data['prof'] = $this->Model_All->get_profil_dsn();
        }
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/edit_kp', $data);
    }

    public function edit_sidang($id)
    {
        $user = $this->session->userdata('user');
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('kp')->num_rows();
        $data = [
            'user' => $user,
            'num_kp' => $riwayat,
            'sidang' => $this->Model_All->get_sidangid($id),
            'dosen' => $this->Model_All->get_dosen(),
            'num_sidang' => $this->Model_All->num_sidang(),
        ];
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data['prof'] = $this->Model_All->get_profil_dsn();
        }
        // var_dump($data);
        // die;
        $this->template->load('layouts', 'kp/edit_sidang', $data);
    }

    function acc_pemeriksa($id)
    {
        $updpeng = $this->db->set('status', 'Disetujui')->where('id_kp', $id)->update('kp');
        if ($updpeng) {
            $this->db->set('statuspemeriksa', 'Disetujui')->where('id_kp', $id)->update('pemeriksa');
            $this->db->set('statuspemeriksa2', 'Menunggu')->where('id_kp', $id)->update('pemeriksa2');
        }
        $this->session->set_flashdata('success', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    function acc_pemeriksa2($id)
    {
        $updpeng = $this->db->set('status2', 'Disetujui')->where('id_kp', $id)->update('kp');
        if ($updpeng) {
            $this->db->set('statuspemeriksa2', 'Disetujui')->where('id_kp', $id)->update('pemeriksa2');
            $this->db->set('statuspengirim', 'Disetujui')->where('id_kp', $id)->update('pengirim');
        }
        $this->session->set_flashdata('success', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
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
        $this->session->set_flashdata('success', "Pengajuan tidak disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    public function update_pemb($id)
    {
        $this->db->set('dosen_pemb', $_POST['dosen_pemb'])->where('id_kp', $id)->update('kp');
        $this->session->set_flashdata('success', "Data berhasil diperbarui");
        redirect('masuk');
    }

    function acc_pemeriksa_sidang($id)
    {
        $updpeng = $this->db->set('status', 'Disetujui')->where('id_sidang', $id)->update('sidang');
        if ($updpeng) {
            $this->db->set('statuspemeriksa', 'Disetujui')->where('id_sidang', $id)->update('pemeriksa');
            $this->db->set('statuspemeriksa2', 'Menunggu')->where('id_sidang', $id)->update('pemeriksa2');
        }
        $this->session->set_flashdata('success', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    function acc_pemeriksa2_sidang($id)
    {
        $updpeng = $this->db->set('status2', 'Disetujui')->where('id_sidang', $id)->update('sidang');
        if ($updpeng) {
            $this->db->set('statuspemeriksa2', 'Disetujui')->where('id_sidang', $id)->update('pemeriksa2');
            $this->db->set('statuspengirim', 'Disetujui')->where('id_sidang', $id)->update('pengirim');
        }
        $this->session->set_flashdata('success', "Pengajuan telah disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    function dec_pemeriksa_sidang($id)
    {
        $updpeng = $this->db->set('status', 'Tidak Disetujui')->where('id_sidang', $id)->update('sidang');
        $updpeng1 = $this->db->set('status2', 'Tidak Disetujui')->where('id_sidang', $id)->update('sidang');
        if ($updpeng && $updpeng1) {
            $this->db->set('statuspemeriksa2', 'Tidak Disetujui')->where('id_sidang', $id)->update('pemeriksa2');
            $this->db->set('statuspemeriksa', 'Tidak Disetujui')->where('id_sidang', $id)->update('pemeriksa');
            $this->db->set('statuspengirim', 'Tidak Disetujui')->where('id_sidang', $id)->update('pengirim');
        }
        $this->session->set_flashdata('success', "Pengajuan tidak disetujui oleh Anda sebagai pemeriksa!");
        redirect('masuk');
    }

    public function update_peng($id)
    {
        $this->db->set('dosen_png', $_POST['dosen_peng'])->where('id_sidang', $id)->update('sidang');
        $this->session->set_flashdata('success', "Data berhasil diperbarui");
        redirect('masuk');
    }

    public function tambah_bimbingan()
    {
        $this->form_validation->set_rules('id_kp', 'id_kp', 'required');
        $this->form_validation->set_rules('kegiatan', 'kegiatan', 'required');
        // $this->form_validation->set_rules('tgl_bimbingan', 'tgl_bimbingan', 'required');
        if ($this->form_validation->run() == FALSE) {
            redirect('bimbingan');
        } else {
            $data = [
                'id_kp' => $_POST['id_kp'],
                'tgl_bimbingan' => date('Y-m-d', strtotime($_POST['tgl_bimbingan'])),
                'kegiatan' => $_POST['kegiatan'],
                'status' => 'Menunggu',
            ];
            // var_dump($data);
            // die;
            $this->db->insert('bimbingan', $data);
            $this->session->set_flashdata('success', "Bimbingan berhasil ditambahkan");
            redirect('dashboard');
        }
    }

    function acc_bimbingan($id)
    {
        $this->db->set('status', 'Disetujui')->where('id_bimbingan', $id)->update('bimbingan');
        $this->session->set_flashdata('success', "Bimbingan telah disetujui oleh Anda");
        redirect('bimbingan');
    }

    function dec_bimbingan($id)
    {
        $this->db->set('status', 'Tidak Disetujui')->where('id_bimbingan', $id)->update('bimbingan');
        $this->session->set_flashdata('success', "Bimbingan tidak disetujui oleh Anda");
        redirect('bimbingan');
    }

    function edit_link($id)
    {
        $this->db->set('link', $_POST['link'])->where('id_sidang', $id)->update('sidang');
        $this->session->set_flashdata('success', "Data berhasil diperbarui");
        redirect('dashboard');
    }
}
