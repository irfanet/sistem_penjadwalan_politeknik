<?php

class Transfer_jadwal_model extends CI_Model
{
  public function view()
  {
    return $this->db->get('jadwal')->result();
  }
  public function upload_file($filename)
  {
    $this->load->library('upload');

    $config['upload_path'] = './assets/upload/excel/';
    $config['allowed_types'] = 'xls';
    $config['max_size']  = '2048';
    $config['overwrite'] = true;
    $config['file_name'] = $filename;

    $this->upload->initialize($config);
    if ($this->upload->do_upload('file')) {
      $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
      return $return;
    } else {
      $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
      return $return;
    }
  }
  public function insert_multiple($data)
  {
    $this->db->insert_batch('jadwal', $data);
  }
  public function add($haritanggal, $jam, $makul, $pengawas, $kelas, $ruang, $kelompok)
  {
    $sql = "INSERT INTO jadwal  VALUES (null,'$haritanggal','$jam', '" . strip_tags($makul) . "','$pengawas','$kelas','$ruang','$kelompok')";
    $this->db->query($sql);
  }
}
