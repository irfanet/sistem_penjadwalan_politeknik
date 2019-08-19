<?php

Class Panitia_ujian_model extends CI_Model{

    public function tampilAll(){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id order by a.id desc")->result_array();
    }

    public function tampilAllPegawai(){
        return $this->db->query("select a.id, a.nip, a.nama_lengkap, a.jabatan, a.email, a.is_active, b.nama as nama_prodi
                                    from pegawai a left join prodi b on a.id_prodi=b.kode where is_active=1  order by a.id desc")->result_array();
    } 

    public function tambahData(){
        $data = array(
            'id_pegawai' => $this->input->post('pegawai',TRUE),
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
            'jabatan' => $this->input->post('jabatan',TRUE)
        );

        $this->db->insert('panitia_ujian',$data);
    }

    public function editData($id){
        $data = array(
            'id_pegawai' => $this->input->post('pegawai',TRUE),
            'semester' => $this->input->post('semester',TRUE),
            'tahun_ajaran' => $this->input->post('tahun_ajaran',TRUE),
            'jabatan' => $this->input->post('jabatan',TRUE)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('panitia_ujian',$data);
    }

    public function getPanitiaById($id){
        return $this->db->query("select * from panitia_ujian where id='$id'")->row_array();
    }


    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('panitia_ujian');
    }

      // TAMPIL SPESIFIK
    public function tampilKabid($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Kabid Jurusan'");
    }

    public function tampilSekretaris($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Sekretaris'");
    }

    public function tampilSeksiTempat($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Seksi Tempat'");
    }

    public function tampilKoorSPDJ($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Koordinator Seksi Pelaksana dan Jadwal'");
    }

    public function tampilKoorSNDP($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Koordinator Seksi Naskah dan Pengepakan'");
    }

    public function tampilPA($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Pelaksana Administrasi'");
    }

    public function tampilAnggota1($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Anggota Seksi Pelaksana dan Jadwal'");
    }

    public function tampilAnggota2($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Anggota Seksi Naskah dan Pengepakan'");
    }

    public function tampilPembantu($semester, $tahun_ajaran){
        return $this->db->query("select a.jabatan, a.id, a.semester, a.tahun_ajaran, b.nama_lengkap from panitia_ujian a 
                                    left join pegawai b on a.id_pegawai = b.id where a.semester='$semester' AND a.tahun_ajaran='$tahun_ajaran' AND a.jabatan='Pembantu Umum'");
    }

    

}