<?php

Class Ruang_kelas_model extends CI_Model{

    public function tampilAll(){
        return $this->db->query("select * from ruang_kelas order by id desc")->result_array();
    }

    public function tambahData(){
        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'kelompok' => $this->input->post('kelompok',TRUE)
        );

        $this->db->insert('ruang_kelas',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('ruang_kelas');
    }

    public function getdataById($id){
        return $this->db->query("select * from ruang_kelas where id='$id'")->row_array();
    }

    public function editData(){
        $data = array(
            'nama' => $this->input->post('nama',TRUE),
            'kelompok' => $this->input->post('kelompok',TRUE)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('ruang_kelas',$data);
    }

    
    public function view(){
        return $this->db->get('siswa')->result(); // Tampilkan semua data yang ada di tabel siswa
      }
      
      // Fungsi untuk melakukan proses upload file
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
        $this->db->insert_batch('ruang_kelas', $data);
      }

}