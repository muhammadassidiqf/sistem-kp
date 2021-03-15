<?php

class Model_All extends CI_Model
{
    public function get_perusahaan()
    {
        $per = $this->db->get('perusahaan')->result();
        return $per;
    }

    public function get_mahasiswaid()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->db->select('*')->from('mahasiswa')->where('nrp = ' . $user['username'] . '')->get()->row_array();
        return $mhs;
    }

    public function get_dosen()
    {
        $dsn = $this->db->get('dosen')->result();
        return $dsn;
    }

    public function get_kp()
    {
        $mhs = $this->model_all->get_mahasiswaid();
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp left join dosen on dosen.id_dosen = kp.dosen_pemb where kp.dosen_pemb = id_dosen) as nama_pemb')->from('kp');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.id_mahasiswa = ' . $mhs['id_mahasiswa'] . '');
        $kp = $this->db->get()->row_array();
        return $kp;
    }

    public function pemeriksa2()
    {
        $last = $this->db->select('id_kp')
            ->order_by('id_kp', 'desc')
            ->limit(1)
            ->get('kp')->row_array();
        $koor = $this->db->select('*')->from('user')->where('role = "Koordinator"')->get()->row_array();
        $pemeriksa = $this->db->select('*')->from('dosen')->where('nik=' . $koor['username'] . '')->get()->row_array();
        $data = [
            'id_dsn' => $pemeriksa['id_dosen'],
            'id_kp' => $last['id_kp'],
            'statuspemeriksa2' => 'Menunggu'
        ];
        // print_r($data);
        $this->db->insert('pemeriksa2', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function pemeriksa()
    {
        $last = $this->db->select('id_kp')
            ->order_by('id_kp', 'desc')
            ->limit(1)
            ->get('kp')->row_array();
        $data = [
            'id_dsn' => $_POST['dosen'],
            'id_kp' => $last['id_kp'],
            'statuspemeriksa' => 'Menunggu'
        ];
        // print_r($data);
        $this->db->insert('pemeriksa', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function get_profil()
    {
        $user = $this->session->userdata('user');
        if ($user['role'] == 'Mahasiswa') {
            $data = $this->db->select('*')->from('user')->join('mahasiswa', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = ' . $user['username'] . '')->get()->row_array();
        }
        return $data;
    }
}
