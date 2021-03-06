<?php

class Model_All extends CI_Model
{
    public function num_sidang()
    {
        $mhs = $this->Model_All->get_mahasiswaid();
        $riwayat = $this->db->where('id_mahasiswa', $mhs['id_mahasiswa'])
            ->get('sidang')->num_rows();
        return $riwayat;
    }

    public function get_perusahaan()
    {
        $per = $this->db->get('perusahaan')->result();
        return $per;
    }

    public function get_mahasiswaid()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->db->select('mahasiswa.*, dosen.nama as dosenwali')->from('mahasiswa')->join('dosen', 'dosen.id_dosen = mahasiswa.dosen_wali', 'left')->where('nrp = ' . $user['username'] . '')->get()->row_array();
        return $mhs;
    }

    public function get_dosenid()
    {
        $user = $this->session->userdata('user');
        $mhs = $this->db->select('dosen.*')->from('dosen')->where('nik = ' . $user['username'] . '')->get()->row_array();
        return $mhs;
    }

    public function get_dosen()
    {
        $dsn = $this->db->get('dosen')->result();
        return $dsn;
    }

    public function get_kp()
    {
        $mhs = $this->Model_All->get_mahasiswaid();
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.status, kp.status2, kp.dosen_pemb')->from('kp');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.id_mahasiswa = ' . $mhs['id_mahasiswa'] . '');
        $this->db->order_by('kp.id_kp', 'desc');
        $kp = $this->db->get()->row_array();
        return $kp;
        // return print_r($this->db->last_query($kp));
    }

    public function num_row_kp()
    {
        $user = $this->Model_All->get_dosenid();
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.status, kp.status2, mahasiswa.nama, mahasiswa.nrp')->from('kp');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=kp.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.dosen_pemb = ' . $user['id_dosen'] . '');
        $kp = $this->db->get()->num_rows();
        return $kp;
    }

    public function num_row_sidang()
    {
        $user = $this->Model_All->get_dosenid();
        $this->db->select('mahasiswa.*, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, sidang.id_sidang, sidang.judul, sidang.tanggal, sidang.tgl_pengajuan, sidang.link, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng')->from('sidang');
        $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=sidang.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
        $this->db->where('sidang.dosen_png = ' . $user['id_dosen'] . '');
        $kp = $this->db->get()->num_rows();
        return $kp;
    }

    public function get_kp_dsn()
    {
        $user = $this->Model_All->get_dosenid();
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.status, kp.status2, mahasiswa.nama, mahasiswa.nrp')->from('kp');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=kp.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.dosen_pemb = ' . $user['id_dosen'] . '');
        $kp = $this->db->get()->result();
        return $kp;
    }

    public function get_bimbid($id)
    {
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.status, kp.status2, mahasiswa.nama, mahasiswa.nrp, bimbingan.*')->from('kp');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=kp.id_mahasiswa', 'left');
        $this->db->join('bimbingan', 'bimbingan.id_kp=kp.id_kp', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.id_kp = ' . $id . '');
        $kp = $this->db->get()->result();
        return $kp;
    }

    public function get_bimbmhs()
    {
        $mhs = $this->Model_All->get_mahasiswaid();
        $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.status, kp.status2, mahasiswa.nama, mahasiswa.nrp, bimbingan.*')->from('kp');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=kp.id_mahasiswa', 'left');
        $this->db->join('bimbingan', 'bimbingan.id_kp=kp.id_kp', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
        $this->db->where('kp.id_mahasiswa = ' . $mhs['id_mahasiswa'] . '');
        $kp = $this->db->get()->result();
        return $kp;
    }

    public function get_sidang()
    {
        $mhs = $this->Model_All->get_mahasiswaid();
        $this->db->select('mahasiswa.*, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, sidang.id_sidang, sidang.judul, sidang.tanggal, sidang.tgl_pengajuan, sidang.link, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng')->from('sidang');
        $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=sidang.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
        $this->db->where('sidang.id_mahasiswa = ' . $mhs['id_mahasiswa'] . '');
        $kp = $this->db->get()->row_array();
        return $kp;
    }
    public function get_sidang_mhs()
    {
        $mhs = $this->Model_All->get_mahasiswaid();
        $this->db->select('mahasiswa.*, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, sidang.id_sidang, sidang.judul, sidang.tanggal, sidang.tgl_pengajuan, sidang.link, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng')->from('sidang');
        $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=sidang.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
        $this->db->where('sidang.id_mahasiswa = ' . $mhs['id_mahasiswa'] . '');
        $kp = $this->db->get()->result();
        return $kp;
    }

    public function get_sidang_dsn()
    {
        $user = $this->Model_All->get_dosenid();
        $this->db->select('mahasiswa.*, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp  where kp.dosen_pemb = id_dosen) as nama_pemb, sidang.id_sidang, sidang.judul, sidang.tanggal, sidang.tgl_pengajuan, sidang.link, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng')->from('sidang');
        $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
        $this->db->join('mahasiswa', 'mahasiswa.id_mahasiswa=sidang.id_mahasiswa', 'left');
        $this->db->join('perusahaan', 'perusahaan.id_perusahaan=kp.id_perusahaan', 'left');
        $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
        $this->db->where('sidang.dosen_png = ' . $user['id_dosen'] . '');
        $kp = $this->db->get()->result();
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

    public function pemeriksa2_sidang()
    {
        $last = $this->db->select('id_sidang')
            ->order_by('id_sidang', 'desc')
            ->limit(1)
            ->get('sidang')->row_array();
        $koor = $this->db->select('*')->from('user')->where('role = "Koordinator"')->get()->row_array();
        $pemeriksa = $this->db->select('*')->from('dosen')->where('nik=' . $koor['username'] . '')->get()->row_array();
        $data = [
            'id_dsn' => $pemeriksa['id_dosen'],
            'id_sidang' => $last['id_sidang'],
            'statuspemeriksa2' => 'Tertunda'
        ];
        // print_r($data);
        $this->db->insert('pemeriksa2', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function pemeriksa_sidang()
    {
        $last = $this->db->select('id_sidang')
            ->order_by('id_sidang', 'desc')
            ->limit(1)
            ->get('sidang')->row_array();
        $data = [
            'id_dsn' => $_POST['dosen'],
            'id_sidang' => $last['id_sidang'],
            'statuspemeriksa' => 'Menunggu'
        ];
        // print_r($data);
        $this->db->insert('pemeriksa', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        }

        return false;
    }

    public function pengirim_sidang()
    {
        $last = $this->db->select('id_sidang')
            ->order_by('id_sidang', 'desc')
            ->limit(1)
            ->get('sidang')->row_array();
        $data = [
            'id_mhs' => $_POST['id_mhs'],
            'id_sidang' => $last['id_sidang'],
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
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
            $this->db->where('pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();

            $data = $this->db->select('*')->from('user')->join('dosen', 'dosen.nik = user.username', 'left')->where('dosen.nik = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, sidang.id_sidang, sidang.tanggal, sidang.status, sidang.status2, sidang.tgl_pengajuan, sidang.judul, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('sidang', 'sidang.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('pengirim', 'pengirim.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
            $this->db->where('pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Menunggu" AND sidang.status="Menunggu" AND sidang.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Menunggu" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui"');
            $sidang =  $this->db->get()->result();
        } elseif ($user['role'] == 'Mahasiswa') {
            $data = $this->db->select('*')->from('user')->join('mahasiswa', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb ', 'left');
            $this->db->where('pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();

            $this->db->select('kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, sidang.id_sidang, sidang.tanggal, sidang.status, sidang.status2, sidang.tgl_pengajuan, sidang.judul, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('sidang', 'sidang.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('pengirim', 'pengirim.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
            $this->db->where('pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND sidang.status="Menunggu" AND kp.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui"');
            $sidang =  $this->db->get()->result();
        }
        // return print_r($this->db->last_query($kp));
        return array_merge($kp, $sidang);
    }

    public function get_kpid($id)
    {
        $user = $this->session->userdata('user');
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data = $this->db->select('*')->from('user')->join('dosen', 'dosen.nik = user.username', 'left')->where('dosen.nik = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
            $this->db->where('kp.id_kp=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR kp.id_kp=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui" OR kp.id_kp=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR kp.id_kp=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        } elseif ($user['role'] == 'Mahasiswa') {
            $data = $this->db->select('*')->from('user')->join('mahasiswa', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.id_kp, kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = id_dosen) as nama_pemb, kp.tanggal, kp.status, kp.status2, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('kp', 'kp.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('pengirim', 'pengirim.id_kp=pemeriksa2.id_kp', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=kp.dosen_pemb', 'left');
            $this->db->where('kp.id_kp=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Menunggu" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND kp.status="Disetujui" AND kp.status2="Menunggu" OR kp.id_kp=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Disetujui" AND kp.status="Disetujui" AND kp.status2="Disetujui" OR kp.id_kp=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Tidak Disetujui" AND kp.status="Tidak Disetujui" AND kp.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        }
        return $kp;
    }

    public function get_sidangid($id)
    {
        $user = $this->session->userdata('user');
        if ($user['role'] == 'Dosen' || $user['role'] == 'Koordinator') {
            $data = $this->db->select('*')->from('user')->join('dosen', 'dosen.nik = user.username', 'left')->where('dosen.nik = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = dosen.id_dosen) as nama_pemb, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng, sidang.id_sidang, sidang.tanggal, sidang.status, sidang.status2, sidang.tgl_pengajuan, sidang.judul, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('sidang', 'sidang.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('pengirim', 'pengirim.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
            $this->db->where('sidang.id_sidang=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Menunggu" AND sidang.status="Menunggu" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR sidang.id_sidang=' . $id . ' AND pemeriksa.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa.statuspemeriksa="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui" OR sidang.id_sidang=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Menunggu" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR sidang.id_sidang=' . $id . ' AND pemeriksa2.id_dsn=' . $data['id_dosen'] . ' AND pemeriksa2.statuspemeriksa2="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        } elseif ($user['role'] == 'Mahasiswa') {
            $data = $this->db->select('*')->from('user')->join('mahasiswa', 'mahasiswa.nrp = user.username', 'left')->where('mahasiswa.nrp = ' . $user['username'] . '')->get()->row_array();
            $this->db->select('kp.dosen_pemb as id_dosen, perusahaan.nama as nama_per, kp.penugasan, pemeriksa2.id_dsn as pemeriksa2, (select dosen.nama from kp where kp.dosen_pemb = dosen.id_dosen) as nama_pemb, (select dosen.nama from sidang where sidang.dosen_png = dosen.id_dosen) as nama_peng, sidang.id_sidang, sidang.tanggal, sidang.status, sidang.status2, sidang.tgl_pengajuan, sidang.judul, (select mahasiswa.nama from mahasiswa where mahasiswa.id_mahasiswa=pengirim.id_mhs) as nama_mhs, (select dosen.nama from dosen where dosen.id_dosen=pemeriksa2.id_dsn) as nama_dsn, pemeriksa.statuspemeriksa, pemeriksa2.statuspemeriksa2')->from('pemeriksa2');
            $this->db->join('sidang', 'sidang.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('kp', 'kp.id_kp=sidang.id_kp', 'left');
            $this->db->join('pemeriksa', 'pemeriksa.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('pengirim', 'pengirim.id_sidang=pemeriksa2.id_sidang', 'left');
            $this->db->join('perusahaan', 'perusahaan.id_perusahaan= kp.id_perusahaan', 'left');
            $this->db->join('dosen', 'dosen.id_dosen=sidang.dosen_png', 'left');
            $this->db->where('sidang.id_sidang=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND sidang.status="Menunggu" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Menunggu" AND sidang.status="Disetujui" AND sidang.status2="Menunggu" OR sidang.id_sidang=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Disetujui" AND sidang.status="Disetujui" AND sidang.status2="Disetujui" OR sidang.id_sidang=' . $id . ' AND pengirim.id_mhs=' . $data['id_mahasiswa'] . ' AND pengirim.statuspengirim="Tidak Disetujui" AND sidang.status="Tidak Disetujui" AND sidang.status2="Tidak Disetujui"');
            $kp =  $this->db->get()->result();
        }
        return $kp;
    }

    public function dsn_koor()
    {
        $this->db->select('dosen.*, (SELECT COUNT(kp.dosen_pemb) FROM kp where dosen.id_dosen=kp.dosen_pemb) as num_kp, (SELECT COUNT(sidang.dosen_png) FROM sidang where dosen.id_dosen=sidang.dosen_png) as num_sidang')->from('dosen');
        $this->db->join('kp', 'kp.dosen_pemb=dosen.id_dosen', 'left');
        $this->db->join('sidang', 'sidang.dosen_png=dosen.id_dosen', 'left');
        $num =  $this->db->get()->result();
        return $num;
    }
}
