<?php

Class Pegawai_model extends CI_Model{

    public function tampilAllPegawai(){
        return $this->db->query("select a.id, a.nip, a.nama_singkat,a.nama_lengkap, a.jabatan, a.golongan, a.email, a.is_active, b.nama as nama_prodi
                                    from pegawai a left join prodi b on a.id_prodi=b.kode where a.jabatan='Kaprodi' OR a.jabatan='Dosen'  order by a.id desc")->result_array();
    }
    public function tampilPegawai(){
        return $this->db->query("select a.id, a.nip, a.nama_singkat,a.nama_lengkap, a.jabatan, a.email, a.is_active
                                    from pegawai a left join prodi b on a.id_prodi=b.kode where a.jabatan='Panitia' OR a.jabatan='Petugas' order by a.id desc")->result_array();
    }
    public function tampilAll(){
        return $this->db->get("pegawai")->result_array();
    }
    public function tampilJadwal(){
        return $this->db->query("select * from pegawai a inner join pengampu b on a.nama_singkat=b.pengampu group by makul")->result_array();
    }

    public function tambahData(){
        if($this->input->post('jabatan')!="Dosen" || $this->input->post('jabatan')!="Kaprodi"){
            $prodi = NULL;
        }else{
            $prodi = $this->input->post('prodi',TRUE);
        }
        $data  = array(
            // maksudnya true itu untuk protect, supaya sistem tdk bsa disisipi script
            'nip' => $this->input->post('nip',TRUE),
            'nama_singkat' => $this->input->post('nama_singkat',TRUE),
            'nama_lengkap' => $this->input->post('nama_lengkap',TRUE),
            'jabatan' => $this->input->post('jabatan',TRUE),
            'id_prodi' => $prodi,
            'email' => $this->input->post('email',TRUE),
            'password' => password_hash($this->input->post('password1'),PASSWORD_DEFAULT),
            'is_active' => 1
        );

        $this->db->insert('pegawai',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('pegawai');
    }

    public function getPegawaiById($id){
        return $this->db->query("select * from pegawai where id='$id'")->row_array();
    }

    public function editPegawai($id){
        
        $data = array(
            'id_prodi' => $this->input->post('prodi',TRUE),
            'jabatan' => $this->input->post('jabatan',TRUE),
            'is_active' => $this->input->post('status',TRUE)
            
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('pegawai',$data);
    }
    public function upload_file($filename){
        $this->load->library('upload'); // Load librari upload
        
        $config['upload_path'] = './assets/upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size']  = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
      
        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
          // Jika berhasil :
          $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
          return $return;
        }else{
          // Jika gagal :
          $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
          return $return;
        }
      }
      
      // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
      public function insert_multiple($data){
        $this->db->insert_batch('pegawai', $data);
      }

}