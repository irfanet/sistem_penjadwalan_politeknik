<?php

Class Matkul_model extends CI_Model{

    private $semester;
    private $tahun_ajaran;

    public function tampilAllMatkul(){
        $this->getSet();
        return $this->db->query("select * from matkul where semester='$this->semester' and tahun_ajaran='$this->tahun_ajaran' ")->result_array();
    }
    public function tampilMatkul($prodi){
        $this->getSet();
        return $this->db->query("select * from matkul where semester='$this->semester' and tahun_ajaran='$this->tahun_ajaran' and prodi='$prodi' ")->result_array();
    }

    public function tambahData(){
        $data = array(
            'id_kelas' => $this->input->post('kelas',TRUE),
            'nama_matkul' => $this->input->post('nama',TRUE),
            'jenis_matkul' => $this->input->post('jenis_matkul',TRUE)
        );

        $this->db->insert('matkul',$data);
    }

    public function hapusData($id){
        $this->db->where('id',$id);
        $this->db->delete('matkul');
    }

    public function getMatkulById($id){
        return $this->db->query("select * from matkul where id='$id'")->row_array();
    }

    public function editData(){
        $data = array(
            'id_kelas' => $this->input->post('kelas',TRUE),
            'nama_matkul' => $this->input->post('nama',TRUE),
            'jenis_matkul' => $this->input->post('jenis_matkul',TRUE)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('matkul',$data);
    }
    public function getSet()
    {
        $this->load->model('setting_model');
        $set = $this->setting_model->getSetting();
        foreach($set as $hasil){
          $semester = $hasil->semester;
          $tahun_ajaran = $hasil->tahun_ajaran;
        }
        $this->semester = $semester;
        $this->tahun_ajaran = $tahun_ajaran;
        // return array('semester' => $semester, 'tahun_ajaran' => $tahun_ajaran);
    
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
        $this->db->insert_batch('matkul', $data);
      }


}