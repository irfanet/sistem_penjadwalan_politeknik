<?php

Class Pengawas_perhari_model extends CI_Model{

    public $semester;
    public $tahun_ajaran;

    public function __construct(){
        parent::__construct();
        $this->getSet();
      }

    public function opt_jadwal(){
        // $this->getSet();
        return $this->db->query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' group by harijamtes ORDER BY jam,jadwal.id ASC")->result_array();
    }
    public function filterPengawas(){
        $this->getSet();
        $post = $this->input->post();
        $jenis = $post["keperluan"];
        $hariJamTes = $post["hariJamTes"];  
            if($hariJamTes=="All"){
                $queryHari = $this->db->query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal
                WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
                group by harijamtes ORDER BY jam,jadwal.id ASC");
            }else{
                $queryHari = $this->db->query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal 
                WHERE CONCAT(haritanggal,'+',jam)='$hariJamTes'
                AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran' 
                Group by harijamtes ORDER BY jam,jadwal.id ASC");
            }

        return $queryHari->result_array();
    }
    public function filterPengganti(){
        $post = $this->input->post();
        $hariJamTes = $post["hariJamTes"];  
        if($hariJamTes=="All"){
            $queryHari = $this->db->query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal 
            WHERE semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
            group by harijamtes ORDER BY jam,jadwal.id ASC");
        }else{
            $queryHari = $this->db->query("SELECT haritanggal, jam, CONCAT(haritanggal,'+',jam) as harijamtes FROM jadwal 
            WHERE CONCAT(haritanggal,'+',jam)='$hariJamTes' 
            AND semester='$this->semester' AND tahun_ajaran='$this->tahun_ajaran'
            Group by harijamtes ORDER BY jam,jadwal.id ASC");
        }
        return $queryHari->result_array(); 
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