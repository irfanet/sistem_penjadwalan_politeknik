<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
                        
class Cari_jadwal_model extends CI_Model {

    public $semester;
    public $tahun_ajaran;
                        
    public function filter($cariJadwal){
        $this->getSet();
        $sqlPerDosen = $this->db->query("SELECT a.id,haritanggal, jam, makul, pengawas, kelas, ruang, kelompok, b.nama_lengkap as nama_lengkap FROM jadwal a inner join pegawai b on pengawas=nama_singkat  WHERE b.nama_lengkap LIKE '%".$cariJadwal."%' AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' order by b.nama_lengkap");
        return $sqlPerDosen->result_array(); 
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
                        
/* End of file Cari_jadwal_model.php */
    
                        