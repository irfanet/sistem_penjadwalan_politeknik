<?php

class Pengawas_cadangan_model extends CI_Model
{
    private $semester;
    private $tahun_ajaran;

    public function tampilAll($semester, $tahun_ajaran)
    {
        return $this->db->query("select * from pengawas_cadangan where semester='$semester' && tahun_ajaran='$tahun_ajaran'")->result_array();
    }
    public function upload_file($filename)
    {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './assets/upload/csv/';
        $config['allowed_types'] = 'csv';
        $config['max_size']  = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }

    // Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
    public function insert_multiple($data)
    {
        $this->db->insert_batch('pengawas_cadangan', $data);
    }

    public function tambahData(){
        $this->getSet();
          $data = array(
            //   'id' => $this->input->post('nama',TRUE),
              'nidn' => $this->input->post('nidn',TRUE),
              'nama_singkat' => $this->input->post('nama',TRUE),
              'semester' => $this->semester,
              'tahun_ajaran' => $this->tahun_ajaran
          );
  
          $this->db->insert('pengawas_cadangan',$data);
      }
  
      public function hapusData($id){
          $this->db->where('id',$id);
          $this->db->delete('pengawas_cadangan');
      }
  
      public function getPengawasById($id){
          return $this->db->query("select * from pengawas_cadangan where id='$id'")->row_array();
      }
  
      public function editData(){
        $this->getSet();
          $data = array(
                //   'id' => $this->input->post('nama',TRUE),
                'nidn' => $this->input->post('nidn',TRUE),
                'nama_singkat' => $this->input->post('nama',TRUE),
                'semester' => $this->semester,
                'tahun_ajaran' => $this->tahun_ajaran
          );
  
          $this->db->where('id', $this->input->post('id'));
          $this->db->update('pengawas_cadangan',$data);
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
}
