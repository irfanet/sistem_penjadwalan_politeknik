<?php

class Pengampu_model extends CI_Model
{
    private $semester;
    private $tahun_ajaran;

    public function tampilAll($semester, $tahun_ajaran)
    {
        return $this->db->query("select * from pengampu where semester='$semester' && tahun_ajaran='$tahun_ajaran'")->result_array();
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
        $this->db->insert_batch('pengampu', $data);
    }
    public function tambahData(){
        $this->getSet();
        $kunci = $this->input->post('makul',TRUE).'-'.$this->input->post('kelas',TRUE);
          $data = array(
            //   'id' => $this->input->post('kelas',TRUE),
              'makul' => $this->input->post('makul',TRUE),
              'kelas' => $this->input->post('kelas',TRUE),
              'pengampu' => $this->input->post('pengampu',TRUE),
              'kunci' => $kunci,
              'semester' => $this->semester,
              'tahun_ajaran' => $this->tahun_ajaran
          );
  
          $this->db->insert('pengampu',$data);
      }
  
      public function hapusData($id){
          $this->db->where('id',$id);
          $this->db->delete('pengampu');
      }
  
      public function getPengampuById($id){
          return $this->db->query("select * from pengampu where id='$id'")->row_array();
      }
  
      public function editData(){
        $this->getSet();
        $kunci = $this->input->post('makul',TRUE).'-'.$this->input->post('kelas',TRUE);
          $data = array(
            'makul' => $this->input->post('makul',TRUE),
            'kelas' => $this->input->post('kelas',TRUE),
            'pengampu' => $this->input->post('pengampu',TRUE),
            'kunci' => $kunci,
            'semester' => $this->semester,
            'tahun_ajaran' => $this->tahun_ajaran
          );
  
          $this->db->where('id', $this->input->post('id'));
          $this->db->update('pengampu',$data);
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
