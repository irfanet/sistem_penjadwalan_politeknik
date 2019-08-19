<?php

Class Dashboard_model extends CI_Model{

    public $semester;
    public $tahun_ajaran;
    public function getData($method){
        $this->getSet();
        $this->db->select('haritanggal');
        $this->db->from('jadwal');
        $this->db->where('semester',$this->semester)->where('tahun_ajaran',$this->tahun_ajaran);
        // $this->db->;
        $this->db->order_by('id', $method);
        $this->db->limit('1');
        return $this->db->get()->result();
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