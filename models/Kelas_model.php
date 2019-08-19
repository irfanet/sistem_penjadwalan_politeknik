<?php

Class Kelas_model extends CI_Model{

    public function tampilAllKelas(){
        return $this->db->query("select a.id, a.nama_kelas, b.nama as nama_prodi 
                                    from kelas a left join prodi b on a.id_prodi=b.kode order by a.id desc")->result_array();
    }
    public function tampilAllKode(){
        return $this->db->get("kelas")->result_array();
    }

    public function tampilKelas(){
        return $this->db->query("select * from kelas order by id desc")->result_array();
    }

    public function tambahData(){
        $data = array(
            'nama_kelas' => $this->input->post('nama',TRUE),
            'id_prodi' => $this->input->post('prodi',TRUE)
        );

        $this->db->insert('kelas',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('kelas');
    }

    public function getKelasById($id){
        return $this->db->query("select * from kelas where id='$id'")->row_array();
    }

    public function editKelas($id){
        
        $data = array(
            'nama_kelas' => $this->input->post('nama',TRUE),
            'id_prodi' => $this->input->post('prodi',TRUE),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kelas',$data);
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
        $this->db->insert_batch('kelas', $data);
      }


}