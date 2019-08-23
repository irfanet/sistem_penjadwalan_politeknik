<?php

Class Jadwal_ujian_model extends CI_Model{
    

    public function tampilAll(){
        // return $this->db->query("select a.id, a.no_absen, a.jam_kelas, a.tgl_ujian, a.semester, a.tahun_ajaran,
        //          b.nama as ruang_kelas, c.nama_matkul, d.nama_kelas, e.nama as nama_pegawai1, f.nama as nama_pegawai2 from jadwal_ujian a 
        // left join ruang_kelas b on a.ruang_kelas = b.id
        // left join matkul c on a.matkul = c.id
        // left join kelas d on a.kelas = d.id
        // left join pegawai e on a.dosen_pengawas1 = e.id
        // left join pegawai f on a.dosen_pengawas2 = f.id order by a.id desc")->result_array();
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)->where('matkul.status',1);
        return $this->db->get()->result();
    }
    public function tampilJadwalSaya(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)->where('matkul.status',1)->where('pengawas',$this->session->userdata('nama'));
        return $this->db->get()->result();
        // $this->db->where('semester', $semester)->where('tahun_ajaran', $tahun_ajaran)->where('pengawas',$this->session->userdata('nama'));
        // return $this->db->get('jadwal')->result();
    }
    public function tampilJadwalKelas($kls){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)->where('jadwal.kelas',$kls)->where('matkul.status',1);
        return $this->db->get()->result();
    }

    public function countJadwal(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)->where('matkul.status',1)->where('jadwal.pengawas',$this->session->userdata('nama'));
        return $this->db->get();
    }
    public function countJadwalAll(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->select('*');
        $this->db->from('jadwal');
        $this->db->join('matkul', 'jadwal.makul = matkul.makul');
        $this->db->where('jadwal.semester', $semester)->where('jadwal.tahun_ajaran', $tahun_ajaran)->where('matkul.status',1);
        return $this->db->get();
    }
    public function countKelas(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->where('semester', $semester)->where('tahun_ajaran', $tahun_ajaran);
        $this->db->group_by("kelas");
        return $this->db->get('jadwal');
    }
    public function countMapel(){
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->db->where('semester', $semester)->where('tahun_ajaran', $tahun_ajaran);
        $this->db->group_by("makul");
        return $this->db->get('jadwal');
    }


    public function tampilMySchedule($id){
        return $this->db->query("select a.id, a.no_absen, a.jam_kelas, a.tgl_ujian, a.semester, a.tahun_ajaran,
                 b.nama as ruang_kelas, c.nama_matkul, d.nama_kelas, e.nama as nama_pegawai1, f.nama as nama_pegawai2 from jadwal_ujian a 
        left join ruang_kelas b on a.ruang_kelas = b.id
        left join matkul c on a.matkul = c.id
        left join kelas d on a.kelas = d.id
        left join pegawai e on a.dosen_pengawas1 = e.id
        left join pegawai f on a.dosen_pengawas2 = f.id where dosen_pengawas1='$id' OR dosen_pengawas2='$id' order by a.id desc")->result_array();
    }

    public function tambahData(){
        $data = array(
            'ruang_kelas' => $this->input->post('ruang_kelas',TRUE),
            'jam_kelas' => $this->input->post('jam_kelas',TRUE),
            'matkul' => $this->input->post('matkul',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'no_absen' => $this->input->post('no_absen',TRUE),
            'dosen_pengawas1' => $this->input->post('dosen_pengawas1',TRUE),
            'dosen_pengawas2' => $this->input->post('dosen_pengawas2',TRUE),
            'tgl_ujian' => $this->input->post('tgl_ujian',TRUE),
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
        );

        $this->db->insert('jadwal_ujian',$data);
    }

    public function editData($id){
        $data = array(
            'ruang_kelas' => $this->input->post('ruang_kelas',TRUE),
            'jam_kelas' => $this->input->post('jam_kelas',TRUE),
            'matkul' => $this->input->post('matkul',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'no_absen' => $this->input->post('no_absen',TRUE),
            'dosen_pengawas1' => $this->input->post('dosen_pengawas1',TRUE),
            'dosen_pengawas2' => $this->input->post('dosen_pengawas2',TRUE),
            'tgl_ujian' => $this->input->post('tgl_ujian',TRUE),
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('jadwal_ujian',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('jadwal_ujian');
    }

    public function getDataById($id){
        return $this->db->query("select * from jadwal_ujian where id= '$id'")->row_array();
    }

    public function tampilAllPegawai(){
        return $this->db->query("select a.id, a.nip, a.nama, a.jabatan, a.email, a.is_active, b.nama as nama_prodi
                                    from pegawai a left join prodi b on a.id_prodi=b.id
                                        where is_active=1 order by a.id desc")->result_array();
    }

    public function tampilPegawaiById($id){
        return $this->db->query("select a.id, a.nip, a.nama, a.jabatan, a.email, a.is_active, b.nama as nama_prodi
                                    from pegawai a left join prodi b on a.id_prodi=b.id
                                        where is_active=1 AND id_prodi='$id' AND jabatan!='Kajur' order by a.id desc")->result_array();
    }

}