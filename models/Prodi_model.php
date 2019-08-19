<?php

Class Prodi_model extends CI_Model{

    public function tampilAllProdi(){
        return $this->db->query("select * from prodi order by id desc")->result_array();
    }

    public function tambahData(){

        // maksudnya true itu untuk protect, supaya sistem tdk bsa disisipi script
        $data = array(
            'kode' => $this->input->post('kode',TRUE),
            'nama' => $this->input->post('nama',TRUE)
        );

        $this->db->insert('prodi',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('prodi');
    }

    public function getProdiById($id){
        return $this->db->query("select * from prodi where id='$id'")->row_array();
    }

    public function editProdi($id){
        
        $data = array(
            'kode' => $this->input->post('kode',TRUE),
            'nama' => $this->input->post('nama',TRUE)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('prodi',$data);
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
        $this->db->insert_batch('prodi', $data);
      }


}