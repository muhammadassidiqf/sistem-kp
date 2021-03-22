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
            'statuspemeriksa2' => 'Tertunda'
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

    public function pengirim()
    {
        $last = $this->db->select('id_kp')
            ->order_by('id_kp', 'desc')
            ->limit(1)
            ->get('kp')->row_array();
        $data = [
            'id_mhs' => $_POST['id_mhs'],
            'id_kp' => $last['id_kp'],
            'statuspengirim' => 'Menunggu'
        ];
        // print_r($data);
        $this->db->insert('pengirim', $data);
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

    public function get_profil_dsn()
    {
        $user = $this->session->userdata('user');
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data = $this->db->select('*')->from('user')->join('dosen', 'dosen.nik = user.username', 'left')->where('dosen.nik = ' . $user['username'] . '')->get()->row_array();
        }
        return $data;
    }

    public function masuk()
    {
        $user = $this->session->userdata('user');
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data = $this->db->select('*')->from('user')->join('dosen', 'dosen.nik = user.username', 'left')->where('dosen.nik = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp left join dosen on dosen.id_dosen = kp.dosen_pemb where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= (select perusahaan.id_perusahaan from kp join perusahaan on kp.id_perusahaan=perusahaan.id_perusahaan where kp.id_kp = pemeriksa2.id_kp)', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=(select dosen.id_dosen from kp join dosen on kp.id_perusahaan=dosen.id_dosen where kp.dosen_pemb = dosen.id_dosen)', 'left');
            $this->db->where('pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Tidak Setujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Tidak Setujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        } elseif ($user['role'] == 'Mahasiswa') {
            $data = $this->db->select('*')->from('user')->join('mahasiswa', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp left join dosen on dosen.id_dosen = kp.dosen_pemb where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= (select perusahaan.id_perusahaan from kp join perusahaan on kp.id_perusahaan=perusahaan.id_perusahaan where kp.id_kp = pemeriksa2.id_kp)', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=(select dosen.id_dosen from kp join dosen on kp.id_perusahaan=dosen.id_dosen where kp.dosen_pemb = dosen.id_dosen)', 'left');
            $this->db->where('pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Tidak Setujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        }
        // return print_r($this->db->last_query());
        return $kp;
    }
}
